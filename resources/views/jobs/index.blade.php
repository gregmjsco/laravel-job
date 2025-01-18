<x-layout>
    <x-slot name="title">Available Jobs</x-slot>
    @forelse($jobs as $job)
        <li><a href="{{route('jobs.show', $job->id)}}">{{ $job->title }} </a> - {{ $job->description }}</li>
    @empty
        <li>No Jobs Found</li>
    @endforelse

</x-layout>