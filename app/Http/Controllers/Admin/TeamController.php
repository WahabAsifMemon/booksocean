<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;
use File;

class TeamController extends Controller
{
     public function index()
    {
        $searchTerm = request()->get('s');
        $teams = Team::orWhere('fullname', 'LIKE', "%$searchTerm%")->latest()->paginate(15);
        return view('admin/team/index')
        ->with(compact('teams'));

    }

    public function create()
    {
        return view('admin/team/create');
    }

    public function store(Request $request)
    {
         $this->validate($request, [
            'fullname' => 'required',
            'designation' => 'required',
            'email' => 'required',
            'facebook_id' => 'required',
            'twitter_id' => 'required',
            'pinterest_id' => 'required',
            'team_img' => 'required|mimes:png,jpg,jpeg,gif|max:2048'

        ]);

         $fileName = null;
         if (request()->hasFile('team_img'))
         {
            $file = request()->file('team_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);    
         }

          Team::create([
            'fullname' => request()->get('fullname'),
            'designation' => request()->get('designation'),
            'telephone' => request()->get('telephone'),
            'mobile' => request()->get('mobile'),
            'email' => request()->get('email'),
            'facebook_id' => request()->get('facebook_id'),
            'twitter_id' => request()->get('twitter_id'),
            'pinterest_id' => request()->get('pinterest_id'),
            'profile' => request()->get('profile'),
            'team_img' => $fileName,
            'status' => 'DEACTIVE',
        ]);
        return redirect()->to('/admin/team');

    }

    public function edit($id)
    {
        $team = Team::find($id);
        return view('admin/team/edit')
        ->with(compact('team'));
    }

    public function update($id)
    {

         $team = team::find($id);

         $currentImage = $team->team_img;

         $fileName = null;
         if (request()->hasFile('team_img'))
         {
            $file = request()->file('team_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);    
         }


          $team->update([
           'fullname' => request()->get('fullname'),
            'designation' => request()->get('designation'),
            'telephone' => request()->get('telephone'),
            'mobile' => request()->get('mobile'),
            'email' => request()->get('email'),
            'facebook_id' => request()->get('facebook_id'),
            'twitter_id' => request()->get('twitter_id'),
            'pinterest_id' => request()->get('pinterest_id'),
            'profile' => request()->get('profile'),
            'team_img' => ($fileName) ? $fileName : $currentImage,
        ]);

           if ($fileName)
            File::delete('./uploads/' . $currentImage);

        return redirect()->to('/admin/team');
    }



    public function destroy($id)
    {
        $team = Team::find($id);
         $currentImage = $team->team_img;
        $team->delete();
            File::delete('./uploads/' . $currentImage);
        return redirect()->back(); 
    }
}
