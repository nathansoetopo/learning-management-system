@foreach ($users as $user)
    <div class="recent-message d-flex px-4 py-3">
        <div class="avatar avatar-lg">
            <img src="{{$user->avatar}}">
        </div>
        <div class="name ms-4">
            <h5 class="mb-1">{{$user->name}}</h5>
            <h6 class="text-muted mb-0">{{'@'.$user->username}}</h6>
        </div>
    </div>
@endforeach
