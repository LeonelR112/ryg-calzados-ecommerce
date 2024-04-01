@extends('templates.mainTemplate')
@section('title', 'R&G - Mi carrito')
@section('content')
<section class="container mb-3">
    <h5 class="title1">Mi Carrito</h5>
    <section class="row m-0 g-2">
        <div class="col-12 col-md-6 col-lg-8">
            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Art</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 border">
            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <tr>
                        <th scope="col">Total productos:</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th scope="col">Total:</th>
                        <td>$ 0</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <button class="btn btn-primary btn-sm" type="button" title="Vaciar carrito"><i class="bi bi-cart-x"></i> Vaciar carrito</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</section>
@endsection
@section('footer-scripts')

@endsection