<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMenuRequest;

class MenuController extends Controller
{
    public function index()
    {
        $list = Menu::where('menu.status','!=',0)
        ->select('menu.id','menu.name','menu.link','menu.type','menu.position')
        ->orderBy('menu.created_at','desc')
        ->get();
        $htmlsortorder = "";
        $htmlparentid = "";
        $htmlposition = "";
        foreach ($list as $item){
            $htmlsortorder .= "<option value='" . ($item->sort_order+1) . "'>Sau " . $item->name . "</option>";
            $htmlparentid .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
        }
        return view("backend.menu.index",compact("list","htmlsortorder","htmlparentid"));   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        try {
            // Cập nhật thông tin menu hiện tại
            $menu = new Menu();
            $menu->name = $request->name;
            $menu->link = $request->link;
            $menu->sort_order =$request->sort_order;
            $menu->parent_id =$request->parent_id;
            $menu->type =$request->type;
            $menu->position =$request->position;
            $menu->created_at =date('Y-m-d H:i:s');
            $menu->created_by =Auth::id()??1; //Cái này là nếu có id của người tạo thì nó lấy id còn không có thì để mặc định là 1
            $menu->updated_by =Auth::id()??1;
            $menu->status = $request->status;
            $menu->save();
    
            session()->flash('success', 'Cập nhật menu thành công.');
        } catch (\Exception $e) {
            session()->flash('error', 'Cập nhật bị thất bại, vui lòng nhập lại.');
        }
    
        return redirect()->route('admin.menu.index');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view('backend.menu.show', compact('menu'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::find($id);
        if($menu == null)
        {
            session()->flash('error', 'Dữ liệu id của menu không tồn tại!');
            return view("backend.menu.index");
        }
        $list = Menu::where('menu.status','!=',0)
        ->select('menu.id','menu.name','menu.link','menu.sort_order','menu.type','menu.position')
        ->orderBy('menu.created_at','desc')
        ->get();
        $htmlparentid = "";
        $htmlsortorder = "";
        foreach ($list as $item) {
            if($menu->parent_id == $item->id){
                $htmlparentid .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
            }
            else{
                $htmlparentid .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            }

            if($menu->sort_order-1 == $item->sort_order){
                $htmlsortorder .= "<option selected value='" . ($item->sort_order + 1) . "'>Sau " . $item->name . "</option>";
            }
            else{
                $htmlsortorder .= "<option value='" . ($item->sort_order + 1) . "'>Sau " . $item->name . "</option>";
            }
        }
        return view("backend.menu.edit", compact("menu", "htmlparentid", "htmlsortorder"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::find($id);
        if($menu == null)
        {
            session()->flash('error', 'Dữ liệu id của menu không tồn tại!');
            return view("backend.menu.index");
        }
        try {
            // Cập nhật thông tin menu hiện tại
            $menu = new Menu();
            $menu->name = $request->name;
            $menu->link = $request->link;
            $menu->sort_order =$request->sort_order;
            $menu->parent_id =$request->parent_id;
            $menu->type =$request->type;
            $menu->position =$request->position;
            $menu->created_at =date('Y-m-d H:i:s');
            $menu->created_by =Auth::id()??1; //Cái này là nếu có id của người tạo thì nó lấy id còn không có thì để mặc định là 1
            $menu->updated_by =Auth::id()??1;
            $menu->status = $request->status;
            $menu->save();
    
            session()->flash('success', 'Cập nhật menu thành công.');
        } catch (\Exception $e) {
            session()->flash('error', 'Cập nhật bị thất bại, vui lòng nhập lại.');
        }
    
        return redirect()->route('admin.menu.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);    
    
        if ($menu) {
            $menu->delete();
            return redirect()->route('admin.menu.index')->with('success', 'Menu đã được xóa thành công.');
        } else {
            return redirect()->route('admin.menu.index')->with('error', 'Menu không tồn tại.');
        }
    }
    
}
