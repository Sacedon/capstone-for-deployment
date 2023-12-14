<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Calendar of Events') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <!-- Calendar Panel -->
        <div class="card">
            <div class="card-body">
                <!-- Calendar Container -->
                <div id='calendar'></div>
            </div>
        </div>
    </div>

   <!-- Add Event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="text-white modal-header bg-primary">
                <h4 class="modal-title" id="addEventModalLabel">Add Event</h4>
            </div>
            <div class="modal-body">
                <form id="addEventForm">
                    <div class="form-group">
                        <label for="eventTitle">Event Title:</label>
                        <input type="text" class="form-control" id="eventTitle" name="title" required>
                    </div>
                    <div class="mt-2 form-group">
                        <label for="eventColor">Event Color:</label>
                        <input type="text" class="form-control" id="eventColor" name="color" />
                    </div>
                    <div class="mt-2 form-group">
                        <label for="eventStart">Event Start Date:</label>
                        <input type="text" class="form-control datepicker" id="eventStart" name="start" required>
                    </div>
                    <div class="mt-2 form-group">
                        <label for="eventEnd">Event End Date:</label>
                        <input type="text" class="form-control datepicker" id="eventEnd" name="end" required>
                    </div>
                    {{ csrf_field() }}
                    <div class="flex justify-end">
                        <button type="submit" class="mt-2 btn btn-add">Add Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- Include FullCalendar and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.js"></script>
    <!-- Include Bootstrap Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.js"></script>

    <script>
        $(document).ready(function () {
            var userRole = "{{ $userRole }}";
            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay',
                },
                height: 600,
                contentHeight: 600,
                navLinks: true,
                editable: true,
                events: "{{ route('calendar') }}",
                displayEventTime: false,
                eventRender: function (event, element, view) {
                    event.allDay = event.allDay === 'true' || event.allDay === true;
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                    if (userRole === 'admin') {
                        // Clear the form fields
                        $('#addEventForm')[0].reset();
                        // Set the start and end date in the form
                        $('#eventStart').val(moment(start).format('YYYY-MM-DD'));
                        $('#eventEnd').val(moment(end).format('YYYY-MM-DD'));
                        $('#addEventModal').modal('show');
                    } else {
                        alert("You do not have the necessary permissions to add events.");
                    }
                },
                eventClick: function (event) {
                    if (userRole === 'admin') {
                        var action = prompt("Do you want to edit (e) or delete (d) this Event?");

                        if (action === 'e') {
                            var editTitle = prompt('Edit Event Title:', event.title);
                            if (editTitle !== null) {
                                event.title = editTitle;
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('updateevent') }}",
                                    data: {
                                        id: event.id,
                                        title: editTitle,
                                        _token: "{{ csrf_token() }}"
                                    },
                                    success: function (response) {
                                        alert("Updated Successfully");
                                        calendar.fullCalendar('updateEvent', event);
                                    }
                                });
                            }
                        } else if (action === 'd') {
                            var deleteMsg = confirm("Do you really want to delete this Event?");
                            if (deleteMsg) {
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('deleteevent') }}",
                                    data: "&id=" + event.id + '&_token=' + "{{ csrf_token() }}",
                                    success: function (response) {
                                        if (parseInt(response) > 0) {
                                            calendar.fullCalendar('removeEvents', event.id);
                                            alert("Deleted Successfully");
                                        }
                                    }
                                });
                            }
                        }
                    } else {
                        alert("You do not have the necessary permissions to edit or delete events.");
                    }
                },
            });

            // Initialize Datepicker for start and end dates in the modal
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
            });

            $('#eventColor').spectrum({
                preferredFormat: "hex",
                showInput: true,
                showPalette: true,
                palette: [
                    ['#FF0000', '#FF8000', '#FFFF00', '#00FF00', '#0000FF', '#8000FF', '#FF00FF']
                ]
            });

            // Handle form submission for adding events
            $('#addEventForm').submit(function (e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('createevent') }}",
                    data: formData,
                    type: "post",
                    success: function (data) {
                        $('#addEventModal').modal('hide');
                        alert("Added Successfully");
                        calendar.fullCalendar('refetchEvents');
                    }
                });
            });
        });
    </script>

<style>
    /* Improved modal styling */
    .modal-header {
        background-color: #007bff;
        color: #fff;
        border-bottom: 1px solid #ddd;
        padding: 15px;
    }

    .modal-body {
        max-height: calc(100vh - 200px);
        overflow-y: auto;
        padding: 15px;
    }

    .modal-content {
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    /* Responsive styling */
    @media (max-width: 576px) {
        .modal-body {
            max-height: calc(100vh - 120px);
        }
    }

    /* Improved card styling */
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .card-body {
        padding: 20px;
    }

    .btn-add {
        /* Style for Reject button */
        background-color: #007bff;
        color: white;
    }

    .btn-add:hover {
        /* Hover effect for Reject button */
        background-color: #106acb;
    }
</style>


</x-app-layout>
