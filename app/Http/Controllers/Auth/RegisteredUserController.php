<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Package;
use App\Models\PackageSubscription;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['required']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone_number' => $request->phone_number,
            'user_type' => 'customer',
            'status' => 'active'
        ]);
        $user->assignRole(Role::findById(3));
        $package = Package::where('name', strtolower('free'))->first();

        $startDate = date('Y-m-d H:i:s');
        $endDate = date('Y-m-d H:i:s', strtotime($startDate. ' + 7 day'));

        $packageSubscription = new PackageSubscription;
        $packageSubscription->user_id = $user->id;
        $packageSubscription->package_id = $package->id;
        $packageSubscription->package_name = $package->name;
        $packageSubscription->package_type = $package->package_type;
        $packageSubscription->token = $package->token;
        $packageSubscription->remaing_token = $package->token;
        $packageSubscription->start_date = $startDate;
        $packageSubscription->end_date = $endDate;
        $packageSubscription->status = "active";
        $packageSubscription->save();

        Mail::to($user->email)->send(new RegisterMail($user));


        event(new Registered($user));

        Auth::login($user);

        //return redirect(RouteServiceProvider::HOME);
        return redirect()->back();
    }
}
