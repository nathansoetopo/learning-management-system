@foreach ($carts->cart as $cart)
    <li class="list-group-item border-bottom py-0">
        <div class="d-flex py-5">
            <div class="bg-gray-200 w-60p h-60p rounded-circle overflow-hidden">
                <img src="{{$cart->image}}" alt="{{$cart->slug}}">
            </div>

            <div class="flex-grow-1 mt-1 ms-4">
                <h6 class="fw-normal mb-0">{{$cart->name}}</h6>
                <div class="font-size-sm">1 × @money($cart->price)</div>
            </div>
        </div>
    </li>
@endforeach
