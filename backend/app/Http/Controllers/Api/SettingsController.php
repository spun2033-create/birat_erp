<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        $result = [];
        foreach ($settings as $s) {
            $result[$s->key] = $s->value;
        }

        return response()->json(['data' => $result]);
    }

    public function update(Request $request)
    {
        $payload = $request->input('settings');
        if (!is_array($payload)) {
            return response()->json(['error' => 'Invalid payload, expected settings object'], 422);
        }

        foreach ($payload as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Return updated settings
        $settings = Setting::all();
        $result = [];
        foreach ($settings as $s) {
            $result[$s->key] = $s->value;
        }

        return response()->json(['data' => $result]);
    }
}
