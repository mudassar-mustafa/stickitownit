<?php

namespace App\Http\Controllers\Backend;


use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Traits\UploadFile;
class SettingController extends Controller
{
    use UploadFile;
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('backend.pages.settings.index', [
            'setting' => Setting::first(),
        ]);
    }

    /**
     * Update the settings information.
     */
    public function update(Request $request): RedirectResponse
    {

        $setting = Setting::first();
        if ($request->tab === 'general_settings') {
            $status = 'general-settings';
            $this->validate($request, [
                'company_name' => 'required',
                'company_short_description' => 'required',
                'email' => 'required',
                'phone_number' => 'required',
                'address' => 'required',
                'office_hours' => 'required',
                'office_working_days' => 'required',
                'number_of_images' => 'required',
                'model_id' => 'required',
                'width' => 'required',
                'height' => 'required',
            ]);
            if ($request->has('logo_header')) {
                $logo_header = $this->upload($request->logo_header, 'settings');
            } else {
                $logo_header = $setting->logo_header;
            }
            if ($request->has('logo_footer')) {
                $logo_footer = $this->upload($request->logo_footer, 'settings');
            } else {
                $logo_footer = $setting->logo_footer;
            }
            $setting->update([
                'logo_header' => $logo_header,
                'logo_footer' => $logo_footer,
                'company_name' => $request->company_name,
                'company_short_description' => $request->company_short_description,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'office_hours' => $request->office_hours,
                'number_of_images' => $request->number_of_images,
                'model_id' => $request->model_id,
                'width' => $request->width,
                'height' => $request->height,
            ]);
        } elseif ($request->tab === 'banner_settings') {
            $status = 'banner-settings';
            $this->validate($request, [
                'banner_tag_line' => 'required',
                'banner_tag_line_description' => 'required',
            ]);
            if ($request->has('banner_one')) {
                $banner_one = $this->upload($request->banner_one, 'settings');
            } else {
                $banner_one = $setting->banner_one;
            }
            if ($request->has('banner_two')) {
                $banner_two = $this->upload($request->banner_two, 'settings');
            } else {
                $banner_two = $setting->banner_two;
            }
            $setting->update([
                'banner_one' => $banner_one,
                'banner_two' => $banner_two,
                'banner_tag_line' => $request->banner_tag_line,
                'banner_tag_line_description' => $request->banner_tag_line_description,
            ]);
        } elseif ($request->tab === 'social_settings') {
            $status = 'social-settings';
            $this->validate($request, [
                'facebook_url' => 'required',
                'twitter_url' => 'required',
                'instagram_url' => 'required',
                'youtube_url' => 'required',
                'linkedin_url' => 'required',
            ]);

            $setting->update([
                'facebook_url' => $request->facebook_url,
                'twitter_url' => $request->twitter_url,
                'instagram_url' => $request->instagram_url,
                'youtube_url' => $request->youtube_url,
                'linkedin_url' => $request->linkedin_url,
            ]);
        }


        return Redirect::route('backend.settings.index')->with([
                'status' => $status,
            ]
        );
    }

}
