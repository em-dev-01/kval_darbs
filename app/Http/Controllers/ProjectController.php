<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Enums\StatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ProjectController extends Controller
{
  public function index()
  {
    return view('projects.index', [
      'projects' => Project::all()
    ]);
  }

  public function create()
  {
    return view('projects.create');
  }

  public function show($project)
  {
    return view('projects.show', ['project' => Project::find($project)]);
  }
  public function store(Request $request)
  {

    $request->validate([
      'title' => 'required|max:255|unique:projects',
      'status' => [new Enum(StatusEnum::class)],
      'due_date' => 'required|date|after:today',
    ]);
    $project = Project::create($request->all());
    $project->save();
    return to_route('projects.show', ['project' => $project->id]);
  }

  public function edit($project)
  {
    return view('projects.edit', ['project' => Project::find($project)]);
  }

  public function update(Request $request, Project $project)
  {
    $request->validate([
      'title' => ['required', 'max:255', Rule::unique('projects')->ignore($project->id)],
      'status' => [new Enum(StatusEnum::class)],
      'due_date' => 'required|date|after:today',
    ]);

    $project->update($request->all());

    return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
  }

  public function destroy(Project $project)
  {
    $project->delete();
    return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
  }
}
