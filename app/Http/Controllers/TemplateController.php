<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Person;
use App\Template;
use App\TemplatePart;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::with(['template_parts' => function($q){
            return $q->orderBy('template_template_part.order');
        }])->orderBy('name')->get();

        return view('template.index', compact(
            'templates'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $template = new Template;
        $template->name = $request->name;
        $template->save();

        session()->flash('message', [
            'content' => 'Template Created: ' . $template->name,
            'type' => 'success',
        ]);

        return redirect()->route('template.edit', $template->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->processTemplate($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the template & who uses it
        $template = Template::with(['people' => function($q){
            return $q->orderBy('name');
        }])->find($id);
        
        // the the parts that are in this template
        $this_template_parts = $template->template_parts()->orderBy('template_template_part.order')->get();
        
        // get all template parts
        $all_template_parts = TemplatePart::orderBy('type')->orderBy('name')->get();
        // remove the ones that are already in the template
        $all_template_parts = $all_template_parts->reject(function($all_template_part) use($template){
            return in_array($all_template_part->id, $template->template_parts->pluck('id')->toArray());
        })->sortBy('name')->sortBy('type');

        return view('template.edit', compact(
            'template',
            'this_template_parts',
            'all_template_parts'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateName(Request $request, $id)
    {
        $template = Template::find($id);
        $template->name = $request->name;
        $template->save();

        session()->flash('message', [
            'content' => 'Template Name Updated',
            'type' => 'success',
        ]);

        return redirect()->back();
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
        $template = Template::find($id);

        $template_part_order = [];
        foreach(json_decode($request->template_part_order) as $order=>$id){
            $template_part_order[$id] = ['order' => $order];
        }

        $template->template_parts()->sync($template_part_order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = Template::find($id);
        $name = $template->name;
        $template->delete();

        session()->flash('message', [
            'content' => $name . ' Deleted',
            'type' => 'success',
        ]);

        return redirect()->back();
    }

    private function processTemplate($id, $person = null)
    {
        $template = Template::with(['template_parts' => function($q){
            return $q->orderBy('template_template_part.order');
        }])->find($id);

        $template_output = '';
        foreach($template->template_parts as $template_part){
            $template_output .= $this->processTemplatePart($template_part->content, $person);
        }

        return $template_output;
    }

    private function processTemplatePart($content, $person = null)
    {
        if(is_null($person)){
            $person = Person::all()->first();
        }
        
        $content = str_replace('##NAME##', $person->name, $content);
        $content = str_replace('##IDENTIFIER##', $person->identifier, $content);
        $content = str_replace('##EMAILNAME##', $person->emailname, $content);
        $content = str_replace('##JOB_TITLE##', $person->job_title, $content);
        $content = str_replace('##PHONE_NUMBER##', $person->phone_number, $content);
        $content = str_replace('##MOBILE_NUMBER##', $person->mobile_number, $content);
        if($person->tpm_trained){
            $content = str_replace('##TPM##', '<img src="http://util.lsipower.co.uk/email/img/tpm.png" alt="TPM Trained" border="0">', $content);
        } else {
            $content = str_replace('##TPM##', '', $content);
        }
        
        return $content;
    }

    public function getGenerate()
    {
        $people = Person::with('templates')->get();
        
        foreach($people as $person){
            foreach($person->templates as $template){
                $filename = $person->name . ' - ' . $template->name . '.html';
                $template_output = $this->processTemplate($template->id, $person);

                Storage::put($filename, $template_output);
            }
        }

        session()->flash('message', [
            'content' => 'Templates Generated',
            'type' => 'success',
        ]);

        return redirect()->back();
    }
}
