<?php

namespace App\Http\Controllers;

use Illuminate\Http\Employee;

class EmployeeDetailsController extends Controller
{
    public function __invoke(Request $request)
    {
        try {

            $employee = Employee::published()->find($request->id);

            if(!$employee) abort(404);

            return view('front.pages.employee-details', compact('employee'));

        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }
}
