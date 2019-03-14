<?php

namespace App\Http\Controllers;

use App\Classtype;
use App\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the studentClass.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $classTypes = Classtype::all();
        $studentClasses = StudentClass::paginate(25);
        if ($request->class_id) {
            $studentClassQuery = StudentClass::query();
            $studentClassQuery->where('class_id', request('class_id'));
            $studentClasses = $studentClassQuery->paginate(25);
        }

        return view('student_classes.index', compact('studentClasses', 'classTypes'));
    }

    /**
     * Show the form for creating a new studentClass.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new StudentClass);

        $classTypes = Classtype::all();

        return view('student_classes.create', compact('classTypes'));
    }

    /**
     * Store a newly created studentClass in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new StudentClass);

        $newStudentClass = $request->validate([
            'name'        => 'required|max:60',
            'class_id'    => 'required',
            'description' => 'nullable|max:255',
        ]);
        $newStudentClass['creator_id'] = auth()->id();

        $studentClass = StudentClass::create($newStudentClass);

        return redirect()->route('student_classes.show', $studentClass);
    }

    /**
     * Display the specified studentClass.
     *
     * @param  \App\StudentClass  $studentClass
     * @return \Illuminate\View\View
     */
    public function show(StudentClass $studentClass)
    {
        return view('student_classes.show', compact('studentClass'));
    }

    /**
     * Show the form for editing the specified studentClass.
     *
     * @param  \App\StudentClass  $studentClass
     * @return \Illuminate\View\View
     */
    public function edit(StudentClass $studentClass)
    {
        $this->authorize('update', $studentClass);
        $classTypes = Classtype::all();

        return view('student_classes.edit', compact('studentClass', 'classTypes'));
    }

    /**
     * Update the specified studentClass in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentClass  $studentClass
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, StudentClass $studentClass)
    {
        $this->authorize('update', $studentClass);

        $studentClassData = $request->validate([
            'name'        => 'required|max:60',
            'class_id'    => 'required',
            'description' => 'nullable|max:255',
        ]);
        $studentClass->update($studentClassData);

        return redirect()->route('student_classes.show', $studentClass);
    }

    /**
     * Remove the specified studentClass from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentClass  $studentClass
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, StudentClass $studentClass)
    {
        $this->authorize('delete', $studentClass);

        $request->validate(['student_class_id' => 'required']);

        if ($request->get('student_class_id') == $studentClass->id && $studentClass->delete()) {
            return redirect()->route('student_classes.index');
        }

        return back();
    }
}
