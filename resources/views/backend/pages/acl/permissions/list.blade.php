@extends('layouts/contentLayoutMaster')

@section('title','Permissions')

@section('earlyScripts')
    <script>
        window.list_url = "{{ route('permissions') }}";
        window.delete_url = "{{ route('permissions.destroy') }}";
        let columns = [
            {data: 'name',              name: 'name',               searchable: true,   orderable: true},
            {data: 'actions',           name: 'actions',            searchable: false,  orderable: false}
        ];
        window.table_columns = columns;
    </script>
@endsection

@section('content')
    <section class="card">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body card-dashboard">
                        {{--@if ( auth()->user()->role === \Illuminate\Support\Facades\Config::get('app.ROLE_ADMIN') )--}}
                            <button type="button" class="btn btn-primary round waves-effect waves-light float-right" onclick="window.location='{{ route("permissions.create") }}'">
                                Add Permission
                            </button>
                        {{--@endif--}}
                        <div class="table-responsive">
                            <table class="table zero-configuration no-footer" id="data_table" >
                                <thead>
                                    <tr>
                                        <th style="width: 90%">Name</th>
                                        <th style="width: 10%">Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/scripts/pageScripts/user.js') }}"></script>
    <script>
        $(".dataTables_wrapper").on("click", ".view-keys-btn", function(e) {
            $('#keymodal .login_token').html($(this).data("token"));
            $('#keymodal .url').attr('href', $(this).data("url"));
            $('#keymodal').modal();
        });
        $(".dataTables_wrapper").on("click", "#view-btn", function(e) {
            $('#viewmodal .name').html($(this).data("name"));
            $('#viewmodal .email').html($(this).data("email"));
            $('#viewmodal .tenant').html($(this).data("tenant"));
            $('#viewmodal .status').html($(this).data("status"));
            $('#viewmodal').modal();
        });
    </script>
@endsection
