<x-app-layout>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Created By</th>
                <th scope="col">Members</th>
                <th scope="col">Deadline</th>
                <th scope="col">View</th>
            </tr>
        </thead>
        <tbody>
            {{-- Display projects created by the user --}}
            @foreach ($ownprojects as $project)
                <tr>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->user->name }}</td>
                    <td>{{ $project->members->where('role', 'member')->count() }}</td>
                    <td>{{ $project->deadline }}</td>
                    <td><a href="{{ route('project.view', $project->id) }}">View</a></td>
                </tr>
            @endforeach

            {{-- Display projects where the user is a member --}}
            @foreach ($projects as $project)
            @if ($project->members->contains('id', Auth::user()->id))
            <tr>
                <td>{{ $project->title }}</td>
                @foreach ($project->users as $user)
                <td>{{ $user->name}}</td>
                @endforeach
                <td>{{ $project->members->where('role', 'member')->count() }}</td>
                <td>{{ $project->deadline }}</td>
                <td><a >View</a></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</x-app-layout>
