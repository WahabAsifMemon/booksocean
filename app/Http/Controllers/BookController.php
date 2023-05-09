
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    public function detail($slug)
    {
        $book = Book::where('slug', $slug)->first();
        return view('book/detail', compact('book'));
    }
}