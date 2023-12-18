@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Products</h1>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ Storage::url($product->image) }}" class="card-img-top img-fluid" style="width: 100%; height:400px;" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Description: {{ $product->description }}</p>
                        <p class="card-text">Price: ${{ $product->price }}</p>
                        <p class="card-text">Stock: {{ $product->stock }}</p>
                    </div>
                </div>
                <br>
            </div>
        @endforeach
    </div>
</div>
@endsection
