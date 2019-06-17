@if (Session::has('successMessage'))
    <div class="alert alert-success">
        <i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('successMessage') }}
    </div>
@endif

@if (Session::has('errorMessage'))
    <div class="alert alert-danger">
        <i class="fa  fa-warning"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('errorMessage') }}
    </div>
@endif