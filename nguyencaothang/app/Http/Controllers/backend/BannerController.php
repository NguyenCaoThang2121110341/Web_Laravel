<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    public function index()
    {

        $list = Banner::whereNotIn('banner.status', [0, 3])
            ->select('banner.id', 'banner.name', 'banner.link', 'banner.image', 'banner.position', 'banner.sort_order','banner.status')
            ->orderBy('banner.created_at', 'desc')
            ->get();
        $htmlsortorder = "";
        foreach ($list as $item) {
            $htmlsortorder .= "<option value='" . ($item->sort_order + 1) . "'>Sau " . $item->name . "</option>";
        }
        return view("backend.banner.index", compact("list", "htmlsortorder"));
    }

    public function store(StoreBannerRequest $request)
    {
        try {
            $banner = new Banner();
            $banner->name = $request->name;
            $banner->link = $request->link;
            $banner->sort_order = $request->sort_order;
            $banner->position = $request->position;
            $banner->description = $request->description;
            $banner->created_at = date('Y-m-d H:i:s');
            $banner->updated_at = $request->updated_at;
            $banner->created_by = Auth::id()??1;
            $banner->updated_by = $request->updated_by;
            $banner->status = $request->status;

            // upload file
            if ($request->image) {
                if (in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])) {
                    $timestamp = now()->timestamp; // Lấy timestamp hiện tại
                    $filename = Str::slug($request->name) . '_' . $timestamp . '.' . $request->image->extension(); 
                    $request->image->move(public_path("img/banners"), $filename);
                    $banner->image = $filename;
                }
            }
            $banner->save();

            session()->flash('success', 'Thêm Banner thành công.');
        } catch (\Exception $e) {
            session()->flash('error', 'Thêm bị thất bại, vui lòng nhập lại.');
        }
        return redirect()->route('admin.banner.index');
    }

    public function edit(string $id)
    {
        $banner = Banner::find($id);
        if($banner == null)
        {
            session()->flash('error', 'Dữ liệu id của banner không tồn tại!');
            return view("backend.banner.index");
        }
        $list = Banner::whereNotIn('banner.status', [0, 3])
            ->select('banner.id', 'banner.name', 'banner.link', 'banner.image', 'banner.position', 'banner.sort_order')
            ->orderBy('banner.created_at', 'desc')
            ->get();
        $htmlsortorder = "";
        foreach ($list as $item) {
            if($banner->sort_order-1 == $item->sort_order){
                $htmlsortorder .= "<option selected value='" . ($item->sort_order + 1) . "'>Sau " . $item->name . "</option>";
            }
            else{
                $htmlsortorder .= "<option value='" . ($item->sort_order + 1) . "'>Sau " . $item->name . "</option>";
            }
        }
        return view("backend.banner.edit", compact("banner", "htmlsortorder"));
    }

    public function update(StoreBannerRequest $request, string $id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            session()->flash('error', 'Dữ liệu id của banner không tồn tại!');
            return redirect()->route('admin.banner.index');
        }
        try {
            // Cập nhật thông tin banner hiện tại
            $banner->name = $request->name;
            $banner->link = $request->link;
            $banner->sort_order = $request->sort_order;
            $banner->position = $request->position;
            $banner->description = $request->description;
            $banner->created_at = date('Y-m-d H:i:s');
            $banner->updated_at = $request->updated_at;
            $banner->created_by = Auth::id()??1;
            $banner->updated_by = $request->updated_by;
            $banner->status = $request->status;

            // upload file
            if ($request->image) {
                if (in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])) {
                    $timestamp = now()->timestamp; // Lấy timestamp hiện tại
                    $filename = Str::slug($request->name) . '_' . $timestamp . '.' . $request->image->extension(); 
                    $request->image->move(public_path("img/banners"), $filename);
                    $banner->image = $filename;
                }
            }
    
            $banner->save();
    
            session()->flash('success', 'Cập nhật banner thành công.');
        } catch (\Exception $e) {
            session()->flash('error', 'Cập nhật bị thất bại, vui lòng nhập lại.');
        }
    
        return redirect()->route('admin.banner.index');
    }

    public function status(string $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->status = $banner->status == 1 ? 2 : 1; // Chuyển đổi trạng thái
        $banner->save();

        $message = $banner->status == 1 ? 'Bật hiển thị banner thành công!' : 'Tắt hiển thị banner thành công!';
        return redirect()->route('admin.banner.index')->with('success', $message);
    }

    public function trash()
    {
        $list_banner_trash = Banner::where('banner.status', 3)
        ->select('banner.id', 'banner.name', 'banner.link', 'banner.image', 'banner.position', 'banner.sort_order','banner.status')
        ->orderBy('banner.created_at', 'desc')
        ->get();
        return view("backend.banner.trash", compact("list_banner_trash"));
    }

    public function delete(string $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->status = 3;
        $banner->save();
        return redirect()->route('admin.banner.index')->with('success', 'Banner đã được xóa vào thùng rác!');
    }

    public function getBannerTrashItemCount()
    {
        $count = Banner::where('status', 3)->count();
        return response()->json(['count' => $count]);
    }

    public function restore(string $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->status = 1;
        $banner->save();
        return redirect()->back()->with('success', 'Banner khôi phục thành công!');
    }

    public function destroy(string $id)
    {
        try {
            $banner = Banner::findOrFail($id);

            // Xóa hình ảnh
            if ($banner->image && file_exists(public_path('img/banners/' . $banner->image))) {
                unlink(public_path('img/banners/' . $banner->image));
            }

            $banner->delete();

            return redirect()->back()->with('success', 'Banner đã được xóa vĩnh viễn!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xóa banner không thành công!');
        }
    }

    public function show(string $id)
    {
        $banner = Banner::findOrFail($id);

        return view('backend.banner.show', compact('banner'));
    }

}
