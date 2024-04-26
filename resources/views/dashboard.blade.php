<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex items-start  gap-5">

            {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div> --}}

            <div class="flex flex-col justify-center items-center gap-5 ">
                <x-primary-button onclick="openProjectModal()" class="ms-3">
                    Create Project
                </x-primary-button>
                {{-- {{ dd(Auth::user()->id) }} --}}
                @if (Auth::user()->projects->isEmpty())
                    <p>No projects found for this user.</p>
                @else
                    @foreach (Auth::user()->projects  as $project)
                        <x-primary-button value="{{ $project->id }}" onclick="openProjectDetailsModal()"
                            class="ms-3 w-[200px]">{{ $project->title }}</x-primary-button>
                        <div class="project-details fixed w-full h-100 inset-0 z-50 overflow-hidden justify-center items-center animated fadeIn hidden faster"
                            style="background: rgba(0,0,0,.7);">
                            <div
                                class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded z-50 overflow-y-auto">
                                <div class="modal-content py-4 text-left px-6">
                                    <!-- Title -->
                                    <div class="flex justify-between items-center pb-3">
                                        <p class="text-2xl font-bold">{{ $project->title }}</p>
                                        <div class="modal-close cursor-pointer z-50">
                                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg"
                                                width="18" height="18" viewBox="0 0 18 18">
                                                <path
                                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                    <!-- Body -->
                                    <form id="invitationForm"
                                        action="{{ route('projects.sendInvitations', $project->id) }}" method="POST">
                                        @csrf
                                        <div class="my-3 flex flex-col gap-2 justify-center items-center">
                                            <label for="email">Email Address</label>
                                            <input id="email" type="email" name="email" required>
                                        </div>
                                        <!-- Add more input fields if needed -->
                                        <div class="flex justify-end items-center gap-3">
                                            <button type="submit"
                                                class="focus:outline-none px-4 bg-teal-500 p-3 ml-3 rounded-lg text-white hover:bg-teal-400">Send
                                                Invitation</button>
                                            <button type="button" onclick="closeProjectDetailsModal()"
                                                class="focus:outline-none px-4 bg-gray-400 p-3 rounded-lg text-black hover:bg-gray-300">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if (!$projects->isEmpty())
                <p>Projects you're a member of:</p>
                @foreach ($projects as $project)
                    {{-- Check if the user is a member of the project --}}
                    @if ($project->members->contains('id', Auth::user()->id))
                        <x-primary-button value="{{ $project->id }}" onclick="openProjectDetailsModal()"
                            class="ms-3 w-[200px]">{{ $project->title }}</x-primary-button>
                    @endif
                @endforeach
            @endif
            
                {{-- <button  class='bg-blue-500 text-white p-2 rounded text-2xl font-bold'>Open
                    </button> --}}
            </div>
            <div class="main-modal project-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn hidden faster"
                style="background: rgba(0,0,0,.7);">
                <div
                    class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                    <div class="modal-content py-4 text-left px-6">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-2xl font-bold">Create your project</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                                    height="18" viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <!--Body-->
                        <form method="POST" action="{{ route('projects.store') }}"
                            class="flex flex-col justify-center items-center w-[100%]">
                            @csrf
                            <input id="created_by" type="text" name="created_by" value="{{ Auth::user()->id }}"
                                class="hidden">
                            <div class="my-3 flex flex-col gap-2 justify-center items-center ">
                                <label for="title">Title</label>
                                <input id="title" type="text" name="title" required autofocus>
                            </div>

                            <div class="my-3 flex flex-col gap-2 justify-center items-center">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            </div>
                            <div class="my-3 flex flex-col gap-2 justify-center items-center ">
                                <label for="start_date">Start date</label>
                                <input id="start_date" type="date" name="start_date" required autofocus>
                            </div>
                            <div class="my-3 flex flex-col gap-2 justify-center items-center ">
                                <label for="deadline">Deadline</label>
                                <input id="deadline" type="date" name="deadline" required autofocus>
                            </div>

                            <!-- Add input fields for other project attributes (start date, deadline, etc.) as needed -->


                            <!--Footer-->
                            <div class="flex justify-end pt-2">
                                <button
                                    class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-black hover:bg-gray-300">Cancel</button>
                                <button
                                    class="focus:outline-none px-4 bg-teal-500 p-3 ml-3 rounded-lg text-white hover:bg-teal-400"
                                    type="submit">Create Projec</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex flex-col justify-center items-center gap-5 ">
                <x-primary-button onclick="openTaskModal()" class="ms-3 position-static">
                    Create Task
                </x-primary-button>
                @foreach ($tasks as $task)
                    <x-primary-button value="{{ $task->id }}"
                        class="ms-3 w-[200px]">{{ $task->title }}</x-primary-button>
                @endforeach
                {{-- <button  class='bg-blue-500 text-white p-2 rounded text-2xl font-bold'>Open
                    </button> --}}
            </div>

            <div class="main-modal task-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn hidden faster"
                style="background: rgba(0,0,0,.7);">
                <div
                    class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                    <div class="modal-content py-4 text-left px-6">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-2xl font-bold">Create your Task</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                                    height="18" viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <!--Body-->
                        <form method="POST" action="{{ route('tasks.store') }}"
                            class="flex flex-col justify-center gap-3 items-center w-[100%]">
                            @csrf

                            <div class="my-3 flex flex-col justify-center items-center">
                                <label for="title">Title</label>
                                <input id="title" type="text" name="title" required autofocus>
                            </div>
                            <div class="my-3 flex flex-col justify-center items-center">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="4" required></textarea>
                            </div>
                            <div class="my-3 flex flex-col justify-center items-center">
                                <label for="priority">Priority</label>
                                <select name="priority" id="priority">
                                    <option value="urgent">urgent</option>
                                    <option value="normal">normal</option>
                                </select>
                            </div>
                            <div class="my-3 flex flex-col justify-center items-center">
                                <label for="start_date">start_date</label>
                                <input id="start_date" type="date" name="start_date" required>
                            </div>
                            <div class="my-3 flex flex-col justify-center items-center">
                                <label for="deadline">Deadline</label>
                                <input id="deadline" type="date" name="deadline" required>
                            </div>

                            <div class="my-3 flex flex-col justify-center items-center">
                                <label for="project_id">Project</label>
                                <select id="project_id" name="project_id">
                                    <option value="">Click</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex justify-end items-center gap-3">

                                <button
                                    class="focus:outline-none px-4 bg-teal-500 p-3 ml-3 rounded-lg text-white hover:bg-teal-400"
                                    type="submit">Create Task</button>
                                <button
                                    class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-black hover:bg-gray-300">Cancel</button>
                            </div>

                        </form>
                        <!-- Add input fields for other project attributes (start date, deadline, etc.) as needed -->


                        <!--Footer-->
                        <div class="flex justify-end pt-2">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        const projectModal = document.querySelector('.project-modal');
        const taskModal = document.querySelector('.task-modal');
        const projectDetailsModal = document.querySelector('.project-details'); // Define projectDetailsModal

        const modalClose = (modal) => {
            modal.classList.add('fadeOut');
            modal.classList.remove('fadeIn');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 500);
        }

        const openProjectModal = () => {
            projectModal.classList.remove('hidden');
            projectModal.classList.remove('fadeOut'); // Remove fadeOut class
            projectModal.classList.add('fadeIn');
            projectModal.style.display = 'flex';
        }

        const openTaskModal = () => {
            taskModal.classList.remove('hidden');
            taskModal.classList.remove('fadeOut'); // Remove fadeOut class
            taskModal.classList.add('fadeIn');
            taskModal.style.display = 'flex';
        }

        const openProjectDetailsModal = () => {
            projectDetailsModal.classList.remove('hidden'); // Fix modal class name
            projectDetailsModal.classList.remove('fadeOut'); // Remove fadeOut class
            projectDetailsModal.classList.add('fadeIn'); // Add fadeIn class
            projectDetailsModal.style.display = 'flex';
        }

        const closeProjectModal = () => {
            modalClose(projectModal);
        }

        const closeTaskModal = () => {
            modalClose(taskModal);
        }
        const closeProjectDetailsModal = () => {
            modalClose(projectDetailsModal);
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == projectModal) closeProjectModal();
            if (event.target == taskModal) closeTaskModal();
            if (event.target == projectDetailsModal) closeProjectDetailsModal(); // Fix variable name
        }

        // Function to handle invitation form submission
        const sendInvitation = (projectId) => {
            const form = document.querySelector('#invitation-form');
            form.addEventListener('submit', (event) => {
                event.preventDefault();
                const formData = new FormData(form);
                fetch(`/projects/${projectId}/send-invitations`, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data); // Handle successful response
                    })
                    .catch(error => {
                        console.error('Error:', error); // Handle error
                    });
            });
        }
    </script>
</x-app-layout>
