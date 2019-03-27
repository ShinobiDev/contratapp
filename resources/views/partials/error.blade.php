@if(empty($errors)==false)
@if (asset($errors)&&count($errors) >0)
  <div class="alert alert-danger alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    @foreach ($errors->all() as $error)
      <li> <strong> {!! $error !!}</strong></li>
    @endforeach

  </div>
@endif
@endif
@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade in text-center" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>

      <strong>{!!session()->get('error')!!}</strong>
    </div>


@endif


