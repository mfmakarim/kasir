@extends('layout.app')
@section('content')

<div class="card">
    <div class="card-header">
        Transaksi Pembelian
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Waktu Transaksi</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td><a href="{{route('purchase.show', $transaction)}}">{{$transaction->id}}</a></td>
                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y')}}</td>
                    <td>{{$transaction->total_harga }}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>

@endsection