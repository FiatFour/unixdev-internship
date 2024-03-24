<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\SurveyForm;
use App\Models\SurveyResponse;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getData(Request $request)
    {
        $surveyFormId = $request->surveyFormId;
        $employeeId = $request->employeeId;

        $redirect_route = route('manager.survey-reports.data-only', ['survey_form' => $surveyFormId, 'employeeId' => $employeeId]);
        return response()->json([
            'success' => 'ok',
            'redirect' => $redirect_route
        ]);
    }

    public function dataOnly(Request $request)
    {
        $employeeId = $request->employeeId;
        $surveyFormId = $request->survey_form;

        $surveyForm = SurveyForm::find($surveyFormId);

        if (!isset($surveyForm)) {
            return redirect()->route('manager.survey-forms.index');
        }

        $employees = User::leftJoin('employee_departments', 'employee_departments.user_id', 'users.id')
            ->where('employee_departments.department_id', $surveyForm->department_id)->get();

        $questions = Question::select('*')
            ->where('survey_form_id', $surveyForm->id)
            ->get();

        $questions->map(function ($item) use ($employeeId) {
            $query = Answer::select('answers.*')->where('answers.question_id', $item->id);
            if ($item->is_order_by == true) {
                $query = $query->orderBy('answers.score');
            }

            $answers = $query->get();
            $item->answers = $answers;

            return $item;
        });

        $surveyResponseChoices = SurveyResponse::select('answer_id')
            ->where('employee_id', $employeeId)
            ->where('survey_form_id', $surveyForm->id)
            ->whereNotNull('answer_id')
            ->pluck('answer_id')
            ->toArray();

        $surveyResponseTexts = SurveyResponse::select('question_id', 'text_answer')
            ->where('employee_id', $employeeId)
            ->where('survey_form_id', $surveyForm->id)
            ->whereNull('answer_id')
            ->get();

        $page_title = __('lang.view') . __('survey-forms.page_title');
        return view('manager.survey-forms.data-only', [
                'page_title' => $page_title,
                'surveyForm' => $surveyForm,
                'questions' => $questions,
                'employees' => $employees,
                'employeeId' => $employeeId,
                'surveyResponses' => $surveyResponses,
                'surveyResponseText' => $surveyResponseText,
            ]
        );
    }
}
