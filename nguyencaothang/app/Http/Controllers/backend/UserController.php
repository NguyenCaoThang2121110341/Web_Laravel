<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $list = User::where('status', '!=', 0)
            ->select('id', 'name', 'email', 'phone', 'username', 'password', 'address', 'roles','image')
            ->orderBy('created_at', 'desc')
            ->get();

        return view("backend.user.index", compact('list'));   
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->password = bcrypt($request->password); // Nên mã hóa mật khẩu
        $user->address = $request->address;
        $user->roles = $request->roles;
        $user->created_at = now();
        $user->created_by = Auth::id() ?? 1; 
        $user->status = $request->status;
        $user->updated_at = now();
        if($request->hasFile('image')){
            if(in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])){
                $currentDateTime = now()->format('YmdHis');
                $fileName = $currentDateTime . '.' . $request->image->extension();
                $request->image->move(public_path("images/users"), $fileName);
                $user->image = $fileName;
            }
        }
        $user->save();

        return redirect()->route('admin.user.index');
    }
    public function edit(string $id)
    {
        $user = User::find($id);
        if($user == null)
        {
            session()->flash('error', 'Dữ liệu id của danh mục không tồn tại!');
            return view("backend.user.index");
        }
        $list = User::where('user.status', '!=', 0)
            ->select('user.id', 'user.name', 'user.image', 'user.username', 'user.password', 'user.gender', 'user.phone', 'user.email', 'user.roles', 'user.address')
            ->orderBy('user.created_at', 'desc')
            ->get();
            // foreach ($list as $item) {
            //     if($category->parent_id == $item->id){
            //         $htmlparentid .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
            //     }
            //     else{
            //         $htmlparentid .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            //     }

            //     if($category->sort_order-1 == $item->sort_order){
            //         $htmlsortorder .= "<option selected value='" . ($item->sort_order + 1) . "'>Sau " . $item->name . "</option>";
            //     }
            //     else{
            //         $htmlsortorder .= "<option value='" . ($item->sort_order + 1) . "'>Sau " . $item->name . "</option>";
            //     }
            // }
        return view("backend.user.edit", compact("user"));
    }
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if($user==null){
            //chuyen trang va bao loi
        }
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->roles = $request->roles;
        // $user->image = $request->image;
        $user->address = $request->address;
        $user->remember_token = $request->remember_token;
        $user->created_at = date('Y-m-d H:i:s');
        $user->created_by = Auth::id()??1; // hoặc bất kỳ giá trị nào bạn muốn
        $user->updated_at = date('Y-m-d H:i:s');
        $user->updated_by = Auth::id()??1; // hoặc bất kỳ giá trị nào bạn muốn
        $user->status = $request->status;
        if($request->hasFile('image')){
            if(in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])){
                $currentDateTime = now()->format('YmdHis');
                $fileName = $currentDateTime . '.' . $request->image->extension();
                $request->image->move(public_path("images/users"), $fileName);
                $user->image = $fileName;
            }
        }
        $user->save();
        $request->session()->flash('success', 'sửa thành công.');
        return redirect()->route('admin.user.index');
    }
}
