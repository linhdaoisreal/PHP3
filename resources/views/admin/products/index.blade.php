@extends('admin.master')

@section('content')
    <h1>DANH SACH SAN PHAM</h1>

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

    <a class="btn btn-primary my-4" href="{{ route('products.create') }}" role="button">ADD NEW</a>

    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">IS ACTIVE</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>
                            <img src="{{ Storage::url($product->image) }}" alt="" width="100px">
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            @if ($product->is_active)
                                YES
                            @else
                                NO
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">SHOW</a>
                            <a class="btn btn-info" href="{{ route('products.edit', $product->id) }}">EDIT</a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Soft Del</button>
                            </form>

                            <form action="{{ route('forceDestroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hard Del</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
