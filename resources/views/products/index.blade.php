

@extends('layouts.app')

@section('content')
<div class="container">
    @if(\Session::has('success'))
        <div class="alert alert-success">
            {{\Session::get('success')}}
        </div>
    @endif
   
    <div class="row">
       <a href="{{url('/create/product')}}" class="btn btn-success">Create Product</a>
       <table class="table table-striped">
        <thead>
            <tr>
              <td>Name</td>
              <td>Quantity</td>
              <td>Price</td>
              <td>Total</td>
              <td>Created At</td>
              <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{$product['name']}}</td>
                <td>{{$product['quantity']}}</td>
                <td>{{$product['price']}}</td>
                <td>{{$product['total_value_number']}}</td>
                <td>{{$product['datetime_submitted']}}</td>
                <td><a href="{{url('/edit/product/') . '/' . $product['datetime_submitted']}}" class="btn">Edit</a></td>
                <!-- <td>Delete</td> -->
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection