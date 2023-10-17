@extends('backend.layouts.app')
@section('title', $title)

@section('earlyScripts')

@endsection

@section('content')
    <main id="main" class="main">
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="add-edit-form" enctype="multipart/form-data" novalidate=""
                                  method="post"
                                  action="{{ isset($item) ? route('backend.roles.update', ['id' => $item->id]) : route('backend.roles.store') }}">
                                @csrf
                                <div class="row">
                                    <input type="hidden" id="_id" name="id"
                                           value="@php echo isset($item) ? $item->id : '' @endphp">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="name">Role Name</label>
                                                <input type="text" name="name" id="name" placeholder="Name"
                                                       class="form-control"
                                                       value="@php echo isset($item) ? $item->name : '' @endphp" @php echo isset($item) ? 'readonly' : '' @endphp>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 mt-4">
                                        <h6 class="mb-2">Assign Permissions</h6>
                                        @php
                                            $permissions = \Spatie\Permission\Models\Permission::all();
                                            $modules = array();
                                            $lastModule = null;
                                            $operations = array();
                                            $finalArr = array();
                                            $i = 0;
                                            foreach ($permissions as $permission) {
                                                $nameArr = explode(".", $permission->name);
                                                if(count($nameArr) > 1) {
                                                    if(!in_array($nameArr[0], $modules)) {
                                                        if($lastModule != null) {
                                                            $finalArr[$lastModule] = $operations;
                                                        }
                                                        $lastModule = $nameArr[0];
                                                        $modules[$i++]= $lastModule;
                                                        $operations = array();
                                                    }
                                                    $operations[$nameArr[1]] = $permission->id;
                                                }
                                            }
                                            if($operations !== null){
                                                $finalArr[$lastModule] = $operations;
                                            }
                                            //dd($finalArr);
                                        @endphp
                                        <div class="form-group">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Module</th>
                                                    <th class="text-center">Create</th>
                                                    <th class="text-center">Read</th>
                                                    <th class="text-center">Update</th>
                                                    <th class="text-center">Delete</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($finalArr as $key => $values)
                                                    <tr>
                                                        <td class="text-center">{{$key}}</td>
                                                        @foreach(\App\Helpers\AclHelper::$BASIC_PERMISSIONS_ARRAY as $permission)
                                                            <td class="text-center">
                                                                @if(array_key_exists($permission, $values))
                                                                    <input class="checkbox center" type="checkbox"
                                                                           name="permissions[]"
                                                                           @php echo isset($item) ? \App\Http\Controllers\ACL\RolesController::isPermissionSelected($item->permissions, $key.'.'.$permission) ? 'checked' : '' : '' @endphp
                                                                           value="{{$values[$permission]}}">
                                                                @endif
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                        <button type="submit"
                                                class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-5 waves-effect waves-light">
                                            Save Changes
                                        </button>
                                        <a href="{{ route('backend.roles.index') }}" type="button"
                                           class="btn btn-danger glow mb-1 mb-sm-0 waves-effect waves-light">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
