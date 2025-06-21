<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return TransactionHeader::with('details.category')->get();
    }

    public function show($id)
    {
        return TransactionHeader::with('details.category')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required|string',
            'code' => 'required|string',
            'rate_euro' => 'required|numeric',
            'date_paid' => 'required|date',

            'details' => 'required|array',
            'details.*.category_id' => 'required|exists:categories,id',
            'details.*.name' => 'required|string',
            'details.*.amount' => 'required|numeric',
        ]);

            $header = TransactionHeader::create([
            'description' => $data['description'],
            'code' => $data['code'],
            'rate_euro' => $data['rate_euro'],
            'date_paid' => $data['date_paid'],
        ]);

        foreach ($data['details'] as $detail) {
            $header->details()->create($detail);
        }

        return response()->json(['message' => 'Created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $header = TransactionHeader::findOrFail($id);

        $data = $request->validate([
            'description' => 'required|string',
            'code' => 'required|string',
            'rate_euro' => 'required|numeric',
            'date_paid' => 'required|date',
            'details' => 'required|array',
            'details.*.category_id' => 'required|exists:categories,id',
            'details.*.name' => 'required|string',
            'details.*.amount' => 'required|numeric',
        ]);

        $header->update($data);

        // Remove old and recreate details
        $header->details()->delete();
        foreach ($data['details'] as $detail) {
            $header->details()->create($detail);
        }

        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $header = TransactionHeader::findOrFail($id);
        $header->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    public function deleteDetail(TransactionHeader $header, $detailId)
    {
        $detail = $header->details()->findOrFail($detailId);

        if ($header->details()->count() === 1) {
            $header->delete();
        } else {
            $detail->delete();
        }

        return response()->json(['message' => 'Deleted successfully']);
    }
}