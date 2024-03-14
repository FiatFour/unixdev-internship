<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\SurveyForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
