@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <div class="d-flex mx-1 my-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item me-1"><a href="{{ route('units.index') }}">Daftar Satuan</a></li>
                            <li class="breadcrumb-item">
                                <i class="fa-solid fa-angle-right" style="font-size: 14px;"></i>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Satuan</li>
                        </ol>
                    </nav>
                </div>

                <form action="{{ route('units.update', $unit->id) }}" method="POST" class="pt-2">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Satuan</label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg"
                                    value="{{ $unit->name ?? old('name') }}" placeholder="Masukan nama satuan">

                                @error('name')
                                    <small class="text-danger ms-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex mt-3">
                        <a href="{{ route('units.index') }}" class="btn btn-outline-danger px-5 me-3">Kembali</a>
                        <button type="submit" class="btn btn-danger px-5">Edit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
