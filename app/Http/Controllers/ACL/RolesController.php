<?php

namespace App\Http\Controllers\ACL;

use App\DataTables\RolesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Enums\CommonEnum;
use App\Services\UtilService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public static function isPermissionSelected($permissionsArr, $permissionString)
    {
        foreach ($permissionsArr as $permission) {
            if ($permission->name === $permissionString) {
                return true;
            }
        }
        return false;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        RolesDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.acl.roles.list');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.roles.index', $exception->getMessage());
        }
    }

    public function create(): View
    {
        return view('backend.pages.acl.roles.add', ['title' => 'Add Role']);
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
                'name' => 'required|max:50',
                'permissions' => 'required'
            ]);
            $roleName = $request['name'];
            $permissions = $request['permissions'];
            $role = Role::create(['name' => $roleName]);
            $role->syncPermissions($permissions);
            return redirect()->route("backend.roles.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Role saved successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.roles.store', $exception->getMessage());
        }

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $role = Role::findById($id);
        return view('backend.pages.acl.roles.add', ['title' => 'Edit Role', 'item' => $role]);
    }

    /**
     * @param $id
     * @param Request $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update(Request $request, $id, UtilService $utilService)
    {
        try {
            $request->validate([
                'name' => 'required|max:50',
                'permissions' => 'required'
            ]);
            $permissions = $request['permissions'];

            $role = Role::findById($id);
            $role->syncPermissions($permissions);
            return redirect()->route("backend.roles.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Record updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.roles.update', $exception->getMessage());
        }
    }


    public function destroy($id, UtilService $utilService)
    {
        try {
            Role::findOrFail($id)->delete();
            return redirect()->route("backend.roles.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Record Successfully deleted."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.roles.index', $exception->getMessage());
        }
    }

}
