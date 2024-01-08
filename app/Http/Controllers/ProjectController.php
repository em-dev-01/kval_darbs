<?php

namespace App\Http\Controllers;

use App\Models\ClientRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->isManager()) {
            $projects = Project::all()->sortByDesc('created_at');
        } else {
            $projects = $user->projects()->orderByDesc('created_at')->get();
        }
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $employees = User::where('role_id', 2)
                  ->where('accepted_status', true)
                  ->get();
        return view('projects.create', compact('employees'));
    }

    public function createWithClient(ClientRequest $clientRequest)
    {
        $employees = User::where('role_id', 2)
            ->where('accepted_status', true)
            ->get();
        return view('projects.create', compact('employees', 'clientRequest'));
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
            'description' => 'required',
            'client_name' => 'max:255',
            'client_email' => 'email:rfc,dns|nullable|max:255',
            'city' => 'max:255',
            'parish' => 'max:255',
            'village' => 'max:255',
            'street' => 'max:255',
            'house' => 'max:255',
            'apartment' => 'max:255',
        ]);

        $selected_employees = $request->input('selected_employees');
        $project = Project::create($request->all());

        $project->client_email = $request->input('client_email');
        $project->client_name = $request->input('client_name');
        $project->client_request_id = $request->input('client_request_id');

        $project->users()->sync($selected_employees);
        $project->save();

        //ja projekts tiek izveidots no klienta pieteikuma, pieteikumam tiek pievienots projekta identifikators
        if ($project->client_request_id) {
            $clientRequest = ClientRequest::find($project->client_request_id);
            if ($clientRequest) {
                $clientRequest->project_id = $project->id;
                $clientRequest->save();
            }

        }
        return redirect()->route('projects.show', $project)->with('success', 'Projekts izveidots');
    }

    public function edit(Project $project)
    {
        $employees = User::where('role_id', 2)
            ->where('accepted_status', true)
            ->get();
        $selected_employees = $project->users()->where('role_id', 2)->get();
        return view('projects.edit', compact('project', 'employees', 'selected_employees'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required', 'max:255', Rule::unique('projects')->ignore($project->id)],
            'description' => 'required',
            'client_name' => 'max:255',
            'client_email' => 'email:rfc,dns|nullable|max:255',
            'city' => 'max:255',
            'parish' => 'max:255',
            'village' => 'max:255',
            'street' => 'max:255',
            'house' => 'max:255',
            'apartment' => 'max:255',
        ]);

        //pievieno un noņem darbiniekus, kas strādā pie projekta
        $selected_employees = $request->input('selected_employees', []); //atzīmētie darbinieki
        $current_employees = $project->users()->where('role_id', 2)->pluck('users.id')->toArray(); //esošie projekta darbinieki
        $employeesToDetach = array_diff($current_employees, $selected_employees); //atrod darbiniekus, kuri tika noņemti
        $employeesToAttach = array_diff($selected_employees, $current_employees); //atrod darbiniekus, kuri tika pievienoti

        $project->users()->detach($employeesToDetach);
        $project->users()->attach($employeesToAttach);

        $project->update($request->all());

        return redirect()->route('projects.show', $project)->with('success', "Projekts rediģēts");
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Projekts dzēsts');
    }
}
