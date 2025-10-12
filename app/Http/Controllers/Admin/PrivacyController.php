<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePrivacyPolicyRequest;
use App\Models\PrivacyPolicy;
use App\Models\PrivacyCollectedItem;
use App\Models\PrivacyPurposeItem;
use Illuminate\Http\RedirectResponse;

class PrivacyController extends Controller
{
    public function edit()
    {
        $policy = PrivacyPolicy::with(['collectedItems','purposes'])->first();
        return view('admin.privacy.edit', [
            'policy' => $policy,
        ]);
    }

    public function update(UpdatePrivacyPolicyRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $policy = PrivacyPolicy::first();
        if (!$policy) {
            $policy = new PrivacyPolicy();
        }
        $policy->fill([
            'policy_intro' => $data['policy_intro'] ?? null,
            'bases_legais' => $data['bases_legais'] ?? null,
            'compartilhamento' => $data['compartilhamento'] ?? null,
            'retencao' => $data['retencao'] ?? null,
            'direitos_titular' => $data['direitos_titular'] ?? null,
            'seguranca' => $data['seguranca'] ?? null,
            'cookies' => $data['cookies'] ?? null,
            'atualizacoes' => $data['atualizacoes'] ?? null,
        ]);
        $policy->save();

        // Atualiza Dados coletados
        $titles = collect($data['col_titles'] ?? []);
        $descs = collect($data['col_descriptions'] ?? []);
        PrivacyCollectedItem::where('privacy_policy_id', $policy->id)->delete();
        $idx = 0;
        foreach ($titles as $i => $title) {
            $title = trim((string) $title);
            $desc = trim((string) ($descs[$i] ?? ''));
            if ($title === '' && $desc === '') continue;
            PrivacyCollectedItem::create([
                'privacy_policy_id' => $policy->id,
                'title' => $title,
                'description' => $desc,
                'position' => $idx++,
            ]);
        }

        // Atualiza Finalidades
        $purposes = collect($data['purposes'] ?? [])
            ->map(fn($v) => trim((string) $v))
            ->filter(fn($v) => $v !== '')
            ->values();
        PrivacyPurposeItem::where('privacy_policy_id', $policy->id)->delete();
        foreach ($purposes as $i => $text) {
            PrivacyPurposeItem::create([
                'privacy_policy_id' => $policy->id,
                'text' => $text,
                'position' => $i,
            ]);
        }

        return redirect()->route('admin.privacy.edit')->with('success','Política de Privacidade salva com sucesso.');
    }
}

