<div class="col-12 col-md-6 order-md-2 order-first">
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('mentor.dashboard') }}">Dashboard</a></li>
            @for ($i = 2; $i <= count(Request::segments()); $i++)
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ URL::to(implode('/', array_slice(Request::segments(), 0, $i, true))) }}">{{ Str::limit(Str::ucfirst(Request::segment($i)), 7, '...') }}</a>
                </li>
            @endfor
        </ol>
    </nav>
</div>