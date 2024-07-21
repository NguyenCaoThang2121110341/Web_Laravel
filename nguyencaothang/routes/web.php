
<?php

use Illuminate\Support\Facades\Route;
// Site
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\ProductController as SanPhamController;
use App\Http\Controllers\frontend\ContactController as LienHeController;
use App\Http\Controllers\frontend\LoginController;
use App\Http\Controllers\frontend\PostController as BaivietController;
use App\Http\Controllers\frontend\CartController;
// Admin
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\MenuController;
use App\Http\Controllers\backend\TopicController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\OrderdetailController;
use App\Http\Middleware\LoginMiddleware;

// Site
Route::get('/', [HomeController::class, 'index'])->name('site.home');
Route::get('san-pham', [SanPhamController::class, 'index'])->name('site.product');
Route::get('chi-tiet-san-pham/{slug}', [SanPhamController::class, 'detail'])->name('site.product.detail');
Route::get('lien-he', [LienHeController::class, 'index'])->name('site.contact');
Route::get('chi-tiet-san-pham/{slug}', [SanPhamController::class, 'detail'])->name('site.product.detail');
Route::get('dang-nhap', [LoginController::class, 'getLogin'])->name('frontend.login');
Route::get('login', [LoginController::class, 'getlogin'])->name('website.getlogin');
Route::post('login', [LoginController::class, 'dologin'])->name('website.dologin');
Route::get('logout', [LoginController::class, 'logout'])->name('website.logout');
Route::get('tat-ca-bai-viet', [BaivietController::class, 'index'])->name('site.post.index');
Route::get('chi-tiet-bai-viet/{slug}', [BaivietController::class, 'detail'])->name('site.post.detail');
Route::get('chu-de/{slug}', [BaivietController::class, 'topic'])->name('site.post.topic');
Route::get('tat-ca-chu-de', [BaivietController::class, 'alltopic'])->name('site.topic');
Route::get('tat-ca-danh-muc', [SanPhamController::class, 'allcategory'])->name('site.category');
Route::get('danh-muc/{slug}', [SanPhamController::class, 'category'])->name('site.product.category');

Route::get('tat-ca-thuong-hieu', [SanPhamController::class, 'allbrand'])->name('site.brand');
Route::get('thuong-hieu/{slug}', [SanPhamController::class, 'brand'])->name('site.product.brand');
Route::get('/tim-kiem', [SanPhamController::class, 'search'])->name('products.search');
//cart
Route::get('gio-hang', [CartController::class, 'index'])->name('site.cart.index');
Route::get('cart/addcart', [CartController::class, 'addcart'])->name('site.cart.addcart');
Route::post('cart/update', [CartController::class, 'update'])->name('site.cart.update');
Route::get('cart/delete/{id}', [CartController::class, 'delete'])->name('site.cart.delete');
Route::get('thanh-toan', [CartController::class, 'checkout'])->name('site.cart.checkout');

// Admin
Route::prefix("admin")->middleware("middleware")->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    

    //Product
    Route::prefix("product")->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product.index');
        
        Route::get('trash', [ProductController::class, 'trash'])->name('admin.product.trash');
        Route::get('show/{id}', [ProductController::class, 'show'])->name('admin.product.show');
        Route::get('create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
        Route::get('restore/{id}', [ProductController::class, 'restore'])->name('admin.product.restore');
        Route::get('destroy/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
        Route::get('count-item-trash', [ProductController::class, 'getProductTrashItemCount'])->name('admin.product.trash.count');
        Route::get('status/{id}', [ProductController::class, 'status'])->name('admin.product.status');

    });
     //Category
     Route::prefix("category")->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('trash', [CategoryController::class, 'trash'])->name('admin.category.trash');
        Route::get('trash-children-category-on-show/{id}', [CategoryController::class, 'trashChildCateOnShow'])->name('admin.category.trash-child-cate-on-show');
        Route::get('trash-product-by-category-on-show/{id}', [CategoryController::class, 'trashProByCateOnShow'])->name('admin.category.trash-pro-by-cate-on-show');
        Route::get('show/{id}', [CategoryController::class, 'show'])->name('admin.category.show');
        Route::get('status/{id}', [CategoryController::class, 'status'])->name('admin.category.status');
        Route::post('store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
        Route::get('delete-children-category-on-show/{id}', [CategoryController::class, 'deleteChildCateOnShow'])->name('admin.category.delete-child-cate-on-show');
        Route::get('delete-product-by-category-on-show/{id}', [CategoryController::class, 'deleteProductByCateOnShow'])->name('admin.category.delete-product-by-cate-on-show');
        Route::get('delete-children-category-on-edit/{id}', [CategoryController::class, 'deleteChildCateOnEdit'])->name('admin.category.delete-child-cate-on-edit');
        Route::get('restore/{id}', [CategoryController::class, 'restore'])->name('admin.category.restore');
        Route::get('destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
        Route::get('count-item-trash', [CategoryController::class, 'getCategoryTrashItemCount'])->name('admin.category.trash.count');
        Route::get('count-item-child-cate-trash/{id}', [CategoryController::class, 'getChildCategoryTrashItemCount'])->name('admin.child.category.trash.count');
        Route::get('count-item-pro-by-cate-trash/{id}', [CategoryController::class, 'getProByCategoryTrashItemCount'])->name('admin.pro.by.category.trash.count');

       
       
      
    });
    //Brand
        Route::prefix("brand")->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('admin.brand.index');
            Route::get('trash', [BrandController::class, 'trash'])->name('admin.brand.trash');
            Route::get('trash-product-by-brand-on-show/{id}', [BrandController::class, 'trashProByBrandOnShow'])->name('admin.brand.trash-pro-by-brand-on-show');
            Route::get('show/{id}', [BrandController::class, 'show'])->name('admin.brand.show');
            Route::post('store', [BrandController::class, 'store'])->name('admin.brand.store');
            Route::get('edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
            Route::put('update/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
            Route::get('delete/{id}', [BrandController::class, 'delete'])->name('admin.brand.delete');
            Route::get('delete-product-by-brand-on-show/{id}', [BrandController::class, 'deleteProductByBrandOnShow'])->name('admin.brand.delete-product-by-brand-on-show');
            Route::get('restore/{id}', [BrandController::class, 'restore'])->name('admin.brand.restore');
            Route::get('destroy/{id}', [BrandController::class, 'destroy'])->name('admin.brand.destroy');
            Route::get('count-item-trash', [BrandController::class, 'getBrandTrashItemCount'])->name('admin.brand.trash.count');
            Route::get('count-item-pro-by-brand-trash/{id}', [BrandController::class, 'getProByBrandTrashItemCount'])->name('admin.pro.by.brand.trash.count');
                Route::get('status/{id}', [BrandController::class, 'status'])->name('admin.brand.status');

        });
   //Banner
   Route::prefix("banner")->group(function () {
    Route::get('/', [BannerController::class, 'index'])->name('admin.banner.index');
    Route::get('trash', [BannerController::class, 'trash'])->name('admin.banner.trash');
    Route::get('show/{id}', [BannerController::class, 'show'])->name('admin.banner.show');
    Route::get('status/{id}', [BannerController::class, 'status'])->name('admin.banner.status');
    Route::post('store', [BannerController::class, 'store'])->name('admin.banner.store');
    Route::get('edit/{id}', [BannerController::class, 'edit'])->name('admin.banner.edit');
    Route::put('update/{id}', [BannerController::class, 'update'])->name('admin.banner.update');
    Route::get('delete/{id}', [BannerController::class, 'delete'])->name('admin.banner.delete');
    Route::get('restore/{id}', [BannerController::class, 'restore'])->name('admin.banner.restore');
    Route::get('destroy/{id}', [BannerController::class, 'destroy'])->name('admin.banner.destroy');
    Route::get('count-item-trash', [BannerController::class, 'getBannerTrashItemCount'])->name('admin.banner.trash.count');
});
     //Menu
     Route::prefix("menu")->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('admin.menu.index');
        Route::get('trash', [MenuController::class, 'trash'])->name('admin.menu.trash');
        Route::get('show/{id}', [MenuController::class, 'show'])->name('admin.menu.show');
        Route::post('store', [MenuController::class, 'store'])->name('admin.menu.store');
        Route::get('edit/{id}', [MenuController::class, 'edit'])->name('admin.menu.edit');
        Route::put('update/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
        Route::get('delete/{id}', [MenuController::class, 'delete'])->name('admin.menu.delete');
        Route::get('restore/{id}', [MenuController::class, 'restore'])->name('admin.menu.restore');
        Route::delete('destroy/{id}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');
    });

         //Topic
         Route::prefix("topic")->group(function () {
            Route::get('/', [TopicController::class, 'index'])->name('admin.topic.index');
            Route::get('trash', [TopicController::class, 'trash'])->name('admin.topic.trash');
            Route::get('trash-post-by-topic-on-show/{id}', [TopicController::class, 'trashPostByTopicOnShow'])->name('admin.topic.trash-post-by-topic-on-show');
            Route::get('show/{id}', [TopicController::class, 'show'])->name('admin.topic.show');
            Route::post('store', [TopicController::class, 'store'])->name('admin.topic.store');
            Route::get('edit/{id}', [TopicController::class, 'edit'])->name('admin.topic.edit');
            Route::put('update/{id}', [TopicController::class, 'update'])->name('admin.topic.update');
            Route::get('delete/{id}', [TopicController::class, 'delete'])->name('admin.topic.delete');
            Route::get('delete-post-by-topic-on-show/{id}', [TopicController::class, 'deletePostByTopicOnShow'])->name('admin.topic.delete-post-by-topic-on-show');
            Route::get('restore/{id}', [TopicController::class, 'restore'])->name('admin.topic.restore');
            Route::get('destroy/{id}', [TopicController::class, 'destroy'])->name('admin.topic.destroy');
            Route::get('count-item-trash', [TopicController::class, 'getTopicTrashItemCount'])->name('admin.topic.trash.count');
            Route::get('count-item-post-by-topic-trash/{id}', [TopicController::class, 'getPostByTopicTrashItemCount'])->name('admin.post.by.topic.trash.count');
                Route::get('status/{id}', [TopicController::class, 'status'])->name('admin.topic.status');

        });
         //Post
         Route::prefix("post")->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('admin.post.index');
            Route::get('trash', [PostController::class, 'trash'])->name('admin.post.trash');
            Route::get('show/{id}', [PostController::class, 'show'])->name('admin.post.show');
            Route::get('status/{id}', [PostController::class, 'status'])->name('admin.post.status');
            Route::post('store', [PostController::class, 'store'])->name('admin.post.store');
            Route::get('edit/{id}', [PostController::class, 'edit'])->name('admin.post.edit');
            Route::put('update/{id}', [PostController::class, 'update'])->name('admin.post.update');
            Route::get('delete/{id}', [PostController::class, 'delete'])->name('admin.post.delete');
            Route::get('restore/{id}', [PostController::class, 'restore'])->name('admin.post.restore');
            Route::get('destroy/{id}', [PostController::class, 'destroy'])->name('admin.post.destroy');
            Route::get('count-item-trash', [PostController::class, 'getPostTrashItemCount'])->name('admin.post.trash.count');
            });
       //User
        Route::prefix("user")->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
            Route::get('trash', [UserController::class, 'trash'])->name('admin.user.trash');
            Route::get('show/{id}', [UserController::class, 'show'])->name('admin.user.show');
            Route::post('store', [UserController::class, 'store'])->name('admin.user.store');
            Route::get('edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
            Route::put('update/{id}', [UserController::class, 'update'])->name('admin.user.update');
            Route::get('delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
            Route::get('restore/{id}', [UserController::class, 'restore'])->name('admin.user.restore');
            Route::get('destroy/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
        });
       //Contact
       Route::prefix("contact")->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('admin.contact.index');
        Route::get('trash', [ContactController::class, 'trash'])->name('admin.contact.trash');
        Route::get('show/{id}', [ContactController::class, 'show'])->name('admin.contact.show');
        Route::post('store', [ContactController::class, 'store'])->name('admin.contact.store');
        Route::get('edit/{id}', [ContactController::class, 'edit'])->name('admin.contact.edit');
        Route::put('update/{id}', [ContactController::class, 'update'])->name('admin.contact.update');
        Route::get('delete/{id}', [ContactController::class, 'delete'])->name('admin.contact.delete');
        Route::get('restore/{id}', [ContactController::class, 'restore'])->name('admin.contact.restore');
        Route::get('destroy/{id}', [ContactController::class, 'destroy'])->name('admin.contact.destroy');
    });
       //Order
       Route::prefix("order")->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.order.index');
        Route::get('trash', [OrderController::class, 'trash'])->name('admin.order.trash');
        Route::get('show/{id}', [OrderController::class, 'show'])->name('admin.order.show');
        Route::post('store', [OrderController::class, 'store'])->name('admin.order.store');
        Route::get('edit/{id}', [OrderController::class, 'edit'])->name('admin.order.edit');
        Route::put('update/{id}', [OrderController::class, 'update'])->name('admin.order.update');
        Route::get('delete/{id}', [OrderController::class, 'delete'])->name('admin.order.delete');
        Route::get('restore/{id}', [OrderController::class, 'restore'])->name('admin.order.restore');
        Route::get('destroy/{id}', [OrderController::class, 'destroy'])->name('admin.order.destroy');
    });
     //Orderdetail
     Route::prefix("order_detail")->group(function () {
        Route::get('/', [OrderdetailController::class, 'index'])->name('admin.order_detail.index');
        
        Route::get('trash', [OrderdetailController::class, 'trash'])->name('admin.order_detail.trash');
        Route::get('show/{id}', [OrderdetailController::class, 'show'])->name('admin.order_detail.show');
        Route::get('create', [OrderdetailController::class, 'create'])->name('admin.order_detail.create');
        Route::post('store', [OrderdetailController::class, 'store'])->name('admin.order_detail.store');
        Route::get('edit/{id}', [OrderdetailController::class, 'edit'])->name('admin.order_detail.edit');
        Route::put('update/{id}', [OrderdetailController::class, 'update'])->name('admin.order_detail.update');
        Route::get('delete/{id}', [OrderdetailController::class, 'delete'])->name('admin.order_detail.delete');
        Route::get('restore/{id}', [OrderdetailController::class, 'restore'])->name('admin.order_detail.restore');
        Route::get('destroy/{id}', [OrderdetailController::class, 'destroy'])->name('admin.order_detail.destroy');
    });


});
