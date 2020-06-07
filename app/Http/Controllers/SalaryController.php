<?php

namespace App\Http\Controllers;

use App\model\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index() {
        $salary=Salary::find(1);
        $data=['salary' =>$salary];
        return view('salary.index',$data);
    }

    public function update(Request $request) {
        $this->validate($request, [
            'salary' => 'required|numeric|min:1000',
            'over_time' => 'required|numeric|min:1000',
            'benefit' => 'required|numeric|min:1000',
          ]);

          $salary=Salary::find(1);
          $salary->salary=$request->salary;
          $salary->over_time=$request->over_time;
          $salary->benefit=$request->benefit;
          $salary->save();
          return redirect()->Back();
    }
}
