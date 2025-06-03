<!DOCTYPE html>
<html lang="en">

<head>
    <!--
    * File Name:Attendance_List.blade.php
    * Description: presents a comprehensive user interface for displaying attendance records within a staff management system.
    *
    * Author: Ng Jun Yu
    * Date: 22/9/2024
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance List</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/staff_management.css') }}">
    <style>
        .container {
            margin-left: 220px;
            margin-top: 60px;
            padding: 40px;
            flex: 1;
        }

        .attendance-list {
            margin-top: 2em;
            border-collapse: collapse;
            width: 100%;
        }

        .attendance-list th,
        .attendance-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .attendance-list th {
            background-color: #f4f4f4;
        }

        ..attendance-list th.id {
            width: 20%;
        }

        .attendance-list th.name {
            width: 40%;
        }

        .attendance-list th.date,
        .attendance-list th.check-in-time,
        .attendance-list th.status {
            width: 13.33%;
        }

        .attendance-list tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .attendance-list tr:hover {
            background-color: #f1f1f1;
        }

        .pagination {
            display: flex;
            justify-content: center;
            padding: 10px 0;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 12px;
            background-color: #ff4d4d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #e60000;
        }

        .no-records {
            margin-top: 2em;
        }
    </style>

    </style>

<body>
    @include('Staff_Service.header_sidebar')

    <div class="container">
        <h3>Attendance List</h3>

        <!-- Date Filter Form -->
        <form action="{{ route('attendance') }}" method="GET">
            <label for="date">Filter by Date:</label>
            <input type="date" name="date" id="date" value="{{ request('date') }}">
            <button type="submit">Filter</button>
        </form>

        <!-- Pagination Controls -->
        @if ($pagination->total() > 0)
            {!! $attendanceHtml !!}

            <!-- Pagination Controls -->
            @if ($pagination->total() > $pagination->perPage())
                <div class="pagination">
                    @if ($pagination->onFirstPage())
                        <span class="disabled">Previous</span>
                    @else
                        <a href="{{ $pagination->previousPageUrl() }}">Previous</a>
                    @endif

                    @if ($pagination->hasMorePages())
                        <a href="{{ $pagination->nextPageUrl() }}">Next</a>
                    @else
                        <span class="disabled">Next</span>
                    @endif
                </div>
            @endif
        @else
            <div class="no-records">No attendance records found.</div>
        @endif
    </div>
</body>

</html>
