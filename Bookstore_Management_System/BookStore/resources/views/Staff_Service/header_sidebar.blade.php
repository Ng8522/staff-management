    <!--
    * File Name:header_sidebar.blade.php
    * Description:provides a header and sidebar navigation for the staff management application
    *
    * Author: Ng Jun Yu
    * Date: 22/9/2024
    -->

<header>
    <h1>Staff Management</h1>
</header>

<div class="sidebar">
    <div class="sidebar-header">
        <h3>Menu</h3>
    </div>
    <ul class="sidebar-menu">
        <li><a href="{{ route('Staff_list') }}" class="sidebar-link">Staff List</a></li>
        <li><a href="{{ route('register_staff_form') }}" class="sidebar-link">Register Staff</a></li>
        <li><a href="{{ route('Position_Management') }}" class="sidebar-link">Position Management</a></li>
        <li><a href="{{ route('attendance') }}" class="sidebar-link">Attendance List</a></li>
        <li><a href="{{ route('login') }}" class="sidebar-link">Quit</a></li>
    </ul>
</div>
