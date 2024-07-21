<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTopicRequest;

class TopicController extends Controller
{
    public function index()
    {
        $list = Topic::whereNotIn('topic.status', [0, 3])
        ->select('topic.id','topic.name','topic.slug','topic.description')
        ->orderBy('topic.created_at','desc')
        ->get();
        $htmlsortorder = "";
        foreach ($list as $item){
            $htmlsortorder .= "<option value='" . ($item->sort_order+1) . "'>Sau " . $item->name . "</option>";
        }
        return view("backend.topic.index",compact("list","htmlsortorder"));   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTopicRequest $request)
    {
        $topic = new Topic();
        $topic->name = $request->name;
        $topic->slug = Str::of($request->name)->slug('-');
      
        $topic->description =$request->description;
        $topic->created_by =Auth::id()??1; //Cái này là nếu có id của người tạo thì nó lấy id còn không có thì để mặc định là 1
        $topic->status = $request->status;
        $topic->created_at =date('Y-m-d H:i:s');
        $topic->save();
        return redirect()->route('admin.topic.index');
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $topic = Topic::find($id);
        if($topic == null)
        {
            session()->flash('error', 'Dữ liệu id của danh mục không tồn tại!');
            return view("backend.topic.index");
        }
        $list = Topic::where('topic.status', '!=', 0)
            ->select('topic.id', 'topic.name', 'topic.slug', 'topic.description')
            ->orderBy('topic.created_at', 'desc')
            ->get();
        $htmlsortorder = "";
            foreach ($list as $item) {
                if($topic->sort_order-1 == $item->sort_order){
                    $htmlsortorder .= "<option selected value='" . ($item->sort_order + 1) . "'>Sau " . $item->name . "</option>";
                }
                else{
                    $htmlsortorder .= "<option value='" . ($item->sort_order + 1) . "'>Sau " . $item->name . "</option>";
                }
            }
        return view("backend.topic.edit", compact("topic", "htmlsortorder"));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $topic = Topic::find($id);
        if($topic==null){
            session()->flash('error', 'Dữ liệu id của topic không tồn tại!');
            return view("backend.topic.index");
        }
        $topic -> name=$request->name;
        $topic->slug = Str::of($request->name)->slug('-');
        $topic -> sort_order = $request->sort_order;
        $topic -> description = $request->description;
        $topic -> created_at = date('Y-m-d H:i:s');
        $topic -> created_by = Auth::id()??1;
        $topic -> status =$request -> status;
        $topic->save();
        $request->session()->flash('success', 'sửa thành công.');
        return redirect()->route('admin.topic.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        $topic = Topic::findOrFail($id);
        $topic->status = $topic->status == 1 ? 2 : 1; // Chuyển đổi trạng thái
        $topic->save();

        $message = $topic->status == 1 ? 'Bật hiển thị chủ đề bài viết thành công!' : 'Tắt hiển thị chủ đề bài viết thành công!';
        return redirect()->route('admin.topic.index')->with('success', $message);
    }

    public function delete(string $id)
    {
        $topic = Topic::findOrFail($id);

        // Kiểm tra xem chủ đề có bài viết không
        if ($topic->posts->count() > 0) {
            return redirect()->route('admin.topic.index')->with('error', 'Chủ đề bài viết đang chứa bài viết.');
        }

        $topic->status = 3;
        $topic->save();
        return redirect()->route('admin.topic.index')->with('success', 'Chủ đề bài viết đã được xóa vào thùng rác!');
    }

    public function trash()
    {
        $list_topic_trash = Topic::where('topic.status', 3)
            ->select('topic.id', 'topic.name', 'topic.slug', 'topic.sort_order', 'topic.description', 'topic.status')
            ->orderBy('topic.created_at', 'desc')
            ->get();
        return view("backend.topic.trash", compact("list_topic_trash"));
    }

    public function getTopicTrashItemCount()
    {
        $count = Topic::where('status', 3)->count();
        return response()->json(['count' => $count]);
    }

    public function restore(string $id)
    {
        $topic = Topic::findOrFail($id);
        $topic->status = 1;
        $topic->save();
        return redirect()->back()->with('success', 'Chủ đề bài viết khôi phục thành công!');
    }

    public function destroy(string $id)
    {
        try {
            $topic = Topic::findOrFail($id);

            // Xóa chủ đề bài viết
            $topic->delete();

            return redirect()->back()->with('success', 'Chủ đề bài viết đã được xóa vĩnh viễn!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xóa chủ đề bài viết không thành công!');
        }
    }

    public function show(string $id)
    {
        $topic = Topic::with(['posts'])
            ->findOrFail($id);

        $hasActivePost = $topic->posts()->where('status', '!=', 3)->exists();

        return view('backend.topic.show', compact('topic', 'hasActivePost'));
    }

    public function trashPostByTopicOnShow(string $id)
    {
        $topic = Topic::findOrFail($id);
        $args_trash_post_by_topic = [
            ['post.status', 3],
            ['post.topic_id', $id]
        ];
        $list_trash_post_by_topic = Post::where($args_trash_post_by_topic)
            ->join('topic', 'topic.id', '=', 'post.topic_id')
            ->select('post.id', 'post.title', 'post.image', 'topic.name as topicname', 'post.type', 'post.detail', 'post.description', 'post.status')
            ->orderBy('post.created_at', 'desc')
            ->get();
        return view("backend.topic.show_trash_post_by_topic", compact("list_trash_post_by_topic", "topic"));
    }

    public function getPostByTopicTrashItemCount(string $id)
    {
        $args_trash_post_by_topic = [
            ['post.status', 3],
            ['post.topic_id', $id]
        ];
        $count = Post::where($args_trash_post_by_topic)->count();
        return response()->json(['count' => $count]);
    }

    public function deletePostByTopicOnShow(string $id)
    {
        $post = Post::findOrFail($id);
        $post->status = 3;
        $post->save();
        return redirect()->route('admin.topic.show', ['id' => $post->topic_id])->with('success', 'Bài viết thuộc chủ đề đã được xóa vào thùng rác!');
    }
}
