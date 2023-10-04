<?php

namespace App\Http\Controllers;

use App\Models\Happiness;
use Illuminate\Http\Request;

class HappinessController extends Controller
{
    public function getAll()
    {
        return response()->json(Happiness::all(), 200);
    }

    public function get($id)
    {
        $happiness = Happiness::findOrFail($id);
        return response()->json($happiness, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'is_workplace' => 'boolean',
            'very_happy' => 'required|numeric|gte:0',
            'happy' => 'required|numeric|gte:0',
            'content' => 'required|numeric|gte:0',
            'unhappy' => 'required|numeric|gte:0',
            'very_unhappy' => 'required|numeric|gte:0',
        ]);
        $happiness = Happiness::create($request->only([
            'name',
            'is_workplace',
            'very_happy',
            'happy',
            'content',
            'unhappy',
            'very_unhappy'
        ]));
        return response()->json($happiness, 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'string',
            'very_happy' => 'numeric|gte:0',
            'happy' => 'numeric|gte:0',
            'content' => 'numeric|gte:0',
            'unhappy' => 'numeric|gte:0',
            'very_unhappy' => 'numeric|gte:0',
        ]);
        $happiness = Happiness::findOrFail($id);
        $happiness->update($request->only([
            'name',
            'very_happy',
            'happy',
            'content',
            'unhappy',
            'very_unhappy'
        ]));
        return response()->json($happiness, 200);
    }

    public function destroy($id)
    {
        Happiness::findOrFail($id)->delete();
        return response()->json('Deleted Successfully', 200);
    }
}
