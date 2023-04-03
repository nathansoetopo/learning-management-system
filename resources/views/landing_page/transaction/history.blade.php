@extends('landing_page.app')
@section('app-content')
    <!-- SHOP CART
                ================================================== -->
    <div class="container">
        <h1 class="mt-5">Riwayat Pembelian</h1>
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
                                    <th class="product-quantity">Tanggal Transaksi</th>
                                    <th class="product-subtotal">Status</th>
                                    <th class="product-remove">&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($histories as $history)
                                    <tr class="woocommerce-cart-form__cart-item cart_item">
                                        <td class="product-name" data-title="Product">
                                            {{$history->master_class->name}}
                                        </td>

                                        <td class="product-price" data-title="Price">
                                            <span class="woocommerce-Price-amount amount"><span
                                                    class="woocommerce-Price-currencySymbol">Rp.</span>@money($history->master_class->price)</span>
                                        </td>

                                        <td class="product-quantity" data-title="Quantity">
                                            {{ day($history->created_at) }}
                                        </td>

                                        <td class="product-subtotal" data-title="Total">
                                            @if ($history->status == 'failed')
                                                <span class="badge badge-danger-pending">Gagal</span>
                                            @else
                                                <span class="badge {{$history->status == 'success' ? 'badge-success' : 'badge-primary'}}">{{$history->status}}</span>
                                            @endif
                                        </td>
                                        <td class="product-remove">
                                            <a href="{{route('landing-page.transaction.check', ['merchantOrderId' => $history->invoice_number])}}" class="remove" aria-label="Remove this item">
                                                <i class="fas fa-info-circle fa-lg"></i>
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
