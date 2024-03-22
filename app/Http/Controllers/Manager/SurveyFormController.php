<?php

namespace App\Http\Controllers\Manager;

use App\Enums\SurveyFormEnum;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Department;
use App\Models\Question;
use App\Models\SurveyForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SurveyFormController extends Controller
{
    public function index(Request $request)
    {
        $s = $request->s;
        $name = $request->name;

        $lists = SurveyForm::latest('survey_forms.id')
            ->leftJoin('departments', 'departments.id',
                'survey_forms.department_id')
            ->select('survey_forms.*', 'departments.name as department_name')
            ->search($request->s, $request)
            ->paginate(PER_PAGE);
        $departments = Department::select('id', 'name')->where('manager_id', Auth::user()->id)->get();


        return view('manager.survey-forms.index', [
            'departments' => $departments,
            'lists' => $lists,
            's' => $s,
            'name' => $name,
        ]);
    }

    public function create()
    {
        $page_title = __('lang.add') . __('survey_forms.page_title');
        $surveyForm = new SurveyForm();
        $departments = Department::select('id', 'name')->where('manager_id', Auth::user()->id)->get();
        return view(
            'manager.survey-forms.form',
            [
                'page_title' => $page_title,
                'surveyForm' => $surveyForm,
                'departments' => $departments,
            ]
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'surveyName' => [
                'required', 'string', 'max:255',
            ],
            'departmentId' => [
                'required'
            ],
        ], [], [
            'surveyName' => __('survey_forms.name'),
            'departmentId' => __('departments.name'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $surveyForm = new SurveyForm();
        $surveyForm->name = $request->surveyName;
        $surveyForm->department_id = $request->departmentId;
        $surveyForm->created_by_id = Auth::user()->id;
        $surveyForm->save();

        foreach ($request->oneChoices as $index => $oneChoice) {
            $questionOneChoice = new Question();
            $questionOneChoice->survey_form_id = $surveyForm->id;
            $questionOneChoice->name = $oneChoice['name'];
            if ($oneChoice['isOrderBy'] == 1) {
                $questionOneChoice->is_order_by = true;
            } else {
                $questionOneChoice->is_order_by = false;
            }
            $questionOneChoice->type = SurveyFormEnum::ONE_CHOICE;
            $questionOneChoice->save();

            foreach ($request->oneChoiceQuestions as $oneChoiceQuestionIndex => $oneChoiceQuestionValue) {
                if ($oneChoiceQuestionValue['oneChoiceIndex'] == $index) {
                    $answerOneChoice = new Answer();
                    $answerOneChoice->name = $oneChoiceQuestionValue['name'];
                    $answerOneChoice->score = $oneChoiceQuestionValue['score'];
                    $answerOneChoice->question_id = $questionOneChoice->id;
                    $answerOneChoice->save();

                }
            }
        }

        foreach ($request->manyChoices as $index => $manyChoice) {
            $questionManyChoice = new Question();
            $questionManyChoice->survey_form_id = $surveyForm->id;
            $questionManyChoice->name = $manyChoice['name'];
            if ($manyChoice['isOrderBy'] == 1) {
                $questionManyChoice->is_order_by = true;
            } else {
                $questionManyChoice->is_order_by = false;
            }
            $questionManyChoice->type = SurveyFormEnum::MANY_CHOICE;
            $questionManyChoice->save();

            foreach ($request->manyChoiceQuestions as $manyChoiceQuestionIndex => $manyChoiceQuestionValue) {
                if ($manyChoiceQuestionValue['manyChoiceIndex'] == $index) {
                    $answerManyChoice = new Answer();
                    $answerManyChoice->name = $manyChoiceQuestionValue['name'];
                    $answerManyChoice->score = $manyChoiceQuestionValue['score'];
                    $answerManyChoice->question_id = $questionManyChoice->id;
                    $answerManyChoice->save();
                }
            }
        }

        foreach ($request->textChoices as $index => $textChoice) {
            $questionTextChoice = new Question();
            $questionTextChoice->survey_form_id = $surveyForm->id;
            $questionTextChoice->name = $textChoice['name'];
            $questionTextChoice->is_order_by = NULL;
            $questionTextChoice->type = SurveyFormEnum::TEXT_CHOICE;
            $questionTextChoice->save();
        }

        $redirect_route = route('manager.survey-forms.index');
        return $this->responseValidateSuccess($redirect_route);
    }
}
