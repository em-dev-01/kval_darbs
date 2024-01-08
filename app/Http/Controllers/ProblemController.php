<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProblemController extends Controller
{
    public function index(Project $project)
    {
        $problems = $project->problems()->orderBy('updated_at', 'desc')->get();
        return view('projects.problems.index', compact('problems', 'project'));
    }

    public function show(Project $project, Problem $problem)
    {
        $problemImages = DB::table('problem_images')
            ->where('problem_id', $problem->id)
            ->get();
        return view('projects.problems.show', compact('problem', 'problemImages'));
    }

    public function create(Project $project)
    {
        return view('projects.problems.form', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg',
        ]);

        $problem = new Problem();

        $problem->title = $request->title;
        $problem->description = $request->description;
        $problem->project_id = $project->id;
    
        $problem->save();
        //funkcija saglabā failus un ievieto attēla ceļu tabulā "problem_images"
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '-' . $image->getClientOriginalName();
                $image->storeAs('public/images', $image_name);
                DB::table('problem_images')->insert([
                    'problem_id' => $problem->id,
                    'image_path' => $image_name,
                    'created_at' => now(),
                ]);
            }
        }

        return redirect()->route('projects.problems.index', $project)->with('success', 'Problēma pievienota');
    }

    public function edit(Project $project, Problem $problem)
    {
        $images = DB::table('problem_images')->where('problem_id', $problem->id)->get();
        return view('projects.problems.form', compact('project', 'problem', 'images'));
    }

    public function update(Request $request, Project $project, Problem $problem)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg',
        ]);

        $problem->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '-' . $image->getClientOriginalName();
                $image->storeAs('public/images', $image_name);
                DB::table('problem_images')->insert([
                    'problem_id' => $problem->id,
                    'image_path' => $image_name,
                    'created_at' => now(),
                ]);
            }
        }

        return redirect()->route('projects.problems.index', $project)->with('success', 'Problēma rediģēta');
    }

    public function close(Problem $problem)
    {
        $problem->open_status = false;
        $problem->save();

        return redirect()->back();
    }

    public function destroy(Project $project, Problem $problem)
    {
        $problem->delete();
        return redirect()->route('projects.problems.index', $project)->with('success', 'Problēma dzēsta');
    }
}
