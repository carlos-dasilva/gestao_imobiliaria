<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAboutPageRequest;
use App\Models\AboutPage;
use App\Models\AboutValue;
use Illuminate\Http\RedirectResponse;

class AboutController extends Controller
{
    public function edit()
    {
        $page = AboutPage::with('values')->first();
        return view('admin.about.edit', [
            'page' => $page,
        ]);
    }

    public function update(UpdateAboutPageRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $page = AboutPage::first();
        if (!$page) {
            $page = new AboutPage();
        }

        $page->fill([
            'who_i_am' => $data['who_i_am'] ?? null,
            'purpose' => $data['purpose'] ?? null,
            'how_i_work' => $data['how_i_work'] ?? null,
        ]);
        $page->save();

        // Atualiza lista de valores
        $values = collect($data['values'] ?? [])
            ->map(fn($v) => trim((string) $v))
            ->filter(fn($v) => $v !== '')
            ->values();

        // Limpa e recria mantendo ordem
        AboutValue::where('about_page_id', $page->id)->delete();
        foreach ($values as $idx => $val) {
            AboutValue::create([
                'about_page_id' => $page->id,
                'value' => $val,
                'position' => $idx,
            ]);
        }

        return redirect()->route('admin.about.edit')->with('success', 'Quem Somos salvo com sucesso.');
    }
}

