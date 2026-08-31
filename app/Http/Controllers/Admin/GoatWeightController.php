<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goat;
use App\Models\GoatWeightRecord;
use Illuminate\Http\Request;

class GoatWeightController extends Controller
{
    public function store(Request $request, Goat $goat)
    {
        $data = $request->validate([
            'weight' => 'required|numeric|min:0',
            'recorded_at' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $goat->weightRecords()->create($data);

        $goat->update(['weight' => $data['weight']]);

        return back()->with('success', 'Weight record added.');
    }

    public function destroy(GoatWeightRecord $record)
    {
        $record->delete();

        return back()->with('success', 'Weight record deleted.');
    }
}