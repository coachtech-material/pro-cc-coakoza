<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'avatar_url' => ['nullable', 'url', 'max:255'],
        ]);

        $request->user()->update($validated);

        return redirect()->route('profile.edit')->with('success', 'プロフィールを更新しました。');
    }
}
