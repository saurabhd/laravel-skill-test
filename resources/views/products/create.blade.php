@extends('layouts.app')

@section('content')
<div class="container">
    <form id="product-form" action="{{url('/product/store')}}" method="POST">
     
        {{ csrf_field() }}
     
        <div class="form-group">
            <label for="product">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name">
        </div>
     
        <div class="form-group">
            <label for="product">Quantity</label>
            <input type="number" min="0" step="1" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity in stock">
        </div>
     
        <div class="form-group">
            <label for="product">Price</label>
            <input  type="number" step="any" class="form-control" id="price" name="price" placeholder="Enter Price per item">
        </div>
     
        <div class="form-group">
            <input class="btn btn-lg btn-primary" id="submit" type="submit" value="Save" name="submit" />
         </div>
     
    </form>
</div>
@endsection