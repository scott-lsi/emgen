@extends('layouts.master')

@section('title', 'Edit Person: ' . $person->name)

@section('content')

<h1>Edit Person: {{ $person->name }}</h1>

<hr>

<form action="{{ route('person.update', $person->id) }}" method="POST" id="edit-person">
    @csrf
    @method('PATCH')
    
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" class="form-control" name="name" value="{{ $person->name }}">
    </div>

    <div class="form-group">
        <label for="emailname">Email Name</label>
        <input type="text" id="emailname" class="form-control" name="emailname" value="{{ $person->emailname }}">
    </div>

    <div class="form-group">
        <label for="identifier">Identifier</label>
        <input type="text" id="identifier" class="form-control" name="identifier" value="{{ $person->identifier }}">
    </div>

    <div class="form-group">
        <label for="job-title">Job Title</label>
        <input type="text" id="job-title" class="form-control" name="job_title" value="{{ $person->job_title }}">
    </div>

    <div class="form-group">
        <label for="phone-number">Phone Number</label>
        <input type="text" id="phone-number" class="form-control" name="phone_number" value="{{ $person->phone_number }}">
    </div>

    <div class="form-group">
        <label for="linkedin">LinkedIn URL</label>
        <input type="text" id="linkedin" class="form-control" name="linkedin" value="{{ $person->linkedin }}">
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="tpm_trained" name="tpm_trained" @if($person->tpm_trained) checked @endif>
        <label class="form-check-label" for="tpm_trained">
            TPM Trained
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="nopersonalimage" name="nopersonalimage" @if($person->nopersonalimage) checked @endif>
        <label class="form-check-label" for="nopersonalimage">
            No Personal Image
        </label>
    </div>

    <hr>

    <h3>Templates</h3>

    <div id="templates">
        @foreach($templates as $id=>$name)
        <div class="btn-group-toggle mb-1" data-toggle="buttons">
            @if(array_key_exists($id, $person_templates))
            <label class="btn btn-light active">
                <input type="checkbox" name="templates[]" value="{{ $id }}" checked> {{ $name }}
            </label>
            @else
            <label class="btn btn-light">
                <input type="checkbox" name="templates[]" value="{{ $id }}"> {{ $name }}
            </label>
            @endif
        </div>
        @endforeach
    </div>

    <hr>

    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Person</button>
</form>

@endsection