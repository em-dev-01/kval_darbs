<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
        <form method="POST" action="{{ route('projects.costs.update', [$project_id, $cost->id]) }}">
          @csrf
          @method('PUT')
          <!-- Task title -->
  
          <div>
            <x-input-label for="task_title" :value="__('Task title')" />
            <x-text-input id="task_title" class="block mt-1 w-full" type="text" name="task_title"
              :value="old('task_title', $cost->task_title)" required autofocus autocomplete="task_title" />
            <x-input-error :messages="$errors->get('task_title')" class="mt-2" />
          </div>
  
          <!-- Unit -->
  
          <div>
            <x-input-label for="unit" :value="__('Unit')" />
            <x-text-input id="unit" class="block mt-1 w-full" type="text" name="unit"
              :value="old('unit', $cost->unit)" required autofocus autocomplete="unit" />
            <x-input-error :messages="$errors->get('unit')" class="mt-2" />
          </div>
  
          <!-- Amount -->
  
          <div>
            <x-input-label for="amount" :value="__('Amount')" />
            <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount"
              :value="old('amount', $cost->amount)" required autofocus autocomplete="amount" />
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
          </div>
  
          <!-- Task cost per unit -->
  
          <div>
            <x-input-label for="task_cost_per_unit" :value="__('Task cost per unit')" />
            <x-text-input id="task_cost_per_unit" class="block mt-1 w-full" type="number" name="task_cost_per_unit"
              :value="old('task_cost_per_unit', $cost->task_cost_per_unit)" required autofocus autocomplete="task_cost_per_unit" />
            <x-input-error :messages="$errors->get('task_cost_per_unit')" class="mt-2" />
          </div>
        
          <!-- Material cost per unit -->
  
          <div>
            <x-input-label for="material_cost_per_unit" :value="__('Material cost per unit')" />
            <x-text-input id="material_cost_per_unit" class="block mt-1 w-full" type="number" name="material_cost_per_unit"
              :value="old('material_cost_per_unit', $cost->material_cost_per_unit)" required autofocus autocomplete="material_cost_per_unit" />
            <x-input-error :messages="$errors->get('material_cost_per_unit')" class="mt-2" />
          </div>
  
          <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
              {{ __('Update') }}
            </x-primary-button>
          </div>
          </form>
        </div>
    </div>
  </div>
  </x-app-layout>
  