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
                            <li class="breadcrumb-item active" aria-current="page">Edit Diskon</li>
                        </ol>
                    </nav>
                </div>

                <form action="{{ route('discounts.update', $discount->id) }}" method="POST" class="pt-2">
                    @csrf
                    @method('put')

                    <div class="row">

                        <div class="row pe-0">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="code" class="form-label ps-1">
                                        Kode Diskon <span class="text-danger"> *</span>
                                    </label>
                                    <input type="text" name="code" id="code" class="form-control form-control-lg"
                                        value="{{ $discount->code ?? old('code') }}" placeholder="Masukan kode diskon">

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
                                        value="{{ $discount->name ?? old('name') }}" placeholder="Masukan nama diskon">

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
                                        <option value="percentage" {{ $discount->type == 'percentage' ? 'selected' : '' }}>
                                            Persentase (%)</option>
                                        <option value="fixed" {{ $discount->type == 'fixed' ? 'selected' : '' }}>
                                            Nominal (Rp)</option>
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
                                    <input name="value" id="value" class="form-control form-control-lg"
                                        value="{{ formatRupiah($discount->value) ?? old('value') }}"
                                        placeholder="Masukan nilai diskon">

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
                                        class="form-control form-control-lg"
                                        value="{{ $discount->valid_from ? $discount->valid_from->format('Y-m-d') : old('valid_from') }}"
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
                                        class="form-control form-control-lg"
                                        value="{{ $discount->valid_until ? $discount->valid_until->format('Y-m-d') : old('valid_until') }}"
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
                                    class="form-control form-control-lg"
                                    value="{{ formatRupiah($discount->min_purchase) ?? old('min_purchase') }}"
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
            let typeSelect = $('#type');

            function updateInputType() {
                let selectedType = typeSelect.val();
                let currentValue = valueInput.val(); // Ambil nilai awal

                if (selectedType === 'percentage') {
                    valueInput.prop('type', 'number').attr('max', 99);
                    let num = parseInt(currentValue, 10);
                    if (!isNaN(num) && num <= 99) {
                        valueInput.val(num);
                    } else {
                        valueInput.val('');
                    }
                } else if (selectedType === 'fixed') {
                    valueInput.prop('type', 'text').removeAttr('max min');
                    if (currentValue) {
                        let formattedValue = currentValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                        valueInput.val(formattedValue);
                    }
                }
            }

            // Pastikan input sesuai dengan tipe diskon saat pertama kali dimuat
            updateInputType();

            // Event saat dropdown berubah
            typeSelect.on('change', function() {
                updateInputType();
            });

            // Event saat user mengetik di input value
            valueInput.on('input', function() {
                let input = $(this);
                let type = typeSelect.val();
                let value = input.val().replace(/\D/g, ''); // Hanya angka

                if (type === 'fixed') {
                    // Format Rupiah
                    let cursorPosition = input.prop("selectionStart");
                    let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    let diff = formattedValue.length - input.val().length;

                    input.val(formattedValue);
                    input[0].setSelectionRange(cursorPosition + diff, cursorPosition + diff);
                } else {
                    // Maksimal 2 digit untuk percentage
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
