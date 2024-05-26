@extends('templates.mainTemplateAuth')
@section('title', 'Usuarios')
@section('title-page', 'USUARIOS')
@section('header-scripts')
    {!! paginationCSS() !!}
@endsection
@section('content')
    <section class="row m-0 g-3">
        <div class="col-12 col-md-6 col-lg-3 text-center">
            <a href="{{route('auth/usuarios/nuevo-usuario')}}" class="btn btn-primary"><i class="bi bi-person-fill-add"></i> Nuevo usuarios</a>
        </div>
        <div class="col-12 col-md-6 col-lg-9">
            <div class="input-group mb-3">
                <span class="input-group-text">Buscar</span>
                <input type="text" id="input_search" class="form-control" placeholder="Nombre o email del usuario a buscar" aria-label="Nombre o email del usuario a buscar">
            </div>              
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="table-primary text-center" colspan="9">Usuarios registrados en el sistema</th>
                        </tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Creado en</th>
                            <th scope="col">Estado</th>
                            <th scope="col" class="text-center">Verificado</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody_usuarios"></tbody>
                </table>
            </div>
        </div>
        <div id="paginador"></div>
    </section>
@endsection
@section('footer-scripts')
    {!! paginationJS() !!}
    <script>
        const JSON_USUARIOS = {!! $json_usuarios_registrados !!};
    </script>
    {!! jsFile('functions/pages/usuarios/indexUsuarios', false) !!}
@endsection