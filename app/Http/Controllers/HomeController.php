<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use App\Data;
use App\Post;
use App\Comment;
use App\Rating;
use App\User_photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\RateRequest;
use App\Http\Requests\PhotoRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $request = new Data;

        $data = DB::table('users')
                        ->join('data', 'users.id', '=' , 'data.user_id')
                        ->select('users.id', 'users.name', 'data.image', 'data.description')
//                        ->get();
                        ->paginate(3);


        // $data = DB::table('data')->get();
        return view('home', ['data' => $data]);
    }

    public function start_page() {
        $request = new Data;

        $data = DB::table('users')
                        ->join('data', 'users.id', '=' , 'data.user_id')
                        ->select('users.id', 'users.name', 'data.image', 'data.description')
                        ->get();

        // $data = DB::table('data')->get();
        return view('start_page', ['data' => $data]);
    }


    public function store(PostRequest $request) {
        // dd($request->file('file'));
        if ($file = $request->file('file')) {
            $name = $file->getClientOriginalName();
            if ($file->move('images', $name)) {
                $post = new Data();
                $post->user_id = $request->user_id;
                $post->image = $name;
                $post->description = $request->description;
                $post->save();

                return redirect()->route('home')->with('success', 'Record added successfully');
            }
        }
    }

    // user profile
    public function user_profile($id)
    {
        // $request = new Comment;

        $check_rate = Rating::where('user_author', auth()->id())
            ->where('user_recipient_rate', $id)
            ->exists();

        $rating = User::find($id)->rates()->avg('rate');

        $comments = User::find($id)->comment;

    /*
        $comment = DB::table('users')
                        ->rightJoin('comments', 'users.id', '=', 'comments.user_author')
                        ->where('comments.user_recipient_comment', $id)
                        ->get();
    */

        $data = DB::table('users')->where('id', $id)->get();

        return view('user_profile', ['data' => $data,
                                    'comment' => $comments,
                                    'rating' => $rating,
                                    'check_rate' => $check_rate
                                ]);
    }


    public function add_comment(CommentRequest $request) {
        $post = new Comment();
        $post->user_author = $request->user_author;
        $post->user_recipient_comment = $request->user_recipient_comment;
        $post->comment = $request->comment;
        $id = $request->user_recipient_comment;

        $post->save();

        echo "Everything is ok";

        return redirect()->route('user_profile', $id)->with('success', 'Comment added successfully');
    }


    public function rate_user(RateRequest $request) {
        $rate = new Rating();

        $rate->user_author = $request->user_author;
        $rate->user_recipient_rate = $request->user_recipient_rate;
        $rate->rate = $request->rate;

        $rate->save();

        $id = $request->user_recipient_rate;

        return redirect()->route('user_profile', $id)->with('success', 'Rating added successfully');
    }


    public function upload_user_photo(PhotoRequest $request) {
        $auth_user = Auth::user()->id;

        if ($file = $request->file('photo')) {
            $name = $file->getClientOriginalName();
            if ($file->move('images', $name)) {
                $post = new User_photo();

                DB::table('users')
                        ->where('id', $auth_user)
                        ->update(['photo' => $name]);

                return redirect()->route('user_profile', $auth_user)
                            ->with('success', 'Photo uploaded successfully');
            }
        }

    }



}



