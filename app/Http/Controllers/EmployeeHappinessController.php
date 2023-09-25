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

    public function getAll()
    {
        $employeeHappiness = new EmployeeHappiness;
        // $employeeHappiness->team = 'Workplace';
        $employeeHappiness->very_happy = EmployeeHappiness::all()->sum('very_happy');
        $employeeHappiness->happy = EmployeeHappiness::all()->sum('happy');
        $employeeHappiness->content = EmployeeHappiness::all()->sum('content');
        $employeeHappiness->unhappy = EmployeeHappiness::all()->sum('unhappy');
        $employeeHappiness->very_unhappy = EmployeeHappiness::all()->sum('very_unhappy');

        return response()->json($employeeHappiness, 200);
    }

    public function get($id)
    {
        $employeeHappiness = EmployeeHappiness::findOrFail($id);
        return response()->json($employeeHappiness, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'team' => 'required',
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

        return response()->json($employeeHappiness, 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'team' => 'required',
            'very_happy' => 'required|numeric|gte:0',
            'happy' => 'required|numeric|gte:0',
            'content' => 'required|numeric|gte:0',
            'unhappy' => 'required|numeric|gte:0',
            'very_unhappy' => 'required|numeric|gte:0',
        ]);

        $employeeHappiness = EmployeeHappiness::findOrFail($id);
        $employeeHappiness->update([
            'very_happy' => $request->input('very_happy'),
            'happy' => $request->input('happy'),
            'content' => $request->input('content'),
            'unhappy' => $request->input('unhappy'),
            'very_unhappy' => $request->input('very_unhappy'),
        ]);

        return response()->json($employeeHappiness, 200);
    }

    public function destroy($id)
    {
        EmployeeHappiness::findOrFail($id)->delete();
        return response()->json('Deleted Successfully', 200);
    }
}
