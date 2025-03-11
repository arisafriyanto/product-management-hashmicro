@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <div class="d-flex mx-1 my-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Daftar Transaksi</li>
                        </ol>
                    </nav>
                </div>

                <div class="d-flex justify-content-start mt-2 mb-3">
                    <a href="{{ route('transactions.create') }}" class="btn btn-danger btn-sm">
                        <img src="{{ asset('images/plus-circle.png') }}" alt="Logo Plus">
                        Buat Transaksi
                    </a>
                </div>

                <div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-borderless pt-2 pb-2" id="transactionsTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 10%">No.</th>
                                        <th style="width: 18%">Invoice</th>
                                        <th>Nama Pembeli</th>
                                        <th class="text-center">Jumlah</th>
                                        <th>Total Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions as $index => $transaction)
                                        <tr class="align-middle">
                                            <td class="text-center pe-0 pe-lg-4">{{ $index + 1 }}.</td>
                                            <td>{{ $transaction->invoice }}</td>
                                            <td>{{ $transaction->user->name }}</td>
                                            <td class="text-center pe-0 pe-lg-4">{{ $transaction->total_quantity }}</td>
                                            <td>{{ formatRupiah($transaction->total_price, true) }}</td>
                                            <td>
                                                <a href="{{ route('transactions.show', $transaction->id) }}" title="Lihat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form action="{{ route('transactions.destroy', $transaction->id) }}"
                                                    method="post" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-white"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus produk?');">
                                                        <img src="{{ asset('images/delete.png') }}" style="width: 116%"
                                                            alt="Icon Delete">
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada transaksi tersedia</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#transactionsTable').DataTable();
        });
    </script>
@endsection
