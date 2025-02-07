@extends('admin.master')

@section('content')
    <h1>CAP NHAT SAN PHAM</h1>

    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-primary" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif

    @if (session()->has('success') && session()->get('success'))
        <div class="alert alert-primary" role="alert">
            SUCCESS
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-primary" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <form method="POST" enctype="multipart/form-data" action="{{ route('products.update', $product) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" value="{{ $product->name }}" name="name" class="form-control" id="">
            </div>

            <div class="mb-3">
                <label class="form-label">description</label>
                <input type="text" value="{{ $product->description }}" name="description" class="form-control"
                    id="">
            </div>

            <div class="mb-3">
                <label class="form-label">price</label>
                <input type="number" value="{{ $product->price }}" name="price" class="form-control" id="">
            </div>

            <div class="mb-3">
                <label class="form-label">quantity</label>
                <input type="number" value="{{ $product->quantity }}" name="quantity" class="form-control" id="">
            </div>

            <div class="mb-3">
                <label class="form-label">image</label>
                <input type="file" value="{{ $product->image }}" name="image" class="form-control" id="">
            </div>

            <div class="mb-3 form-check">
                <label class="form-check-label" for="">Active</label>
                <input value="1" name="is_active" type="checkbox" class="form-check-input" id="">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
