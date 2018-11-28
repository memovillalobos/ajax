<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Validator;

class StudentsController extends Controller
{
    //
    public function index(){
      $students = Student::select(['id', 'first_name', 'last_name'])->get();
      return response()->json(['status' => 'ok', 'students' => $students]);
    }

    public function show(Student $student){
      return response()->json(['status' => 'ok', 'student' => $student]);
    }

    public function store(Request $request){
      $validator = Validator::make($request->all(), [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'phone_number' => 'required',
      ]);
      if($validator->fails()){
        return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()]);
      }
      $student = Student::create($request->all());
      return response()->json(['status' => 'ok', 'student' => $student]);
    }
}
