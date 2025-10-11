<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSiteSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::first();
        return view('admin.settings.edit', [
            'settings' => $settings,
        ]);
    }

    public function update(UpdateSiteSettingRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['system_log_enabled'] = (bool) ($data['system_log_enabled'] ?? false);

        $settings = SiteSetting::first();
        if (!$settings) {
            $settings = SiteSetting::create($data);
        } else {
            $settings->update($data);
        }

        return redirect()->route('admin.settings.edit')->with('success','Configurações salvas com sucesso.');
    }
}

