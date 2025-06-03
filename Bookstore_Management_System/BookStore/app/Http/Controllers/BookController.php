<?php
/**
 * File Name: BookController.php
 * Description: Control the creation, viewing, update, deletion of Book records and module
 *
 * Author: Muhammad Amir Hail Bin Mohamad Hazi
 * Date: 22 September 2024
 *
 * @package inventorymanagement
 */
namespace App\Http\Controllers;
use App\Models\BookLog; // Add this at the top
use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Observers\StaffObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Observers\BookObserver;
use App\Observers\BookSubject;
use Illuminate\Support\Facades\File;
class BookController
{
    /**
     * Display a listing of the resource.
     */
    protected $bookSubject;

    public function __construct(BookSubject $bookSubject, StaffObserver $staffObserver)
    {
        $this->bookSubject = $bookSubject;
        $this->bookSubject->attach($staffObserver);
    }
    public function index(Request $request)
    {
        if (!session()->has('staffid') || strpos(session('staffid'), 'S') !== 0) {
            return redirect('/error'); // Redirect to your error page
        }
        $query = Book::query();

        // Search functionality
        if ($request->has('search') && $request->input('search') != '') {
            $query->where('title', 'LIKE', '%' . $request->input('search') . '%');
        }

        // Sort by latest first (newest to oldest)
        $books = $query->orderBy('created_at', 'desc')->get();

        return view('index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'category' => 'required|in:Drama,Epic,Poetry',
            'year' => 'integer|min:0',
            'price' => 'numeric|min:0',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $book = new Book();
        $book->title = $validatedData['title'];
        $book->authors = $validatedData['authors'];
        $book->publisher = $validatedData['publisher'];
        $book->category = $validatedData['category'];
        $book->year = $validatedData['year'];
        $book->price = $validatedData['price'];
        $book->stock_quantity = $validatedData['stock_quantity'];

        // Handle cover image upload
        if ($request->hasFile('cover')) {
            $destinationPath = public_path('storage/covers');
            $fileName = $request->file('cover')->getClientOriginalName();
            $request->file('cover')->move($destinationPath, $fileName);
            $book->cover = 'covers/' . $fileName; // Save the relative path
        }

        $book->save(); // Save the book
        // Log the edit
        BookLog::create([
            'book_title' => $book->title,
            'staff_id' => session('staffid'),
            'description' => 'Created a new book',
        ]);
        $this->bookSubject->notify(); // Notify observers after storing the book
        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view('show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        return view('edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'category' => 'required|in:Drama,Epic,Poetry',
            'year' => 'integer|min:0',
            'price' => 'numeric|min:0',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $book->title = $validatedData['title'];
        $book->authors = $validatedData['authors'];
        $book->publisher = $validatedData['publisher'];
        $book->category = $validatedData['category'];
        $book->year = $validatedData['year'];
        $book->price = $validatedData['price'];
        $book->stock_quantity = $validatedData['stock_quantity'];

        // Handle cover image upload
        if ($request->hasFile('cover')) {
            // Define the destination path for the new cover image in public/storage/covers
            $destinationPath = public_path('storage/covers');
            $fileName = $request->file('cover')->getClientOriginalName();

            // Check and delete the old cover if it exists
            if ($book->cover) {
                $oldCoverPath = public_path('storage/' . $book->cover); // Old cover path
                if (File::exists($oldCoverPath)) {
                    File::delete($oldCoverPath);
                }
            }

            // Move the new cover image to the public/storage/covers directory
            $request->file('cover')->move($destinationPath, $fileName);

            // Save the relative path to the database (covers/xxx.png)
            $book->cover = 'covers/' . $fileName;
        }

        $book->save(); // Update the book
        BookLog::create([
            'book_title' => $book->title,
            'staff_id' => session('staffid'),
            'description' => 'Edited the book',
        ]);
        $this->bookSubject->notify(); // Notify observers after storing the book
        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        // Delete the cover image if it exists
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete(); // Delete the book
        BookLog::create([
            'book_title' => $book->title,
            'staff_id' => session('staffid'),
            'description' => 'Deleted the book',
        ]);
        $this->bookSubject->notify(); // Notify observers after updating the book
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
    // New method to notify observers
    public function increaseStock(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $book = Book::findOrFail($id);
        $book->stock_quantity += $request->input('quantity');
        $book->save();
        BookLog::create([
            'book_title' => $book->title,
            'staff_id' => session('staffid'),
            'description' => 'Added stock for the book',
        ]);
        $this->bookSubject->notify(); // Notify observers after updating the book
        return redirect()->route('books.index')->with('success', 'Stock increased successfully!');
    }

    public function decreaseStock(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $book = Book::findOrFail($id);

        // Check if enough stock is available before decreasing
        if ($book->stock_quantity >= $request->input('quantity')) {
            $book->stock_quantity -= $request->input('quantity');
            $book->save();
            BookLog::create([
                'book_title' => $book->title,
                'staff_id' => session('staffid'),
                'description' => 'Reduced stock for the book',
            ]);
            $this->bookSubject->notify(); // Notify observers after updating the book
            return redirect()->route('books.index')->with('success', 'Stock decreased successfully!');
        } else {
            return redirect()->route('books.index')->with('error', 'Cannot decrease stock below zero!');
        }
    }




}