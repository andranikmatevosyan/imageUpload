@extends('layouts.app')

@section('content')
    <img src="{{ route('image.display', $slug) }}" alt="" title="">
@endsection
