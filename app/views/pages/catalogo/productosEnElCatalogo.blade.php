@extends('templates.mainTemplate')
@section('title', 'R&G - ' . $categoria['nombrecat'])
@section('header-scripts')

@endsection
@section('content')
<section class="container mb-3 fade-in py-4">
    <section class="row m-0 g-3">
        <div class="col-12">
            <div class="position-relative overflow-hidden d-flex justify-content-end align-items-center flex-column" style="min-height:220px">
                <div class="card-color-categ-md" style="background-color: {{$categoria['color']}}"></div>
                <article class="position-relative d-flex justify-content-end align-items-center flex-column">
                    @if($categoria['imagen'] != '')
                        <img src="{{$categoria['imagen']}}" class="img-categoria rounded shadow-sm" style="z-index: 2" alt="img_not_found">
                    @else
                        <div class="text-center w-100" style="z-index:2"><i class="bi bi-boxes display-3"></i></div>
                    @endif
                </article>
            </div>
        </div>
        <div class="col-12">
            <h2 class="text-center w-100 my-4">{{$categoria['nombrecat']}}</h2>
            <p class="text-center w-100">{!! $categoria['descri_l'] !!}</p>
        </div>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('catalogo')}}">Catálogo</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$categoria['nombrecat']}}</li>
                </ol>
            </nav>     
            <div class="input-group mb-3" id="content_searcher">
                <span class="input-group-text">Buscar</span>
                <input type="text" class="form-control" id="input_search" placeholder="Buscar producto por nombre..." aria-label="Buscar producto por nombre...">
            </div>              
        </div>
        <div class="col-12">
            <section id="content_products" class="row m-0"></section>
        </div>
        <div class="col-12" id="paginador"></div>
    </section>
</section>
@endsection
@section('footer-scripts')
 
@endsection