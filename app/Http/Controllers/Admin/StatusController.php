<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use DB;

class StatusController extends Controller
{
    public function status(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'ACTIVE') {
                $status = 'DEACTIVE';
            }else {
                $status = 'ACTIVE';
            }
            DB::table($data['table'])->where('id', $data['id'])->update(['status'=>$status]);
            return response()->json([
                'status' => $status,
                'id' => $data['id'],
                'message' => 'Status Updated Succecsfully'
            ]);
        }
    }
}
