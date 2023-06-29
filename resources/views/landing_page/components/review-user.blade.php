@foreach ($data as $review)
    <li class="media d-flex">
        <div class="avatar avatar-xxl me-3 me-md-6 flex-shrink-0">
            <img src="{{$review->avatar}}" alt="..." class="avatar-img rounded-circle">
        </div>
        <div class="media-body flex-grow-1">
            <div class="d-md-flex align-items-center mb-5">
                <div class="me-auto mb-4 mb-md-0">
                    <h5 class="mb-0">{{$review->name}}</h5>
                </div>
                <div class="star-rating">
                    <div class="rating" style="width:{{getStarRate($review->rate)}};"></div>
                </div>
            </div>
            <p class="mb-6 line-height-md">{{$review->description}}</p>
        </div>
    </li>
@endforeach
