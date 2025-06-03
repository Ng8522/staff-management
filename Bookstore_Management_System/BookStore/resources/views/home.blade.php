<!DOCTYPE html>
<html lang="en">

<head>
    <!--
    * File Name:home.blade.php
    * Description:serves as the main dashboard
    *
    * Author: Ng Jun Yu
    * Date: 22/9/2024
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Home page</title>
</head>

<body>
    @include('header')

    <main>
        <h1>Dashboard</h1>

        <section class="dashboard">
            <div class="dashboard-widgets">
                <div class="widget">
                    <h3>Hello, {{ $staff->name }}. Have a nice day.</h3>
                    <p></p>
                </div>
                <div class="widget">
                    <h3>Take Attendance</h3>
                    <button id="mark-attendance" class="button">Mark Attendance</button>
                    <br><br>
                    <div id="response-message" style="display: none;"></div>
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#mark-attendance').click(function() {
                            let status = "Present";
                            let checkInTime = new Date().toLocaleTimeString("en-us", {
                                hour: "2-digit",
                                minute: "2-digit",
                                hour12: false
                            });

                            $.ajax({
                                url: "{{ route('storeAttendance') }}",
                                type: 'POST',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    status: status,
                                    check_in_time: checkInTime
                                },
                                success: function(response) {
                                    $('#response-message').text(response.message).show();
                                },
                                error: function(xhr) {
                                    $('#response-message').text('Error: ' + xhr.responseJSON.message).show();
                                }
                            });
                        });

                        $('#filter-form').submit(function(event) {
                            event.preventDefault();
                            $.ajax({
                                url: $(this).attr('action'),
                                type: 'GET',
                                data: $(this).serialize(),
                                success: function(response) {
                                    $('.container').html(response);
                                },
                                error: function(xhr) {
                                    $('#response-message').text('Error: ' + xhr.responseJSON.message).show();
                                }
                            });
                        });
                    });
                </script>
            </div>
        </section>
    </main>
</body>

</html>
