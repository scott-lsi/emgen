@extends('layouts.master')

@section('title', 'Create Person')

@section('content')

<h1>New Person</h1>

<form action="{{ route('person.store') }}" method="POST" id="create-person">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" class="form-control" name="name">
    </div>

    <div class="form-group">
        <label for="name">Email Name</label>
        <input type="text" id="emailname" class="form-control" name="emailname">
    </div>

    <div class="form-group">
        <label for="name">Identifier</label>
        <input type="text" id="identifier" class="form-control" name="identifier">
    </div>

    <div class="form-group">
        <label for="name">Job Title</label>
        <input type="text" id="job-title" class="form-control" name="job_title">
    </div>

    <div class="form-group">
        <label for="name">Phone Number</label>
        <input type="text" id="phone-number" class="form-control" name="phone_number">
    </div>

    <hr>

    <h3>Templates</h3>

    <div id="templates">
        @foreach($templates as $id=>$name)
        <div class="btn-group-toggle mb-1" data-toggle="buttons">
            <label class="btn btn-light">
                <input type="checkbox" name="templates[]" value="{{ $id }}"> {{ $name }}
            </label>
        </div>
        @endforeach
    </div>

    <hr>

    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create Person</button>
</form>

@endsection