@extends('templates.mainTemplate')
@section('title', 'R&G - ' . $producto['nombreprod'])
@section('header-scripts')
    {!! paginationCSS() !!}
    {!! exZoomJQueryCSS() !!}
    {!! lightboxCSS() !!}
    {!! jsFile('classes/FrontTools') !!}
@endsection
@section('content')
<section class="container mb-3 fade-in py-4">
    <section class="row m-0">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('catalogo')}}">Catálogo</a></li>
                  <li class="breadcrumb-item"><a href="{{route('catalogo/ver/' . $producto['id_categ'])}}">{{$producto['nombrecat']}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{$producto['nombreprod']}}</li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <article class="row m-0 g-3">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="exzoom" id="exzoom">
                        <!-- Images -->
                        <div class="exzoom_img_box" style="background: none; border:none">
                            <ul class='exzoom_img_ul'>
                                @foreach ($imagenes_producto as $img)
                                    @if(preg_match("/(.mp4)$/" ,$img['url_img']))
                                        @php continue;/* Los videos parecen que no son compatible con exzoom */ @endphp
                                        <li><video src="{{$img['url_img']}}" class="" width="100%" autoplay muted controls loop></video></li>
                                    @else
                                        <li><a href="{{$img['url_img']}}" data-lightbox="image-{{$producto['id_producto']}}" data-title="{{$producto['nombreprod']}}"><img src="{{$img['url_img']}}" class="img-fluid" alt="img_not_found"></a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="exzoom_nav"></div>
                        <!-- Nav Buttons -->
                        <p class="exzoom_btn">
                            <a href="javascript:void(0);" class="exzoom_prev_btn"> <i class="bi bi-caret-left-fill"></i></a>
                            <a href="javascript:void(0);" class="exzoom_next_btn"> <i class="bi bi-caret-right-fill"></i></a>
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-7 p-2">
                    <h1 class="text-center">{{$producto['nombreprod']}}</h1>
                    <hr>
                    <p class="fs-5 text-center mb-0">Artículo n°: <br><b>{{$producto['nro_art']}}</b></p>
                    <p class="text-center">{{$producto['descri_c']}}</p>
                    <h5 class="text-center">Talles disponibles</h5>
                    <p class="text-center fs-3 bg-gradient">{!! obtenerLabelsTalles($producto['talles']) !!}</p>
                    <p class="text-center fs-3">Precio mayorista</p>
                    <h3 class="text-center text-price-product">$ {{ number_format($producto['precio'], 0, ",", ".") }}</h3>
                </div>
                <div class="col-12">
                    <h5 class="text-center">Descripción del producto</h5>
                    <hr>
                    {!! $producto['descri_l'] !!}
                </div>
                <div class="col-12 text-center my-3">
                    <button class="btn btn-primary" type="button" title="Volver" onclick="window.history.back()">Volver</button>
                </div>
            </article>
        </div>
    </section>
</section>
@endsection
@section('footer-scripts')
    {!! exZoomJQueryJS() !!}
    {!! paginationJS() !!}
    {!! lightboxJS() !!}
    {!! jsFile('functions/pages/public/catalogo/detallesDeUnProducto', false) !!}
@endsection