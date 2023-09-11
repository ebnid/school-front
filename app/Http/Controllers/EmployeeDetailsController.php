<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeDetailsController extends Controller
{
    public function __invoke(Request $request)
    {
        try {

            $employee = Employee::with('educations')->published()->find($request->id);
            if(!$employee) abort(404);

            return view('front.pages.employee-details', compact('employee'));

        }catch(\Exception $e){
            abort(404);
        }
    }
}
