<?php

namespace App\Http\Controllers\ACL;

use App\DataTables\PermissionsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Enums\CommonEnum;
use App\Services\UtilService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
        UtilService    $utilService,
        PermissionsDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.acl.permissions.list');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.permissions.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::all();
        return view('backend.pages.acl.permissions.add', ['roles' => $roles, 'title' => 'Add Permission']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UtilService $utilService): RedirectResponse
    {
        try {
            $request->validate([
                'name' => 'required|max:100',
                'permissions' => 'required'
            ]);
            $moduleName = $request['name'];
            $rolesArr = $request['roles'];
            $isErrorFound = false;
            $permissionsArr = array();
            $i = 0;
            foreach ($request['permissions'] as $permission) {
                $per = Permission::create(['name' => $moduleName . '.' . $permission]);
                if ($per == null) {
                    $isErrorFound = true;
                    break;
                }
                $permissionsArr[$i++] = $per;
            }
            if (isset($rolesArr)) {
                foreach ($rolesArr as $roleId) {
                    $role = Role::findById($roleId);
                    $role->syncPermissions($permissionsArr);
                }
            }
            return redirect()->route("backend.permissions.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Permissions saved successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.permissions.store', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id, UtilService $utilService)
    {
        try {
            Permission::findOrFail($id)->delete();
            return redirect()->route("backend.permissions.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Record Successfully deleted."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.permissions.index', $exception->getMessage());
        }
    }
}
