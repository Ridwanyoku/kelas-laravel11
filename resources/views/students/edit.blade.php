@extends('layout')

@section('content')
<h1>Edit Student</h1>
<form action="{{ route('students.update', $student) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ $student->name }}" required>
    <label for="registration_date">Registration Date:</label>
    <input type="date" id="registration_date" name="registration_date" value="{{ $student->registration_date }}" required>
    <button type="submit">Update</button>
</form>
@endsection
