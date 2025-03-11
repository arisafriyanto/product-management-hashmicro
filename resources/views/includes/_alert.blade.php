@if (session('success'))
    <div class="position-fixed" style="top: 3rem; left: 50%; transform: translate(-50%, -50%); z-index: 1050;">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="position-fixed" style="top: 3rem; left: 50%; transform: translate(-50%, -50%); z-index: 1050;">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

@if ($errors->has('errors'))
    <div class="position-fixed" style="top: 3rem; left: 50%; transform: translate(-50%, -50%); z-index: 1050;">
        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
            <ul class="mb-0 ps-0">
                <li>{{ $errors->first('errors') }}</li>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
