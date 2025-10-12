<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTermsPageRequest;
use App\Models\TermsPage;
use App\Models\TermsResponsibility;
use Illuminate\Http\RedirectResponse;

class TermsController extends Controller
{
    public function edit()
    {
        $page = TermsPage::with('responsibilities')->first();
        return view('admin.terms.edit', [
            'page' => $page,
        ]);
    }

    public function update(UpdateTermsPageRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $page = TermsPage::first();
        if (!$page) {
            $page = new TermsPage();
        }
        $page->fill([
            'terms_intro' => $data['terms_intro'] ?? null,
            'services' => $data['services'] ?? null,
            'intellectual_property' => $data['intellectual_property'] ?? null,
            'communications' => $data['communications'] ?? null,
            'privacy' => $data['privacy'] ?? null,
            'forum' => $data['forum'] ?? null,
        ]);
        $page->save();

        // Atualiza responsabilidades
        $resp = collect($data['responsibilities'] ?? [])
            ->map(fn($v) => trim((string) $v))
            ->filter(fn($v) => $v !== '')
            ->values();
        TermsResponsibility::where('terms_page_id', $page->id)->delete();
        foreach ($resp as $i => $text) {
            TermsResponsibility::create([
                'terms_page_id' => $page->id,
                'text' => $text,
                'position' => $i,
            ]);
        }

        return redirect()->route('admin.terms.edit')->with('success','Termos de Uso salvos com sucesso.');
    }
}

