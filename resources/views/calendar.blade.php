<x-app-layout>
    <style>
        .oli {
            background-image: url('https://vojislavd.com/ta-template-demo/assets/img/auth-background.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
            width: 100%;

        }

    </style>
    <div class="oli w-[100%] flex justify-center items-center">

        <div class=" bg-white h-screen " id="calendar"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            try {
                var myCalendar = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(myCalendar, {
                    headerToolbar: {
                        left: 'dayGridMonth,timeGridWeek,timeGridDay',
                        center: 'title,prev,next',
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
                            @if ($project->members->contains('id', Auth::user()->id))
                                {
                                    title: '{{ $project->title }}',
                                    start: '{{ $project->start_date }}',
                                    end: '{{ $project->deadline }}',
                                    color: 'purple'
                                },
                            @endif
                        @endforeach
                    ],
                });

                calendar.render();
            } catch (error) {
                console.error(error);
            }
        });
    </script>
    <style>
        .fc-header-toolbar .fc-prev-button{
            margin-left: 10px;
            margin-right: 10px;
            margin-top: 10px;

        }
        .fc-header-toolbar .fc-next-button{
            margin-top: 10px;
        }
        @media (max-width: 430px) {

            .fc-header-toolbar .fc-listMonth-button,
            .fc-header-toolbar .fc-listWeek-button,
            .fc-header-toolbar .fc-listDay-button ,
            .fc-header-toolbar .fc-timeGridWeek-button,
            .fc-header-toolbar .fc-timeGridDay-button,
            .fc-header-toolbar .fc-dayGridMonth-button {
                display: none;
            }
        }
    </style>
</x-app-layout>
