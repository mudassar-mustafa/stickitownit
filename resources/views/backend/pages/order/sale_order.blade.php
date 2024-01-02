@extends('backend.layouts.app')
@section('title','Orders')
@push('css')
<style>
    .rating {
        display: inline-flex;
        margin-top: -10px;
        flex-direction: row-reverse;
    }

    .rating>input {
        display: none
    }

    .rating>label {
        position: relative;
        width: 28px;
        font-size: 35px;
        color: #ff0000;
        cursor: pointer;
    }

    .rating>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before {
        opacity: 1 !important
    }

    .rating>input:checked~label:before {
        opacity: 1
    }

    .rating:hover>input:checked~label:before {
        opacity: 0.4
    }
</style>
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
                            <div class="row g-3 mt-2">
                                @if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('Seller') || Auth::user()->hasRole('Admin'))
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label for="buyer_id" class="form-label">Buyer Name</label>
                                        <select class="state form-select" id="buyer_id" name="buyer_id">
                                            <option value=""> Please Select Buyer</option>
                                            @if (!empty($buyerList))
                                                @foreach ($buyerList as $buyer)
                                                    <option value ="{{ $buyer->id }}" {{ request('buyerIds') == $buyer->id ? "selected" : "" }}>{{ $buyer->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>    
                                @endif
                                @if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('Customer') || Auth::user()->hasRole('Admin'))
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label for="seller_id" class="form-label">Seller Name</label>
                                        <select class="state form-select" id="seller_id">
                                            <option value=""> Please Select Seller</option>
                                            @if (!empty($sellerList))
                                                @foreach ($sellerList as $seller)
                                                    <option value ="{{ $seller->id }}" {{ request('sellerIds') == $seller->id ? "selected" : "" }}>{{ $seller->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>    
                                @endif
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="state form-select" id="category_id">
                                        <option value=""> Please Select Category</option>
                                        @if (!empty($sellerList))
                                            @foreach ($categoryList as $category)
                                                <option value ="{{ $category->id }}" {{ request('categoryIds') == $category->id ? "selected" : "" }}> {{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <label for="order_date" class="form-label">Order Date</label>
                                    <input type="date" class="form-control" id="order_date" name="order_date" value="{{request('orderDate') == 'null' || request('orderDate') == null  ? "" : date('Y-m-d', strtotime(request('orderDate'))) }}">
                                </div>
                                
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <label for="ship_date" class="form-label">Ship Date</label>
                                    <input type="date" class="form-control" id="ship_date" name="ship_date" value="{{ request('shipDate') == 'null' || request('shipDate') == null ? "" : date('Y-m-d', strtotime(request('shipDate'))) }}">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-primary" style="margin-top: 30px;" onclick="filerData();">Filter</button>
                                </div>
                            </div>
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
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="remarks" class="form-label">Remarks</label>
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

          {{-- Feedback Modal --}}

          <div class="modal fade" id="feedback_modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Order Feedback</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <input type="hidden" value="" id="order_id">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                <div class="rating">
                                    <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                                    <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                                    <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                    <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                    <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="name" class="form-label">Remarks</label>
                                <textarea class="form-control" placeholder="Remarks" id="feedback_remarks" name="feedback_remarks" style="height: 100px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" type="button" class="btn btn-primary" onclick="storeFeedback()">Submit</button>
                    </div>
                </form>

              </div>
            </div>
          </div>
    </main>

    <div class="modal fade" id="orderDetailModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
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
            if(orderStatus === "printed"){
                $("#status option[value='cancelled']").prop("disabled",true);
                $("#status option[value='printed']").prop("disabled",true);
            }else if(orderStatus === "delivered"){
                $("#status option[value='cancelled']").prop("disabled",true);
                $("#status option[value='printed']").prop("disabled",true);
                $("#status option[value='delivered']").prop("disabled",true);
            }

            $("#order_status_update_modal").modal('show');
        }

        function updateOrderStatus() {
            if($("#status").val() === ""){
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

        function updateFeedback(orderId) {
            $("#order_id").val(orderId);
            $("#feedback_modal").modal('show');
        }

        function storeFeedback() {
            var rating = $('input[name="rating"]:checked').val();
            var remarks = $('#feedback_remarks').val();
            if(rating == "" || rating == undefined){
                swal("Error!", "Please select rating", "error");
                return;
            }

            if(remarks == "" || remarks == undefined){
                swal("Error!", "Please enter remarks", "error");
                return;
            }

            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                async: false,
                url: '{{route("backend.pages.order.storeFeedback")}}',
                data: {
                    orderId: $("#order_id").val(),
                    rating: rating,
                    remarks: remarks,
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

        function filerData(){
            debugger;
            var url = "{{ route('backend.pages.order.sale_order', [':buyerIds',':sellerIds',':categoryIds',':orderDate',':shipDate']) }}";
            if($("#buyer_id").val() != ""){
                url = url.replace(':buyerIds',$("#buyer_id").val() == undefined ? null : $("#buyer_id").val());
            }else{
                url = url.replace(':buyerIds',null);
            }
            if($("#seller_id").val() != ""){
                url = url.replace(':sellerIds',$("#seller_id").val() == undefined ? null : $("#seller_id").val());
            }else{
                url = url.replace(':sellerIds',null);
            }
            if($("#category_id").val() != ""){
                url = url.replace(':categoryIds',$("#category_id").val() == undefined ? null : $("#category_id").val());
            }else{
                url = url.replace(':categoryIds',null);
            }
            if($("#order_date").val() != ""){
                url = url.replace(':orderDate',$("#order_date").val() == undefined ? null : $("#order_date").val());
            }else{
                url = url.replace(':orderDate',null);
            }
            if($("#ship_date").val() != ""){
                url = url.replace(':shipDate',$("#ship_date").val() == undefined ? null : $("#ship_date").val());
            }else{
                url = url.replace(':shipDate',null);
            }

            window.location.href = url;
        }
    </script>
@endpush
