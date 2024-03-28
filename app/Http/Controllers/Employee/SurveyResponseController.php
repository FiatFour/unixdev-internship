<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Department;
use App\Models\EmployeeDepartment;
use App\Models\Question;
use App\Models\SurveyForm;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SurveyResponseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $lists = SurveyForm::leftJoin('departments', 'departments.id',
            'survey_forms.department_id')
            ->leftJoin('employee_departments', 'employee_departments.department_id', 'departments.id')
            ->leftJoin('users', 'users.id', 'employee_departments.user_id')
            ->where('employee_departments.user_id', Auth::user()->id)
            ->select('survey_forms.*')->search($request->s, $request)->get();

        $lists->map(function ($item) {
            $query = SurveyResponse::select('survey_form_id')->where([
                ['survey_form_id', $item->id],
                ['employee_id', Auth::user()->id],
            ])->first();

            if (isset($query->survey_form_id)) {
                if ($query->survey_form_id != null) {
                    $item['responsed'] = true;
                } else {
                    $item['responsed'] = false;
                }
            }
            return $item;
        });

        return view('employee.survey-responses.index', [
            'lists' => $lists,
            'search' => $search,
        ]);
    }

    public function create(SurveyForm $surveyForm)
    {
        $page_title = __('lang.add') . __('survey_forms.page_title');

        $lists = SurveyForm::
        leftJoin('questions', 'questions.survey_form_id', 'survey_forms.id')
            ->leftJoin('answers', 'answers.question_id', 'questions.id')
            ->where('survey_forms.id', $surveyForm->id)
            ->select('survey_forms.id', 'survey_forms.name', 'questions.id as question_id', 'questions.name as question_name', 'questions.type', 'questions.is_order_by', 'answers.id as answers_id', 'answers.name as answers_name', 'answers.score as answers_score',)
            ->get();

        $questions = Question::select('*')->where('survey_form_id', $surveyForm->id)->get();
        $questions->map(function ($item) {
            $query = Answer::select('id', 'name', 'score')->where('question_id', $item->id);
            if ($item->is_order_by == true) {
                $query = $query->orderBy('score');
            }
            $answers = $query->get();
            $item->answers = $answers;

            return $item;
        });

        return view(
            'employee.survey-responses.form',
            [
                'page_title' => $page_title,
                'surveyForm' => $surveyForm,
                'questions' => $questions,
            ]
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Validate radio inputs as array
            'oneChoiceAnswers'    => 'required|array',
            'oneChoiceAnswers.*' => 'required', // This ensures that at least one radio button in each group is selected

            // Validate checkbox inputs as array
            'manyChoiceAnswers'    => 'required|array',
            'manyChoiceAnswers.*.*' => 'required', // This ensures that at least one checkbox in each group is checked

            "textAnswers"    => "required|array",
            "textAnswers.*"  => "required|string",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'test',
                'errors' => $validator->errors(),
            ]);
        }

        $questions = Question::select('id')->where('survey_form_id', $request->surveyFormId)->get();

        foreach ($questions as $questionIndex => $question) {
            foreach ($request->oneChoiceAnswers as $oneChoiceIndex => $oneChoiceAnswerId) {
                if ($oneChoiceIndex == $questionIndex) {
                    $surveyResponse = new SurveyResponse();
                    $surveyResponse->employee_id = Auth::user()->id;
                    $surveyResponse->survey_form_id = $request->surveyFormId;
                    $surveyResponse->question_id = $question->id;
                    $surveyResponse->answer_id = $oneChoiceAnswerId;
                    $surveyResponse->save();
                }
            }
            foreach ($request->manyChoiceAnswers as $manyChoiceIndex => $manyChoiceAnswerIds) {
                if ($manyChoiceIndex == $questionIndex) {
                    foreach ($manyChoiceAnswerIds as $manyChoiceAnswerId) {
                        $surveyResponse = new SurveyResponse();
                        $surveyResponse->employee_id = Auth::user()->id;
                        $surveyResponse->survey_form_id = $request->surveyFormId;
                        $surveyResponse->question_id = $question->id;
                        $surveyResponse->answer_id = $manyChoiceAnswerId;
                        $surveyResponse->save();
                    }
                }
            }
            foreach ($request->textAnswers as $textIndex => $textAnswer) {
                if ($textIndex == $questionIndex) {
                    $surveyResponse = new SurveyResponse();
                    $surveyResponse->employee_id = Auth::user()->id;
                    $surveyResponse->survey_form_id = $request->surveyFormId;
                    $surveyResponse->question_id = $question->id;
                    $surveyResponse->text_answer = $textAnswer;
                    $surveyResponse->save();
                }
            }
        }

        $redirect_route = route('employee.survey-responses.index');
        return $this->responseValidateSuccess($redirect_route);
    }

}
