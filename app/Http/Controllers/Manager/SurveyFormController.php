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

        return view('manager.survey-forms.index', [
            'department' => $department,

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
        dd($request->all());

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

            $question = new Question();
            $question->survey_form_id = $surveyForm->id;
            $question->name = $oneChoice['name'];
            $question->is_order_by = $oneChoice['isOrderBy'];
            $question->type = SurveyFormEnum::ONE_CHOICES;
            $question->save();


            foreach ($request->oneChoiceQuestions as $oneChoiceQuestionIndex => $oneChoiceQuestionValue) {
//                foreach ($oneChoiceQuestionValue as $oneChoiceIndex => $oneChoiceValue) {
//                    if ($oneChoiceValue->oneChoiceIndex = $index) {
//                        $answer = new Answer();
//                        $answer->name = $oneChoiceValue->name;
//                        $answer->score = $oneChoiceValue->score;
//                        $answer->question_id = $question->id;
//                        $answer->save();
//                    }
//                }

                    if ($oneChoiceQuestionValue['oneChoiceIndex'] = $index) {
                        $answer = new Answer();
                        $answer->name = $oneChoiceQuestionValue['name'];
                        $answer->score = $oneChoiceQuestionValue['score'];
                        $answer->question_id = $question->id;
                        $answer->save();
                    }
            }
        }
        dd('hji');
    }
}
