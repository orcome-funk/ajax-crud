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

        return view('ajax_samples.create', compact('classTypes'));
    }
}
