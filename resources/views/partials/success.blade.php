@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade in text-center" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>

      <strong>{!!session()->get('success')!!}</strong>
    </div>


@endif

@if (session()->has('danger'))
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>

      <strong>{!!session()->get('success')!!}</strong>
    </div>


@endif
