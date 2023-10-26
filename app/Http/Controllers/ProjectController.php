<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Enums\StatusEnum;
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
}
