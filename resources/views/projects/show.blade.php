<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
        {{ $project->title }}
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
