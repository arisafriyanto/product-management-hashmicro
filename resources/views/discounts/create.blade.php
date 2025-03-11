@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <div class="d-flex mx-1 my-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item me-1"><a href="{{ route('discounts.index') }}">Daftar Diskon</a>
                            </li>
                            <li class="breadcrumb-item">
                                <i class="fa-solid fa-angle-right" style="font-size: 14px;"></i>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Diskon</li>
                        </ol>
                    </nav>
                </div>

                <form action="{{ route('discounts.store') }}" method="POST" class="pt-2">
                    @csrf

                    <div class="row">

                        <div class="row pe-0">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="code" class="form-label ps-1">
                                        Kode Diskon <span class="text-danger"> *</span>
                                    </label>
                                    <input type="text" name="code" id="code" class="form-control form-control-lg"
                                        value="{{ old('code') }}" placeholder="Masukan kode diskon">

                                    @error('code')
                                        <small class="text-danger ms-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label ps-1">
                                        Nama Diskon <span class="text-danger"> *</span>
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control form-control-lg"
                                        value="{{ old('name') }}" placeholder="Masukan nama diskon">

                                    @error('name')
                                        <small class="text-danger ms-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row pe-0">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label ps-1">
                                        Jenis Diskon <span class="text-danger"> *</span>
                                    </label>
                                    <select class="form-select form-select-lg" name="type" id="type">
                                        <option value="percentage" selected>Persentase (%)</option>
                                        <option value="fixed">Nominal (Rp)</option>
                                    </select>

                                    @error('type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 pe-0">
                                <div class="mb-3">
                                    <label for="value" class="form-label ps-1">
                                        Nilai Diskon <span class="text-danger"> *</span>
                                    </label>
                                    <input type="number" name="value" id="value" class="form-control form-control-lg"
                                        value="{{ old('value') }}" placeholder="Masukan nilai diskon">

                                    @error('value')
                                        <small class="text-danger ms-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row pe-0">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="valid_from" class="form-label ps-1">
                                        Tanggal Mulai
                                    </label>
                                    <input type="date" name="valid_from" id="valid_from"
                                        class="form-control form-control-lg" value="{{ old('valid_from') }}"
                                        placeholder="Masukan nilai diskon">

                                    @error('valid_from')
                                        <small class="text-danger ms-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 pe-0">
                                <div class="mb-3">
                                    <label for="valid_until" class="form-label ps-1">
                                        Tanggal Berakhir
                                    </label>
                                    <input type="date" name="valid_until" id="valid_until"
                                        class="form-control form-control-lg" value="{{ old('valid_until') }}"
                                        placeholder="Masukan nilai diskon">

                                    @error('valid_until')
                                        <small class="text-danger ms-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="min_purchase" class="form-label ps-1">
                                    Minimal Transaksi
                                </label>
                                <input type="text" name="min_purchase" id="min_purchase"
                                    class="form-control form-control-lg" value="{{ old('min_purchase') }}"
                                    placeholder="Masukan minimal transaksi">

                                @error('min_purchase')
                                    <small class="text-danger ms-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="d-flex mt-3">
                        <a href="{{ route('discounts.index') }}" class="btn btn-outline-danger px-5 me-3">Kembali</a>
                        <button type="submit" class="btn btn-danger px-5">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let valueInput = $('#value');

            valueInput.attr({
                type: 'number',
                max: 99
            });

            $('#type').on('change', function() {
                if ($(this).val() === 'percentage') {
                    valueInput.attr({
                        type: 'number',
                        max: 99
                    }).removeAttr('min').val('');
                } else if ($(this).val() === 'fixed') {
                    valueInput.attr('type', 'text').removeAttr('max min').val('');
                }
            });

            $('#value').on('input', function() {
                let input = $(this);
                let type = $('#type').val();
                let value = input.val().replace(/\D/g, '');

                if (type === 'fixed') {
                    let cursorPosition = input.prop("selectionStart");
                    let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    let diff = formattedValue.length - input.val().length;

                    input.val(formattedValue);
                    input[0].setSelectionRange(cursorPosition + diff, cursorPosition + diff);
                } else {
                    if (value.length > 2) {
                        value = value.substring(0, 2);
                    }
                    let num = parseInt(value, 10);
                    if (num > 99) num = 99;
                    if (isNaN(num)) num = '';

                    input.val(num);
                }
            });

            $('#min_purchase').on('input', function() {
                let input = $(this);
                let cursorPosition = input.prop("selectionStart");
                let rawValue = input.val().replace(/\D/g, '');
                let formattedValue = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                let diff = formattedValue.length - input.val().length;

                input.val(formattedValue);
                input[0].setSelectionRange(cursorPosition + diff, cursorPosition + diff);
            });
        });
    </script>
@endsection
