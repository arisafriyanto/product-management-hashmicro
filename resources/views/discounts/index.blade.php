@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <div class="d-flex mx-1 my-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Daftar Diskon</li>
                        </ol>
                    </nav>
                </div>

                <div class="d-flex justify-content-start mt-2 mb-3">
                    <a href="{{ route('discounts.create') }}" class="btn btn-danger btn-sm">
                        <img src="{{ asset('images/plus-circle.png') }}" alt="Logo Plus">
                        Tambah Diskon
                    </a>
                </div>

                <div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-borderless pt-2 pb-2" id="discountsTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Nilai</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Berakhir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($discounts as $index => $discount)
                                        <tr class="align-middle">
                                            <td class="text-center">{{ $index + 1 }}.</td>
                                            <td>{{ $discount->code }}</td>
                                            <td>{{ $discount->name }}</td>
                                            <td>
                                                @if ($discount->type == 'percentage')
                                                    Persentase
                                                @else
                                                    Nominal
                                                @endif
                                            </td>
                                            <td>
                                                @if ($discount->type == 'percentage')
                                                    {{ formatRupiah($discount->value) }}%
                                                @else
                                                    {{ formatRupiah($discount->value, true) }}
                                                @endif

                                            </td>
                                            @if ($discount->valid_from && $discount->valid_until)
                                                <td>{{ $discount->valid_from->format('d F Y') }}</td>
                                                <td>{{ $discount->valid_until->format('d F Y') }}</td>
                                            @else
                                                <td>Setiap Hari</td>
                                                <td>-</td>
                                            @endif
                                            <td>
                                                <a href="{{ route('discounts.edit', $discount->id) }}" title="Edit">
                                                    <img src="{{ asset('images/edit.png') }}" alt="Icon Edit">
                                                </a>
                                                <form action="{{ route('discounts.destroy', $discount->id) }}"
                                                    method="post" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-white"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus diskon?');">
                                                        <img src="{{ asset('images/delete.png') }}" style="width: 116%"
                                                            alt="Icon Delete">
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada diskon tersedia</td>
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
            $('#discountsTable').DataTable();
        });
    </script>
@endsection
