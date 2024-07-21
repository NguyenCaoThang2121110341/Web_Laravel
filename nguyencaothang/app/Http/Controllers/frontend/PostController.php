<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Topic;

class PostController extends Controller
{
    public function index()
    {
    $list_post = Post::where('status', '=', 1)
    ->orderBy('created_at','desc')
    ->paginate(9);
    return view("frontend.Post.allpost", compact('list_post'));
    }

    public function detail($slug)
    {
        $post=Post::where([['status','=',1], ['slug', '=', $slug]])->first();
        $listtopid = $this->getlisttopicid($post->topic_id);
        $list_post = Post::where([['status', '=', 1], ['id', '!=', $post->id]])
        ->whereIn('topic_id', $listtopid)
        ->orderBy('created_at','desc')
        ->limit(8)
        ->get();
        return view('frontend.PostDetail.postdetail', compact('post', 'list_post'));
    }

    public function getlisttopicid($rowid)
    {
        $listtopid = [];
    
        array_push($listtopid, $rowid);
    
        $list1 = Topic::where([['id', '=', $rowid], ['status', '=', 1]])
            ->select("id")
            ->get();
    
        if (count($list1) > 0) {
            foreach ($list1 as $row1) {
                array_push($listtopid, $row1->id);
            }
        }
    
        return $listtopid;
    }
    
    public function topic($slug)
    {
        $row = Topic::where('slug', '=', $slug)
            ->select("id", "name", "slug")
            ->first();
    
        $list_post = [];
    
        if ($row != null) {
            $listtopid = $this->getlisttopicid($row->id);
    
            $list_post = Post::where('status', '=', 1)
                ->where('topic_id', $listtopid)
                ->orderBy('created_at', 'desc')
                ->paginate(9);
        }
    
        return view("frontend.PostTopic.posttopic", compact('list_post', 'row'));
    }
    public function alltopic(Request $request)
    {
        $list_topic = topic::where('status', '=', 1)
        ->orderBy('created_at','desc')
        ->paginate(3);
        return view("frontend.Alltopic.alltopic", compact('list_topic'));
    }
}