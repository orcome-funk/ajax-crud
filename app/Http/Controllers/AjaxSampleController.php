<?php

namespace App\Http\Controllers;

use App\Classtype;

class AjaxSampleController extends Controller
{
    /**
     * Display a listing with Ajax.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $classTypes = Classtype::all();
        // $studentClasses = StudentClass::paginate(25);
        // if ($request->class_id) {
        //     $studentClassQuery = StudentClass::query();
        //     $studentClassQuery->where('class_id', request('class_id'));
        //     $studentClasses = $studentClassQuery->paginate(25);
        // }

        return view('ajax_samples.create', compact('classTypes'));
    }
}
