<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
        <form method="POST" action="{{ route('projects.store') }}">
          @csrf

          <!-- Title -->
          <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required
              autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
          </div>

          <!-- Address -->

          <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')"
              autofocus autocomplete="City" />
          </div>

          <div>
            <x-input-label for="county" :value="__('County')" />
            <x-text-input id="county" class="block mt-1 w-full" type="text" name="county" :value="old('county')"
              autofocus autocomplete="County" />
          </div>

          <div>
            <x-input-label for="parish" :value="__('Parish')" />
            <x-text-input id="parish" class="block mt-1 w-full" type="text" name="parish" :value="old('parish')"
              autofocus autocomplete="Parish" />
          </div>

          <div>
            <x-input-label for="village" :value="__('Village')" />
            <x-text-input id="village" class="block mt-1 w-full" type="text" name="village" :value="old('Village')"
              autofocus autocomplete="Village" />
          </div>

          <div>
            <x-input-label for="street" :value="__('Street')" />
            <x-text-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')"
              autofocus autocomplete="Street" />
          </div>

          <div>
            <x-input-label for="house" :value="__('House')" /><span>Name or number</span>
            <x-text-input id="house" class="block mt-1 w-full" type="text" name="house" :value="old('house')"
              autofocus autocomplete="House" />
          </div>

          <div>
            <x-input-label for="apartment" :value="__('Apartment')" />
            <x-text-input id="apartment" class="block mt-1 w-full" type="text" name="apartment" :value="old('apartment')"
              autofocus autocomplete="Apartment" />
          </div>
          <!-- Due date -->

          <div>
            <x-input-label for="due_date" :value="__('Due date')" />
            <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date" :value="old('due_date')"
              required autofocus autocomplete="due_date" />
            <x-input-error :messages="$errors->get('due_date')" class="mt-2" />

          </div>

          <!-- Status -->

          <div>
            <x-input-label for="status" :value="__('Status')" />
            <select name="status" id="status" class="block mt-1 w-full" required autofocus>
              @foreach (App\Enums\StatusEnum::values() as $enumValue)
                <option value="{{ $enumValue }}"
                  {{ old('status', App\Enums\StatusEnum::STARTED) == $enumValue ? 'selected' : '' }}>{{ $enumValue }}
                </option>
              @endforeach
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />

          </div>
           <!-- Add employees -->
          <div>
            <x-input-label for="employees" :value="__('Employees')" />
            @foreach ($employees as $employee)
              <input type="checkbox" name="selected_employees[]" value="{{ $employee->id }}">
              {{ $employee->name }}
            @endforeach

            <x-input-error :messages="$errors->get('employees')" class="mt-2" />

          </div>

         


          <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
              {{ __('Create') }}
            </x-primary-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
