<x-layout>
    <div class="bg-blue-900 h-24 px-4 mb-4 flex justify-center items-center rounded">
     <x-search />
    </div>
    <x-slot:pageTitle>All Jobs</x-slot:pageTitle>
    <h1 class="text-2xl">{{ $title }}</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse($jobs as $job)
        <x-job-card :job="$job" />
        @empty
        <p>No jobs found</p>
        @endforelse
    </div>
</x-layout>

<!-- Pagination Links -->
<div class="mt-4">{{ $jobs->links() }}</div>