<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Contracts\View\View;
use App\Contracts\Backend\UserContract;

use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\UserDataTable;

class UserController extends Controller
{
    /**
     * @var UserContract
     */
    protected $userRepository;

    public function __construct(UserContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        UserDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.user.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.users.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->back();
        return view('backend.pages.user.create');
    }

    /**
     * @param StoreUserRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->userRepository->createUser($data);

            return redirect()->route("backend.pages.users.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "User has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.users.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $user = $this->userRepository->findUserById($id);
            return view('backend.pages.user.edit', compact('user'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.users.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdateUserRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdateUserRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->userRepository->updateUser($id, $data);

            return redirect()->route("backend.pages.users.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "User has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.users.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->userRepository->deleteUser($id);
            return redirect()->route("backend.pages.users.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "User has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.users.destroy', $exception->getMessage());
        }
    }
}
