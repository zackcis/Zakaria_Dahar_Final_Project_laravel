<x-app-layout>
    <div class="w-[100%] flex justify-center items-center">

        <div class=" rounded-lg h-screen" id="calendar"></div>
    </div>

    <!-- Modal -->
    {{-- <div class="main-modal fixed w-full h-full inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster hidden"
        style="background: rgba(0,0,0,.7);" id="calendarModal" style="display: none;">
        <div
            class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Customize Booking</p>
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
                <div class="my-5">
                    <p>Here you can customize your booking.</p>
                </div>
                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button
                        class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-black hover:bg-gray-300">Cancel</button>
                    <button
                        class="focus:outline-none px-4 bg-teal-500 p-3 ml-3 rounded-lg text-white hover:bg-teal-400">Confirm</button>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- End Modal -->

    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            try {
                var myCalendar = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(myCalendar, {
                    headerToolbar: {
                        left: 'dayGridMonth,timeGridWeek,timeGridDay',
                        center: 'title',
                        right: 'listMonth,listWeek,listDay'
                    },
                    views: {
                        listDay: {
                            buttonText: 'Day Events'
                        },
                        listWeek: {
                            buttonText: 'Week Events'
                        },
                        listMonth: {
                            buttonText: 'Month Events'
                        },
                        timeGridWeek: {
                            buttonText: 'Week'
                        },
                        timeGridDay: {
                            buttonText: "Day"
                        },
                        dayGridMonth: {
                            buttonText: "Month"
                        }
                    },
                    initialView: "dayGridMonth",
                    nowIndicator: true,
                    weekends: true,
                    events: [
                        @foreach ($projects as $project)
                            {
                                title: '{{ $project->title }}',
                                start: '{{ $project->start_date }}',
                                end: '{{ $project->deadline }}',
                                color: 'blue'
                            },
                        @endforeach
                    ],
                });

                calendar.render();
            } catch (error) {
                console.error(error);
            }
        });
    </script>
</x-app-layout>
