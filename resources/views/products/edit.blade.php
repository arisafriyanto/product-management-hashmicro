@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <div class="d-flex mx-1 my-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item me-1"><a href="{{ route('products.index') }}">Daftar Produk</a>
                            </li>
                            <li class="breadcrumb-item">
                                <i class="fa-solid fa-angle-right" style="font-size: 14px;"></i>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
                        </ol>
                    </nav>
                </div>

                <form action="{{ route('products.update', $product->id) }}" method="POST" class="pt-2">
                    @csrf
                    @method('put')

                    <div class="row">

                        <div class="row pe-0">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        Nama Produk <span class="text-danger"> *</span>
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control form-control-lg"
                                        value="{{ $product->name ?? old('name') }}" placeholder="Masukan nama produk">

                                    @error('name')
                                        <small class="text-danger ms-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 pe-0">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">
                                        Kategori <span class="text-danger"> *</span>
                                    </label>
                                    <select class="form-select form-select-lg" name="category_id" id="category_id">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row pe-0">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">
                                        Harga <span class="text-danger"> *</span>
                                    </label>
                                    <input type="text" name="price" id="price" class="form-control form-control-lg"
                                        value="{{ formatRupiah($product->price) ?? old('price') }}"
                                        placeholder="Masukan harga">

                                    @error('price')
                                        <small class="text-danger ms-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 pe-0">
                                <div class="mb-3">
                                    <label for="unit_id" class="form-label">
                                        Satuan <span class="text-danger"> *</span>
                                    </label>
                                    <select class="form-select form-select-lg" name="unit_id" id="unit_id">
                                        <option value="">Pilih Satuan</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}"
                                                {{ $product->unit_id == $unit->id ? 'selected' : '' }}>
                                                {{ $unit->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('unit_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="stock" class="form-label">
                                        Stok <span class="text-danger"> *</span>
                                    </label>
                                    <input type="number" name="stock" id="stock" class="form-control form-control-lg"
                                        value="{{ $product->stock ?? old('stock') }}" placeholder="Masukan harga">

                                    @error('stock')
                                        <small class="text-danger ms-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="d-flex mt-3">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-danger px-5 me-3">Kembali</a>
                            <button type="submit" class="btn btn-danger px-5">Edit</button>
                        </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('products.partials.script')
@endsection
