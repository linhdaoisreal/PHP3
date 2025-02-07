@extends('admin.master')

@section('content')
    <h1>CHI TIET SAN PHAM</h1>

    <div class="card">
        <img src="{{Storage::url($product->image)}}" class="card-img-top" width="100px" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{$product->name}}</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
@endsection
