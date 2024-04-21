@extends('templates.mainTemplate')
@section('title', 'R&G - Productos')
@section('content')
<section class="container mb-3 fade-in">
    <h5 class="title1">Productos</h5>
    <p class="content-descript1">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit veritatis fugiat perferendis iusto nulla sapiente impedit sed dolorem consectetur, ipsum sint ducimus asperiores odit illo aliquam quasi eveniet. Quod, error.
    </p>
    <section class="row m-0 g-2">
        @foreach($productos as $producto)
            <div class="col-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-end align-items-center h-100 flex-column">
                            <a href="{{$producto['imagen']}}" data-lightbox="image-{{$producto['id_producto']}}" data-title="{{$producto['nombre']}}"><img src="{{$producto['imagen']}}" alt="ryg-logo" class="img-fluid "></a>
                            <div class="title-product-card"> <span class="small">(Art. {{$producto['nro_art']}})</span> <br>{{$producto['nombre']}}</div>
                            <p class="small text-muted text-center w-100 m-0">Precio unitario</p>
                            <div class="price-product-card">{{$producto['precio'] == 0 ? "Consultar" : "$ " . number_format($producto['precio'], 0, ',', '.')}}</div>
                            <p class="w-100 small text-center">{{$producto['descri_c']}}</p>
                            <div class="w-100 justify-content-center align-items-center flex-column">
                                <div class="w-100 mb-2">
                                    <p class="mb-0 small text-center">Cantidad</p>
                                    <div class="input-group mb-3">
                                        <button class="btn btn-primary btn-sm" type="button" onclick="controlCantidad('restar', '{{$producto['id_producto']}}')" title="Restar uno"><i class="bi bi-dash"></i></button>
                                        <input type="number" class="form-control form-control-sm text-center input_cantidad_control" id="cant_prod_{{$producto['id_producto']}}" value="1" step="1" min="1">
                                        <button class="btn btn-primary btn-sm" type="button" onclick="controlCantidad('sumar', '{{$producto['id_producto']}}')" title="Sumar uno"><i class="bi bi-plus"></i></button>
                                    </div>
                                </div>
                                <button class="btn btn-dark btn-sm w-100 mb-2" type="button" title="Más detalles"><i class="bi bi-info-circle"></i> Ver detalles</button>
                                <button class="btn btn-primary btn-sm w-100" type="button" title="Agregar a mi carrito"><i class="bi bi-cart-plus"></i> Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
</section>
@endsection
@section('footer-scripts')
    {!! jsFile('functions\pages\controlCantidadCarrito', false) !!}
@endsection