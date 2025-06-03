<!DOCTYPE html>
<html lang="en">
<!--
/**
 * File Name: index.blade.php
 * Description:  Staff page for view all Book record with redirect buttons to modify the Book record
 * Author: Muhammad Amir Hail Bin Mohamad Hazi
 * Date: 22 September 2024
 *
 * @package inventorymanagement
 */
-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
    <title>Book List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <!-- Add a hidden notification banner at the top of the page -->
        <div id="updateNotification" class="alert alert-info text-center" style="display:none;">
            A book has been updated. <a href="#" onclick="location.reload()">Click here</a> to refresh.
        </div>

        <h1 class="my-4">Book Inventory</h1>

        <!-- Flash message display -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('books.create') }}" class="btn btn-success">Add New Book</a>
        <hr />
        <form method="GET" action="{{ route('books.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" placeholder="Search by title" value="{{ request('search') }}"
                    class="form-control" />
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        @if ($books->isEmpty())
            <p>No books found.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Authors</th>
                        <th>Publisher</th>
                        <th>Category</th>
                        <th>Stock Quantity</th>
                        <th>Year</th> <!-- Added Year column -->
                        <th>Price</th> <!-- Added Price column -->
                        <th style="width: 150px;">Cover</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->authors }}</td>
                            <td>{{ $book->publisher }}</td>
                            <td>{{ $book->category }}</td>
                            <td>{{ $book->stock_quantity }}</td>
                            <td>{{ $book->year }}</td> <!-- Display Year -->
                            <td>{{ number_format($book->price, 2) }}</td> <!-- Display Price -->
                            <td>
                                @if ($book->cover && $book->cover !== 'default_cover')
                                    <img src="{{ asset('storage/' . $book->cover) }}" alt="Book Cover"
                                        style="width: 100px; height: auto;" />
                                @else
                                    No Image
                                @endif

                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="mt-3 d-flex justify-content-center">
                                    <form action="{{ route('books.increaseStock', $book->id) }}" method="POST"
                                        class="me-2 d-flex align-items-center">
                                        @csrf
                                        <input type="number" id="quantity" name="quantity" min="1"
                                            value="1" class="form-control" style="width: 80px;" />
                                        <button type="submit" class="btn btn-success ms-2"
                                            title="Increase Stock">+</button>
                                    </form>
                                    <form action="{{ route('books.decreaseStock', $book->id) }}" method="POST"
                                        class="d-flex align-items-center">
                                        @csrf
                                        <input type="number" id="quantity" name="quantity" min="1"
                                            value="1" class="form-control" style="width: 80px;" />
                                        <button type="submit" class="btn btn-danger ms-2"
                                            title="Decrease Stock">-</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <script>
        // Create a BroadcastChannel
        const channel = new BroadcastChannel('book_updates');

        // Listen for messages
        channel.onmessage = (event) => {
            if (event.data === 'update') {
                document.getElementById('updateNotification').style.display = 'block';
                // Set a timer to reset the session value after 5 seconds
                setTimeout(() => {
                    resetUpdateStatus();
                }, 5000); // 5000 milliseconds = 5 seconds
            }
        };

        // Function to check for updates
        const checkForUpdates = () => {
            fetch('/check-for-updates')
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Log the response
                    if (data.update_available) {
                        // Notify other tabs
                        channel.postMessage('update');
                    }
                })
                .catch(error => console.error('Error:', error)); // Log any errors
        };

        // Function to reset the update status in session
        const resetUpdateStatus = () => {
            fetch('/reset-update-status', {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Update status reset:', data);
                    // Optionally hide the notification here if desired
                    document.getElementById('updateNotification').style.display = 'none';
                })
                .catch(error => console.error('Error:', error)); // Log any errors
        };

        // Check for updates every 1 second
        setInterval(checkForUpdates, 1000);
    </script>






</body>

</html>
