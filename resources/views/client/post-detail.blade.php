@extends('layout')

@section('tittle')
    ALL ABOUT POST {{$data->title}}
@endsection

@section('content')
<div class="card" style="">
    <div class="card-body">
        <h5 class="card-title">{{ $data->title }}</h5>
        <p class="card-text">{{ $data->description }}</p>
        <p class="card-text">{{ $data->created_at }}</p>
    </div>
</div>
@endsection