<?php

namespace App\Http\Controllers;

use App\Exports\CostExport;
use Illuminate\Http\Request;
use App\Models\Cost;
use App\Models\Project;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
class CostController extends Controller
{
    public function index($project_id){
        $project = Project::where('id', $project_id)->first();
        $costs = Cost::where('project_id', $project_id)->orderBy('created_at', 'asc')->get();
        return view('projects.costs.index', compact('project', 'costs'));
    }
    public function create($project_id){
        return view('projects.costs.create', compact('project_id'));
    }

    public function store($project_id, Request $request)
    {
        $request->validate([
            'task_title' => 'required|max:255',
            'amount' => 'required|between:0,9999.99',
            'unit' => 'prohibited_unless:custom_unit,null|required_without:custom_unit',
            'custom_unit' => 'prohibited_unless:unit,null|required_without:unit',
            'material_cost_per_unit' => 'nullable|numeric|between:0,9999.99', 
            'task_cost_per_unit' => 'nullable|numeric|between:0,9999.99',
        ]);

        //kopējo maksu aprēķini
        $total_unit_cost = $request->material_cost_per_unit+$request->task_cost_per_unit;
        $total_task_cost = $request->amount * $request->task_cost_per_unit;
        $total_material_cost = $request->amount * $request->material_cost_per_unit;
        $total_cost = $total_task_cost + $total_material_cost;
       
        $cost = new Cost($request->all());

        if($request->unit && !$request->custom_unit){
            $cost->unit = $request->unit;
        }
        elseif(!$request->unit && $request->custom_unit){
            $cost->unit = $request->custom_unit;
        }
        $cost->total_unit_cost = $total_unit_cost;
        $cost->total_task_cost = $total_task_cost;
        $cost->total_material_cost = $total_material_cost;
        $cost->total_cost = $total_cost;
        $cost->project_id = $project_id;

        $cost->save();
        return redirect()->route('projects.costs.index', $project_id);
    }

    public function edit($project_id, Cost $cost)
    {
        $costDetails = [
            'cost_id' => $cost->id,
            'task_title' => $cost->task_title,
            'unit' => $cost->unit,
            'custom_unit' => $cost->custom_unit,
            'amount' => $cost->amount,
            'material_cost_per_unit' => $cost->material_cost_per_unit,
            'task_cost_per_unit' => $cost->task_cost_per_unit,
            'project_id' => $project_id,
        ];
        return response()->json($costDetails);
    }

    public function update($project_id, Request $request, Cost $cost)
    {
        $request->validate([
            'task_title' => 'required|max:255',
            'amount' => 'required|between:0,9999.99',
            'unit' => 'prohibited_unless:custom_unit,null|required_without:custom_unit',
            'custom_unit' => 'prohibited_unless:unit,null|required_without:unit',
            'material_cost_per_unit' => 'nullable|numeric|between:0,9999.99', 
            'task_cost_per_unit' => 'nullable|numeric|between:0,9999.99',
        ]);

        if($request->unit && !$request->custom_unit){
            $cost->unit = $request->unit;
        }
        elseif(!$request->unit && $request->custom_unit){
            $cost->unit = $request->custom_unit;
        }

        $cost->total_unit_cost = $request->material_cost_per_unit+$request->task_cost_per_unit;
        $cost->total_task_cost = $request->amount * $request->task_cost_per_unit;
        $cost->total_material_cost = $request->amount * $request->material_cost_per_unit;
        $cost->total_cost = $cost->total_task_cost + $cost->total_material_cost;

        $cost->update($request->except('unit'));
        return response()->json();
    }

    public function destroy($project_id, Cost $cost)
    {
        $cost->delete();
        return redirect()->route('projects.costs.index', $project_id);
    }

    public function export($project_id){
        $project = Project::find($project_id)->title;
        return Excel::download(new CostExport($project_id),  $project.' izmaksas.xlsx');
    }
}
