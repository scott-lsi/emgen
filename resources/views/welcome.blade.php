@extends('layouts.master')

@section('title', 'LSi E-Mail Template Generator')

@section('content')

<h1>Welcome to the LSi E-Mail Template Generator</h1>

<hr>

<a href="{{ route('template.generate') }}" id="generate-templates-button" class="btn btn-block btn-primary"><i class="fas fa-thumbs-up"></i> Generate Templates</a>

@endsection