<x-app-layout>
    <style>
        /* ---- RESET/BASIC STYLING ---- */
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: sans-serif;

            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        *::-webkit-scrollbar {
            display: none;
        }

        .board {
            width: 100%;
            height: 100vh;
            overflow: scroll;

            background-image: url(https://images.unsplash.com/photo-1519681393784-d120267933ba?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80);
            background-position: center;
            background-size: cover;
        }

        /* ---- FORM ---- */
        #todo-form {
            padding: 32px 32px 0;
        }

        #todo-form input {
            padding: 12px;
            margin-right: 12px;
            width: 225px;

            border-radius: 4px;
            border: none;

            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.25);
            background: white;

            font-size: 14px;
            outline: none;
        }

        #todo-form button {
            padding: 12px 32px;

            border-radius: 4px;
            border: none;

            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.25);
            background: #ffffff;
            color: black;

            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
        }

        /* ---- BOARD ---- */
        .lanes {
            display: flex;
            align-items: flex-start;
            justify-content: start;
            gap: 16px;

            padding: 24px 32px;

            overflow: scroll;
            height: 100%;
        }

        .heading {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .swim-lane {
            display: flex;
            flex-direction: column;
            gap: 12px;

            background: #f4f4f4;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.25);

            padding: 12px;
            border-radius: 4px;
            width: 225px;
            min-height: 120px;

            flex-shrink: 0;
        }

        .task {
            background: white;
            color: black;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);

            padding: 12px;
            border-radius: 4px;

            font-size: 16px;
            cursor: move;
        }

        .is-dragging {
            scale: 1.05;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.25);
            background: rgb(50, 50, 50);
            color: white;
        }
    </style>
    <div class="all w-full">
        <div class="board">
            <div class="w-[100%]">
    <h1 class="text-center text-white my-6"><b>Personal Tasks</b></h1>
            </div>
            <form id="todo-form">
                <button onclick="openTaskModal()" type="submit">Add +</button>
            </form>


            <div class="main-modal task-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn hidden faster"
                style="background: rgba(0,0,0,.7);">
                <div
                    class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded z-50 overflow-y-auto">
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

                            <div class="my-1 flex flex-col justify-center items-center">
                                <label for="title">Title</label>
                                <input class="bg-zinc-200 text-zinc-600 font-mono ring-1 ring-zinc-400 focus:ring-2 focus:ring-rose-400 outline-none duration-300 placeholder:text-zinc-600 placeholder:opacity-50 rounded-lg px-4 py-1 shadow-md focus:shadow-lg focus:shadow-rose-400"  id="title" type="text" name="title" required autofocus>
                            </div>
                            <div class="my-1 flex flex-col justify-center items-center">
                                <label for="description">Description</label>
                                <textarea class="bg-zinc-200 text-zinc-600 font-mono ring-1 ring-zinc-400 focus:ring-2 focus:ring-rose-400 outline-none duration-300 placeholder:text-zinc-600 placeholder:opacity-50 rounded-lg px-4 py-1 shadow-md focus:shadow-lg focus:shadow-rose-400"  id="description" name="description" rows="4" required></textarea>
                            </div>
                            <div class="my-1 flex flex-col justify-center items-center">
                                <label for="priority">Priority</label>
                                <select class="bg-zinc-200 text-zinc-600 font-mono ring-1 ring-zinc-400 focus:ring-2 focus:ring-rose-400 outline-none duration-300 placeholder:text-zinc-600 placeholder:opacity-50 rounded-lg px-4 py-1 shadow-md focus:shadow-lg focus:shadow-rose-400"  name="priority" id="priority">
                                    <option value="normal">normal</option>
                                    <option value="urgent">urgent</option>
                                </select>
                            </div>
                            <div class="my-1 flex flex-col justify-center items-center">
                                <label for="start_date">start_date</label>
                                <input class="bg-zinc-200 text-zinc-600 font-mono ring-1 ring-zinc-400 focus:ring-2 focus:ring-rose-400 outline-none duration-300 placeholder:text-zinc-600 placeholder:opacity-50 rounded-lg px-4 py-1 shadow-md focus:shadow-lg focus:shadow-rose-400"  id="start_date" type="date" name="start_date" required>
                            </div>
                            <div class="my-1 flex flex-col justify-center items-center">
                                <label for="deadline">Deadline</label>
                                <input class="bg-zinc-200 text-zinc-600 font-mono ring-1 ring-zinc-400 focus:ring-2 focus:ring-rose-400 outline-none duration-300 placeholder:text-zinc-600 placeholder:opacity-50 rounded-lg px-4 py-1 shadow-md focus:shadow-lg focus:shadow-rose-400"  id="deadline" type="date" name="deadline" required>
                            </div>
                            {{-- 
                            <div class="my-3 flex flex-col justify-center items-center hidden">
                                <label for="project_id">Project</label>
                                <select id="project_id" name="project_id">

                                    <option value="{{ $project->id }}">{{ $project->title }}</option>

                                </select>
                            </div> --}}
                            <div class="flex justify-end items-center gap-3">

                                <button
                                    class="focus:outline-none px-4 bg-teal-500 p-3 ml-3 rounded-lg text-white hover:bg-teal-400"
                                    type="submit">Create Task</button>
                                <button
                                    class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-black hover:bg-gray-300">Cancel</button>
                            </div>

                        </form>

                        <div class="flex justify-end pt-2">
                        </div>
                    </div>
                </div>
            </div>
            @php
                // dd($tasks)
            @endphp
            <div class="lanes">
                <div class="swim-lane" id="todo-lane">
                    <h3 class="heading">TODO</h3>
                    {{-- {{ dd() }} --}}
                    @foreach ($independentTasks as $task)
                    @if ($task->project_id === null && $task->user_id === Auth::id())
                        <p class="task" draggable="true">{{ $task->title }}</p>
                    @endif
                @endforeach
                </div>

                <div class="swim-lane">
                    <h3 class="heading">Doing</h3>
                </div>

                <div class="swim-lane">
                    <h3 class="heading">Done</h3>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        const draggables = document.querySelectorAll(".task");
        const droppables = document.querySelectorAll(".swim-lane");
        const projectDetailsModal = document.querySelector('.project-details');
        const taskModal = document.querySelector('.task-modal');

        draggables.forEach((task) => {
            task.addEventListener("dragstart", () => {
                task.classList.add("is-dragging");
            });
            task.addEventListener("dragend", () => {
                task.classList.remove("is-dragging");
            });
        });

        droppables.forEach((zone) => {
            zone.addEventListener("dragover", (e) => {
                e.preventDefault();
                const bottomTask = insertAboveTask(zone, e.clientY);
                const curTask = document.querySelector(".is-dragging");
                if (!bottomTask) {
                    zone.appendChild(curTask);
                } else {
                    zone.insertBefore(curTask, bottomTask);
                }
            });

            zone.addEventListener("drop", (e) => {
                e.preventDefault();
                const curTask = document.querySelector(".is-dragging");
                zone.appendChild(curTask);
            });
        });

        const insertAboveTask = (zone, mouseY) => {
            const els = zone.querySelectorAll(".task:not(.is-dragging)");
            let closestTask = null;
            let closestOffset = Number.NEGATIVE_INFINITY;
            els.forEach((task) => {
                const {
                    top
                } = task.getBoundingClientRect();
                const offset = mouseY - top;
                if (offset < 0 && offset > closestOffset) {
                    closestOffset = offset;
                    closestTask = task;
                }
            });
            return closestTask;
        };

        const form = document.getElementById("todo-form");
        const input = document.getElementById("todo-input");
        const todoLane = document.getElementById("todo-lane");

        form.addEventListener("submit", (e) => {
            e.preventDefault();
            const value = input.value;
            if (!value) return;
            const newTask = document.createElement("p");
            newTask.classList.add("task");
            newTask.setAttribute("draggable", "true");
            newTask.innerText = value;
            newTask.addEventListener("dragstart", () => {
                newTask.classList.add("is-dragging");
            });
            newTask.addEventListener("dragend", () => {
                newTask.classList.remove("is-dragging");
            });
            todoLane.appendChild(newTask);
            input.value = "";
        });

        const openProjectDetailsModal = () => {
            projectDetailsModal.classList.remove('hidden');
            projectDetailsModal.classList.remove('fadeOut');
            projectDetailsModal.classList.add('fadeIn');
            projectDetailsModal.style.display = 'flex';
        }

        const closeProjectDetailsModal = () => {
            projectDetailsModal.classList.remove('fadeIn');
            projectDetailsModal.classList.add('fadeOut');
            setTimeout(() => {
                projectDetailsModal.classList.add('hidden');
                projectDetailsModal.style.display = 'none'; // Reset display style
            }, 500);
        }

        const openTaskModal = () => {
            taskModal.classList.remove('hidden');
            taskModal.classList.remove('fadeOut');
            taskModal.classList.add('fadeIn');
            taskModal.style.display = 'flex';
        }

        const closeTaskModal = () => {
            taskModal.classList.remove('fadeIn');
            taskModal.classList.add('fadeOut');
            setTimeout(() => {
                taskModal.classList.add('hidden');
                taskModal.style.display = 'none'; // Reset display style
            }, 500);
        }

        window.onclick = function(event) {
            if (event.target == projectDetailsModal) closeProjectDetailsModal();
            if (event.target == taskModal) closeTaskModal();
        }

        const closeButtons = document.querySelectorAll('.modal-close');
        closeButtons.forEach(button => {
            button.addEventListener('click', () => {
                if (button.closest('.project-details')) closeProjectDetailsModal();
                if (button.closest('.task-modal')) closeTaskModal();
            });
        });
    </script>

    </div>
</x-app-layout>
