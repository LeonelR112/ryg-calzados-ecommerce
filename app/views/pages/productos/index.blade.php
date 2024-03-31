@extends('templates.mainTemplate')
@section('title', 'R&G - Productos')
@section('content')
<section class="container">
    <h5 class="title1">Productos</h5>
    <p class="content-descript1">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit veritatis fugiat perferendis iusto nulla sapiente impedit sed dolorem consectetur, ipsum sint ducimus asperiores odit illo aliquam quasi eveniet. Quod, error.
    </p>
    <section class="row m-0 g-2">
        <div class="col-6 col-md-4 col-lg-4 col-xxl-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center h-100 flex-column">
                        <a href="{{assets('img/productos/exampleProd.jpeg')}}" data-lightbox="image-1" data-title="My caption"><img src="{{assets('img/productos/exampleProd.jpeg')}}" alt="ryg-logo" class="img-fluid"></a>
                        <div class="title-product-card">Producto #1 (Art. 123)</div>
                        <div class="price-product-card">$ 100</div>
                        <p class="w-100 small text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa, voluptate!</p>
                        <div class="w-100 justify-content-center align-items-center flex-column">
                            <div class="w-100 mb-2">
                                <input type="number" class="form-control text-center w-100" value="1" step="1" min="1">
                            </div>
                            <button class="btn btn-dark btn-sm w-100 mb-2" type="button" title="Más detalles"><i class="bi bi-info-circle"></i> Ver detalles</button>
                            <button class="btn btn-primary btn-sm w-100" type="button" title="Agregar a mi carrito"><i class="bi bi-cart-plus"></i> Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection
@section('footer-scripts')

@endsection