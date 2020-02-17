@extends('layouts.master')

@section('title', 'Edit Template Part: ' . $template_part->name)

@section('content')

<h1>Update Template Part: {{ $template_part->name }}</h1>

<form action="{{ route('templatepart.update', $template_part->id) }}" method="POST">
    @method('PATCH')
    @csrf
    
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" class="form-control" name="name" value="{{ $template_part->name }}">
    </div>
    
    <div class="form-group">
        <label for="type">Type</label>
        <input type="text" id="type" class="form-control" name="type" value="{{ $template_part->type }}">
    </div>
    
    <div class="form-group">
        <label for="content">Content</label>
        <textarea id="content" class="form-control text-monospace" name="content" rows="20">{{ $template_part->content }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Template Part</button>
</form>

@endsection