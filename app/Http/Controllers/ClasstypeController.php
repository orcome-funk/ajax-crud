<?php

namespace App\Http\Controllers;

use App\Classtype;
use Illuminate\Http\Request;

class ClasstypeController extends Controller
{
    /**
     * Display a listing of the classtype.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $editableClasstype = null;
        $classtypeQuery = Classtype::query();
        $classtypeQuery->where('name', 'like', '%'.request('q').'%');
        $classtypes = $classtypeQuery->paginate(25);

        if (in_array(request('action'), ['edit', 'delete']) && request('id') != null) {
            $editableClasstype = Classtype::find(request('id'));
        }

        return view('classtypes.index', compact('classtypes', 'editableClasstype'));
    }

    /**
     * Store a newly created classtype in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Classtype);

        $newClasstype = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newClasstype['creator_id'] = auth()->id();

        Classtype::create($newClasstype);

        return redirect()->route('classtypes.index');
    }

    /**
     * Update the specified classtype in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classtype  $classtype
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Classtype $classtype)
    {
        $this->authorize('update', $classtype);

        $classtypeData = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $classtype->update($classtypeData);

        $routeParam = request()->only('page', 'q');

        return redirect()->route('classtypes.index', $routeParam);
    }

    /**
     * Remove the specified classtype from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classtype  $classtype
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Classtype $classtype)
    {
        $this->authorize('delete', $classtype);

        $request->validate(['classtype_id' => 'required']);

        if ($request->get('classtype_id') == $classtype->id && $classtype->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('classtypes.index', $routeParam);
        }

        return back();
    }
}
