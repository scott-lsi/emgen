@extends('layouts.master')

@section('title', 'Template Parts')

@section('content')

<h1>Template Parts</h1>

<hr>

<a href="{{ route('templatepart.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create New</a>

<table class="table mt-3">
    <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
    </thead>
    <tbody>
        @foreach($template_parts as $template_part)
        <tr>
            <td><a href="{{ route('templatepart.edit', $template_part->id) }}">{{ $template_part->name }}</a></td>
            <td>{{ $template_part->type }}</td>
            <td>{{ date('d-m-Y H:i:s', strtotime($template_part->created_at)) }}</td>
            <td>{{ date('d-m-Y H:i:s', strtotime($template_part->updated_at)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection