@extends('landing_page.app')
@section('app-content')
    <!-- SHOP CART
                ================================================== -->
    <div class="container">
        <h1 class="mt-5">Keranjang Anda</h1>
        <div class="page type-page status-publish hentry mt-3 mb-3">
            <!-- .entry-header -->
            <div class="entry-content">
                <div class="woocommerce">
                    <form class="woocommerce-cart-form table-responsive" action="#" method="post">
                        <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                            <thead>
                                <tr>
                                    <th class="product-name">Produk</th>
                                    <th class="product-price">Harga</th>
                                    <th class="product-action">&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($carts->cart as $cart)
                                    <tr class="woocommerce-cart-form__cart-item cart_item" id="row-{{$cart->id}}">
                                        <td class="product-name" data-title="Product">
                                            {{$cart->name}}
                                        </td>

                                        <td class="product-price" data-title="Price">
                                            <span class="woocommerce-Price-amount amount"><span
                                                    class="woocommerce-Price-currencySymbol">Rp.</span>@money($cart->price)</span>
                                        </td>

                                        <td class="product-action" data-title="Quantity">
                                            <a href="{{route('landing-page.master-class.show', ['id' => $cart->id])}}" class="me-3" aria-label="Remove this item">
                                                <i class="fas fa-shopping-cart fa-lg"></i>
                                            </a>
                                            <a href="#" class="remove" data-title="{{$cart->name}}" data-row="{{$cart->id}}" aria-label="Remove this item">
                                                <i class="fas fa-trash fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <!-- .entry-content -->
        </div>
    </div>
@endsection
@push('app-script')
    <script>
        var token = $('meta[name=csrf-token]').attr('content')

        $(document).on('click', '.remove', function(){
            var title = $(this).data('title')
            var id = $(this).data('row')
            Swal.fire({
                title: 'Hapus '+title+' dari keranjang ?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Pilih',
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result['isConfirmed']) {
                    deleteCart(id)
                    $('#row-'+id).hide()
                    console.log('Delete')
                }
            })
        })

        function deleteCart(master_class_id){
            var url = "{{route('landing-page.master-class.cart.delete', ":id")}}";
            url = url.replace(':id', master_class_id)
            console.log(url)
            $.ajax({
                type: "DELETE",
                url: url,
                data: {
                    '_token': token,
                },
                success: function(response) {
                    console.log(response)
                }
            })
        }
    </script>
@endpush