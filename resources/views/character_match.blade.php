@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <div class="d-flex mx-1 my-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Pengecekan Persentase Karakter</li>
                        </ol>
                    </nav>
                </div>


                <div class="pt-1">
                    <div class="mb-3">

                        <form action="{{ route('character.match.check') }}" method="POST">
                            @csrf


                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="input1" class="form-label ps-1">
                                            Input 1 <span class="text-danger"> *</span>
                                        </label>
                                        <input type="text" name="input1" id="input1"
                                            class="form-control form-control-lg" value="{{ old('input1', $input1 ?? '') }}"
                                            placeholder="Masukan input 1">

                                        @error('input1')
                                            <small class="text-danger ms-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="input2" class="form-label ps-1">
                                            Input 2 <span class="text-danger"> *</span>
                                        </label>
                                        <input type="text" name="input2" id="input2"
                                            class="form-control form-control-lg" value="{{ old('input2', $input2 ?? '') }}"
                                            placeholder="Masukan input 2">

                                        @error('input2')
                                            <small class="text-danger ms-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-danger">Cek Persentase</button>
                        </form>

                        @if (isset($percentage))
                            <div class="mt-4">
                                <h5 class="text-center">Hasil Pengecekan</h5>
                                <div class="card border-danger mt-2">
                                    <div class="card-body text-center">
                                        <h6 class="mb-0">Persentase karakter yang cocok:</h6>
                                        <h3 class="mt-3"><span class="badge bg-danger">{{ $percentage }}%</span></h3>
                                    </div>
                                </div>

                                @if (!empty($matched_chars))
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <h6>Karakter yang cocok:</h6>
                                            <ul class="list-group">
                                                @foreach (explode(', ', $matched_chars) as $char)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        {{ strtoupper($char) }}
                                                        <span class="badge bg-success">✓</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center text-danger mt-2">
                                        <p>Tidak ada karakter yang cocok</p>
                                    </div>
                                @endif
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
