<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;
use App\Category;
use App\Author;
use App\Country;
use File;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchTerm = request()->get('s');
        $books = Book::orWhere('title','LIKE',"%$searchTerm%")->paginate(15);
        return view('admin/book/index')
        ->with(compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 'ACTIVE')->get();
        $authors = Author::where('status', 'ACTIVE')->get();
        return view('admin/book/create')
            ->with(compact('categories', 'authors'));       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
            'category' => 'required|not_in:0',
            'author' => 'required|not_in:0',
            'availability' => 'required',
            'price' => 'required',
            ]);

           Book::create([
            'category_id' => request() ->get('category_id'),
            'author_id' => request() ->get('author_id'),
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'availability' => request()->get('availability'),
            'category' => request()->get('category'),
            'author' => request()->get('author'),
            'price' => request()->get('publisher'),
            'Country of Publisher ' => request()->get('country of Publisher '),
            'isbn' => request()->get('isbn'),
            'isbn-10' => request()->get('isbn-10'),
            'audience' => request()->get('audience'),
            'format' => request()->get('format'),
            'language' => request()->get('language'),
            'total pages' => request()->get('total Pages'),
            'edition number' => request()->get('edition number'),
            'recomended' => request()->get('recomended'),
            'description' => request()->get('description'),
            'book_img' => 'No image found',
            'book_upload' => 'No pdf found',
            'status' => 'DEACTIVE',
          ]);
        return redirect()->to('/admin/book');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $categories = Category::get();
        $authors = Author::get();
        $countries = Country::get();
        return view('admin/book/edit')
            ->with(compact('book', 'categories', 'authors', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->update([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'availability' => request()->get('availability'),
            'category' => request()->get('category'),
            'author' => request()->get('author'),
            'price' => request()->get('publisher'),
            'Country of Publisher ' => request()->get('country of Publisher '),
            'isbn' => request()->get('isbn'),
            'isbn-10' => request()->get('isbn-10'),
            'audience' => request()->get('audience'),
            'format' => request()->get('format'),
            'language' => request()->get('language'),
            'total pages' => request()->get('total Pages'),
            'edition number' => request()->get('edition number'),
            'recomended' => request()->get('recomended'),
            'status' => 'DEACTIVE',
            'description' => request()->get('description'),
            'book_img' => 'NO IMAGE FOUND',
            'book_upload' => 'No pdf found',
          ]);
        return redirect()->to('/admin/book');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect()->back();
    }
    public function status($id)
    {
        $book = Book::find($id);
        $newStatus = ($book->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $book->update([
            'status' => $newStatus
        ]);
        return redirect()->back();
    }
}