<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
         $searchTerm = request()->get('s');
        $categorys = Category::orWhere('title', 'LIKE', "%$searchTerm%")->latest()->paginate(15);
        return view('admin/category/index')
            ->with(compact('categorys'));
    }

   
    public function create()
    {
        return view('admin/category/create');
    }

    public function store(Request $request)
    {
         $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
        ]);

        Category::create([
        'title' => request()->get('title'),
        'slug' => request()->get('slug'),
        'description' => request()->get('description'),
        'status' => 'DEACTIVE',
    ]);
           return redirect()->to('/admin/category');
        
    }

    public function edit($id)
    {
       $category = Category::find($id);
        return view('admin/category/edit')
        ->with(compact('category'));
    }

     public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'description' => request()->get('description'),
        ]);

        return redirect()->to('/admin/category');
    }
    public function status(Request $request)
    {
        $data = $request->all();
        if ($request->ajax()) {
            $category = Category::find($data['id']);
            $newStatus = ($category->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
            $category->update([
            'status' => $newStatus
            ]);

            return response()->json([
                'status'=>200,
                'statusName'=>$newStatus
            ]);
        }
        // return redirect()->back();
    }

    public function destroy($id)
    {
        $category = category::find($id);
        $category->delete();
        return redirect()->back();

        
    }
}
