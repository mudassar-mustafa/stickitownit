@extends('backend.layouts.app')
@section('title','Image Generations')
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
                                    <h4 class="card-title"> Image Generations</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-4">
                            <!-- Default Tabs -->
                            <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                                <li class="nav-item flex-fill" role="presentation">
                                    <a class="nav-link w-100 @if(!isset($_GET['status']) || $_GET['status'] === 'inprogress') active  @endif" id="home-tab"  href="/backend/generations?status=inprogress"
                                            aria-controls="home" aria-selected="false" tabindex="-1">InProgress
                                    </a>
                                </li>
                                <li class="nav-item flex-fill" role="presentation">
                                    <a class="nav-link w-100 @if(isset($_GET['status']) && $_GET['status'] === 'completed') active @endif" id="profile-tab" href="/backend/generations?status=completed"
                                            aria-controls="profile" aria-selected="true">Completed
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content pt-2" id="myTabjustifiedContent">
                                <div class="tab-pane fade   @if(!isset($_GET['status']) || $_GET['status'] === 'inprogress') active show @endif" id="home-justified" role="tabpanel"
                                     aria-labelledby="home-tab">
                                    @if(!isset($_GET['status']) || $_GET['status'] === 'inprogress')
                                        {{$dataTable->table()}}
                                    @endif
                                </div>
                                <div class="tab-pane fade  @if(isset($_GET['status']) && $_GET['status'] === 'completed') active show @endif" id="profile-justified" role="tabpanel"
                                     aria-labelledby="profile-tab">
                                    @if(isset($_GET['status']) && $_GET['status'] === 'completed')
                                        {{$dataTable->table()}}
                                    @endif
                                </div>

                            </div><!-- End Default Tabs -->

                        </div>
                        {{--                        <div class="card-body">--}}
                        {{--                            <div class="mt-4">--}}
                        {{--                                {{$dataTable->table()}}--}}
                        {{--                            </div>--}}

                        {{--                        </div>--}}
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
                            swal("Submitted", "{{ trans('Deletion Request Submitted') }}", "success");
                        } else {
                            swal("Cancelled", "{{ trans('Request Cancelled') }}", "error");
                        }
                    });

                });
            }
        }
    </script>
@endpush
