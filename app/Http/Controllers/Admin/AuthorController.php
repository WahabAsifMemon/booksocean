<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Author;
use File;

class AuthorController extends Controller
{
    public function index()
    {
        $searchTerm = request()->get('s');
        $authors = Author::orWhere('title', 'LIKE', "%$searchTerm%")->latest()->paginate(15);
        return view('admin/author/index')
            ->with(compact('authors'));
    }

    public function create()
    {
        return view('admin/author/create');       
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
            'designation' => 'required',
            'dob' => 'required',
            'email' => 'required',
            'country' => 'required|not_in:none',
            'author_img' => 'required|mimes:png,jpg,jpeg,gif|max:2048'
        ]);

        $fileName = null;
        if (request()->hasFile('author_img')) 
        {
            $file = request()->file('author_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);                
        }


        Author::create([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'designation' => request()->get('designation'),
            'dob' => request()->get('dob'),
            'country' => request()->get('country'),
            'email' => request()->get('email'),
            'phone' => request()->get('phone'),
            'description' => request()->get('description'),
            'author_feature' => request()->get('author_feature'),
            'facebook_id' => request()->get('facebook_id'),
            'twitter_id' => request()->get('twitter_id'),
            'youtube_id' => request()->get('youtube_id'),
            'pinterest_id' => request()->get('pinterest_id'),
            'author_img' => $fileName,
            'status' => 'DEACTIVE',
        ]);
        return redirect()->to('/admin/author');
    }

        public function show($id)
        {
            //
        }

        public function edit($id)
        {
            $author = Author::find($id);
            return view('admin/author/edit')
                ->with(compact('author'));
        }

        public function update(Request $request, $id)
        {
        $author = Author::find($id);

            $currentImage = $author->author_img;

            $fileName = null;
            if (request()->hasFile('author_img')) 
            {
                $file = request()->file('author_img');
                $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
                $file->move('./uploads/', $fileName);
            }

        $author->update([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'designation' => request()->get('designation'),
            'dob' => request()->get('dob'),
            'country' => request()->get('country'),
            'email' => request()->get('email'),
            'phone' => request()->get('phone'),
            'description' => request()->get('description'),
            'author_feature' => request()->get('author_feature'),
            'facebook_id' => request()->get('facebook_id'),
            'twitter_id' => request()->get('twitter_id'),
            'youtube_id' => request()->get('youtube_id'),
            'pinterest_id' => request()->get('pinterest_id'),
            'author_img' => ($fileName) ? $fileName : $currentImage,
        ]);

        if ($fileName)
            File::delete('./uploads/' . $currentImage);

        return redirect()->to('/admin/author');
    }
    
        public function destroy(Request $request, $id)
        {
            if ($request->ajax()) 
        {
            $author = Author::find($id);
            $currentImage = $author->author_img;
            $author->delete();
            File::delete('./uploads/' . $currentImage);
            return 'true';
        }
        }

        public function status(Request $request, $id)
    {
        if ($request->ajax()) 
        {
            sleep(1);
            $author = Author::find($id);
            $newStatus = ($author->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
            $author->update([
                'status' => $newStatus
            ]);
            return $newStatus;
        }
    }

     public function status_active(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Author::where('id', $value)->update(['status' => 'ACTIVE']);
            }

            $record = Author::find($request->statusAll);
            return $record;
        }
    }

         public function status_deactive(Request $request)
         {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Author::where('id', $value)->update(['status' => 'DEACTIVE']);
            }

            $record = Author::find($request->statusAll);
            return $record;
        }
    }

     public function delete_all(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Author::where('id', $value)->delete();
            }
            $record = Author::find($request->statusAll);
            return $record;
        }
    }
}