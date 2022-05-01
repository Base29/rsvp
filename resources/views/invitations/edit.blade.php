<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Invitation
        </h2>
    </x-slot>
    <div>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
  
  <div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">

      <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="{{ route('invitations.update', $invitation->id) }} method="POST">
        @csrf
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="first-name" class="block text-sm font-medium text-gray-700">Surname</label>
                  <input type="text" name="surname" id="surname" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('surname', $invitation->surname) }}">
                </div>
  
                <div class="col-span-6 sm:col-span-3">
                  <label for="last-name" class="block text-sm font-medium text-gray-700">Display Name</label>
                  <input type="text" name="display_name" id="display_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('display_name', $invitation->display_name) }}">
                </div>
  
                <div class="col-span-6 sm:col-span-3">
                  <label for="country" class="block text-sm font-medium text-gray-700">Type</label>
                  <select id="type" name="type" autocomplete="country-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('type', $invitation->type) }}">
                    <option value="family">Family</option>
                    <option value="single">Single</option>
                  </select>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="country" class="block text-sm font-medium text-gray-700">Plus 1</label>
                    <select id="plus_one" name="plus_one" autocomplete="country-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('plus_one', $invitation->plus_one) }}">
                      <option value="yes">Yes</option>
                      <option value="no">No</option>
                    </select>
                  </div>
  
                <div class="col-span-6">
                  <label for="street-address" class="block text-sm font-medium text-gray-700">Guests</label>
                  <input type="number" name="guests" id="guests" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('guests', $invitation->guests) }}">
                </div>
               
                    <div class="mb-3 xl:w-96">
                        <label for="street-address" class="block text-sm font-medium text-gray-700">Notes</label>
                      <textarea
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        id="notes"
                        name="notes"
                        rows="3"
                        placeholder="Your note"
                        value="{{ old('notes', $invitation->notes) }}"
                      ></textarea>
                    </div>
                  
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update Invitation</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
</div>
</x-app-layout>