@extends('templates.mainTemplate')
@section('title', 'R&G - Productos')
@section('header-scripts')
    {!! paginationCSS() !!}
@endsection
@section('content')
<section class="container mb-3 fade-in py-4">
    <p class="title1">PRODUCTOS</p>
    <p class="text-center">Estos productos son solamente para venta por mayor. Podes realizar un pedido desde el formulario de contacto. También ingresando desde <a class="link-dark" href="#">acá</a></p>
    <section class="row m-0 g-3">
        <div class="col-12">
            <h5 class="text-center">CATEGORÍAS</h5>
            <div class="input-group mb-3">
                <span class="input-group-text">Buscar</span>
                <input type="text" class="form-control" id="input_search" placeholder="Categoría a buscar" aria-label="Categoría a buscar">
            </div>              
        </div>
        <div class="col-12">
            <section class="row m-0 g-3" id="content_productos"></section>
        </div>
        <div class="col-12 my-2" id="paginador"></div>
    </section>
</section>
@endsection
@section('footer-scripts')
    {!! paginationJS() !!}
    <script>
        const JSON_CATEGORIAS = JSON.parse('{!! addslashes($json_categorias) !!}');
    </script>
    {!! jsFile('functions\pages\controlCantidadCarrito', false) !!}
@endsection