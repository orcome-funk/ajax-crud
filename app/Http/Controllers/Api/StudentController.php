<?php

namespace App\Http\Controllers\Api;

use App\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        // return request('class_id');
        return StudentClass::where('class_id', request('class_id'))->pluck('name', 'id');
    }
}
