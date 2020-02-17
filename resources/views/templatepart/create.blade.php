@extends('layouts.master')

@section('title', 'Create Template Part')

@section('content')

<h1>New Template Part</h1>

<form action="{{ route('templatepart.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" class="form-control" name="name">
    </div>
    
    <div class="form-group">
        <label for="type">Type</label>
        <input type="text" id="type" class="form-control" name="type">
    </div>
    
    <div class="form-group">
        <label for="content">Content</label>
        <textarea id="content" class="form-control text-monospace" name="content" rows="20"></textarea>
    </div>

    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create Template Part</button>
</form>

@endsection