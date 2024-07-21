<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBrandRequest;

class BrandController extends Controller
{
    public function index()
    {
        $list = Brand::whereNotIn('brand.status', [0, 3])
        ->select('brand.id','brand.name','brand.image','brand.slug')
        ->orderBy('brand.created_at','desc')
        ->get();
        $htmlsortorder = "";
        foreach ($list as $item){
            $htmlsortorder .= "<option value='" . ($item->sort_order+1) . "'>Sau " . $item->name . "</option>";
        }
        return view("backend.brand.index",compact("list","htmlsortorder"));   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::of($request->name)->slug('-');
        $brand->sort_order =$request->sort_order;
        $brand->description =$request->description;
        // $brand->created_by =Auth::id()??1; //Cái này là nếu có id của người tạo thì nó lấy id còn không có thì để mặc định là 1
        $brand->status = $request->status;
        $brand->created_at =date('Y-m-d H:i:s');
        if($request->hasFile('image')){
            if(in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])){
                $fileName = $brand->slug . '.' . $request->image->extension();
                $request->image->move(public_path("images/brand"), $fileName);
                $brand->image = $fileName;
            }
        }
        $brand->save();
        return redirect()->route('admin.brand.index');
    }

    /**
     * Display the specified resource.
     */
   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::find($id);
        if($brand == null)
        {
            session()->flash('error', 'Dữ liệu id của danh mục không tồn tại!');
            return view("backend.brand.index");
        }
        $list = Brand::where('brand.status', '!=', 0)
            ->select('brand.id', 'brand.name', 'brand.image', 'brand.slug', 'brand.sort_order')
            ->orderBy('brand.created_at', 'desc')
            ->get();
     
        $htmlsortOrder = "";
        foreach ($list as $item) {
          

            if($brand->sort_order-1 == $item->sort_order){
                $htmlsortOrder .= "<option selected value='" . ($item->sort_order + 1) . "'>Sau " . $item->name . "</option>";
            }
            else{
                $htmlsortOrder .= "<option value='" . ($item->sort_order + 1) . "'>Sau " . $item->name . "</option>";
            }
        }
        return view("backend.brand.edit", compact("brand",  "htmlsortOrder"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);
        if($brand==null){
            //chuyen trang va bao loi
        }
        $brand->name = $request->name;
        $brand->slug = Str::of($request->name)->slug('-');
       
        $brand->sort_order = $request->sort_order;
        $brand->description = $request->description;
        $brand->created_at = date('Y-m-d H:i:s');
        $brand->created_by = Auth::id() ?? 1;
        $brand->status = $request->status;
        if($request->hasFile('image')){
            if(in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])){
                $fileName = $brand->slug . '.' . $request->image->extension();
                $request->image->move(public_path("images/brand"), $fileName);
                $brand->image = $fileName;
            }
        }
        $brand->save();
        return redirect()->route('admin.brand.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->status = $brand->status == 1 ? 2 : 1; // Chuyển đổi trạng thái
        $brand->save();

        $message = $brand->status == 1 ? 'Bật hiển thị thương hiệu thành công!' : 'Tắt hiển thị thương hiệu thành công!';
        return redirect()->route('admin.brand.index')->with('success', $message);
    }

    public function delete(string $id)
    {
        $brand = Brand::findOrFail($id);

        // Kiểm tra xem thương hiệu có sản phẩm không
        if ($brand->products->count() > 0) {
            return redirect()->route('admin.brand.index')->with('error', 'Thương hiệu đang chứa sản phẩm.');
        }

        $brand->status = 3;
        $brand->save();
        return redirect()->route('admin.brand.index')->with('success', 'Thương hiệu đã được xóa vào thùng rác!');
    }

    public function trash()
    {
        $list_brand_trash = Brand::where('brand.status', 3)
        ->select('brand.id', 'brand.name', 'brand.image', 'brand.slug', 'brand.sort_order', 'brand.status')
        ->orderBy('brand.created_at', 'desc')
        ->get();
        return view("backend.brand.trash", compact("list_brand_trash"));
    }

    public function getBrandTrashItemCount()
    {
        $count = Brand::where('status', 3)->count();
        return response()->json(['count' => $count]);
    }

    public function restore(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->status = 1;
        $brand->save();
        return redirect()->back()->with('success', 'Thương hiệu khôi phục thành công!');
    }

    public function destroy(string $id)
    {
        try {
            $brand = Brand::findOrFail($id);

            // Xóa hình ảnh
            if ($brand->image && file_exists(public_path('img/brands/' . $brand->image))) {
                unlink(public_path('img/brands/' . $brand->image));
            }

            // Xóa danh mục
            $brand->delete();

            return redirect()->back()->with('success', 'Thương hiệu đã được xóa vĩnh viễn!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xóa thương hiệu không thành công!');
        }
    }

    public function getProByBrandTrashItemCount(string $id){
        $args_trash_pro_by_brand = [
            ['product.status', 3],
            ['product.brand_id', $id]
        ];
        $count = Product::where($args_trash_pro_by_brand)->count();
        return response()->json(['count' => $count]);
    }

    public function show(string $id)
    {
        $brand = Brand::with(['products'])
            ->findOrFail($id);

        $hasActiveProducts = $brand->products()->where('status', '!=', 3)->exists();

        return view('backend.brand.show', compact('brand','hasActiveProducts'));
    }

    public function trashProByBrandOnShow(string $id){
        $brand = Brand::findOrFail($id);
        $args_trash_pro_by_brand = [
            ['product.status', 3],
            ['product.brand_id', $id]
        ];
        $list_trash_pro_by_brand = Product::where($args_trash_pro_by_brand)
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('brand', 'brand.id', '=', 'product.brand_id')
            ->select('product.id', 'product.name', 'product.image', 'category.name as categoryname', 'brand.name as brandname')
            ->orderBy('product.created_at', 'desc')
            ->get();
        return view("backend.brand.show_trash_pro_by_brand", compact("list_trash_pro_by_brand", "brand"));
    }

    public function deleteProductByBrandOnShow(string $id)
    {
        $product = Product::findOrFail($id);
        $product->status = 3;
        $product->save();
        return redirect()->route('admin.brand.show', ['id' => $product->brand_id])->with('success', 'Sản phẩm thuộc thương hiệu đã được xóa vào thùng rác!');
    }
}
