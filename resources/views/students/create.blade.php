@extends('layout')

@section('content')
<h1>Add New Student</h1>
<form action="{{ route('students.store') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <label for="registration_date">Registration Date:</label>
    <input type="date" id="registration_date" name="registration_date" required>
    <button type="submit">Add</button>
</form>
@endsection
