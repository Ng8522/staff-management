<!DOCTYPE html>
<html lang="en">

<head>
    <!--
    * File Name:attendance-list.blade.php
    * Description: provides a clear and organized interface for displaying attendance records
    *
    * Author: Ng Jun Yu
    * Date: 22/9/2024
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Attendance-Leave</title>
    <style>
        .container {
            max-width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            color: #777;
        }

        .status-pending {
            color: #ff9800;
        }

        .status-approved {
            color: #4caf50;
        }

        .status-rejected {
            color: #f44336;
        }
    </style>
</head>

<body>
    <header>
        <h1>
            Your Attendance List
        </h1>
        <nav>
            <ul>
                @if (session('staffid'))
                    <li><a href="{{ route('home') }}">Back to Home</a></li>
                @endif
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <h1>Recent Attendance</h1>
            @if (count($attendanceRecords) > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendanceRecords as $attendance)
                            <tr>
                                <td>{{ $attendance['date'] }}</td>
                                <td>{{ $attendance['status'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No recent attendance records found.</p>
            @endif
        </div>
    </main>
</body>

</html>
