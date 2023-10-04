@extends('backend.layouts.app')
@section('title','Products')
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
                                    <h4 class="card-title"> Product Variation</h4>
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
    <script src="{{ asset('backend/vendor/sweetalert/sweetalert.min.js')}}"></script>
    <script>
        function drawCallBackHandler() {

            console.log("Draw Call Back Called");
            $('[data-toggle="tooltip"]').tooltip();
            var confirmAction = $(".deleteModel");
            if (confirmAction.length) {
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
                            $("#" + formId).submit();
                            swal("Submited", "{{ trans('Deletion Request Submitted') }}", "success");
                        } else {
                            swal("Cancelled", "{{ trans('Request Cancelled') }}", "error");
                        }
                    });

                });
            }
        }

       function updateVariationData(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            var form_data = new FormData();
            if(document.getElementById('image'+id+'').files[0] != undefined){
                form_data.append("image", document.getElementById('image'+id+'').files[0]);
            }
            form_data.append("id", id);
            form_data.append("quantity", $("#quantity"+id+"").val());
            form_data.append("price", $("#price"+id+"").val());
            form_data.append("visibility", $("#visibility"+id+"").is(":checked") == true ? "1" : "0");
            form_data.append("_token", csrf_token);
            $.ajax({
                type: 'POST',
                url: '{{route("backend.pages.product.updateVariation")}}',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.status == 'success') {
                        location.reload(true);
                    }
                }
            });
       }
    </script>
@endpush
