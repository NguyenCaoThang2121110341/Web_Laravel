<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Category::whereNotIn('category.status', [0, 3])
        ->select('category.id','category.name','category.image','category.slug')
        ->orderBy('category.created_at','desc')
        ->get();
        $htmlparentid = "";
        $htmlsortorder = "";
        foreach ($list as $item){
            $htmlparentid .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            $htmlsortorder .= "<option value='" . ($item->sort_order+1) . "'>Sau " . $item->name . "</option>";
        }
        return view("backend.category.index",compact("list","htmlparentid","htmlsortorder"));   
    }

  
  

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::of($request->name)->slug('-');
        $category->parent_id = $request->parent_id;
        $category->sort_order = $request->sort_order;
        $category->description = $request->description;
        $category->created_at = date('Y-m-d H:i:s');
        $category->created_by = Auth::id() ?? 1;
        $category->status = $request->status;
        if($request->hasFile('image')){
            if(in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])){
                $fileName = $category->slug . '.' . $request->image->extension();
                $request->image->move(public_path("images/cate"), $fileName);
                $category->image = $fileName;
            }
        }
        $category->save();
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::with(['parent', 'children', 'products'])
            ->findOrFail($id);

        $hasActiveProducts = $category->products()->where('status', '!=', 3)->exists();

        return view('backend.category.show', compact('category','hasActiveProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        if($category == null)
        {
            session()->flash('error', 'Dữ liệu id của danh mục không tồn tại!');
            return view("backend.category.index");
        }
        $list = Category::where('category.status', '!=', 0)
            ->select('category.id', 'category.name', 'category.image', 'category.slug', 'category.sort_order')
            ->orderBy('category.created_at', 'desc')
            ->get();
        $htmlparentId = "";
        $htmlsortOrder = "";
        foreach ($list as $item) {
            if($category->parent_id == $item->id){
                $htmlparentId .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
            }
            else{
                $htmlparentId .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            }

            if($category->sort_order-1 == $item->sort_order){
                $htmlsortOrder .= "<option selected value='" . ($item->sort_order + 1) . "'>Sau " . $item->name . "</option>";
            }
            else{
                $htmlsortOrder .= "<option value='" . ($item->sort_order + 1) . "'>Sau " . $item->name . "</option>";
            }
        }
        return view("backend.category.edit", compact("category", "htmlparentId", "htmlsortOrder"));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if($category==null){
            //chuyen trang va bao loi
        }
        $category->name = $request->name;
        $category->slug = Str::of($request->name)->slug('-');
        $category->parent_id = $request->parent_id;
        $category->sort_order = $request->sort_order;
        $category->description = $request->description;
        $category->created_at = date('Y-m-d H:i:s');
        $category->created_by = Auth::id() ?? 1;
        $category->status = $request->status;
        if($request->hasFile('image')){
            if(in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])){
                $fileName = $category->slug . '.' . $request->image->extension();
                $request->image->move(public_path("images/cate"), $fileName);
                $category->image = $fileName;
            }
        }
        $category->save();
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */

     public function trash()
     {
         $list_category_trash = Category::with(['parent' => function ($query) {
             $query->select('id', 'name');
         }])
             ->where('category.status', 3)
             ->select('category.id', 'category.name', 'category.image', 'category.slug', 'category.sort_order', 'category.parent_id', 'category.status')
             ->orderBy('category.created_at', 'desc')
             ->get();
         return view("backend.category.trash", compact("list_category_trash"));
     }
 
     public function trashChildCateOnShow(string $id)
     {
         $category = Category::findOrFail($id);
         $args_trash_child_cate = [
             ['category.status', 3],
             ['category.parent_id', $id]
         ];
         $list_category_trash = Category::with(['parent' => function ($query) {
             $query->select('id', 'name');
         }])
             ->where($args_trash_child_cate)
             ->select('category.id', 'category.name', 'category.image', 'category.slug', 'category.sort_order', 'category.parent_id', 'category.status')
             ->orderBy('category.created_at', 'desc')
             ->get();
         return view("backend.category.show_trash_child_cate", compact("list_category_trash", "category"));
     }
 
     public function trashProByCateOnShow(string $id)
     {
         $category = Category::findOrFail($id);
         $args_trash_pro_by_cate = [
             ['product.status', 3],
             ['product.category_id', $id]
         ];
         $list_trash_pro_by_cate = Product::where($args_trash_pro_by_cate)
             ->join('category', 'category.id', '=', 'product.category_id')
             ->join('brand', 'brand.id', '=', 'product.brand_id')
             ->select('product.id', 'product.name', 'product.image', 'category.name as categoryname', 'brand.name as brandname')
             ->orderBy('product.created_at', 'desc')
             ->get();
         return view("backend.category.show_trash_pro_by_cate", compact("list_trash_pro_by_cate", "category"));
     }
 
 
     public function delete(string $id)
     {
         $category = Category::findOrFail($id);
 
         // Kiểm tra xem danh mục có danh mục con không
         if ($category->children->count() > 0) {
             return redirect()->route('admin.category.index')->with('error', 'Danh mục này có chứa danh mục con.');
         }
 
         // Kiểm tra xem danh mục có sản phẩm không
         if ($category->products->count() > 0) {
             return redirect()->route('admin.category.index')->with('error', 'Danh mục đang chứa sản phẩm.');
         }
 
         // Nếu không có cả danh mục con và sản phẩm, tiến hành xóa
         $category->status = 3;
         $category->save();
         return redirect()->route('admin.category.index')->with('success', 'Danh mục đã được xóa vào thùng rác!');
     }
 
     public function deleteChildCateOnShow(string $id)
     {
         $category = Category::findOrFail($id);
         // Kiểm tra xem danh mục có sản phẩm không
         if ($category->products->count() > 0) {
             return redirect()->route('admin.category.show', ['id' => $category->parent_id])
                 ->with('error', 'Danh mục con đang chứa sản phẩm.');
         }
         // Nếu không có cả danh mục con và sản phẩm, tiến hành xóa
         $category->status = 3;
         $category->save();
         return redirect()->route('admin.category.show', ['id' => $category->parent_id])->with('success', 'Danh mục con đã được xóa vào thùng rác!');
     }
 
     public function deleteChildCateOnEdit(string $id)
     {
         $category = Category::findOrFail($id);
         // Kiểm tra xem danh mục có sản phẩm không
         if ($category->products->count() > 0) {
             return redirect()->route('admin.category.edit', ['id' => $category->parent_id])
                 ->with('error', 'Danh mục con đang chứa sản phẩm.');
         }
         // Nếu không có cả danh mục con và sản phẩm, tiến hành xóa
         $category->status = 3;
         $category->save();
         return redirect()->route('admin.category.edit', ['id' => $category->parent_id])->with('success', 'Danh mục con đã được xóa vào thùng rác!');
     }
 
     public function deleteProductByCateOnShow(string $id)
     {
         $product = Product::findOrFail($id);
         $product->status = 3;
         $product->save();
         return redirect()->route('admin.category.show', ['id' => $product->category_id])->with('success', 'Sản phẩm thuộc danh mục đã được xóa vào thùng rác!');
     }
 
     public function restore(string $id)
     {
         $category = Category::findOrFail($id);
         $category->status = 1;
         $category->save();
         return redirect()->back()->with('success', 'Danh mục khôi phục thành công!');
     }
 
     public function getCategoryTrashItemCount()
     {
         $count = Category::where('status', 3)->count();
         return response()->json(['count' => $count]);
     }
 
     public function getChildCategoryTrashItemCount(string $id)
     {
         $args_trash_child_cate = [
             ['category.status', 3],
             ['category.parent_id', $id]
         ];
         $count = Category::where($args_trash_child_cate)->count();
         return response()->json(['count' => $count]);
     }
 
     public function getProByCategoryTrashItemCount(string $id)
     {
         $args_trash_pro_by_cate = [
             ['product.status', 3],
             ['product.category_id', $id]
         ];
         $count = Product::where($args_trash_pro_by_cate)->count();
         return response()->json(['count' => $count]);
     }
     public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);

            // Xóa hình ảnh
            if ($category->image && file_exists(public_path('img/categories/' . $category->image))) {
                unlink(public_path('img/categories/' . $category->image));
            }

            // Xóa danh mục
            $category->delete();

            return redirect()->back()->with('success', 'Danh mục đã được xóa vĩnh viễn!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xóa danh mục không thành công!');
        }
    }

    public function status(string $id)
    {
        $category = Category::findOrFail($id);
        $category->status = $category->status == 1 ? 2 : 1; // Chuyển đổi trạng thái
        $category->save();

        $message = $category->status == 1 ? 'Bật hiển thị danh mục thành công!' : 'Tắt hiển thị danh mục thành công!';
        return redirect()->route('admin.category.index')->with('success', $message);
    }
}
