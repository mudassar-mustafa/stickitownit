@extends('backend.layouts.app')
@section('title','Package Orders')
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
                                    <h4 class="card-title">Package Orders</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('Admin'))
                                <div class="row g-3 mt-2">
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
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label for="order_date" class="form-label">Order Date</label>
                                        <input type="date" class="form-control" id="order_date" name="order_date" value="{{request('orderDate') == null || request('orderDate') == 'null' ? "" : date('Y-m-d', strtotime(request('orderDate'))) }}">
                                    </div>    
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <button type="button" class="btn btn-primary" style="margin-top: 30px;" onclick="filerData();">Filter</button>
                                    </div>
                                </div>
                            @endif
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

        function filerData(){
            var url = "{{ route('backend.pages.order.package_order', [':buyerIds', ':orderDate']) }}";
            if($("#buyer_id").val() != ""){
                url = url.replace(':buyerIds',$("#buyer_id").val() == undefined ? null : $("#buyer_id").val());
            }else{
                url = url.replace(':buyerIds',null);
            }
            if($("#order_date").val() != ""){
                url = url.replace(':orderDate',$("#order_date").val() == undefined ? null : $("#order_date").val());
            }else{
                url = url.replace(':orderDate',null);
            }
            window.location.href = url;
        }

    </script>
@endpush
