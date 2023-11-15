<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cost;
use App\Models\Project;

class CostController extends Controller
{
    public function index($project_id){
        $project = Project::with('users')->find($project_id);
        $costs = Cost::where('project_id', $project_id)->get();
        return view('projects.costs.index', compact('project', 'costs'));
    }
    public function create($project_id){
        return view('projects.costs.create', compact('project_id'));
    }

    public function store($project_id, Request $request)
    {
        $total_task_cost = $request->amount * $request->task_cost_per_unit;
        $total_material_cost = $request->amount * $request->material_cost_per_unit;
        $total_cost = $total_task_cost + $total_material_cost;
        $cost = new Cost($request->all());
        
        $cost->total_task_cost = $total_task_cost;
        $cost->total_material_cost = $total_material_cost;
        $cost->total_cost = $total_cost;
        $cost->project_id = $project_id;

        $cost->save();
        return redirect()->route('projects.costs.index', $project_id);
    }

    public function edit($project_id, Cost $cost)
    {
        return view('projects.costs.edit', compact('project_id', 'cost'));
    }

    public function update($project_id, Request $request, Cost $cost)
    {
        $cost->update($request->all());
        return redirect()->route('projects.costs.index', $project_id);
    }

    public function destroy($project_id, Cost $cost)
    {
        $cost->delete();
        return redirect()->route('projects.costs.index', $project_id);
    }
}
