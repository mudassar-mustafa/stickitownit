@extends('backend.layouts.app')
@push('css')
@endpush
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title"> Brands</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('backend.pages.brand.create')}}" class="text-right">
                                    <button type="button" class="btn btn-primary me-1 pull-right">Add New Brand</button> 
                                  </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mt-4">
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
