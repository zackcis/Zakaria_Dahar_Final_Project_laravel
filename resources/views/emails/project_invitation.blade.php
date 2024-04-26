<x-mail::message>
# Introduction

{{ Auth::user()->name }} has invited you to join {{ $project->title}} project




<x-mail::button :url="route('projects.join', ['projectId' => $project->id])">
    Join Project
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
