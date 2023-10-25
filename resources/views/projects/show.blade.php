<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
        <table>
          <tr>
            <th>Title</th>
            <th>Address</th>
            <th>Due date</th>
            <th>Status</th>
          </tr>
          @foreach ($projects as $project)
            <tr>
              <td>{{ $project->title }}</td>
              <td>{{ $project->address }}</td>
              <td>{{ $project->due_date }}</td>
              <td>{{ $project->status }}</td>
              {{-- <td><a href="{{route('users.show', $user->id)}}">View</a></td> --}}
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>

</x-app-layout>
