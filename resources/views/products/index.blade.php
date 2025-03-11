@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <div class="d-flex mx-1 my-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Daftar Produk</li>
                        </ol>
                    </nav>
                </div>

                <div class="d-flex justify-content-start mt-2 mb-3">
                    <a href="{{ route('products.create') }}" class="btn btn-danger btn-sm">
                        <img src="{{ asset('images/plus-circle.png') }}" alt="Logo Plus">
                        Tambah Produk
                    </a>
                </div>

                <div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-borderless pt-2 pb-2" id="productsTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $index => $product)
                                        <tr class="align-middle">
                                            <td class="text-center">{{ $index + 1 }}.</td>
                                            <td>{{ $product->code }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->unit->name }}</td>
                                            <td>{{ formatRupiah($product->price, true) }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                <a href="{{ route('products.edit', $product->id) }}" title="Edit">
                                                    <img src="{{ asset('images/edit.png') }}" alt="Icon Edit">
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="post"
                                                    class="d-inline-block">
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
                                            <td colspan="8" class="text-center">Tidak ada produk tersedia</td>
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
            $('#productsTable').DataTable();
        });
    </script>
@endsection
