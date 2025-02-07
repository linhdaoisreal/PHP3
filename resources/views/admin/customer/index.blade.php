@extends('admin.master')

@section('content')
    <h1>DANH SACH KHACH HANG</h1>

    <a class="btn btn-primary my-4" href="{{ route('customers.create') }}" role="button">ADD NEW</a>

    @if (session()->has('success') && session()->get('success'))
        <div class="alert alert-primary" role="alert">
            <strong>Your action now done</strong>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">PHONE</th>
                    <th scope="col">IS_ACTIVE</th>
                    <th scope="col">CREATED_AT</th>
                    <th scope="col">UPDATED_AT</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $customer)
                    <tr class="">
                        <td scope="row">{{ $customer->id }}</td>
                        <td scope="row">{{ $customer->name }}</td>
                        <td scope="row">{{ $customer->email }}</td>
                        <td scope="row">{{ $customer->phone }}</td>
                        <td scope="row">
                            @if ($customer->is_active)
                                <span class="badge bg-primary">ACT</span>
                            @else
                                <span class="badge bg-danger">NOPE</span>
                            @endif
                        </td>
                        <td scope="row">{{ $customer->created_at }}</td>
                        <td scope="row">{{ $customer->updated_at }}</td>
                        <td scope="row">
                            <a class="btn btn-warning" href="{{route('customers.edit', $customer->id)}}">Sửa</a>
                            <a class="btn btn-info" href="{{route('customers.show', $customer->id)}}">Xem</a>

                            <form action="{{route('customers.destroy', $customer->id)}}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger" onclick="return confirm('Sure???')">Soft Del</button>
                            </form>
 
                            <form action="{{route('customers.forceDestroy', $customer->id)}}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger" onclick="return confirm('Sure???')">Hard Del</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
@endsection
