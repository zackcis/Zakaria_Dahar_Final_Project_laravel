<x-app-layout >
    <style>
        .oli{
            background-image: url('https://vojislavd.com/ta-template-demo/assets/img/auth-background.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
            width: 100%;
        }
        </style>
        <div class="oli w-[100%] h-[100vh] flex justify-center items-center">

            <div class=" w-[70%] p-4 rounded-lg">
        
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
                                    <td class="">{{ $project->createdBy->name }}</td>
                                    <td class="">{{ $project->members->count() }}</td>
                                    <td class="">{{ $project->deadline }}</td>
                                    <td class=""><a href="{{ route('projects.show', ['project' => $project->id]) }}"
                                            class="text-blue-500 hover:text-blue-700">View</a></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</x-app-layout>
