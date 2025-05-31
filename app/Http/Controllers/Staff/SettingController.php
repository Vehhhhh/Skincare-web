<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Cache;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    use FileUploadTrait;

    /**
     * Update logo settings.
     *
     * @param Request $request
     * @return RedirectResponse
     */

    function index(): View
    {
        return view('staff.setting.index');
    }
    function updateGeneralSetting(Request $request)
    {
        $validateData =  $request->validate([

            'site_default_currency' => ['required', 'max:4'], //usd
            'site_currency_icon' => ['required', 'max:4'], //$
            'site_currency_icon_position' => ['required', 'max:255'],
            'site_currency_icon_position' => ['required', 'max:255'],
        ]);

        foreach ($validateData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(SettingsService::class);
        $settingsService->clearCacheSettings();

        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }
    public function UpdateLogoSetting(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'logo' => ['nullable', 'image', 'max:1000'],
            'footer_logo' => ['nullable', 'image', 'max:1000'],
            'favicon' => ['nullable', 'image', 'max:1000'],
            'breadcrumb' => ['nullable', 'image', 'max:1000'],
        ]);

        foreach ($validatedData as $key => $value) {
            $oldPath = config('settings.' . $key);
            $imagePatch = $this->uploadImage($request, $key, $oldPath, '/uploads/settings');

            if ($imagePatch) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $imagePatch]
                );
            }
        }

        $settingsService = app(SettingsService::class);
        $settingsService->clearCacheSettings();
        Cache::forget('mail_settings');

        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }
}
