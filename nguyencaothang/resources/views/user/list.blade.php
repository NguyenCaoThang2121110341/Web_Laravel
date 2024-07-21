@extends('layouts.site')
@section('content')
    @foreach ($data as $pt)
        {{ $pt }}
    @endforeach
@endsection