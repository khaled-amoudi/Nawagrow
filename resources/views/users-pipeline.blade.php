@extends('layouts.app')


@section('content')

    @foreach ($users as $user)
        {{ $user->email }} <br>
    @endforeach

@endsection
