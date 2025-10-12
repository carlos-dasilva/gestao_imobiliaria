<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSiteSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

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

        // Uploads opcionais: logo e favicon
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $data['logo_path'] = $file->store('site', 'public');
        }
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $data['favicon_path'] = $file->store('site', 'public');
        }

        $settings = SiteSetting::first();
        // Remove arquivos antigos quando substituídos
        if ($settings) {
            if (!empty($data['logo_path']) && !empty($settings->logo_path) && Storage::disk('public')->exists($settings->logo_path)) {
                Storage::disk('public')->delete($settings->logo_path);
            }
            if (!empty($data['favicon_path']) && !empty($settings->favicon_path) && Storage::disk('public')->exists($settings->favicon_path)) {
                Storage::disk('public')->delete($settings->favicon_path);
            }
        }
        if (!$settings) {
            $settings = SiteSetting::create($data);
        } else {
            $settings->update($data);
        }

        return redirect()->route('admin.settings.edit')->with('success','Configurações salvas com sucesso.');
    }
}
