<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Hello, ') }} {{ Auth::user()->name }} {{ Auth::user()->last_name }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          {{ __("You're logged in!") }}
        </div>
        <div>
          @auth
            @if (Auth::user()->role->id == 1)
              <a href="{{ route('projects.index') }}">Show all projects</a>
              <a href="{{ route('projects.create') }}">Create a new project</a>
            @endif
          @endauth
        </div>

      </div>
    </div>
  </div>
</x-app-layout>
