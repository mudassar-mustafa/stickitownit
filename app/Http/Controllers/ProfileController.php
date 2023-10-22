<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Contracts\Backend\DashboardContract;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;

class ProfileController extends Controller
{

    /**
     * @var DashboardContract
     */
    protected $dashboardRepository;

    public function __construct(DashboardContract $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        
        $countries = $this->dashboardRepository->getCountries();
        return view('backend.pages.profile.index', [
            'user' => $request->user(),
            'countries' => $countries
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        return Redirect::route('profile.edit')->with([
                'status' => 'profile-updated',
            ]
        );
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function getStates(Request $request, UtilService $utilService){
        $states = $this->dashboardRepository->getStates($request->country_id);
        return $utilService->makeResponse(200, "States get successfully", $states, CommonEnum::SUCCESS_STATUS);
    }

    public function getCities(Request $request, UtilService $utilService){
        $cities = $this->dashboardRepository->getCities($request->state_id);
        return $utilService->makeResponse(200, "Cities get successfully", $cities, CommonEnum::SUCCESS_STATUS);
    }
}
