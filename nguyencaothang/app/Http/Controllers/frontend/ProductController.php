<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $list_product = Product::where('status', '=', 1)
        ->orderBy('created_at','desc')
        ->paginate(9);
        return view("frontend.Product.allproduct", compact('list_product'));
    }

    public function detail($slug)
    {
        $product = Product::where([['status', '=' , 1],['slug','=',$slug]])->first();
        $listcatid = $this->getlistcategoryid($product->category_id);
        $list_product = Product::where([['status', '=', 1], ['id', '!=', $product->id]])
        ->whereIn('category_id', $listcatid)
        ->orderBy('created_at','desc')
        ->limit(8)
        ->get();
        return view("frontend.ProductDetail.productdetail",compact('product','list_product'));
    }
     //get list category
     public function getlistcategoryid($rowid)
     {
         $listcatid=[];
             array_push($listcatid, $rowid);
             $list1 = Category::where([['parent_id','=',$rowid], ['status','=',1]])->select("id")->get();
             if(count($list1)>0)
             {
                 foreach($list1 as $row1)
                 {
                     array_push($listcatid, $row1->id);
                     $list2 = Category::where([['parent_id','=', $row1->id],['status','=',1]])->select("id")->get();
                     if(count($list2)>0)
                     {
                         foreach($list2 as $row2)
                         {
                             array_push($listcatid, $row2->id);
                             // $list2 = Category::where([['parent_id','=',$row1->id],['status','=',1]])->select("id")->get();
                         }
                     }
                 }
             }
             return $listcatid;
     
     }
     
           //product category
           public function category($slug)
         {
             $row=Category::where('slug','=',$slug)->select("id", "name", "slug")->first();
             $listcatid=[];
             if($row!=null)
             {
                 $listcatid = $this->getlistcategoryid($row->id);
             }
             $list_product = Product::where('status', '=', 1)
             ->whereIn('category_id', $listcatid)
             ->orderBy('created_at','desc')
             ->paginate(3);
             return view("frontend.ProductCate.productcate", compact('list_product', 'row'));
         }
         public function allcategory(Request $request)
         {
             $list_category = Category::where('status', '=', 1)
             ->orderBy('created_at','desc')
             ->paginate(3);
             return view("frontend.AllCategory.allcategory", compact('list_category'));
         }


        //  brand
        public function allbrand(Request $request)
        {
            $list_brand = Brand::where('status', '=', 1)
            ->orderBy('created_at','desc')
            ->paginate(3);
            return view("frontend.AllBrand.allbrand", compact('list_brand'));
        }

        public function getlistbrandid($rowid)
        {
            $listbrandid=[];
                array_push($listbrandid, $rowid);
                $list1 = Brand::where([ ['status','=',1]])->select("id")->get();
                if(count($list1)>0)
                {
                    foreach($list1 as $row1)
                    {
                        array_push($listbrandid, $row1->id);
                        $list2 = Brand::where([['status','=',1]])->select("id")->get();
                        if(count($list2)>0)
                        {
                            foreach($list2 as $row2)
                            {
                                array_push($listbrandid, $row2->id);
                                // $list2 = Category::where([['parent_id','=',$row1->id],['status','=',1]])->select("id")->get();
                            }
                        }
                    }
                }
                return $listbrandid;
        
        }
        public function brand($slug)
        {
            $row=Brand::where('slug','=',$slug)->select("id", "name", "slug")->first();
            $listbrandid=[];
            if($row!=null)
            {
                $listbrandid = $this->getlistbrandid($row->id);
            }
            $list_product = Product::where('status', '=', 1)
            ->where('brand_id', $listbrandid)
            ->orderBy('created_at','desc')
            ->paginate(3);
            return view("frontend.ProductBrand.productbrand", compact('list_product', 'row'));
        }
     
        public function search(Request $request)
        {
            $search = $request->input('search');
    
            // Tìm kiếm sản phẩm có tên chứa từ khóa tìm kiếm
            $products = Product::where('name', 'like', '%'.$search.'%')->get();
            return view('frontend.ProductSearch.productsearch', compact('products', 'search'));
        }
}