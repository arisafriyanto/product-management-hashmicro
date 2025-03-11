@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <div class="d-flex mx-1 my-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item me-1"><a href="{{ route('transactions.index') }}">Daftar Transaksi</a>
                            </li>
                            <li class="breadcrumb-item">
                                <i class="fa-solid fa-angle-right" style="font-size: 14px;"></i>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-sm-12 mb-3 mb-sm-0">
                    <div>
                        <div>
                            <p class="text-muted mb-4">Berikut adalah rincian detail transaksi yang telah dibuat.
                            </p>

                            <div>
                                <h5 class="mb-3">Informasi Transaksi</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>Invoice</th>
                                            <td>{{ $transaction->invoice }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Pembeli</th>
                                            <td>{{ $transaction->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Jumlah</th>
                                            <td>{{ $transaction->total_quantity }} Produk</td>
                                        </tr>
                                        <tr>
                                            <th>Subtotal Harga</th>
                                            <td>{{ formatRupiah($transaction->subtotal_price, true) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Diskon</th>
                                            <td>{{ formatRupiah($transaction->discount, true) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Harga</th>
                                            <td>{{ formatRupiah($transaction->total_price, true) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Pembelian</th>
                                            <td>{{ $transaction->created_at->format('d F Y, H:i') }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h5 class="mt-4">Detail Produk</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Produk</th>
                                            <th>Satuan</th>
                                            <th class="text-center">Jumlah</th>
                                            <th>Harga</th>
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaction->details as $detail)
                                            <tr>
                                                <td>{{ $detail->product->code }}</td>
                                                <td>{{ $detail->product->name }}</td>
                                                <td>{{ $detail->product->unit->name }}</td>
                                                <td class="text-center">{{ $detail->quantity }}</td>
                                                <td>{{ formatRupiah($detail->price, true) }}</td>
                                                <td>{{ formatRupiah($detail->subtotal_price, true) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
