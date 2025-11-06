@extends('layouts.master')

@section('title','Import')

@section('styles')
  

@endsection


@section('content')

<form action="{{ route('party.import.post') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file" required>
    <button type="submit">Import</button>
</form>


@endsection


