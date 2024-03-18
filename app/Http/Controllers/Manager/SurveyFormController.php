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
        $department = Department::where('manager_id', Auth::user()->id)->first();
        $surveyForms = SurveyForm::select('*')->paginate(PER_PAGE);

        return view('manager.survey-forms.index', [
            'department' => $department,
            'lists' => $surveyForms,
        ]);
    }

    public function create()
    {
        $page_title = __('lang.add') . __('survey_forms.page_title');
        $surveyForm = new SurveyForm();

        return view(
            'manager.survey-forms.form',
            [
                'page_title' => $page_title,
                'surveyForm' => $surveyForm,
            ]
        );
    }

    public function store(Request $request)
    {
//        dd($request->all());

        $validator = Validator::make($request->all(), [
            'surveyName' => [
                'required', 'string', 'max:255',
            ],
        ], [], [
            'name' => __('survey_forms.input_survey_name'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $surveyForm = new SurveyForm();
        $surveyForm->name = $request->surveyName;
        $surveyForm->manager_id = Auth::user()->id;
        $surveyForm->save();

        foreach ($request->oneChoices as $index => $oneChoice) {
            $questionOneChoice = new Question();
            $questionOneChoice->survey_form_id = $surveyForm->id;
            $questionOneChoice->name = $oneChoice['name'];
            $questionOneChoice->is_order_by = $oneChoice['isOrderBy'];
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
            $questionManyChoice->is_order_by = $manyChoice['isOrderBy'];
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
