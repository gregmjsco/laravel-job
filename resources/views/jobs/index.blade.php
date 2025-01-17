<x-layout>
    <x-slot name="title">Available Jobs</x-slot>
    @forelse($jobs as $job)
        <li>{{ $job->title }} - {{ $job->description }}</li>
    @empty
        <li>No Jobs Found</li>
    @endforelse

</x-layout>