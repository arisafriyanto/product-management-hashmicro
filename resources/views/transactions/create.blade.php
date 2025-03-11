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
                            <li class="breadcrumb-item active" aria-current="page">Buat Transaksi</li>
                        </ol>
                    </nav>
                </div>

                <form action="{{ route('transactions.store') }}" method="POST" class="pt-2">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="user_id" class="form-label ps-1">
                                    Nama Pembeli <span class="text-danger"> *</span>
                                </label>
                                <select class="form-select form-select-lg" name="user_id" id="user_id">
                                    <option value="">Pilih Pembeli</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>

                                @error('user_id')
                                    <small class="text-danger ps-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="ps-1 pb-3">Produk</label>
                        <div id="products-container">

                            <div class="product-row mb-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <select class="form-select form-select-lg product-select"
                                                name="products[0][product_id]">
                                                <option value="">Pilih Produk</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                                        {{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <input type="number" name="products[0][quantity]"
                                                class="form-control form-control-lg product-quantity" placeholder="Jumlah"
                                                min="1" value="1">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <input type="text" name="products[0][price]"
                                                class="form-control form-control-lg product-price" placeholder="Harga"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <input type="text" name="products[0][total_price]"
                                                class="form-control form-control-lg product-total-price"
                                                placeholder="Total harga" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-1 mt-1">
                                        <div class="mb-2">
                                            <button type="button" class="btn btn-success" id="add-product">+</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="pt-3">
                        <div class="d-flex mb-3">
                            <div>
                                <input type="text" name="subtotal_price" id="subtotal-price"
                                    class="form-control form-control-lg" placeholder="Subtotal harga" readonly>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-1" id="discountForm">
                            <div>
                                <input type="text" name="discount" id="discount" class="form-control form-control-lg"
                                    placeholder="Masukkan kode diskon">
                                <input type="hidden" name="discount_amount" id="discount_amount">
                            </div>
                            <div>
                                <button type="button" id="applyDiscount" class="btn btn-danger ms-3">Apply</button>
                            </div>
                        </div>
                        <p id="discountMessage" class="ps-1"></p>

                        <div class="d-flex mb-3">
                            <div class="">
                                <input type="text" name="total_price" id="total-price"
                                    class="form-control form-control-lg" placeholder="Total harga" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex mt-3">
                        <a href="{{ route('transactions.index') }}" class="btn btn-outline-danger px-5 me-3">Kembali</a>
                        <button type="submit" class="btn btn-danger px-5">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let productIndex = 1;

        document.addEventListener('click', function(event) {
            if (event.target.id === 'add-product') {
                addProductRow();
            }

            if (event.target.classList.contains('remove-product')) {
                const row = event.target.closest('.product-row');
                row.remove();
                updateTotalPrice();
                updateDisabledProducts();
            }
        });

        document.addEventListener('input', function(event) {
            if (event.target.classList.contains('product-select') || event.target.classList.contains(
                    'product-quantity')) {
                const row = event.target.closest('.product-row');
                updateRowPrice(row);
                updateTotalPrice();
                updateDisabledProducts();
            }
        });

        function addProductRow() {
            const newRow = `
                <div class="product-row mb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-2">
                                <select class="form-select form-select-lg product-select" name="products[${productIndex}][product_id]">
                                    <option value="">Pilih Produk</option>
                                    <?php foreach ($products as $product): ?>
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                            {{ $product->name }}
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-2">
                                <input type="number" name="products[${productIndex}][quantity]"
                                    class="form-control form-control-lg product-quantity" placeholder="Jumlah"
                                    min="1" value="1">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-2">
                                <input type="text" name="products[${productIndex}][price]"
                                    class="form-control form-control-lg product-price" placeholder="Harga"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <input type="text" name="products[${productIndex}][total_price]"
                                    class="form-control form-control-lg product-total-price"
                                    placeholder="Total harga" readonly>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="mb-2">
                                <button type="button" class="btn btn-danger remove-product">-</button>
                            </div>
                        </div>
                    </div>
                </div>`;


            document.getElementById('products-container').insertAdjacentHTML('beforeend', newRow);
            productIndex++;
            updateDisabledProducts();
        }

        function updateRowPrice(row) {
            const productSelect = row.querySelector('.product-select');
            const quantityInput = row.querySelector('.product-quantity');
            const priceInput = row.querySelector('.product-price');
            const totalPriceInput = row.querySelector('.product-total-price');

            const selectedProductPrice = parseFloat(productSelect.options[productSelect.selectedIndex]?.getAttribute(
                'data-price')) || 0;
            const quantity = parseInt(quantityInput.value) || 1;

            priceInput.value = selectedProductPrice;
            totalPriceInput.value = (selectedProductPrice * quantity);

            formatCurrency(priceInput);
            formatCurrency(totalPriceInput);
        }

        function updateTotalPrice() {
            let totalPrice = 0;
            document.querySelectorAll('.product-total-price').forEach(input => {
                let numericValue = input.value.replace(/\./g, '');
                totalPrice += parseFloat(numericValue) || 0;
            });
            const totalPriceInput = document.getElementById('total-price');
            const subTotalPriceInput = document.getElementById('subtotal-price');

            if (totalPrice === 0) {
                subTotalPriceInput.value = "";
                subTotalPriceInput.placeholder = "Subtotal harga";

                totalPriceInput.value = "";
                totalPriceInput.placeholder = "Total harga";
            } else {
                subTotalPriceInput.value = totalPrice;
                formatCurrency(subTotalPriceInput);

                totalPriceInput.value = totalPrice;
                formatCurrency(totalPriceInput);
            }
        }

        function updateDisabledProducts() {
            const selectedValues = Array.from(document.querySelectorAll('.product-select'))
                .map(select => select.value)
                .filter(value => value !== "");

            document.querySelectorAll('.product-select').forEach(select => {
                Array.from(select.options).forEach(option => {
                    if (selectedValues.includes(option.value) && option.value !== select.value) {
                        option.disabled = true;
                    } else {
                        option.disabled = false;
                    }
                });
            });
        }

        function formatCurrency(input) {
            let cursorPosition = input.selectionStart;
            let rawValue = input.value.replace(/\D/g, '');
            let formattedValue = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            let diff = formattedValue.length - input.value.length;

            input.value = formattedValue;
            input.setSelectionRange(cursorPosition + diff, cursorPosition + diff);
        }

        function applyDiscount(discountType, discountValue, minPurchasing) {
            let subtotal = parseFloat($('#subtotal-price').val().replace(/\./g, '')) || 0;

            let totalPrice = subtotal;
            let discountAmount = 0;

            if (discountType == 'percentage') {
                discountAmount = (subtotal * parseFloat(discountValue)) / 100;
                totalPrice -= discountAmount;

                $('#discountMessage')
                    .text('Kode diskon berlaku (' + discountAmount.toLocaleString('id-ID') +
                        ')')
                    .css("color", "green");
            } else if (discountType == 'fixed') {
                totalPrice -= parseFloat(discountValue);
                discountAmount = parseFloat(discountValue);
            }

            totalPrice = Math.max(totalPrice, 0);

            if (minPurchasing && totalPrice < minPurchasing) {
                $('#discountMessage')
                    .text(
                        `Total pesanan harus minimal ${minPurchasing.toLocaleString('id-ID')}`
                    )
                    .css("color", "red");
                return;
            }

            $('#total-price').val(totalPrice.toLocaleString('id-ID'));
            $('#discount_amount').val(discountAmount);
        }

        $('#applyDiscount').click(function() {
            let discountCode = $('#discount').val().trim();

            if (discountCode === '') {
                $('#discountMessage').text("Kode diskon harus diisi.").css("color", "red");
                return;
            }

            $.ajax({
                url: '/check-discount',
                type: 'POST',
                data: {
                    discount: discountCode,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        let discountType = response.data.type;
                        let discountValue = parseFloat(response.data.value);
                        let minPurchasing = response.data.min_purchase ? parseFloat(response.data
                            .min_purchase) : 0;

                        if (discountType == 'fixed') {
                            $('#discountMessage')
                                .text(response.message + ' (' + discountValue.toLocaleString('id-ID') +
                                    ')')
                                .css("color", "green");
                        }


                        applyDiscount(discountType, discountValue, minPurchasing);
                    } else {
                        $('#discountMessage').text(response.message).css("color", "red");
                    }
                },
                error: function(xhr) {
                    $('#discountMessage').text(xhr.responseJSON.message).css("color", "red");
                }
            });
        });


        document.addEventListener('DOMContentLoaded', () => {
            updateTotalPrice();
            updateDisabledProducts();
        });
    </script>
@endsection
