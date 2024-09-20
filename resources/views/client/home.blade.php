@extends('layout')

@section('tittle')
    @isset($cate)
        @if ($cate->id != 0)
            Latest Post By {{$cate->name}} 
        @else
            HOME PAGE
        @endif
        
    @endisset
@endsection

@section('content')
<h1>
    Latest Posts
    @isset($cate)
        @if ($cate->id != 0)
            By {{$cate->name}}
        @endif
    @endisset
</h1>

<div class="row gap-4">
    @foreach ($data as $post)
        <div class="card" style="">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->description }}</p>
                <p class="card-text">Ngày đăng: {{ $post->created_at }}</p>
                <p class="card-text">Mã thể loại: {{ $post->category_id }}</p>
                <a href="{{ url('post/' . $post->id) }}" class="btn btn-primary">Go read It</a>
            </div>
        </div>
    @endforeach
    </div>
@endsection