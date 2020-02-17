@extends('layouts.master')

@section('title', 'Edit Template: ' . $template->name)

@section('content')

<h1>Edit Template: {{ $template->name }}</h1>

<hr>

<form action="{{ route('template.updatename', $template->id) }}" method="post" id="template-name-update" class="form-inline mb-3">
    @csrf
    <label for="template-name" class="sr-only">Template Name</label>
    <input type="text" name="name" id="template-name" class="form-control mr-2" value="{{ $template->name }}">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Template Name</button>
</form>

<hr>

<p class="lead mb-0">Used By:</p>

<ul class="list-inline">
    @foreach($template->people as $person)
    <li class="list-inline-item"><a href="{{ route('person.edit', $person->id) }}">{{ $person->name }}</a></li>
    @endforeach
</ul>

<hr>

<div class="row">
    <div class="col-6">
        <h2>Selected Parts</h2>

        <ul id="selected-template-parts" class="list-group">
            @foreach($this_template_parts as $template_part)
            <li class="list-group-item" data-id="{{ $template_part->id }}">{{ $template_part->name }} ({{ $template_part->type }}) <a href="javascript:;" class="remove-part"><i class="fas fa-minus-circle"></i></a></li>
            @endforeach
        </ul>
    </div>

    <div class="col-6">
        <h2>Unselected Parts</h2>

        <ul id="all-template-parts" class="list-group">
            @foreach($all_template_parts as $template_part)
            <li class="list-group-item" data-id="{{ $template_part->id }}">{{ $template_part->name }} ({{ $template_part->type }}) <a href="javascript:;" class="add-part"><i class="fas fa-plus-circle"></i></a></li>
            @endforeach
        </ul>
    </div>
</div>

<form action="{{ route('template.update', $template->id) }}" method="post" id="template-part-update" hidden>
    @csrf
    @method('PATCH')
    <input type="hidden" name="template_part_order" id="template-part-order">
    <input type="submit" value="submit">
</form>

<hr>

<h2>Preview</h2>

<iframe id="preview"></iframe>

@endsection
