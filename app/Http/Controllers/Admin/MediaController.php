<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Media;
use File;


class MediaController extends Controller
{
     public function index()
    {
        $searchTerm = request()->get('s');
        $medias = Media::orWhere('title', 'LIKE', "%$searchTerm%")->latest()->paginate(15);
        return view('admin/media/index')
        ->with(compact('medias'));
    }

    public function create()
    {
        return view('admin/media/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
            'media_type' => 'required|not_in:none',
            'media_img' => 'required|mimes:png,jpg,jpeg,gif|max:2048'

        ]);
        $fileName = null;
        if (request()->hasFile('media_img'))
        {
            $file = request()->file('media_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/' , $fileName);    
        }

        Media::create([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'media_type' => request()->get('media_type'),
            'description' => request()->get('description'),
            'media_img' => $fileName,
            'status' => 'DEACTIVE',
        ]);


        return redirect()->to('/admin/media');
    }

    public function edit($id)
    {
        $media = Media::find($id);
            return view('admin/media/edit')
            ->with(compact('media'));
    }


     public function update(Request $request, $id)
    {
        $media = Media::find($id);
         $currentImage = $media->media_img;

            $fileName = null;
            if (request()->hasFile('media_img')) 
            {
                $file = request()->file('media_img');
                $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
                $file->move('./uploads/', $fileName);
            }
        $media->update([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'media_type' => request()->get('media_type'),
            'description' => request()->get('description'),
            'media_img' => ($fileName) ? $fileName : $currentImage,

        ]);

        if ($fileName)
            File::delete('./uploads/' . $currentImage);

        return redirect()->to('/admin/media');
    }


    public function status($id)
    {

         $media = Media::find($id);
        $newStatus = ($media->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $media->update([
            'status' => $newStatus
        ]);
        return redirect()->back();
    }

    public function destroy($id)
        {
            $media = Media::find($id);
            $currentImage = $media->media_img;
            $media->delete();
            File::delete('./uploads/' . $currentImage);
            return redirect()->back();
        }

}
