<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\EmployeeDepartment;
use App\Models\SurveyForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyResponseController extends Controller
{
    public function index(Request $request)
    {
//        $department = Department::where('manager_id', Auth::user()->id)->first();

//        $surveyForms = SurveyForm::select('*')->where()->paginate(PER_PAGE);

        $lists = SurveyForm::leftJoin('departments', 'departments.id',
                'survey_forms.department_id')
             ->leftJoin('employee_departments', 'employee_departments.department_id', 'departments.id')
             ->where('employee_departments.user_id', Auth::user()->id)
             ->select('survey_forms.*')->get();




//            where('user_id',Auth::user()->id)

        dd($lists);
        return view('employee.survey-responses.index', [
//            'department' => $department,
            'lists' => $surveyForms,
        ]);
    }
}
