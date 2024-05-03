<x-mail::message>
# Invitation

{{ Auth::user()->name }} has invited you to join {{ $project->title}} project




<x-mail::button :url="route('projects.join', ['projectId' => $project->id])">
    Join Project
</x-mail::button>

Thanks,<br>
Zentasks
</x-mail::message>
