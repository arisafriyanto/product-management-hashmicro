@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <div class="d-flex mx-1 my-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Daftar Kategori</li>
                        </ol>
                    </nav>
                </div>

                <div class="d-flex justify-content-start mt-2 mb-3">
                    <a href="{{ route('categories.create') }}" class="btn btn-danger btn-sm">
                        <img src="{{ asset('images/plus-circle.png') }}" alt="Logo Plus">
                        Tambah Kategori
                    </a>
                </div>

                <div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-borderless pt-2 pb-2" id="categoriesTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 15%">No.</th>
                                        <th>Nama Kategori</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $index => $category)
                                        <tr class="align-middle">
                                            <td class="text-center pe-0 pe-lg-4">{{ $index + 1 }}.</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <a href="{{ route('categories.edit', $category->id) }}" title="Edit">
                                                    <img src="{{ asset('images/edit.png') }}" width="12%"
                                                        alt="Icon Edit">
                                                </a>
                                                <form action="{{ route('categories.destroy', $category->id) }}"
                                                    method="post" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-white"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori?');">
                                                        <img src="{{ asset('images/delete.png') }}" style="width: 116%"
                                                            alt="Icon Delete">
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada kategori tersedia</td>
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
            $('#categoriesTable').DataTable();
        });
    </script>
@endsection
