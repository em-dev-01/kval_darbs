<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
  public function show()
  {
    return view('projects.show', [
      'projects' => Project::all()
    ]);
  }
}
