<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TemplatePart;

class TemplatePartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $template_parts = TemplatePart::orderBy('type')->orderBy('name')->get();

        return view('templatepart.index', compact(
            'template_parts'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('templatepart.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $template_part = new TemplatePart;
        $template_part->name = $request->name;
        $template_part->type = $request->type;
        $template_part->content = $request->content;
        $template_part->save();

        return redirect()->route('templatepart.edit', $template_part->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return TemplatePart::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template_part = TemplatePart::find($id);

        return view('templatepart.edit', compact(
            'template_part'
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
        $template_part = TemplatePart::find($id);

        $template_part->name = $request->name;
        $template_part->type = $request->type;
        $template_part->content = $request->content;
        $template_part->save();

        session()->flash('message', [
            'content' => 'Template Part Updated',
            'type' => 'success',
        ]);

        return redirect()->route('templatepart.edit', $template_part->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
