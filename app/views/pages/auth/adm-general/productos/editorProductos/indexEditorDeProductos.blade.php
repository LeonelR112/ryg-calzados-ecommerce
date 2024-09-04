@extends('templates.mainTemplateAuth')
@section('title', 'R&G - Editor de Productos')
@section('title-page', 'PRODUCTOS')
@section('header-scripts')
    {!! cssFile('lightbox') !!}
    {!! jsFile('classes/FrontTools') !!}
@endsection
@section('content')
    <section class="row m-0 justify-content-center p-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('auth/adm-productos')}}">Productos</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Editor de productos</li>
                </ol>
            </nav>   
        </div>
        <div class="col-12 col-md-6 col-lg-3 text-center">
            <a href="{{route('auth/productos/editor-productos/crear')}}" class="btn btn-primary">+ Nuevo producto</a>
        </div>
        <div class="col-12 col-md-6 col-lg-9">
            <div class="input-group mb-3">
                <span class="input-group-text">Buscar</span>
                <input type="text" class="form-control" id="input_search" placeholder="Nombre del producto" aria-label="Nombre del producto">
            </div>              
        </div>
        <div class="col-12">
            <article class="table-responsive">
                <table class="table table-hover table-sm align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center table-primary" colspan="9">Productos en el sistema</th>
                        </tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Art.</th>
                            <th scope="col" class="text-center">Imagen</th>
                            <th scope="col">Nombre</th>
                            <th scope="col" class="text-center">Stock</th>
                            <th scope="col" class="text-center">Visible</th>
                            <th scope="col" class="text-center">Precio</th>
                            <th scope="col" class="text-center" title="Precio por unidad">Precio Unid.</th>
                            <th scope=""></th>
                        </tr>
                    </thead>
                    <tbody id="tbody_productos"></tbody>
                </table>
            </article>
        </div>
        <div class="col-12 p-2" id="paginador"></div>
    </section>
    <form action="{{route('auth/productos/editor-productos/borrar-producto')}}" method="POST" id="form_del_product">
        <input type="hidden" name="id_producto" id="input_del_id_producto">
    </form>
@endsection
@section("footer-scripts")
    {!! jsFile('lightbox') !!}
    <script>
        const JSON_PRODUCTOS = {!! $json_productos !!};
    </script>
    {!! jsFile('functions/pages/productos/editorProductos/indexEditorProductos', false) !!}
@endsection