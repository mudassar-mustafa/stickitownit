@extends('backend.layouts.app')
@push('css')
@endpush
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Brand</h1>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Brands</h4>
                    </div>
                    <div class="card-body">
                      <a href="{{route('backend.pages.brand.create')}}">
                        <button type="button" class="btn btn-primary me-1 pull-right">Add New Brand</button> 
                      </a>
                        <div class="table-responsive">
                            {{$dataTable->table()}}
                        </div>
              
                    </div>
                    </div>
                </div>
              </div>
        </section>
    </main>
@endsection
@push('scripts')
{{$dataTable->scripts()}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  function drawCallBackHandler() {

console.log("Draw Call Back Called");
$('[data-toggle="tooltip"]').tooltip();
var confirmAction = $(".deleteModel");
if (confirmAction.length)
{
    confirmAction.click(function (e) {
        e.preventDefault();
        var formId = $(this).attr("form-id");
        var confirmMessage = $(this).attr("form-alert-message");

        swal({
            title: "Are you sure?",
            text: confirmMessage,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(isConfirm => {
            if (isConfirm) {
                $("#"+formId).submit();
                swal("Submited", "{{ trans('Deletion Request Submitted') }}", "success");
            } else {
                swal("Cancelled", "{{ trans('Request Cancelled') }}", "error");
            }
        });

    });
}
}
</script>
@endpush
