<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    <style>
        .oli {
            background-image: url('https://vojislavd.com/ta-template-demo/assets/img/auth-background.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
            width: 100%;
        }
    </style>
    <div class="oli flex flex-col justify-center items-center w-[100%] ">

        <div
            class="mt-5 flex justify-around items-center w-[70%]  max-[430px]:flex-col   max-[430px]:justify-center  max-[430px]:items-center  max-[430px]:gap-6  max-[430px]:w-[100%]">
            <div class="lg:w-6/12 md:w-9/12 sm:w-10/12 mx-auto ">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="flex items-center justify-between px-4 py-3 bg-gray-700">
                        <button id="prevMonth" class="text-white">Previous</button>
                        <h2 id="currentMonth" class="text-white"></h2>
                        <button id="nextMonth" class="text-white">Next</button>
                    </div>
                    <div class="grid grid-cols-7 gap-2 p-2" id="calendar">
                        <!-- Calendar Days Go Here -->
                    </div>
                    <div id="myModal" class="modal hidden fixed inset-0 flex items-center justify-center z-50">
                        <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>

                        <div
                            class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                            <div class="modal-content py-4 text-left px-6">
                                <div class="flex justify-between items-center pb-3">
                                    <p class="text-2xl font-bold">Selected Date</p>
                                    <button id="closeModal"
                                        class="modal-close px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring">✕</button>
                                </div>
                                <div id="modalDate" class="text-xl font-semibold"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="w-full max-w-lg p-6 mx-auto bg-white rounded-2xl shadow-xl flex flex-col justify-center items-center gap-2  max-[430px]:w-[95%]">
                <div class="w-[100%] flex flex-col justify-center items-center   max-[430px]:w-[95%]">
                    <x-primary-button onclick="openProjectModal()" class="ms-3">
                        Create Project
                    </x-primary-button>
                </div>
                <div class="w-full  max-[430px]:w-[100%]">
                    <table class="table w-full h-full rounded-lg">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col " class="text-center">Created By</th>
                                <th scope="col">Members</th>
                                <th scope="col">Deadline</th>
                                <th class="ml-10" scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($projects as $project)
                                @if ($project->members->contains('id', Auth::user()->id))
                                    <tr class="">
                                        <th class=" max-[430px]:text-center" scope="row">{{ $project->title }}</th>
                                        <td class=" max-[430px]:text-center">{{ $project->createdBy->name }}</td>
                                        <td class=" max-[430px]:text-center">{{ $project->members->count() }}</td>
                                        <td class=" max-[430px]:text-center">{{ $project->deadline }}</td>
                                        <td class=" max-[430px]:text-center"><a
                                                href="{{ route('projects.show', ['project' => $project->id]) }}"
                                                class="text-blue-500 hover:text-blue-700">View</a></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
                        <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data" 
                            class="flex flex-col justify-center items-center w-[100%]">
                            @csrf
                            <input id="created_by" type="text" name="created_by" value="{{ Auth::user()->id }}"
                                class="hidden">
                            <div class="my-1 flex flex-col gap-2 justify-center items-center ">
                                <label for="title">Title</label>
                                <input class="bg-zinc-200 text-zinc-600 font-mono ring-1 ring-zinc-400 focus:ring-2 focus:ring-rose-400 outline-none duration-300 placeholder:text-zinc-600 placeholder:opacity-50 rounded-lg px-4 py-1 shadow-md focus:shadow-lg focus:shadow-rose-400" id="title" type="text" name="title" required autofocus>
                            </div>

                            <div class="my-1 flex flex-col gap-2 justify-center items-center">
                                <label for="description">Description</label>
                                <textarea class="bg-zinc-200 text-zinc-600 font-mono ring-1 ring-zinc-400 focus:ring-2 focus:ring-rose-400 outline-none duration-300 placeholder:text-zinc-600 placeholder:opacity-50 rounded-lg px-4 py-1 shadow-md focus:shadow-lg focus:shadow-rose-400" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            </div>
                            <div class="my-1 flex flex-col gap-2 justify-center items-center ">
                                <label for="start_date">Start date</label>
                                <input class="bg-zinc-200 text-zinc-600 font-mono ring-1 ring-zinc-400 focus:ring-2 focus:ring-rose-400 outline-none duration-300 placeholder:text-zinc-600 placeholder:opacity-50 rounded-lg px-4 py-1 shadow-md focus:shadow-lg focus:shadow-rose-400" id="start_date" type="date" name="start_date" required autofocus>
                            </div>
                            <div class="my-1 flex flex-col gap-2 justify-center items-center ">
                                <label for="deadline">Deadline</label>
                                <input class="bg-zinc-200 text-zinc-600 font-mono ring-1 ring-zinc-400 focus:ring-2 focus:ring-rose-400 outline-none duration-300 placeholder:text-zinc-600 placeholder:opacity-50 rounded-lg px-4 py-1 shadow-md focus:shadow-lg focus:shadow-rose-400" id="deadline" type="date" name="deadline" required autofocus>
                            </div>
                            <div class="my-1 flex flex-col gap-2 justify-center items-center">
                                <label for="project_picture">Project Picture</label>
                                <input class="bg-zinc-200 text-zinc-600 font-mono ring-1 ring-zinc-400 focus:ring-2 focus:ring-rose-400 outline-none duration-300 placeholder:text-zinc-600 placeholder:opacity-50 rounded-lg px-4 py-1 shadow-md focus:shadow-lg focus:shadow-rose-400" id="project_picture" type="file" name="project_picture">
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
                <!-- component -->
                <!-- This is an example component -->
                <div class="main-modal task-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn hidden faster"
                    style="background: rgba(0,0,0,.7);">
                    <div
                        class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                        <div class="modal-content py-4 text-left px-6">
                            <!--Title-->
                            <div class="flex justify-between items-center pb-3">
                                <p class="text-2xl font-bold">Create your Task</p>
                                <div class="modal-close cursor-pointer z-50">
                                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg"
                                        width="18" height="18" viewBox="0 0 18 18">
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
        <!-- component -->
        <!-- Create By Joker Banny -->
        <div class=" flex justify-center items-center py-20 ">
            <div class="md:px-4 md:grid md:grid-cols-2 lg:grid-cols-3 gap-5 space-y-4 md:space-y-0">
                <div
                    class="max-w-sm bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
                    <h3 class="mb-3 text-xl font-bold text-indigo-600">Beginner Friendly</h3>
                    <div class="relative">
                        <img class="w-full rounded-xl"
                            src="https://images.unsplash.com/photo-1541701494587-cb58502866ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80"
                            alt="Colors" />
                        <p
                            class="absolute top-0 bg-yellow-300 text-gray-800 font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">
                            FREE</p>
                    </div>
                    <h1 class="mt-4 text-gray-800 text-2xl font-bold cursor-pointer">Time management Course</h1>
                    <div class="my-4">
                        <div class="flex space-x-1 items-center">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <p>1:34:23 Minutes</p>
                        </div>
                        <div class="flex space-x-1 items-center">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <p>3 Parts</p>
                        </div>
                        <div class="flex space-x-1 items-center">
                            <span>

                            </span>

                        </div>
                        <button class="mt-4 text-xl w-full text-white bg-indigo-600 py-2 rounded-xl shadow-lg"><a class="text-decoration-none text-white" href="https://www.coursera.org/learn/work-smarter-not-harder">Buy
                            Lesson</a></button>
                    </div>
                </div>
                <div
                    class="max-w-sm bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
                    <h3 class="mb-3 text-xl font-bold text-indigo-600">Intermediate</h3>
                    <div class="relative">
                        <img class="w-full rounded-xl"
                            src="https://images.unsplash.com/photo-1550684848-fac1c5b4e853?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1050&q=80"
                            alt="Colors" />
                        <p
                            class="absolute top-0 bg-yellow-300 text-gray-800 font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">
                            $12</p>
                        <p
                            class="absolute top-0 right-0 bg-yellow-300 text-gray-800 font-semibold py-1 px-3 rounded-tr-lg rounded-bl-lg">
                            %20 Discount</p>
                    </div>
                    <h1 class="mt-4 text-gray-800 text-2xl font-bold cursor-pointer">Learn How to learn</h1>
                    <div class="my-4">
                        <div class="flex space-x-1 items-center">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <p>1:34:23 Minutes</p>
                        </div>
                        <div class="flex space-x-1 items-center">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <p>3 Parts</p>
                        </div>
                        <div class="flex space-x-1 items-center">
                            <span>

                            </span>

                        </div>
                        <button class="mt-4 text-xl w-full text-white bg-indigo-600 py-2 rounded-xl shadow-lg"><a class="text-decoration-none text-white" href="https://www.coursera.org/learn/work-smarter-not-harder">Start
                            Watching Now</a></button>
                    </div>
                </div>
                <div
                    class="max-w-sm bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
                    <h3 class="mb-3 text-xl font-bold text-indigo-600">Beginner Friendly</h3>
                    <div class="relative">
                        <img class="w-full rounded-xl"
                            src="https://images.unsplash.com/photo-1561835491-ed2567d96913?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1050&q=80"
                            alt="Colors" />
                        <p
                            class="absolute top-0 bg-yellow-300 text-gray-800 font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">
                            $50</p>
                    </div>
                    <h1 class="mt-4 text-gray-800 text-2xl font-bold cursor-pointer">Mental health improvment</h1>
                    <div class="my-4">
                        <div class="flex space-x-1 items-center">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <p>1:34:23 Minutes</p>
                        </div>
                        <div class="flex space-x-1 items-center">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <p>3 Parts</p>
                        </div>
                        <div class="flex space-x-1 items-center">


                        </div>
                        <button class="mt-4 text-xl w-full text-white bg-indigo-600 py-2 rounded-xl shadow-lg"><a class="text-decoration-none text-white" href="https://www.coursera.org/learn/positive-psychiatry">Buy
                            Lesson</a></button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const projectModal = document.querySelector('.project-modal');
            const taskModal = document.querySelector('.task-modal');
            const projectDetailsModal = document.querySelector('.project-details');

            const modalClose = (modal) => {
                modal.classList.add('fadeOut');
                modal.classList.remove('fadeIn');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 500);
            }

            const openProjectModal = () => {
                projectModal.classList.remove('hidden');
                projectModal.classList.remove('fadeOut');
                projectModal.classList.add('fadeIn');
                projectModal.style.display = 'flex';
            }

            const openTaskModal = () => {
                taskModal.classList.remove('hidden');
                taskModal.classList.remove('fadeOut');
                taskModal.classList.add('fadeIn');
                taskModal.style.display = 'flex';
            }

            const openProjectDetailsModal = () => {
                projectDetailsModal.classList.remove('hidden');
                projectDetailsModal.classList.remove('fadeOut');
                projectDetailsModal.classList.add('fadeIn');
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


            window.onclick = function(event) {
                if (event.target == projectModal) closeProjectModal();
                if (event.target == taskModal) closeTaskModal();
                if (event.target == projectDetailsModal) closeProjectDetailsModal();
            }


            // Function to generate the calendar for a specific month and year
            function generateCalendar(year, month) {
                const calendarElement = document.getElementById('calendar');
                const currentMonthElement = document.getElementById('currentMonth');

                // Create a date object for the first day of the specified month
                const firstDayOfMonth = new Date(year, month, 1);
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                // Clear the calendar
                calendarElement.innerHTML = '';

                // Set the current month text
                const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ];
                currentMonthElement.innerText = `${monthNames[month]} ${year}`;

                // Calculate the day of the week for the first day of the month (0 - Sunday, 1 - Monday, ..., 6 - Saturday)
                const firstDayOfWeek = firstDayOfMonth.getDay();

                // Create headers for the days of the week
                const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                daysOfWeek.forEach(day => {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'text-center font-semibold';
                    dayElement.innerText = day;
                    calendarElement.appendChild(dayElement);
                });

                // Create empty boxes for days before the first day of the month
                for (let i = 0; i < firstDayOfWeek; i++) {
                    const emptyDayElement = document.createElement('div');
                    calendarElement.appendChild(emptyDayElement);
                }

                // Create boxes for each day of the month
                for (let day = 1; day <= daysInMonth; day++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'text-center py-2 border cursor-pointer';
                    dayElement.innerText = day;

                    // Check if this date is the current date
                    const currentDate = new Date();
                    if (year === currentDate.getFullYear() && month === currentDate.getMonth() && day === currentDate
                        .getDate()) {
                        dayElement.classList.add('bg-blue-500', 'text-white'); // Add classes for the indicator
                    }

                    calendarElement.appendChild(dayElement);
                }
            }

            // Initialize the calendar with the current month and year
            const currentDate = new Date();
            let currentYear = currentDate.getFullYear();
            let currentMonth = currentDate.getMonth();
            generateCalendar(currentYear, currentMonth);

            // Event listeners for previous and next month buttons
            document.getElementById('prevMonth').addEventListener('click', () => {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                generateCalendar(currentYear, currentMonth);
            });

            document.getElementById('nextMonth').addEventListener('click', () => {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                generateCalendar(currentYear, currentMonth);
            });

            // Function to show the modal with the selected date
            function showModal(selectedDate) {
                const modal = document.getElementById('myModal');
                const modalDateElement = document.getElementById('modalDate');
                modalDateElement.innerText = selectedDate;
                modal.classList.remove('hidden');
            }

            // Function to hide the modal
            function hideModal() {
                const modal = document.getElementById('myModal');
                modal.classList.add('hidden');
            }

            // Event listener for date click events
            const dayElements = document.querySelectorAll('.cursor-pointer');
            dayElements.forEach(dayElement => {
                dayElement.addEventListener('click', () => {
                    const day = parseInt(dayElement.innerText);
                    const selectedDate = new Date(currentYear, currentMonth, day);
                    const options = {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    const formattedDate = selectedDate.toLocaleDateString(undefined, options);
                    showModal(formattedDate);
                });
            });

            // Event listener for closing the modal
            document.getElementById('closeModal').addEventListener('click', () => {
                hideModal();
            });
        </script>
    </div>
</x-app-layout>
