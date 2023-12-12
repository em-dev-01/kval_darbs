<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Enums\StatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use App\Models\User;

class ProjectController extends Controller
{
  public function index()
  {
    $projects = Project::all();
    return view('projects.index', compact('projects'));
  }

  public function create()
  {
    $employees = User::where('role_id', 2 )->get();
    return view('projects.create', compact('employees'));
  }

  public function show(Project $project)
  {
    $project = Project::with('users')->find($project->id);
    return view('projects.show', compact('project'));
  }
  
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|max:255|unique:projects',
      'status' => [new Enum(StatusEnum::class)],
      'due_date' => 'required|date|after:today',
    ]);

    $selected_employees = $request->input('selected_employees');
    $project = Project::create($request->all());
    $project->users()->sync($selected_employees);
    $project->save();
    return redirect()->route('projects.show', $project);
  }

  public function edit(Project $project)
  {
    $employees = User::where('role_id', 2 )->get();
    $selected_employees = $project->users()->where('role_id', 2)->get();
    return view('projects.edit', compact('project','employees', 'selected_employees'));
  }

  public function update(Request $request, Project $project)
  {
    $request->validate([
      'title' => ['required', 'max:255', Rule::unique('projects')->ignore($project->id)],
      'status' => [new Enum(StatusEnum::class)],
      'due_date' => 'required|date|after:today',
    ]);

    //pievienot un no?emt darbiniekus, kas str?d? pie projekta
    $selected_employees = $request->input('selected_employees', []);
    $current_employees = $project->users()->where('role_id', 2)->pluck('users.id')->toArray();
    $employeesToDetach = array_diff($current_employees, $selected_employees);
    $employeesToAttach = array_diff($selected_employees, $current_employees); 

    $project->users()->detach($employeesToDetach);
    $project->users()->attach($employeesToAttach);

    $project->update($request->all());

    return redirect()->route('projects.show', $project)->with('projectData', $project);
  }

  public function destroy(Project $project)
  {
    $project->delete();
    return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
  }
}
