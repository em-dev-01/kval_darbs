<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
        <table>
          <tr>
            <th>Name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Phone nr.</th>
            <th>Role</th>
          </tr>
          @foreach ($users as $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->last_name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->phone }}</td>
              <td>{{ $user->role->role_name }}</td>
              <td><a href="{{route('users.show', $user->id)}}">View</a></td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>




</x-app-layout>
