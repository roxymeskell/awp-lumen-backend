<?php

namespace App\Http\Controllers;

use App\Models\EmployeeHappiness;
use Illuminate\Http\Request;

class EmployeeHappinessController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    protected function buildJsonResponse($data) {
        $employeeHappiness = new EmployeeHappiness;
        $employeeHappinessAll = EmployeeHappiness::all();
        $employeeHappiness->very_happy = $employeeHappinessAll->sum('very_happy');
        $employeeHappiness->happy = $employeeHappinessAll->sum('happy');
        $employeeHappiness->content = $employeeHappinessAll->sum('content');
        $employeeHappiness->unhappy = $employeeHappinessAll->sum('unhappy');
        $employeeHappiness->very_unhappy = $employeeHappinessAll->sum('very_unhappy');

        return response()->json([
            'total' => $employeeHappiness,
            'data' => $data,
        ], 200);
    }

    public function getAll()
    {
        return $this->buildJsonResponse(EmployeeHappiness::all());
    }

    public function get($id)
    {
        $employeeHappiness = EmployeeHappiness::findOrFail($id);
        return $this->buildJsonResponse($employeeHappiness);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'team' => 'required|string',
            'very_happy' => 'required|numeric|gte:0',
            'happy' => 'required|numeric|gte:0',
            'content' => 'required|numeric|gte:0',
            'unhappy' => 'required|numeric|gte:0',
            'very_unhappy' => 'required|numeric|gte:0',
        ]);
        $employeeHappiness = EmployeeHappiness::create([
            'team' => $request->input('team'),
            'very_happy' => $request->input('very_happy'),
            'happy' => $request->input('happy'),
            'content' => $request->input('content'),
            'unhappy' => $request->input('unhappy'),
            'very_unhappy' => $request->input('very_unhappy'),
        ]);

        return $this->buildJsonResponse($employeeHappiness);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'team' => 'string',
            'very_happy' => 'numeric|gte:0',
            'happy' => 'numeric|gte:0',
            'content' => 'numeric|gte:0',
            'unhappy' => 'numeric|gte:0',
            'very_unhappy' => 'numeric|gte:0',
        ]);

        $employeeHappiness = EmployeeHappiness::findOrFail($id);
        $employeeHappiness->update($request->all());
        // $employeeHappiness->update([
        //     'very_happy' => $request->input('very_happy'),
        //     'happy' => $request->input('happy'),
        //     'content' => $request->input('content'),
        //     'unhappy' => $request->input('unhappy'),
        //     'very_unhappy' => $request->input('very_unhappy'),
        // ]);

        return $this->buildJsonResponse($employeeHappiness);
    }

    public function destroy($id)
    {
        EmployeeHappiness::findOrFail($id)->delete();
        return $this->buildJsonResponse('Deleted Successfully');
    }
}
