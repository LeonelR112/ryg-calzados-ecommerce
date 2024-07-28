@extends('templates.mainTemplateAuth')
@section('title', 'R&G - Editor de Productos')
@section('title-page', 'PRODUCTOS')
@section("header-scripts")
    {!! lightboxCSS() !!}
    {!! trumbowygCSS() !!}
    {!! trumbowygPluginCSS('emoji') !!}
    {!! trumbowygPluginCSS('color') !!}
    {!! paginationCSS() !!}
    {!! jsFile('classes/FrontTools') !!}
    {!! jsFile('classes/Validador', false) !!}
@endsection
@section('content')
    <section class="row m-0 justify-content-center p-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('auth/adm-productos')}}">Productos</a></li>
                    <li class="breadcrumb-item"><a href="{{route('auth/productos/editor-productos')}}">Editor de productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo producto</li>
                </ol>
            </nav>   
        </div>
        <div class="col-12">
            <form action="{{route('auth/producto/editar-productos/crear-producto')}}" method="POST">
                <section class="row m-0 justify-content-center">
                    <div class="col-12 col-md-10 col-lg-8 col-xl-8 p-3 border rounded shadow-sm">
                        <h5 class="text-center">Nuevo producto</h5>
                        <hr>
                        <p class="text-muted small text-center">* Campo obligatorio</p>
                        <section class="row m-g g-3">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text">Nombre *</span>
                                    <input type="text" class="form-control" name="nombreprod" id="input_nombreprod" placeholder="" aria-label="">
                                    <div class="invalid-feedback" id="msgNombre"></div>
                                </div>                                  
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">Nro Artículo *</span>
                                    <input type="number" class="form-control" name="nro_art" id="input_nro_art" placeholder="" aria-label="" min="0">
                                    <div class="invalid-feedback" id="msgNroArt"></div>
                                </div>                                  
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">Orden *</span>
                                    <input type="number" class="form-control" name="orden" id="input_orden" placeholder="" aria-label="" min="0" step=".01">
                                    <div class="invalid-feedback" id="msgOrden"></div>
                                </div>                                  
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">Precio por mayor *</span>
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" name="precio" id="input_precio" placeholder="" aria-label="" min="0">
                                    <div class="invalid-feedback" id="msgPrecio"></div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">Precio unitario *</span>
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" name="precio_unitario" id="input_precio_unitario" placeholder="" aria-label="" min="0">
                                    <div class="invalid-feedback" id="msgPrecioUnitario"></div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">Hay stock *</span>
                                    <select class="form-select" name="haystock" aria-label="Default select example">
                                        <option value="S" selected>Si</option>
                                        <option value="N">No</option>
                                    </select>
                                </div>                                  
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">Visible *</span>
                                    <select class="form-select" name="visible" aria-label="Default select example">
                                        <option value="S" selected>Si</option>
                                        <option value="N">No</option>
                                    </select>
                                </div>                                  
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Talles:</label>
                                <div class="d-flex justify-content-start align-items-center flex-wrap p-1">
                                    <div>
                                        <div class="form-check form-check-inline border shadow-sm bg-light">
                                            <input class="form-check-input talles_selector" name="talles[]" type="checkbox" id="check_talle_35" value="35">
                                            <label class="form-check-label cursor-pointer" for="check_talle_35"><span class="badge text-dark fs-5">35</span></label>
                                        </div> 
                                    </div>
                                    <div>
                                        <div class="form-check form-check-inline border shadow-sm bg-light">
                                            <input class="form-check-input talles_selector" name="talles[]" type="checkbox" id="check_talle_36" value="36">
                                            <label class="form-check-label cursor-pointer" for="check_talle_36"><span class="badge text-dark fs-5">36</span></label>
                                        </div> 
                                    </div>
                                    <div>
                                        <div class="form-check form-check-inline border shadow-sm bg-light">
                                            <input class="form-check-input talles_selector" name="talles[]" type="checkbox" id="check_talle_37" value="37">
                                            <label class="form-check-label cursor-pointer" for="check_talle_37"><span class="badge text-dark fs-5">37</span></label>
                                        </div> 
                                    </div>
                                    <div>
                                        <div class="form-check form-check-inline border shadow-sm bg-light">
                                            <input class="form-check-input talles_selector" name="talles[]" type="checkbox" id="check_talle_38" value="38">
                                            <label class="form-check-label cursor-pointer" for="check_talle_38"><span class="badge text-dark fs-5">38</span></label>
                                        </div> 
                                    </div>
                                    <div>
                                        <div class="form-check form-check-inline border shadow-sm bg-light">
                                            <input class="form-check-input talles_selector" name="talles[]" type="checkbox" id="check_talle_39" value="39">
                                            <label class="form-check-label cursor-pointer" for="check_talle_39"><span class="badge text-dark fs-5">39</span></label>
                                        </div> 
                                    </div>
                                    <div>
                                        <div class="form-check form-check-inline border shadow-sm bg-light">
                                            <input class="form-check-input talles_selector" name="talles[]" type="checkbox" id="check_talle_40" value="40">
                                            <label class="form-check-label cursor-pointer" for="check_talle_40"><span class="badge text-dark fs-5">40</span></label>
                                        </div> 
                                    </div>
                                    <div>
                                        <div class="form-check form-check-inline border shadow-sm bg-light">
                                            <input class="form-check-input talles_selector" name="talles[]" type="checkbox" id="check_talle_41" value="41">
                                            <label class="form-check-label cursor-pointer" for="check_talle_41"><span class="badge text-dark fs-5">41</span></label>
                                        </div> 
                                    </div>
                                    <div>
                                        <div class="form-check form-check-inline border shadow-sm bg-light">
                                            <input class="form-check-input talles_selector" name="talles[]" type="checkbox" id="check_talle_es" value="es">
                                            <label class="form-check-label cursor-pointer" for="check_talle_es"><span class="badge text-dark fs-5">Talles especiales</span></label>
                                        </div> 
                                    </div>
                                </div>
                                <div class="text-danger" id="msgTalles"></div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input_descri_c" class="form-label">Descripción corta: *</label>
                                    <textarea class="form-control no-resize" name="descri_c" id="input_descri_c" rows="3"></textarea>
                                    <div class="invalid-feedback" id="msgDescriC"></div>
                                    <div class="text-end small text-muted">
                                        (<span id="count_chars_descri_c">0</span>/1000)
                                    </div>
                                </div>                                  
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input_descri_l" class="form-label">Descripción general:</label>
                                    <textarea class="form-control" name="descri_l" id="input_descri_l" rows="3"></textarea>
                                    <div class="invalid-feedback" id="msgDescriL"></div>
                                </div>                                  
                            </div>
                            <div class="col-12">
                                <hr>
                                <label for="" class="form-label">Categorías para este producto:</label>
                                <div class="d-flex justify-content-start align-items-center flex-wrap p-1">
                                    @foreach($categorias as $categoria)
                                        <div class="form-check form-check-inline border shadow-sm bg-light">
                                            <input class="form-check-input categ_selector" name="ids_categ[]" type="checkbox" id="check_categ_{{$categoria['id_categ']}}" value="{{$categoria['id_categ']}}">
                                            <label class="form-check-label cursor-pointer" for="check_categ_{{$categoria['id_categ']}}"><span class="badge text-dark">{{$categoria['nombrecat']}}</span></label>
                                        </div>             
                                    @endforeach
                                </div>
                                <div class="text-danger small w-100" id="msgCategorias"></div>
                            </div>
                            <div class="col-12">
                                <hr>
                                <label for="" class="form-label">Imágenes:</label>
                                <div id="content_imagenes_seleccionadas" class="row m-0 g-3 mb-3">
                                    <p class="text-muted text-center small fst-italic border p-2"><i class="bi bi-image"></i> <br> -Sin imágenes- </p>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary btn-sm" id="button_selector_img" type="button" title="Abrir selector de imágenes">Agregar imagen</button>
                                </div>
                                <div class="text-center text-danger small" id="msgImagenes"></div>
                                <hr>
                            </div>
                            <textarea name="json_imagenes_prod" id="json_input_imagenes_prod" class="d-none" cols="30" rows="10"></textarea>
                            <div class="col-12 d-flex justify-content-center align-items-center flex-wrap">
                                <button class="btn btn-primary px-4 m-2" id="button_submit" type="submit">Guardar</button>
                                <a href="{{route('auth/productos')}}" class="btn btn-dark px-3 m-2">Cancelar</a>
                            </div>
                        </section>
                    </div>
                </section>
            </form>
        </div>
    </section>
@endsection
@section("modals")
    <!-- Modal -->
    <div class="modal fade" id="modalSelectorDeImagenes" tabindex="-1" aria-labelledby="modalSelectorDeImagenesLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalSelectorDeImagenesLabel">Selector de imágenes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <section class="row m-0 g-3" style="min-height: 350px">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Buscar</span>
                                <input type="text" class="form-control" id="input_search_img" placeholder="Nombre del archivo" aria-label="Nombre del archivo">
                            </div>                              
                        </div>
                        <div class="col-12">
                            <section class="row m-0 g-3" id="content_selector_img"></section>
                        </div>
                        <div class="col-12 p-2" id="paginadorImg"></div>
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
    {!! trumbowygJS() !!}
    {!! trumbowygPluginJS('emoji') !!}
    {!! trumbowygPluginJS('color') !!}
    <script>
        const JSON_IMAGENES_SELECTOR = {!! $json_imagenes_selector !!};
        const PREV_IMAGENES = null;
    </script>
    {!! jsFile('validadores/pages/auth/productos/formProductos', false) !!}
@endsection