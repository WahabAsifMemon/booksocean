<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use App\Team;
use App\Author;
use App\Book;
use App\Category;

class MainController extends Controller
{
    public function index()
    {
       $sliders = Media::where(['status' => 'ACTIVE', 'media_type' => 'slider'])->get();
        $upcoming_books = Book::where('status', 'UPCOMING')->limit(5)->get();
        $downloaded_books = Book::with('author', 'category')->orderBy('downloaded', 'DESC')->get();
        $recomended_books = Book::where('recomended', '1')->get();
        $books = Book::with('author')->where('status', 'ACTIVE')->paginate(10);
        $categories = Category::where('status', 'ACTIVE')->get();
        $author_feature = Author::where(['status' => 'ACTIVE', 'author_feature' => 'yes'])->inRandomOrder()->first();
        $galleries = Media::where(['status' => 'ACTIVE', 'media_type' => 'gallery'])->limit(6)->get();

        return view('index', compact('sliders', 'upcoming_books', 'downloaded_books', 'recomended_books', 'books', 'categories', 'author_feature', 'galleries'));
    }

    public function about()
    {
        $teams = Team::where('status', 'ACTIVE')->limit(5)->get();
        return view('about', compact('teams'));
    }

    public function gallery()
    {
        $galleries = Media::where(['status' => 'ACTIVE', 'media_type' => 'gallery' ])->paginate(8);
        return view('gallery', compact('galleries'));
    }

    public function blog()
    {
        return view('blog');
    }

    public function author()
    {
        $author_features = Author::where('author_feature', 'yes')->limit(5)->get();
        $downloaded_books = Book::orderBy('downloaded', 'DESC')->limit(5)->get();
        $authors = Author::where('status', 'ACTIVE')->paginate(10);
        return view('author', compact('authors', 'author_features', 'downloaded_books'));
    }

    public function author_detail($slug)
    {
        $author = Author::where('slug', $slug)->first();
        return view('author_detail', compact('author'));
    }

    public function contact()
    {
        return view('contact');
    }
}