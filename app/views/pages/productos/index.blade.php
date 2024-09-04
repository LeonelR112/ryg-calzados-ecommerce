@extends('templates.mainTemplate')
@section('title', 'R&G - Catálogo de productos')
@section('header-scripts')

@endsection
@section('content')
<section class="container mb-3 fade-in py-4">
    <p class="title1 mb-0">CATÁLOGO</p>
    <p class="text-center small">(venta por mayor)</p>
    <p class="text-center">En esta sección encontrarás el catálogo de los productos, agrupados por categorías. Seleccione una categoría para poder ver los productos asignados. Caso contrario, tiene la opción para ver todos los productos.</p>
    <section class="row m-0 g-1">
        <div class="col-12">
            <h3 class="text-center">CATEGORÍAS</h3>
        </div>
        <div class="col-12">
            <section class="row m-0 g-3" id="content_categorias">
                @if(count($categorias) > 0)
                    @foreach ($categorias as $categoria)
                    <article class="col-12 col-md-6 col-lg-4 col-xxl-3 d-flex justify-content-end align-items-center flex-column">
                        <div class="card position-relative shadow-sm w-100 h-100 overflow-hidden card-selector">
                            <div class="card-body">
                                <div style="width:100%;height:80px;background-color: {{$categoria['color']}}; position:absolute;top:0px;right:0px;z-index:1;"></div>
                                <div class="d-flex justify-content-end align-items-center flex-column h-100" style="position: relative;z-index: 2">
                                    <div class="text-center w-100 mb-1">{!! $categoria['imagen'] != '' ? '<img src="'. $categoria['imagen'] .'" alt="img_not_found" class="rounded small img-card-table-md" />' : '<i class="bi bi-card-image display-3"></i>' !!}</div>
                                    <h4 class="text-center w-100 text-wrap">{{$categoria['nombrecat']}}</h4>
                                    <div class="w-100"><p class="mb-0 text-center text-wrap small">{{$categoria['descri_c']}}</p></div>
                                    <div class="text-center w-100"><i class="bi bi-hand-index"></i> click para ver</div>
                                </div>
                            </div>
                            <a href="#" class="stretched-link"></a>
                        </div>
                    </article>
                    @endforeach
                @endif

                <article class="col-12 col-md-6 col-lg-4 col-xxl-3 d-flex justify-content-end align-items-center flex-column">
                    <div class="card position-relative shadow-sm w-100 h-100 overflow-hidden card-selector">
                        <div style="width:100%;height:30px;"></div>
                        <div class="card-body">
                            <div class="d-flex justify-content-end align-itmes-center flex-column h-100">
                                <div class="text-center w-100"><i class="bi bi-boxes display-3"></i></div>
                                <h4 class="text-center w-100">VER TODOS LOS PRODUCTOS</h4>
                                <div class="w-100"><p class="mb-0 text-center small">Esta sección tendrá todos los productos disponibles. Incluido un buscador.</p></div>
                                <div class="text-center w-100"><i class="bi bi-hand-index"></i> click para ver</div>
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </div>
        <div class="col-12 my-2" id="paginador"></div>
    </section>
</section>
@endsection
@section('footer-scripts')
    <script>
        const JSON_CATEGORIAS = JSON.parse('{!! addslashes($json_categorias) !!}');
    </script>
@endsection