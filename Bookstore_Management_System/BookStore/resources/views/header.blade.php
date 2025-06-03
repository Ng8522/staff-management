<!--
    * File Name:header.blade.php
    * Description: provided is a well-structured header component
    *
    * Author: Ng Jun Yu
    * Date: 22/9/2024
    -->
<script>
    function updateTime() {
        const now = new Date();
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const day = days[now.getDay()];
        const date = now.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        const time = now.toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true
        });

        document.getElementById('current-time').innerHTML = `${day}, ${date} - ${time}`;
    }

    setInterval(updateTime, 1000);
</script>
<header>
    <div class="current-time" id="current-time">
    </div>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            @if ($isAdminOrHRManager)
                <li><a href="{{ route('Staff_list') }}">Staff Management</a></li>
            @endif
            @if($isAdminOrInventoryManager)
                <li><a href="{{ route('books.index') }}">Inventory Management</a></li>
            @endif
            <li><a href="{{ route('attendance-list') }}">Attendance</a></li>
            <li><a href="{{ route('profile') }}">Profile</a></li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>

        </ul>
    </nav>
</header>
