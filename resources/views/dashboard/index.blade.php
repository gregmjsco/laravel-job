<x-layout> 
    <section class="flex flex-col md:flex-row gap-6">
        <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-1/2">
            <h3 class="text-3xl text-center font-bold mb-4">Profile Info</h3>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
          
              <div class="mb-4">
                <label class="block text-gray-700" for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ $user->name }}"
                  class="w-full px-4 py-2 border rounded focus:outline-none" />
              </div>
              <div class="mb-4">
                <label class="block text-gray-700" for="email">Email</label>
                <input id="email" type="text" name="email" value="{{ $user->email }}"
                  class="w-full px-4 py-2 border rounded focus:outline-none" />
              </div>
              <div class="mb-4">
                <label class="block text-gray-700" for="avatar">Profile Avatar</label>
                <input id="avatar" type="file" name="avatar" class="w-full px-4 py-2 border rounded focus:outline-none" />
              </div>
              <button type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">Save</button>
            </form>
          </div>

    <div class="bg-white p-8 rounded-lg shadow-md w-full">
        <h3 class="text-3xl text-center font-bold mb-4">My Job Listings</h3>
        @forelse ($jobs as $job)
        <div
          class="flex justify-between items-center border-b-2 border-gray-200 py-2"
        >
          <div>
            <h3 class="text-xl font-semibold">{{ $job->title }}</h3>
            <p class="text-gray-700">{{ $job->job_type }}</p>
          </div>
         <div class="flex space-x-4">
            <a
              href="{{ route('jobs.edit', $job->id) }}"
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm"
              >Edit</a
            >
            <form method="POST" action="{{ route('jobs.destroy', $job->id) }}?from=dashboard" onsubmit="return confirm('Are you sure you want to delete this job?');">
              @csrf @method('DELETE')
              <button
                type="submit"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm"
              >
                Delete
              </button>
            </form>
          </div>
        </div>
        @empty
        <p class="text-gray-700">You have no job listings.</p>
        @endforelse
      </div>    
    </section>
    <x-bottom-banner />
</x-layout>