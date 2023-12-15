@extends('layouts.master')

@section('title', 'Tambah Order')

@section('content')

    <div class="container-fluid">
        <div class="mt-4 p-5 bg-black text-white rounded mb-4">
            <h1>Add New Order</h1>
        </div>
        <form action="{{ route('order.createOrder') }}" method="POST" id="orderForm">

            <label for="status" class="mb-4">Status:</label>
            <select name="status" id="status">
                <option value="Selesai">Selesai</option>
                <option value="Menunggu_Pembayaran">Menunggu Pembayaran</option>
            </select>
            <div>
                <h1 for="menu" class="mb-4">Menu:</h1>
            </div>

            <div class="row">
                <div class="col-6">
                    @foreach ($menus as $menu)
                        <div class="mb-3">
                            <input type="checkbox" name="menu[{{ $menu->id }}][quantity]" value="1"
                                class="menu-checkbox">
                            {{ $menu->nama }} - {{ $menu->harga }}

                            @if ($menu->rekomendasi)
                                <span class="badge bg-danger mb-2">(Diskon 10%)</span>
                            @endif
                            <br>
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="menu[{{ $menu->id }}][quantity]" min="1"
                                class="menu-quantity">
                        </div>
                    @endforeach
                </div>
                <div class="col-6">
                    <h5 class="mt-3">Total Price:</h5>
                    <div class="row">
                        <h6><span id="total-price">Rp 0</span></h6>
                    </div>

                    <h5 class="mt-3">PPN (11%):</h5>
                    <div class="row">
                        <h6><span id="ppn">Rp 0</span></h6>
                    </div>

                    <h5 class="mt-3">Total (including 11% VAT):</h5>
                    <div class="row">
                        <h6><span id="total">Rp 0</span></h6>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3 mt-3">Submit Order</button>
                </div>
            </div>
            @csrf
        </form>
    </div>


    <script>
        document.addEventListener('input', function(event) {
            if (event.target.classList.contains('menu-checkbox') || event.target.classList.contains(
                    'menu-quantity')) {
                updateTotalPrice();
            }

            if (event.target.classList.contains('menu-checkbox')) {
                var quantityInput = event.target.closest('div').querySelector('.menu-quantity');
                if (event.target.checked && quantityInput.value === "") {
                    quantityInput.value = "1";
                    updateTotalPrice();
                } else if (!event.target.checked) {
                    quantityInput.value = "";
                }
            }
        });

        document.getElementById('orderForm').addEventListener('submit', function(event) {
            var checkboxes = document.querySelectorAll('.menu-checkbox:checked');
            var valid = true;

            checkboxes.forEach(function(checkbox) {
                var quantityInput = checkbox.closest('div').querySelector('.menu-quantity');
                if (isNaN(parseInt(quantityInput.value)) || parseInt(quantityInput.value) < 1) {
                    alert('Quantity tidak boleh kosong, minimal pemesanan adalah 1');
                    event.preventDefault(); // Prevent form submission if validation fails
                    valid = false;
                    return;
                }
            });

            if (valid) {
                updateTotalPrice();
            }
        });

        function formatRupiah(angka) {
            var number_string = angka.toString();
            var sisa = number_string.length % 3;
            var rupiah = number_string.substr(0, sisa);
            var ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return 'Rp ' + rupiah;
        }

        function updateTotalPrice() {
            var totalWithoutPPN = 0;

            document.querySelectorAll('.menu-checkbox:checked').forEach(function(checkbox) {
                var price = parseFloat(checkbox.parentNode.textContent.split(' - ')[1]);
                var discount = checkbox.parentNode.textContent.includes('(Diskon 10%)') ? 0.9 : 1;
                var quantity = parseInt(checkbox.closest('div').querySelector('.menu-quantity').value);
                totalWithoutPPN += price * discount * quantity;
            });

            var ppn = totalWithoutPPN * 0.11;
            var total = totalWithoutPPN + ppn;

            document.getElementById('total-price').textContent = formatRupiah(totalWithoutPPN.toFixed(0));
            document.getElementById('ppn').textContent = formatRupiah(ppn.toFixed(0));
            document.getElementById('total').textContent = formatRupiah(total.toFixed(0));
        }
    </script>
@endsection
