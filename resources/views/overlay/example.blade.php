@extends('layouts.overlay')

@section('content')
    <x-latest-event :recentList="$followers"/>
@endsection
