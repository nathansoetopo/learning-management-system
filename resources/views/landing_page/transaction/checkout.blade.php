@extends('landing_page.app')
@section('app-content')
    <!-- PAGE TITLE
                                                ================================================== -->
    <header class="py-8 py-md-10" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">Shop Checkout</h1>
        </div>
    </header>


    <!-- SHOP CHECKOUT
                                                ================================================== -->
    <div class="container pb-6 pb-xl-10">
        <form name="checkout" id="checkout" method="POST" class="checkout woocommerce-checkout"
            action="{{ route('landing-page.transaction.create') }}" novalidate="">
            @csrf
            <div class="col2-set" id="customer_details">
                <div class="col-1">
                    <div class="woocommerce-billing-fields">
                        <h3>Detail Invoice</h3>
                        <div class="woocommerce-billing-fields__field-wrapper">
                            <p class="form-row form-row-first validate-required woocommerce-invalid woocommerce-invalid-required-field"
                                id="billing_first_name_field" data-priority="10">
                                <label for="name" class="">Nama Pengguna <abbr class="required"
                                        title="required">*</abbr></label>
                                <input type="text" class="input-text " name="name" id="name"
                                    placeholder="Nama Pengguna" value="{{ $user->name }}" autofocus="autofocus" readonly
                                    required>
                            </p>
                            <p class="form-row form-row-last validate-required" id="billing_last_name_field"
                                data-priority="20">
                                <label for="email" class="">Email <abbr class="required"
                                        title="required">*</abbr></label>
                                <input type="email" class="input-text " name="email" id="email"
                                    placeholder="Email Pengguna" value="{{ $user->email }}" readonly>
                            </p>
                            <p class="form-row form-row-wide address-field validate-postcode validate-required"
                                id="billing_postcode_field" data-priority="90"
                                data-o_class="form-row form-row-wide address-field validate-required validate-postcode">
                                <label for="username" class="">Username <abbr class="required"
                                        title="required">*</abbr></label>
                                <input type="text" class="input-text " name="username" id="username"
                                    placeholder="Username Pengguna" value="{{ $user->username }}" readonly>
                            </p>
                            <p class="form-row form-row-first validate-required validate-phone" id="billing_phone_field"
                                data-priority="100">
                                <label for="billing_phone" class="">Phone <abbr class="required"
                                        title="required">*</abbr></label>
                                <input type="tel" class="input-text " name="billing_phone" id="billing_phone"
                                    placeholder="Nomor Telephone" name="phone" value="{{ $user->phone }}"
                                    autocomplete="tel" readonly>
                            </p>
                            <p class="form-row form-row-last validate-required validate-email" id="billing_email_field"
                                data-priority="110">
                                <label for="address" class="">Alamat Rumah <abbr class="required"
                                        title="required">*</abbr></label>
                                <input type="text" class="input-text " name="address" id="address"
                                    placeholder="Alamat Rumah" value="{{ $user->address }}" readonly>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-2">
                    <div class="woocommerce-shipping-fields"></div>
                    <div class="woocommerce-additional-fields">
                        <h3>Additional information</h3>
                        <div class="woocommerce-additional-fields__field-wrapper">
                            <p class="form-row notes" id="order_comments_field" data-priority=""><label for="order_comments"
                                    class="">Order notes</label>
                                <textarea name="order_comments" class="input-text " id="order_comments"
                                    placeholder="Notes about your order, e.g. special notes for delivery." rows="7" cols="5"></textarea>
                            </p>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div id="order_review" class="woocommerce-checkout-review-order">
                <div class="woocommerce-checkout-review-order-inner">
                    <h3 id="order_review_heading">Your order</h3>
                    <table class="shop_table woocommerce-checkout-review-order-table">
                        <thead>
                            <tr>
                                <th class="product-name">Product</th>
                                <th class="product-total">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="cart_item">
                                <td class="product-name">
                                    {{ $masterClass->name }}
                                    <strong class="product-quantity">× 1</strong>
                                </td>
                                <td class="product-total">
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">Rp. </span>
                                        @money($masterClass->price)
                                    </span>
                                </td>
                            </tr>
                            <tr class="cart_item" id="discount">
                                <td class="product-name">
                                    Discount Voucher
                                    <strong class="product-quantity"></strong>
                                </td>
                                <td class="product-total">
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">Rp. </span>
                                        <p id="money_discount">@money($masterClass->price)</p>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <th>Total</th>
                                <td>
                                    <strong id="total">@money($masterClass->price)</strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div id="payment" class="woocommerce-checkout-payment">
                    <label for="voucher" class="">Kode Voucher (Bila ada)</label>
                    <input type="text" class="form-control" name="voucher" id="voucher"
                        placeholder="Masukkan kode voucher" autofocus="autofocus" required>
                    <input type="hidden" value="{{ $masterClass->price }}" name="amount">
                    <input type="hidden" value="{{ $masterClass->name }}" name="master_class_name">
                    <input type="hidden" value="{{ $masterClass->id }}" name="master_class_id">
                    <div class="form-row place-order mt-4">
                        <button type="submit" class="btn btn-primary btn-block" form="checkout">
                            PLACE ORDER
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('app-script')
    <script>
        $('#discount').hide();
        var token = $('meta[name=csrf-token]').attr('content')
        $('#voucher').on('keyup', function() {
            $.ajax({
                type: "POST",
                url: "{{ route('landing-page.transaction.get-voucher') }}",
                data: {
                    '_token': token,
                    'voucher': $(this).val(),
                    'master_class_id': '{{ $masterClass->id }}'
                },
                success: function(data) {
                    var nom = 0;
                    if (data.discount_type == '%') {
                        nom = {{ $masterClass->price }} * (data.nominal / 100)
                    } else {
                        nom = {{ $masterClass->price }} - data.nominal
                    }

                    var nom_total = {{ $masterClass->price }} - nom

                    if (nom_total != null && nom != null) {
                        $('#discount').show()
                        $('#money_discount').text(nom ?? 0)
                        $('#total').text(nom_total)
                    }
                }
            })
        });

        // function discount(data){
        //     var nom = {{ $masterClass->price }} data.discount_type data.nominal

        //     console.log(nom)
        // }
        // var token = $('meta[name=csrf-token]').attr('content')
        // $.ajax({
        //     type: "POST",
        //     url: url,
        //     data: {
        //         '_token': token,
        //     }
        // })
    </script>
@endpush
