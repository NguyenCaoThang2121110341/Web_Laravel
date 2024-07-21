<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */


    public function index()
    {
        $list = Product::whereNotIn('product.status', [0, 3])
        ->join('category','category.id','=','product.category_id')
        ->join('brand','brand.id','=','product.brand_id')
        ->select('product.id','product.id','product.name','product.image','category.name as categoryname','qty','brand.name as brandname','price','product.description')
        ->orderBy('product.created_at','desc')
        ->get();
    
        return view("backend.product.index",compact("list"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_category= Category::where('status','!=',0)
        ->orderBy('created_at','asc')
        ->get();
        $list_brand= Brand::where('status','!=',0)
        ->orderBy('created_at','asc')
        ->get();
        $htmlcategoryid="";
        $htmlbrandid="";
        foreach($list_category as $item)
        {
            $htmlcategoryid .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
        }
        foreach($list_brand as $item)
        {
            $htmlbrandid .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
        }
        return view("backend.product.create",compact("htmlcategoryid","htmlbrandid"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product=new Product();
        $product->name=$request->name; //form
        $product->slug=Str::of($request->name)->slug('-');
        $product->category_id=$request->category_id;//form
        $product->brand_id=$request->brand_id;//form
        $product->price=$request->price;//form
        $product->pricesale=$request->pricesale;//form
        $product->qty=$request->qty;//form
        $product->description=$request->description;//form
        $product->detail=$request->detail;//form
        $product->created_at=date('Y-m-d H:i:s');
        // $product->created_by=Auth::id()??1;
        $product->status=$request->status;//form
        // $category->image=$request->image;//form
        if($request->hasFile('image')){
            if(in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])){
                $fileName = $product->slug . '.' . $request->image->extension();
                $request->image->move(public_path("images/product"), $fileName);
                $product->image = $fileName;
            }
        }
        $product->save();
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        if($product == null)
        {
            session()->flash('error', 'Dữ liệu id của danh mục không tồn tại!');
            return view("backend.product.index");
        }
        $list = Product::where('product.status', '!=', 0)
            ->select('product.id', 'product.name', 'product.image', 'product.slug', 'product.description', 'product.price', 'product.pricesale')
            ->orderBy('product.created_at', 'desc')
            ->get();
            $categories  = Category::where('status', '!=', 0)
            ->select('category.id', 'category.name' )
            ->get();
            $brands  = Brand::where('status', '!=', 0)
            ->select('brand.id', 'brand.name' )
            ->get();
            // // ->pluck('name', 'id');

            $htmlcategories = "";
            foreach ($categories as $item) {
                if($product->category_id == $item->id){
                    $htmlcategories .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
                }
                else{
                    $htmlcategories .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
                }
            }


            $htmlbrands = "";
            foreach ($brands as $item) {
                if($product->brand_id == $item->id){
                    $htmlbrands .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
                }
                else{
                    $htmlbrands .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
                }
            }

        return view("backend.product.edit", compact("product","categories","brands","htmlcategories","htmlbrands"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if($product==null){
            //chuyen trang va bao loi
        }
        $product->name = $request->name;
        $product->slug = Str::of($request->name)->slug('-');
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->detail = $request->detail;
        $product->description = $request->description;
        if($request->hasFile('image')){
            if(in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])){
                $fileName = $product->slug . '.' . $request->image->extension();
                $request->image->move(public_path("images/product"), $fileName);
                $product->image = $fileName;
            }
        }
        $product->price = $request->price;
        $product->pricesale = $request->pricesale;
        $product->created_at = date('Y-m-d H:i:s');
        $product->created_by = Auth::id() ?? 1;
        $product->status = $request->status;
        $product->save();

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function show(string $id)
    {
        $product = Product::with(['category', 'brand'])->findOrFail($id);
        return view('backend.product.show', compact('product')); 
    }

    public function trash()
    {
        $list_trash_product = Product::where('product.status', 3)
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('brand', 'brand.id', '=', 'product.brand_id')
            ->select('product.id', 'product.name', 'product.image', 'category.name as categoryname', 'brand.name as brandname', 'product.slug')
            ->orderBy('product.created_at', 'desc')
            ->get();
        return view("backend.product.trash", compact("list_trash_product"));
    }
    
    public function delete(string $id)
    {
        $product = Product::findOrFail($id);

        $product->status = 3;
        $product->save();
        return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được xóa vào thùng rác!');
    }

    public function restore(string $id)
    {
        $product = Product::findOrFail($id);
        $product->status = 1;
        $product->save();
        return redirect()->back()->with('success', 'Sản phẩm khôi phục thành công!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);

            // Xóa hình ảnh
            if ($product->image && file_exists(public_path('img/products/' . $product->image))) {
                unlink(public_path('img/products/' . $product->image));
            }

            // Xóa danh mục
            $product->delete();

            return redirect()->back()->with('success', 'Sản phẩm đã được xóa vĩnh viễn!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xóa sản phẩm không thành công!');
        }
    }

    public function status(string $id)
    {
        $product = Product::findOrFail($id);
        $product->status = $product->status == 1 ? 2 : 1; // Chuyển đổi trạng thái
        $product->save();

        $message = $product->status == 1 ? 'Bật hiển thị sản phẩm thành công!' : 'Tắt hiển thị sản phẩm thành công!';
        return redirect()->route('admin.product.index')->with('success', $message);
    }

    public function getProductTrashItemCount(){
        $count = Product::where('status', 3)->count();
        return response()->json(['count' => $count]);
    }
   

}
