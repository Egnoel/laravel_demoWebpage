<x-layout>
    <x-slot:heading>
        Job Page
    </x-slot:heading>

    <h2 class="text-gray-300 font-bold text-lg">{{$job->title}}</h2>
    <p class="text-gray-500">This job pays {{$job->salary}} per year</p>

    @can('edit')
        <p class="mt-6">
            <x-button href="/jobs/{{$job->id}}/edit">Edit Job</x-button>
        </p>
    @endcan
</x-layout>
