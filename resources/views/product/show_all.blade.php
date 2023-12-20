@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Productos de Limpieza</h3>
    <div class="row">
        <div class="row mb-4">
            <div class="col-md-12">
                <form action="{{ route('products.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar producto" aria-label="Buscar producto" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>
                    </div>
                </form>
                @if ($filtro ?? false)
                    <button class="btn"><a href="/show_products" class="btn btn-primary">Deshacer búsqueda</a></button>
                @endif
            </div>
        </div>
        
        {{ $products->appends(['search' => request()->query('search')])->links('pagination::bootstrap-5') }}
        
        @if ($resultados ?? '')
            <br>
                <p><span class="fw-bold">{{ $resultados}}</span></p>
            <br>
        @endif

        @foreach ($products as $product)
        <div class="col-md-3">
            <div class="card">
                    {{-- <img src="{{ Storage::url($product->image) }}" class="card-img-top img-fluid" style="width: 100%; height:300px;" alt="{{ $product->name }}"> --}}
                    <img src="{{ Storage::url($product->image) }}" class="card-img-top img-fluid" style="cursor:pointer;  width: 100%; height: 350px;" alt="{{ $product->name }}" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $product->id }}">

                    <div class="card-body" style="background:#ccf5ff; font-family: Arial, Helvetica, sans-serif;">
                        <h5 class="card-title fw-bold">{{ Str::limit($product->name, 20) }}</h5>
                        <p class="card-text"><span class="fw-bold">Descripci&oacute;n:</span> {{ Str::limit($product->description, 45) }}</p>
                        {{-- <p class="card-text text-end fw-bold">Precio: ${{ $product->price }}</p> --}}
                    </div>
                </div>
                <br>
            </div>

            {{-- Modal para mostrar la imagen en pantalla completa --}}
            <div class="modal fade" id="imageModal-{{ $product->id }}" tabindex="-1" aria-labelledby="imageModalLabel-{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel-{{ $product->id }}">{{ $product->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ Storage::url($product->image) }}" class="img-fluid mb-2" alt="{{ $product->name }}">
                            <p><strong>Descripción:</strong> {{ $product->description }}</p>
                            {{-- <p><strong>Precio:</strong> ${{ number_format($product->price, 2) }}</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if (count($products) == 0)
        <p>No hay Productos para mostrar</p>
        @endif
        {{ $products->appends(['search' => request()->query('search')])->links('pagination::bootstrap-5') }}
        
        @if ($resultados ?? '')
            <br>
                <p><span class="fw-bold">{{ $resultados}}</span></p>
            <br>
        @endif
    </div>
    {{-- {{ $products->links('pagination::bootstrap-4') }} --}}
    
</div>
@endsection
