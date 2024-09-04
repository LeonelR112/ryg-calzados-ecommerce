@extends('templates.mainTemplateAuth')
@section('title', 'R&G - Usuarios')
@section('title-page', 'USUARIOS')
@section('header-scripts')
@endsection
@section('content')
    <section class="row m-0 g-3">
       <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('auth/usuarios')}}">Usuarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modificar usuario</li>
                </ol>
            </nav>          
       </div>
       <div class="col-12">
            <form action="{{route('auth/usuarios/modificar-usuario')}}" method="POST">
                <input type="hidden" name="id_usuario" value="{{$usuario_existe['id_usuario']}}">
                <section class="row m-0 justify-content-center">
                    <div class="col-12 col-md-10 col-lg-9 col-xxl-8 border shadow-sm p-2 py-4">
                        <h5 class="text-center">Modificar nuevo usuario</h5>
                        <hr>
                        <p class="mb-0 text-center">* campo obligatorio</p>
                        <section class="row m-0 g-2">
                            <div class="col-12 col-lg-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Nombre*</span>
                                    <input type="text" class="form-control" name="nombre" id="input_nombre" value="{{$usuario_existe['nombre']}}" placeholder="" aria-label="" aria-describedby="">
                                    <div class="invalid-feedback" id="msgNombre"></div>
                                </div>                              
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Email*</span>
                                    <input type="email" class="form-control" name="email" value="{{$usuario_existe['email']}}" id="input_email" placeholder="email@email.com" aria-label="email@email.com" aria-describedby="">
                                    <div class="invalid-feedback" id="msgEmail"></div>
                                </div>                              
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Teléfono</span>
                                    <input type="text" class="form-control" id="input_telefono" value="{{$usuario_existe['telefono'] == 0 ? '' : $usuario_existe['telefono']}}" name="telefono" placeholder="" aria-label="" aria-describedby="">
                                    <div class="invalid-feedback" id="msgTelefono"></div>
                                </div>                              
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Contraseña*</span>
                                    <input type="text" class="form-control" id="input_contrasena" name="contrasena" value="{{$usuario_existe['password']}}" placeholder="" aria-label="" aria-describedby="">
                                    <div class="invalid-feedback" id="msgContrasena"></div>
                                </div>                              
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Categoría*</span>
                                    <select class="form-select" name="categoria" aria-label="Default select example">
                                        <option value="4" {{$usuario_existe['categoria'] == 4 ? "selected" : ""}}>Miembro</option>
                                        <option value="1" {{$usuario_existe['categoria'] == 1 ? "selected" : ""}}>Administrador</option>
                                    </select>
                                </div>                              
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Estado*</span>
                                    <select class="form-select" name="estado" aria-label="Default select example">
                                        <option value="A" {{$usuario_existe['estado'] == "A" ? "selected" : ""}}>Activo</option>
                                        <option value="I" {{$usuario_existe['estado'] == "I" ? "selected" : ""}}>Inactivo</option>
                                    </select>
                                </div>                              
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Verificado*</span>
                                    <select class="form-select" name="verificado" aria-label="Default select example">
                                        <option value="S" {{$usuario_existe['verificado'] == "S" ? "selected" : ""}}>Si</option>
                                        <option value="N" {{$usuario_existe['verificado'] == "N" ? "selected" : ""}}>No</option>
                                    </select>
                                </div>                              
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">ID</span>
                                    <input type="text" class="form-control" placeholder="" disabled  value="{{$usuario_existe['id_usuario']}}" aria-label="" aria-describedby="">
                                </div>                              
                            </div>
                            <div class="col-12 d-flex justify-content-center algin-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" id="check_notificacion" name="enviar_notificacion" type="checkbox" value="1" id="check_notificacion">
                                    <label class="form-check-label" style="cursor:pointer" title="Enviar un mensaje de notificación al usuario de que su cuenta fue creada" for="check_notificacion">
                                        Enviar un mensaje de notificación
                                    </label>
                                </div>                              
                            </div>
                            <div class="col-12 d-flex justify-content-center algin-items-center flex-wrap">
                                <button class="btn btn-primary px-4 m-2" type="submit" id="button_submit">Guardar</button>
                                <a href="{{route('auth/usuarios')}}" class="btn btn-dark m-2" title="Cancelar y volver">Cancelar</a>
                            </div>
                        </section>
                    </div>
                </section>
            </form>
       </div>
    </section>
@endsection
@section('footer-scripts')
    {!! jsFile('validadores/pages/usuarios/formUsuarios', false) !!}
@endsection