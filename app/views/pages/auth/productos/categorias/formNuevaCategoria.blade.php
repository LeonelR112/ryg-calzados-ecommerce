@extends('templates.mainTemplateAuth')
@section('title', 'R&G - Productos')
@section('title-page', 'CATEGORIAS')
@section('header-scripts')
    {!! paginationCSS() !!}
    {!! trumbowygCSS() !!}
@endsection
@section('content')
    <section class="row m-0 g-3 p-2">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('auth/adm-productos')}}">Productos</a></li>
                  <li class="breadcrumb-item"><a href="{{route('auth/productos/categorias')}}">Categorias</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Nueva categoría</li>
                </ol>
            </nav>              
        </div>
        <div class="col-12">
            <form action="#" method="POST">
                <article class="row justify-content-center m-0 g-2">
                    <div class="col-12 col-md-10 col-lg-7 p-2 border shadow-sm">
                        <h5 class="text-center">Nueva categoría</h5>
                        <hr>
                        <p class="text-muted small">* campo obligatorio.</p>
                        <section class="row g-3 m-0">
                            <div class="col-12 col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">Nombre *</span>
                                    <input type="text" class="form-control" name="nombrecat" id="input_nombrecat" placeholder="" aria-label="">
                                    <div class="invalid-feedback" id="msgNombrecat"></div>
                                </div>                              
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">Orden *</span>
                                    <input type="number" class="form-control" name="orden" id="input_orden" min="0" value="0" step=".01" placeholder="" aria-label="">
                                    <div class="invalid-feedback" id="msgOrden"></div>
                                </div>                              
                            </div>
                            <div class="col-12">
                                <span class="input-group-text">Descripción corta *</span>
                                <textarea class="form-control" name="descri_c" id="input_descri_c" rows="3" placeholder="" aria-label=""></textarea>
                                <div class="invalid-feedback" id="msgDescriC"></div>   
                                <div class="text-end">(<span id="count_chars_descric">0</span>/500)</div>                              
                            </div>
                            <div class="col-12">
                                <span class="input-group-text">Descripción general</span>
                                <textarea class="form-control" name="descri_l" id="input_descri_l" rows="3" placeholder="" aria-label=""></textarea>
                                <div class="invalid-feedback" id="msgDescriL"></div>                                            
                            </div>
                            <div class="col-12 text-center">
                                <input type="hidden" name="imagen" id="input_imagen">
                                <label for="" class="form-label">Imagen para la categoría: <span class="fst-italioc text-muted">(opcional)</span></label><br>
                                <div class="text-center text-danger small" id="msgImagen"></div>
                                <div class="text-center d-flex justify-content-center align-items-center mb-2" id="vista_previa">
                                    <div class="rounded border p-4 text-center" style="width: 100px; height:80px">Sin imagen</div>
                                </div>
                                <button class="btn btn-primary" type="button" id="btn_selector_img" title="Selecionar una imagen"><i class="bi bi-card-image"></i> Seleccionar imagen</button>
                            </div>
                            <div class="col-12 col-md-6 text-center">
                                <label for="" class="form-label">Estado de la categoría:</label><br>
                                <div class="d-flex justify-content-center align-items-center flex-wrap">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="visible" id="checkVisible" value="S" checked>
                                        <label class="form-check-label" for="checkVisible"><span class="badge bg-success">Visible</span></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="visible" id="checkNoVisible" value="N">
                                        <label class="form-check-label" for="checkNoVisible"><span class="badge bg-primary">No visible</span></label>
                                    </div>                                                         
                                </div>
                            </div>
                            <div class="col-12 col-md-6 text-center">
                                <label for="" class="form-label">Color</label><br>
                                <input type="color" name="color" id="input_color" value="#ffffff">
                                <div class="invalir-feedback" id="msgColor"></div>
                            </div>
                            <div class="col-12 my-2 d-flex justify-content-center align-items-center flex-wrap">
                                <button class="btn btn-primary px-4 m-2" type="submit" title="Guardar">Guardar</button>
                                <a href="{{route('auth/productos/categorias')}}" class="btn btn-dark px-2 m-2">Volver</a>
                            </div>
                        </section>
                    </div>
                </article>
            </form>
        </div>
    </section>
@endsection
@section('modals')
    <!-- Modal -->
    <div class="modal fade" id="modalSelectorDeImagenes" tabindex="-1" aria-labelledby="modalSelectorDeImagenesLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalSelectorDeImagenesLabel">Selector de imágenes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <section class="row m-0">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Buscar</span>
                                <input type="text" id="input_search_img" class="form-control" placeholder="" aria-label="">
                            </div>                              
                        </div>
                        <div class="col-12">
                            <section class="row m-0 g-3" id="content_selector_img"></section>
                        </div>
                        <div class="col-12" id="paginador"></div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
    <script>
        const JSON_IMAGENES = {!! $json_imagenes !!};
    </script>
    {!! paginationJS() !!}
    {!! trumbowygJS() !!}
    {!! jsFile('functions/pages/productos/categorias/formCategorias', false) !!}
    {!! jsFile('validadores/pages/auth/productos/formCategorias', false) !!}
@endsection