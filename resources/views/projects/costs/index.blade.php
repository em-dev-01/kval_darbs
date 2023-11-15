<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
        <h1>{{ $project->title }}</h1>
        @if ($costs->count() == 0)
          <div>There are no costs created for this project yet</div>
        @else
        <table>
          <tr>
            <th>Task title</th>
            <th>Unit</th>
            <th>Amount</th>
            <th>Task cost per unit</th>
            <th>Material cost per unit</th>
            <th>Total task cost</th>
            <th>Total material cost</th>
            <th>Total cost</th>
          </tr>

          @foreach ($costs as $cost)
            <tr>
              <td>{{ $cost->task_title }}</td>
              <td>{{ $cost->unit }}</td>
              <td>{{ $cost->amount }}</td>
              <td>{{ $cost->task_cost_per_unit }}</td>
              <td>{{ $cost->material_cost_per_unit }}</td>
              <td>{{ $cost->total_task_cost }}</td>
              <td>{{ $cost->total_material_cost }}</td>
              <td>{{ $cost->total_cost }}</td>
              <td><a href="{{ route('projects.costs.edit', [$project->id, $cost->id]) }}">Edit</a></td>
              <td><form method="POST" action="{{ route('projects.costs.destroy', [$project->id, $cost->id]) }}">
                @csrf
                @method('DELETE')
                <x-danger-button>Delete</x-danger-button>
              </form></td>
            </tr>
          @endforeach
        </table>
            
        @endif
      </div>
      <a href="{{ route('projects.costs.create', $project->id) }}">Add cost</a>
    </div>
  </div>
</x-app-layout>