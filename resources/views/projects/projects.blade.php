<x-app-layout>
    <div class="w-full">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Members</th>
                <th scope="col">Deadline</th>
                <th class="ml-10" scope="col">View</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($projects as $project)
            @if ($project->members->contains('id', Auth::user()->id))
            <tr class="">
                <th class="" scope="row">{{ $project->title }}</th>
                <td class="">{{ $project->createdBy->name}}</td>
                <td class="">{{ $project->members->count()}}</td>
                <td class="">{{ $project->deadline }}</td>
                <td class=""><a href="{{ route('projects.show', ['project' => $project->id]) }}" class="text-blue-500 hover:text-blue-700">View</a></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
