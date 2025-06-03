<!DOCTYPE html>
<html lang="en">

<head>
    <!--
    * File Name:Staff_List.blade.php
    * Description: serves as a user interface for displaying a list of staff members
    *
    * Author: Ng Jun Yu
    * Date: 22/9/2024
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff List</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/staff_management.css') }}">
    <style>
        .container {
            margin-left: 220px;
            margin-top: 60px;
            padding: 40px;
            flex: 1;
        }

        .staff-list {
            border-collapse: collapse;
            width: 100%;
        }

        .staff-list th,
        .staff-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .staff-list th {
            background-color: #f4f4f4;
        }

        .staff-list th.id {
            width: 10%;
        }

        .staff-list th.name {
            width: 40%;
        }

        .staff-list th.position {
            width: 20%;
        }

        .staff-list th.actions {
            width: 30%;
        }

        .btn-edit {
            background-color: #4CAF50;
        }

        .btn-delete {
            background-color: #f44336;
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

        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
    </style>

<body>
    @include('Staff_Service.header_sidebar')

    <div class="container">
        <h3>Staff List</h3>
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
        @if ($staff->isEmpty())
            <p>No staff records found.</p>
        @else
            <table class="staff-list" id="staffList">
                <thead>
                    <tr>
                        <th class="id">ID</th>
                        <th class="name">Name</th>
                        <th class="position">Position</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staff as $employee)
                        <tr>
                            <td>{{ $employee->staff_id }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>
                                @php
                                    $position = \App\Models\Position::where('position_id', $employee->position_id)->first();
                                    echo $position -> position_name;
                                @endphp
                            </td>
                            <td>
                                <a href="{{ route('go_changing_page', $employee->staff_id) }}" class="btn btn-edit">Change Position</a>
                                <form action="{{ route('delete_staff', $employee->staff_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this position?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" class="pagination-container">
                            {{ $staff->links() }}
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>
</body>

</html>
