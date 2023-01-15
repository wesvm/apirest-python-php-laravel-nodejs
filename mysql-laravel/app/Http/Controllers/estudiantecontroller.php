<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estudiante;

class estudiantecontroller extends Controller
{
    public function getStudent(){
        return response()->json(estudiante::all(), 200);
    }

    public function getStudentbyId($id){
        $est = estudiante::find($id);

        if(is_null($est)){
            return response()->json(['Message'=>'Not found'], 404);
        }
        return response()->json($est::find($id), 200);
    }

    public function setStudent(Request $request){
        $est = estudiante::create($request->all());
        return response()->json($est, 200);
    }

    public function updStudent(Request $request, $id){
        $est = estudiante::find($id);

        if(is_null($est)){
            return response()->json(['Message'=>'Not found'], 404);
        }

        $est->update($request->all());
        return response()->json($est, 200);
    }

    public function delStudent($id){
        $est = estudiante::find($id);

        if(is_null($est)){
            return response()->json(['Message'=>'Not found'], 404);
        }

        $est->delete();
        return response()->json(['Message'=>'Sucess!'], 200);
    }

}
