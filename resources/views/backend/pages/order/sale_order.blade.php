@extends('backend.layouts.app')
@section('title','Orders')
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
                                    <h4 class="card-title"> Orders</h4>
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
        <div class="modal fade" id="order_status_update_modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Order Status Update</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <input type="hidden" value="" id="order_id">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" class="form-select" name="status">
                                    <option value="">Please Select Status</option>
                                    <option value="printed">Printed</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="delivered">Delivered</option>
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="name" class="form-label">Remarks</label>
                                <textarea class="form-control" placeholder="Remarks" id="remarks" name="remarks" style="height: 100px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" type="button" class="btn btn-primary" onclick="updateOrderStatus()">Update</button>
                    </div>
                </form>
                
              </div>
            </div>
          </div>
    </main>

    <div class="modal fade" id="orderDetailModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Order Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body showOrderDetail">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

@endsection
@push('scripts')
    {{$dataTable->scripts()}}
    <script src="{{ asset('backend/vendor/sweetalert/sweetalert.min.js')}}"></script>
    <script>
        function drawCallBackHandler() {
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

        function updateStatus(orderId) {
            $("#order_id").val('');
            $("#status").val('');
            $("#remarks").val('');
            $("#order_id").val(orderId);
            var orderStatus = $("#btnStatus"+orderId+"").data('order_status');
            if(orderStatus == "printed"){
                $("#status option[value='cancelled']").prop("disabled",true);
            }
            $("#order_status_update_modal").modal('show');
        }

        function updateOrderStatus() {
            if($("#status").val() == ""){
                swal("Validation!", "Please Select Status", "error");
                return false;
            }
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                async: false,
                url: '{{route("backend.pages.order.updateOrderStatus")}}',
                data: {
                    order_id: $("#order_id").val(),
                    status: $("#status").val(),
                    remarks: $("#remarks").val(),
                    _token: csrf_token
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        swal("Success!", ""+data.message+"", "success");
                        location.reload(true);
                    }else{
                        swal("Error!", ""+data.message+"", "error");
                    }
                }
            });
        }

        function showOrderDetail(orderId) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                async: false,
                url: '{{route("backend.pages.order.getOrderDetail")}}',
                data: {
                    orderId: orderId,
                    _token: csrf_token
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $(".showOrderDetail").empty();
                        $(".showOrderDetail").append(data.data);
                        $("#orderDetailModal").modal('show');
                    }else{
                        swal("Error!", ""+data.message+"", "error");
                    }
                }
            });
                        
        }
    </script>
@endpush
