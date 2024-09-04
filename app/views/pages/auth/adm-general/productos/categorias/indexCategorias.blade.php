@extends('templates.mainTemplateAuth')
@section('title', 'R&G - Productos')
@section('title-page', 'CATEGORIAS')
@section('header-scripts')
    {!! paginationCSS() !!}
    {!! lightboxCSS() !!}
    {!! jsFile('classes/FrontTools') !!}
@endsection
@section('content')
    <section class="row m-0 g-3 p-2">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('auth/adm-productos')}}">Productos</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Categorías</li>
                </ol>
            </nav>              
        </div>
        <div class="col-12 col-md-3 text-center">
            <a href="{{route('auth/categorias/nueva-categoria')}}" class="btn btn-primary">+ Nueva categoría</a>
        </div>
        <div class="col-12 col-md-9">
            <div class="input-group">
                <span class="input-group-text">Buscar</span>
                <input type="text" class="form-control" id="input_search" placeholder="Nombre de la categoría" aria-label="Nombre de la categoría">
            </div>              
        </div>
        <div class="col-12">
            <article class="table-responsive">
                <table class="table table-sm table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="table-primary text-center" colspan="6">Categorías guardadas</th>
                        </tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" class="text-center">Imagen</th>
                            <th scope="col">Nombre</th>
                            <th scope="col" class="text-center">Visible</th>
                            <th scope="col" class="text-center">color</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody_categorias"></tbody>
                </table>
            </article>
        </div>
        <div class="col-12" id="paginador"></div>
    </section>
    <form action="{{route('auth/productos/categorias/borrar-categoria')}}" method="POST" id="form_del_categ">
        <input type="hidden" name="id_categ" id="input_del_id_categ">
    </form>
@endsection
@section('footer-scripts')
    {!! paginationJS() !!}
    {!! lightboxJS() !!}
    <script>
        const JSON_CATEGORIAS = {!! $json_categorias !!};
    </script>
    {!! jsFile('functions/pages/productos/categorias/indexAbmCategorias', false) !!}
@endsection