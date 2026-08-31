<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goat;
use App\Models\GoatHealthRecord;
use Illuminate\Http\Request;

class GoatHealthController extends Controller
{
    public function store(Request $request, Goat $goat)
    {
        $data = $request->validate([
            'record_type' => 'required|string|max:50',
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'veterinarian' => 'nullable|string|max:100',
            'record_date' => 'required|date',
            'next_due_date' => 'nullable|date',
            'cost' => 'nullable|numeric|min:0',
        ]);

        $goat->healthRecords()->create($data);

        return back()->with('success', 'Health record added.');
    }

    public function destroy(GoatHealthRecord $record)
    {
        $record->delete();

        return back()->with('success', 'Health record deleted.');
    }
}