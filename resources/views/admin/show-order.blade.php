@extends('layouts.admin', ['title' => 'Megtekintés'])

@section('content')
<div class="container-fluid mx-lg-5">
    <div class="row">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">#{{ $order->id }} számú rendelés</span>
        </h4>
        <p>Név: {{ $order->name }}</p>
        <p>E-mail: {{ $order->email }}</p>
        <p>Telefonszám: {{ $order->phone }}</p>
        <p>Rendelés dátuma: {{ date('Y.m.d. H:i',strtotime($order->created_at)) }}</p>
        <hr>
        <div class="table-responsive">
            <table class="table table-success table-striped w-50">
                <thead>
                    <tr>
                        <th scope="col">Dátum</th>
                        <th scope="col">Leves</th>
                        <th scope="col">A</th>
                        <th scope="col">B</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    @for ($i = 0; $i < count($order->datum); $i++)
                        @if($product->datum == $order->datum[$i] && ($order->leves[$i] != "" || $order->a_menu[$i] != "" || $order->b_menu[$i] != ""))
                        <tr>
                            <th>{{ $order->datum[$i] }}</th>
                            <td>{{ $order->leves[$i] }}</td>
                            <td>{{ $order->a_menu[$i] }}</td>
                            <td>{{ $order->b_menu[$i] }}</td>
                        </tr>
                        @endif
                        @endfor
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection