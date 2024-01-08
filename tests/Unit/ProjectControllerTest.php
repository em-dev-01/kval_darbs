<?php
namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        DB::table('roles')->insert([
            'role_name' => 'manager',
        ]);
        DB::table('roles')->insert([
            'role_name' => 'employee',
        ]);

        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'last_name' => 'test',
            'password' => 'password',
            'role_id' => 1,
            'accepted_status' => true,
        ]);

        $this->actingAs($user);

        if ($user !== null) {
            $this->actingAs($user);
        } else {
            throw new \Exception("User not found.");
        }

    }

    public function test_store_method_creates_project()
    {
        $projectData = [
            'title' => 'Test Project',
            'description' => 'This is a test project',
        ];

        $response = $this->post(route('projects.store'), $projectData);
        $id = Project::latest()->first()->id;

        $response->assertStatus(302);

        $response->assertRedirect(route('projects.show', $id));

        $this->assertDatabaseHas('projects', [
            'title' => 'Test Project',
        ]);
    }


    public function test_index_method_displays_problems_for_a_project()
    {
        $project = Project::factory()->create();
        $response = $this->get(route('projects.problems.index', $project->id));

        $response->assertStatus(200);
        $response->assertViewIs('projects.problems.index');
    }

    public function test_show_method_displays_a_single_problem()
    {
        $project = Project::factory()->create();
        $problem = Problem::factory()->create(['project_id' => $project->id]);

        $response = $this->get(route('projects.problems.show', ['project' => $project->id, 'problem' => $problem->id]));

        $response->assertStatus(200);
        $response->assertViewIs('projects.problems.show');
    }

    public function test_create_method_displays_create_form_for_a_problem()
    {
        $project = Project::factory()->create();
        $response = $this->get(route('projects.problems.create', $project->id));

        $response->assertStatus(200);
        $response->assertViewIs('projects.problems.form');
    }

    public function test_store_method_creates_a_problem_for_a_project()
    {
        Storage::fake('public');

        $project = Project::factory()->create();

        $problemData = [
            'title' => 'Test Problem',
            'description' => 'This is a test problem',
            'images' => [
                UploadedFile::fake()->image('test1.jpg'),
                UploadedFile::fake()->image('test2.jpg'),
            ],
        ];

        $response = $this->post(route('projects.problems.store', $project->id), $problemData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('problems', [
            'title' => 'Test Problem',
            'description' => 'This is a test problem',
            'project_id' => $project->id,
        ]);

        foreach ($problemData['images'] as $image) {
            Storage::disk('public')->assertExists('images/' . $image->hashName());
            $this->assertDatabaseHas('problem_images', [
                'image_path' => 'images/' . $image->hashName(),
            ]);
        }
    }

}
