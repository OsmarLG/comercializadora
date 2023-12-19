@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Productos de Limpieza</h1>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ Storage::url($product->image) }}" class="card-img-top img-fluid" style="width: 100%; height:400px;" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Description: {{ $product->description }}</p>
                        <p class="card-text">Price: ${{ $product->price }}</p>
                    </div>
                </div>
                <br>
            </div>
        @endforeach
        @if (count($products) == 0)
            <p>No hay Productos para mostrar</p>
        @endif
    </div>
</div>
@endsection
