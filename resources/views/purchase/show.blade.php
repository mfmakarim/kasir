@extends('layout.app')
@section('content')

<div class="card">
    <div class="card-header">
        Pembelian
    </div>
    <div class="card-body">
        <h5>ID: {{$tran->id}} </h5>
        <h5>Total: {{$tran->total_harga}}</h5>
        <h5>Tanggal: {{\Carbon\Carbon::parse($tran->created_at)->format('d/m/Y')}}</h5>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->barang }}</td>
                    <td>{{ $transaction->jumlah }}</td>
                    <td>{{ $transaction->harga_satuan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
