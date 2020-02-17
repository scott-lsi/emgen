<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Person;
use App\Template;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = Person::orderBy('name')->with(['templates' => function($q){
            $q->orderBy('name');
        }])->get();

        return view('person.index', compact(
            'people'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = Template::orderBy('name')->pluck('name', 'id');

        return view('person.create', compact(
            'templates'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $person = new Person;
        $person->name = $request->name;
        $person->emailname = $request->emailname;
        $person->identifier = $request->identifier;
        $person->job_title = $request->job_title;
        $person->phone_number = $request->phone_number;
        $person->save();
        
        $person->templates()->attach($request->templates);

        session()->flash('message', [
            'content' => 'New Person Created: ' . $person->name,
            'type' => 'success',
        ]);

        return redirect()->route('person.edit', $person->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = Person::find($id);
        $templates = Template::orderBy('name')->pluck('name', 'id');
        $person_templates = $person->templates->pluck('name', 'id')->toArray();

        return view('person.edit', compact(
            'person',
            'templates',
            'person_templates'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $person = Person::find($id);
        $person->name = $request->name;
        $person->emailname = $request->emailname;
        $person->identifier = $request->identifier;
        $person->job_title = $request->job_title;
        $person->phone_number = $request->phone_number;
        $person->save();
        
        $person->templates()->sync($request->templates);

        session()->flash('message', [
            'content' => $person->name . ' Updated',
            'type' => 'success',
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person = Person::find($id);
        $name = $person->name;

        $person->templates()->detach();
        $person->delete();

        session()->flash('message', [
            'content' => $name . ' Deleted',
            'type' => 'success',
        ]);

        return redirect()->back();
    }
}
