@extends('templates.mainTemplateAuth')
@section('title', 'R&G - Categorías')
@section('title-page', 'CATEGORIAS')
@section('header-scripts')
    {!! paginationCSS() !!}
@endsection
@section('content')
    <section class="row m-0 g-3 p-2">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('auth/adm-productos')}}">Productos</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Imágenes</li>
                </ol>
            </nav>   
        </div>
        <div class="col-12 col-md-6 col-lg-3 text-center">
            <button class="btn btn-primary" type="button" id="button_open_form_imgs"><i class="bi bi-images"></i> Agregar imágenes</button>
        </div>
        <div class="col-12 col-md-6 col-lg-9">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" placeholder="Buscar imagenes">
            </div>              
        </div>
        <div class="col-12">
            <p class="text-center">Imágenes guardadas en el sistema</p>
            <hr>
            <section class="row m-0 g-3" id="content_images"></section>
        </div>
        <div class="col-12 my-2" id="paginador"></div>
    </section>
@endsection
@section("modals")
<!-- Modal form imagnes-->
<section class="modal fade" id="modalFormImagenes" tabindex="-1" aria-labelledby="modalFormImagenesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalFormImagenesLabel">Subir imágenes</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('auth/productos/imagenes/subir-imagenes')}}" method="POST" id="form_images" enctype="multipart/form-data">
                    <section class="row m-0 g-2" style="min-height: 350px">
                        <div class="col-12 text-center">
                            <input type="file" name="files_ready[]" id="input_files" class="d-none" multiple>
                            <label for="input_files" class="btn btn-primary">
                                <i class="bi bi-image"></i><i class="bi bi-hand-index"></i> Seleccionar imágenes
                            </label>
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                            <p class="text-center text-small">Solo las imágnes con extensión <b>bmp, gif, jpg y jpeg</b> son válidas para subir.</p>
                        </div>
                        <div class="col-12">
                            <p class="text-center">Imágenes preparadas para subir:</p>
                        </div>
                        <div class="col-12" id="images_list_ready"></div>
                        <div class="col-12 text-danger text-center" id="msgImagenes"></div>
                        <div class="col-12" id="loading_msg"></div>
                        <div class="col-12 p-2 d-flex justify-content-center align-items-center flex-wrap" id="content_btns_submit"></div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footer-scripts')
    {!! paginationJS() !!}
    <script>
        const JSON_IMAGENES = {!! $json_imagenes !!};
    </script>
    {!! jsFile('functions/pages/productos/gestorImagenes/indexGestorDeImagenes', false) !!}
    {!! jsFile('validadores/pages/auth/productos/validarGestorDeImagenes', false) !!}
@endsection