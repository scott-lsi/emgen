@extends('layouts.master')

@section('title', 'People')

@section('content')

<h1>People</h1>

<hr>

<a href="{{ route('person.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create New</a>

<table class="table mt-3">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email Name</th>
            <th>Identifier</th>
            <th>Job Title</th>
            <th>Phone Number</th>
            <th>Templates</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($people as $person)
        <tr>
            <td><a href="{{ route('person.edit', $person->id) }}">{{ $person->name }}</a></td>
            <td>{{ $person->emailname }}</td>
            <td>{{ $person->identifier }}</td>
            <td>{{ $person->job_title }}</td>
            <td>{{ $person->phone_number }}</td>
            <td>
                <ul class="list-unstyled mb-0">
                    @foreach($person->templates as $template)
                    <li><a href="{{ route('template.edit', $template->id) }}">{{ $template->name }}</a></li>
                    @endforeach
                </ul>
            </td>
            <td>{{ date('d-m-Y', strtotime($person->created_at)) }}</td>
            <td>{{ date('d-m-Y', strtotime($person->updated_at)) }}</td>
            <td>
                <form action="{{ route('person.destroy', $person->id) }}" method="post">
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