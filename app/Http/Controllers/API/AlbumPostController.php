<?php
namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Album;

class AlbumPostController extends Controller
{
    public $successStatus = 200;


    public function getAllPosts(Request $request)
    {
        $token = $request['t']; //t = token
        $userid = $request['u'];// u-userid


        $albums = DB::table('album')
        ->leftJoin('users','album.id', '=','users.id')
        ->select('album.id','album.song','album.singer','album.date_release','users.name','album.created_at','album.updated_at')
        ->get();
        return response()->json($albums,$this->successStatus);

    }

    public function getPost(Request $request)
    {

        $id = $request['pid']; //old post id

        $token = $request['t']; //t = token
        $userid = $request['u'];// u-userid

        $user = User::where('id',$userid)->where('remember_token',$token)->first();


        if($user != null){

            $albums = Album::where('id',$id)->first();
            if($user != null){
                return response()->json($albums,$this->successStatus);
            }else{
                return response()->json(['response'=>'Posts not found'],404);
            }

        }else{
            return response()->json(['response'=>'Bad call'],501);
        }
    }


    public function searchPost(Request $request)
    {

        $params = $request['p']; //p = params

        $token = $request['t']; //t = token
        $userid = $request['u'];// u-userid

        $user = User::where('id',$userid)->where('remember_token',$token)->first();


        if($user != null){

            $albums = Album::where('song','LIKE','%' .$params . '%')->GET();
            if($user != null){
                return response()->json($albums,$this->successStatus);
            }else{
                return response()->json(['response'=>'Posts not found'],404);
            }

        }else{
            return response()->json(['response'=>'Bad call'],501);
        }
    }
}
