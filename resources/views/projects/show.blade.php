<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
        {{ $project->title }}
        {{ $project->due_date }}
        {{ $project->status }}
        {{ $project->city }}
        {{ $project->county }}
        {{ $project->parish }}
        {{ $project->village }}
        {{ $project->street }}
        {{ $project->hoise }}
        {{ $project->apartment }}
      </div>
      <div id="employees">
        List of employees working on this project:
        @foreach($project->users as $user)
          <li>{{ $user->name }}</li>
        @endforeach
      </div>

      <a href="{{ route('projects.edit', $project->id) }}">Edit project</a>
      <form method="POST" action="{{ route('projects.destroy', $project) }}">
        @csrf
        @method('DELETE')
        <x-danger-button>Delete</x-danger-button>
      </form>
    </div>
  </div>
</x-app-layout>
