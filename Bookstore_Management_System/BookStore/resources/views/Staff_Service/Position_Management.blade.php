!DOCTYPE html>
<html lang="en">

<head>
    <!--
    * File Name:Position_Management.blade.php
    * Description: serves as the main interface for managing positions
    *
    * Author: Ng Jun Yu
    * Date: 22/9/2024
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Position</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/staff_management.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">


    <style>
        .container {
            margin-left: 220px;
            margin-top: 60px;
            padding: 40px;
            flex: 1;
        }

        .position-list {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 50px;
        }

        .position-list th,
        .position-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .position-list th {
            background-color: #f4f4f4;
        }

        .position-list th.id {
            width: 10%;
        }

        .position-list th.name {
            width: 30%;
        }

        .position-list th.salary {
            width: 20%;
        }

        .position-list th.cur.staffNo {
            width: 20%;
        }

        .position-list th.action {
            width: 20%;
        }
    </style>

<body>
    @include('Staff_Service.header_sidebar')
    <div class="container">
        <div class="alert-success @if (session('success')) show @endif">
            @if (session('success'))
                {{ session()->get('success') }}
                <button class="close-button" onclick="this.parentElement.style.display='none';">&times;</button>
            @endif
        </div>
        <div class="alert-failed @if (session('error')) show @endif">
            @if (session('error'))
                {{ session()->get('error') }}
                <button class="close-button" onclick="this.parentElement.style.display='none';">&times;</button>
            @endif
        </div>

        <h3>Position Management</h3>

        @if ($positions->isEmpty())
            <p class="no-results">No positions found.</p>
        @else
            <table class="position-list">
                <thead>
                    <tr>
                        <th class="id">Position ID</th>
                        <th class="name">Position Name</th>
                        <th class="salary">Basic Salary (RM)</th>
                        <th class="staffNo">Current Staff</th>
                        <th class="action">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($positions as $position)
                        <tr>
                            <td>{{ $position->position_id }}</td>
                            <td>{{ $position->position_name }}</td>
                            <td>{{ number_format($position->basic_salary, 2) }}</td>
                            <td>{{ $position->staff_count }}</td>
                            <td class="action">
                                <a href="{{ route('go_edit_position', $position->position_id) }}"
                                    class="button">Edit</a>
                                <form action="{{ route('delete_position', $position->position_id) }}" method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this position?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" class="pagination-container">
                            {{ $positions->links() }}
                        </td>
                    </tr>
                </tbody>
            </table>

        @endif
        <a href="{{ route('add_position_page') }}" class="button">Add New Position</a>
    </div>
</body>

</html>
