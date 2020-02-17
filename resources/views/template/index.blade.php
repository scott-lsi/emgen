@extends('layouts.master')

@section('title', 'Templates')

@section('content')

<h1>Templates</h1>

<hr>

<form action="{{ route('template.store') }}" method="post" class="form-inline mb-3">
    @csrf
    <label for="template-name" class="sr-only">Template Name</label>
    <input type="text" name="name" id="template-name" class="form-control mr-2" placeholder="New Template Name">
    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create Template</button>
</form>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Template Parts</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($templates as $template)
        <tr>
            <td><a href="{{ route('template.edit', $template->id) }}">{{ $template->name }}</a></td>
            <td>
                @foreach($template->template_parts as $template_part)
                <a href="{{ route('templatepart.edit', $template_part->id) }}">{{ $template_part->name }}</a><br>
                @endforeach
            </td>
            <td>{{ date('d-m-Y H:i:s', strtotime($template->created_at)) }}</td>
            <td>{{ date('d-m-Y H:i:s', strtotime($template->updated_at)) }}</td>
            <td>
                <form action="{{ route('template.destroy', $template->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-hand-middle-finger"></i> Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection