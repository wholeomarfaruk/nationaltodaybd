@extends('layouts.website')



@section('content')
    @livewire('shorts-page',['video'=>$video])
@endsection
