@extends('landing_page.app')
@section('app-content')
    <header class="py-8 py-md-10" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">Pengaturan Akun</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="#">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        Profile
                    </li>
                </ol>
            </nav>
        </div>
        <!-- Img -->
        <img class="d-none img-fluid" src="..." alt="...">
    </header>

    <div class="container">
        <div class="card card-border card-border-xl border-primary">
            <div class="card-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Profile</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                            aria-selected="false">Voucher</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-wishlist-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-wishlist" type="button" role="tab" aria-controls="pills-wishlist"
                            aria-selected="false">Keinginan Saya</button>
                    </li>
                </ul>
                <div class="container" id="error_alert">
                    {{-- Content --}}
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                        aria-labelledby="pills-profile-tab">
                        <div class="container pt-3">
                            <small class="text-center">Klik avatar untuk update foto</small>
                            <center>
                                <div class="avatar avatar-xxl">
                                    <label for="file"><img src="{{ $user->avatar }}" alt="profile"
                                            class="avatar-img rounded-circle" id="avatar"></label>
                                </div>
                            </center>
                            <input type="file" name="file" id="file" form="update_profile" class="inputfile"
                                style="visibility: hidden">
                            <div class="container mt-5">
                                <form method="POST" action="{{ route('landing-page.profile.update') }}"
                                    id="update_profile">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush" name="name"
                                            id="cardName" placeholder="Name" value="{{ $user->name }}">
                                        <label for="cardName">Nama Pengguna</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="email" class="form-control form-control-flush" name="email"
                                            id="cardEmail" placeholder="Email" value="{{ $user->email }}" readonly>
                                        <label for="cardEmail">Email</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush" name="username"
                                            id="username" placeholder="Username" value="{{ $user->username }}">
                                        <label for="username">Username</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush" name="phone"
                                            id="phone" placeholder="Nomor Telephone" value="{{ $user->phone }}">
                                        <label for="phone">No. Telephone</label>
                                    </div>
                                    <div class="form-label-group">
                                        <select name="gender" id="gender" class="form-control form-control-flush">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Pria
                                            </option>
                                            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Wanita
                                            </option>
                                        </select>
                                        <label for="gender">Jenis Kelamin</label>
                                    </div>
                                    <div class="form-label-group">
                                        <textarea name="address" class="form-control form-control-flush" id="address" cols="10" rows="10"
                                            placeholder="Alamat Rumah">{{ $user->address ?? '-' }}</textarea>
                                        <label for="address">Alamat Rumah</label>
                                    </div>
                                    <div class="mt-6">
                                        <button class="btn btn-block btn-success lift" type="submit">
                                            Update Profile Saya
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="container">
                            @if (!empty($user->claim))
                                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Kode Voucher</th>
                                            <th class="product-price">Potongan</th>
                                            <th class="product-quantity">Berakhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="woocommerce-cart-form__cart-item cart_item">
                                            <td class="product-name" data-title="Product">
                                                {{ $user->claim->voucher->voucher_code }}
                                            </td>

                                            <td class="product-price" data-title="Price">
                                                <span class="woocommerce-Price-amount amount"><span
                                                        class="woocommerce-Price-currencySymbol">{{ $user->claim->voucher->nominal }}
                                                        {{ $user->claim->voucher->discount_type }}</span>
                                            </td>

                                            <td class="product-quantity" data-title="Quantity">
                                                {{ day($user->claim->voucher->end_date) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <center>
                                    <h4>Belum Memiliki Voucher</h4>
                                </center>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-wishlist" role="tabpanel" aria-labelledby="pills-wihslist-tab">
                        <div class="container">
                            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                <thead>
                                    <tr>
                                        <th class="product-name">Nama Kelas</th>
                                        <th class="product-price">Durasi</th>
                                        <th class="product-quantity">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->wishlists as $wishlist)
                                        <tr class="woocommerce-cart-form__cart-item cart_item">
                                            <td class="product-name" data-title="Product">
                                                <a href="{{route('landing-page.master-class.show', ['id' => $wishlist->id])}}">{{ $wishlist->name }}</a>
                                            </td>

                                            <td class="product-price" data-title="Price">
                                                <span class="woocommerce-Price-amount amount"><span
                                                        class="woocommerce-Price-currencySymbol">{{$wishlist->duration}} Jam</span>
                                            </td>

                                            <td class="product-quantity" data-title="Quantity">
                                                @money($wishlist->price)
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                            aria-selected="true">Akun Saya</button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                            aria-selected="false">Pesanan Saya</button>
                        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-messages" type="button" role="tab"
                            aria-controls="v-pills-messages" aria-selected="false">Voucher Saya</button>
                        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-settings" type="button" role="tab"
                            aria-controls="v-pills-settings" aria-selected="false">Wishlist</button>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="container">
                                <form>
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush" id="cardName"
                                            placeholder="Name">
                                        <label for="cardName">Name</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="email" class="form-control form-control-flush" id="cardEmail"
                                            placeholder="Email">
                                        <label for="cardEmail">Email</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="password" class="form-control form-control-flush" id="cardPassword"
                                            placeholder="Password">
                                        <label for="cardPassword">Password</label>
                                    </div>
                                    <div class="mt-6">
                                        <button class="btn btn-block btn-success lift" type="submit">
                                            Download a sample
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">Pesanan Saya</div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                            aria-labelledby="v-pills-messages-tab">Voucher Saya</div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                            aria-labelledby="v-pills-settings-tab">Wishlist</div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
@push('app-script')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');

        $('#file').on('change', function() {
            var files = $('#file')[0].files

            readUrl(this)
        })

        $('#update_profile').on('submit', function(e) {
            e.preventDefault()

            var formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                url: '{{ route('landing-page.profile.update') }}',
                type: 'POST',
                dataType: "JSON",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {

                    if (data.status == 200) {
                        var alert = $("<div>", {
                            "class": "alert alert-success",
                            "role": "alert",
                            "text": "" + data.data + ""
                        });
                        $('#error_alert').html(alert)
                    }

                },
                error: function(err) {
                    console.log(err)

                    if (err.status == 422) {
                        $.each(err.responseJSON.errors, function(i, error) {
                            var alert = $("<div>", {
                                "class": "alert alert-danger",
                                "role": "alert",
                                "text": "" + error[0] + ""
                            });
                            $('#error_alert').append(alert)
                        });
                    } else {
                        console.log(err)
                    }
                }
            });
        })

        function readUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
