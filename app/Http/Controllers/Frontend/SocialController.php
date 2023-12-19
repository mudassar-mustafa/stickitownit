<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Package;
use App\Models\PackageSubscription;

class SocialController extends Controller
{

    public function signInwithGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
    public function callbackToGoogle(UtilService $utilService)
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('google_user_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect('/');

            }else{

                $checkUser = User::whereEmail($user->email)->first();
                if (!is_null($checkUser)) {
                    $checkUser->google_user_id = $user->id;
                    $checkUser->save();
                    $newUser = $checkUser;
                } else {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_user_id' => $user->id,
                        'user_type' => 'customer',
                        'status' => 'active',
                        'password' => encrypt('customer@123')
                    ]);

                    $newUser->assignRole(Role::findById(3));
                    $package = Package::where('name', strtolower('free'))->first();

                    $startDate = date('Y-m-d H:i:s');
                    $endDate = date('Y-m-d H:i:s', strtotime($startDate . ' + 7 day'));

                    $packageSubscription = new PackageSubscription;
                    $packageSubscription->user_id = $newUser->id;
                    $packageSubscription->package_id = $package->id;
                    $packageSubscription->package_name = $package->name;
                    $packageSubscription->package_type = $package->package_type;
                    $packageSubscription->token = $package->token;
                    $packageSubscription->remaing_token = $package->token;
                    $packageSubscription->start_date = $startDate;
                    $packageSubscription->end_date = $endDate;
                    $packageSubscription->status = "active";
                    $packageSubscription->save();
                }


                Auth::login($newUser);

                return redirect('/');
            }

        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('callbackToGoogle', $exception->getMessage());
        }
    }
}
