<div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-all me-2"></i>
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class='bx bxs-error bx-sm'></i>
            <strong> {{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
<div class="alert alert-danger alert-block">
    <ul>
        @foreach ($errors->all() as $error)

        <li><i class='bx bxs-error bx-sm'></i> {{ $error }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></li>

        @endforeach
    </ul>
</div>
@endif


</div>
