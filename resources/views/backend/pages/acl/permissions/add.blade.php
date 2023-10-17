@extends('layouts.contentLayoutMaster')

@section('title', $title)

@section('earlyScripts')
    <script>
        window.action_url = "{{ isset($item) ? route('permissions.update', ['id' => $item->id]) : route('permissions.store') }}";
        window.list_url = "{{ route('permissions') }}";
    </script>
@endsection

@section('content')
    <section class="card">
        <div class="card-body">
            <form id="add-edit-form" enctype="multipart/form-data" novalidate="">
                @csrf
                <div class="row">
                    <input type="hidden" id="_id" name="id" value="@php echo isset($item) ? $item->id : '' @endphp">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <div class="controls">
                                <label for="name">Module Name</label>
                                <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                                       value="@php echo isset($item) ? $item->name : '' @endphp">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        @php
                            $permissionsArr = \App\Helpers\AclHelper::$BASIC_PERMISSIONS_ARRAY;
                        @endphp
                        <div class="form-group">
                            <div class="controls">
                                @foreach($permissionsArr as $permission)
                                    <label for="{{$permission}}">{{$permission}}</label>
                                    <input class="checkbox" type="checkbox" name="permissions[]"
                                           value="{{$permission}}">
                                @endforeach
                            </div>
                        </div>
                        @if(count($roles) > 0)
                            <div class="form-group">
                                <h6 class="mb-2">Assign Permissions to Role</h6>
                                <div class="controls custom-control">
                                    @foreach($roles as $role)
                                        <div>
                                            <label for="{{$role->id}}">{{$role->name}}</label>
                                            <input class="checkbox" id="{{$role->id}}" type="checkbox" name="roles[]"
                                                   value="{{$role->id}}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                        <button type="submit"
                                class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-light">Save
                            Changes
                        </button>
                        @if (! isset($item))
                            <button id="reset_btn" type="reset"
                                    class="btn btn-outline-warning mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-light">
                                Reset
                            </button>
                        @endif
                        <button id="cancel_btn" type="button"
                                class="btn btn-danger glow mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-light">Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
