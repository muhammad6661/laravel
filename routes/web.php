<?php
//====== Admin Controller =====//

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\Usefull_linkController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\MinistryController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\PhotoGalleryController;
use App\Http\Controllers\Admin\ShareholderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideoGalleryController;
//====== End Admin Controler


use Illuminate\Support\Facades\Route;


//====== Front Controller =====//
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\LocalizationContorller;
use App\Models\Category;
use App\Models\Organization;
use App\Models\Shareholder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//=====================================================================================
//                            Front Routes                                           \\
//=======================================================================================
  Route::get('/local/{lang}',[LocalizationContorller::class,'index']);
  Route::group(['middleware'=>'setLocale'],function(){
  Route::get('/',[IndexController::class,'index']);
  Route::get('/contact',[IndexController::class,'contact']);
  Route::get('/normativnye-dokumenty/{slug}',[IndexController::class,'section']);
  Route::get('/faqs',[IndexController::class,'faq']);
  Route::get('/what-is-eiti',[IndexController::class,'eiti']);
  Route::get('/eiti-standard',[IndexController::class,'eiti_standard']);
  Route::get('/otchyetii-ipdo-tadzheekeestana', [IndexController::class,'reports']);
  Route::get('/recommendation',[IndexController::class,'recommendation']);
  Route::get('/appeal',[IndexController::class,'appeal']);
  Route::get('/beneficiarnye-sobstvenniki',[IndexController::class,'beneficial']);
  Route::get('/videogallery',[IndexController::class,'videogallery']);
  Route::get('/photo',[IndexController::class,'photo']);
  Route::get('/photogalleries/{slug}',[IndexController::class,'photogalleries']);
  Route::get('/category/{slug}',[IndexController::class,'category']);
  Route::get('/category/{slug}/{id}',[IndexController::class,'organization']);
  Route::get('/category1/{slug_cat}/{slug_text}',[IndexController::class,'search']);
  Route::get('/category1/{slug_cat}',[IndexController::class,'search']);
  Route::get('/category/filter/letter/{slug}',[IndexController::class,'filter_letter']);
  Route::get('/category/filter/paginate/{paginate}',[IndexController::class,'filter_paginate']);
  Route::get('/live-search/{slug}/{search}',[IndexController::class,'live_search']);
  Route::get('/change/type-search/{type}',[IndexController::class,'type_change']);
  Route::get('/view_shareholder/{id}',[IndexController::class,'view_shareholder']);
  Route::get('/card', function() { return view('front.card'); });

  //Send message to Email
  Route::post('/sendToEmail', [IndexController::class, 'sendToEmail']);
  });

//=====================================================================================
//                            End Front Routers                                           \\
//=======================================================================================




// Auth::routes();

//=====================================================================================
//                            Authenticate Admin to dashboard                          \\
//=======================================================================================
Route::get('/admin',[AuthController::class,'index']);
Route::post('/login-check',[AuthController::class,'login_check']);
Route::get('/logout',[AuthController::class,'logout']);
Route::group(['middleware'=>'dashboard'],function(){

//Log routes
Route::get('/admin/log',[LogController::class, 'index']);
Route::post('/admin/logs/destroy',[LogController::class,'logs_destroy']);
Route::get('/admin/filter/date_from/{date}',[LogController::class,'filte_date_from']);
Route::get('/admin/filter/date_to/{date}',[LogController::class,'filte_date_to']);
Route::get('/admin/log/{id}/destroy',[LogController::class,'destroy']);

// Route::get('/admin/regex',[ShareholderController::class,'regex']);
// Route::post('/admin/regex/fio/{id}',[ShareholderController::class,'fio_regex']);

//User routes
Route::get('/admin/user',[UserController::class, 'index']);
Route::get('/admin/user/create',[UserController::class, 'create']);
Route::post('/admin/user/store',[UserController::class,'store']);
Route::post('/admin/user/update/{id}',[UserController::class,'update']);
Route::get('/admin/user/{id}/delete',[UserController::class,'delete']);
Route::get('/admin/user/edit/{id}', [UserController::class, 'edit']);
Route::get('/admin/profile',[UserController::class, 'profile']);
// Route::post('/admin/user/update-profile/{id}',[UserController::class,'update']);

//==================================== Group route for Admin dashboard===================\\
  //Category
   Route::get('/admin/category',[CategoryController::class,'index']);
   Route::post('/admin/category/store',[CategoryController::class,'store']);
   Route::get('/admin/category/edit/{id}',[CategoryController::class,'edit']);
   Route::post('/admin/category/update/{id}',[CategoryController::class,'update']);
   Route::get('/admin/category/{id}/active',[CategoryController::class,'active']);
   Route::get('/admin/category/{id}/destroy',[CategoryController::class,'destroy']);
   //Organization
   Route::get('/admin/organizations',[OrganizationController::class,'index']);
   Route::get('/admin/organization/filter/category/{id}',[OrganizationController::class,'filter_category']);
   Route::get('/admin/organization/create',[OrganizationController::class,'create']);
   Route::post('/organization/call/addForm/sharholder',[OrganizationController::class,'addForm_shareholder']);
   Route::post('/organization/call/editForm/sharholder',[OrganizationController::class,'ediForm_shareholder']);
   Route::post('/validator/shareholder',[OrganizationController::class,'valide_shareholder']);
   Route::post('/admin/organization/store',[OrganizationController::class,'store']);
   Route::get('/admin/organization/edit/{id}',[OrganizationController::class,'edit']);
   Route::post('/admin/organization/update/{id}',[OrganizationController::class,'update']);
   Route::get('/admin/organization/{id}/active',[OrganizationController::class,'active']);
   Route::get('/admin/organization/{id}/destroy',[OrganizationController::class,'destroy']);
   Route::post('/admin/organization/{id}/store/shareholder',[OrganizationController::class,'store_shareholder']);
   Route::post('/admin/shareholder/{id}/update',[OrganizationController::class,'shaeholder_update']);
   Route::get('/admin/shareholder/{id}/destroy',[OrganizationController::class,'shareholder_destroy']);

        //Shareholder
        // /admin/shareholder/update/
   //ShareHolders
   Route::get('/admin/organization/{id}/shareholders',[ShareholderController::class,'index']);
   Route::get('/admin/organization/{id}/shareholder/create',[ShareholderController::class,'create']);
   Route::post('/admin/organization/{id}/shareholder/store',[ShareholderController::class,'store']);
   Route::get('/admin/shareholder/edit/{id}',[ShareholderController::class,'edit']);
   Route::get('/admin/shareholder/{id}/active',[ShareholderController::class,'active']);

  Route::get('/admin/shareholder/filter/category/{id}',[ShareholderController::class,'filter_category']);
  Route::get('/admin/shareholder/filter/ministry/{id}',[ShareholderController::class,'filter_ministry']);

     //Ministry
   Route::get('/admin/ministry',[MinistryController::class,'index']);
   Route::post('/admin/ministry/store',[MinistryController::class,'store']);
   Route::get('/admin/ministry/edit/{id}',[MinistryController::class,'edit']);
   Route::post('/admin/ministry/update/{id}',[MinistryController::class,'update']);
   Route::get('/admin/ministry/{id}/active',[MinistryController::class,'active']);
   Route::get('/admin/ministry/{id}/destroy',[MinistryController::class,'destroy']);
     // Settings
    Route::get('/admin/setting', [SettingController::class, 'setting']);
    Route::post('/admin/setting/update', [SettingController::class, 'update']);
    //PhotoGallery
    Route::get('/admin/photogalleries',[PhotoGalleryController::class,'index']);
    Route::get('/admin/photogallery/create',[PhotoGalleryController::class,'create']);
    Route::post('/admin/gallery/upload/toTemp',[PhotoGalleryController::class,'uploadGaleryToTemp']);
    Route::post('/admin/gallery/unlink/fromTemp',[PhotoGalleryController::class,'unlinkGaleryFromTemp']);
    Route::post('/admin/photogallery/store',[PhotoGalleryController::class,'store']);
    Route::get('/admin/photogallery/{id}/edit',[PhotoGalleryController::class,'edit']);
    Route::get('/admin/gallery/{id}',[PhotoGalleryController::class,'delete_gallery']);
    Route::post('/admin/upload/gallery/toPhoto/{id}',[PhotoGalleryController::class,'uploadsGallery']);
    Route::post('/admin/photogallery/{id}/update',[PhotoGalleryController::class,'update']);
    Route::get('/admin/photo/{id}/destroy',[PhotoGalleryController::class,'destroy']);
    // Route::get('/admin/photogalleries',[PhotoGalleryController::class,'index']);
     //Videogalley routes
     Route::get('/admin/videogalleries',[VideoGalleryController::class, 'index']);
     Route::get('/admin/videogallery/edit-videogallery/{id}',[VideoGalleryController::class, 'edit']);
     Route::get('/admin/videogalley/create-videogallery',[VideoGalleryController::class, 'create']);
     Route::post('/admin/videogallery/store',[VideoGalleryController::class, 'store']);
     Route::get('/admin/video/{id}/active',[VideoGalleryController::class,'active']);
     Route::post('/admin/videogallery/update/{id}',[VideoGalleryController::class,'update']);
     Route::get('/admin/videogallery/delete/{id}',[VideoGalleryController::class,'delete']);
    //Usefull_Links
    Route::get('/admin/usefull_links', [Usefull_linkController::class, 'index']);
    Route::get('/admin/usefull_links/edit-link/{id}', [Usefull_linkController::class, 'edit']);
    Route::get('/admin/usefull_links/create-link',[Usefull_linkController::class,'create_link']);
    Route::post('/admin/usefull_links/store',[Usefull_linkController::class,'store_link']);
    Route::get('/admin/usefull_links/delete-link/{id}',[Usefull_linkController::class,'delete_link']);
    Route::post('/admin/usefull_links/update-link/{id}',[Usefull_linkController::class,'update_link']);
    Route::get('/admin/link/{id}/active',[Usefull_linkController::class,'active']);
    //Pages route
    Route::get('/admin/pages',[PageController::class,'index']);
    Route::get('/admin/page/{slug}',[PageController::class,'index_page']);
    Route::get('/admin/page/edit/{slug}',[PageController::class,'edit_page']);
    Route::post('/admin/page/{slug}/update',[PageController::class,'update']);
    //page Faqs
    Route::get('/admin/page/{slug}/faqs',[PageController::class,'faqs']);
    Route::get('/admin/page/voprosy-i-otvety/create-faq',[PageController::class,'create_faq']);
    Route::post('/admin/page/voprosy-i-otvety/faq/store',[PageController::class,'store_faq']);
    Route::get('/admin/page/voprosy-i-otvety/edit-faq/{id}',[PageController::class,'edit_faq']);
    Route::get('/admin/page/voprosy-i-otvety/update-faq/{id}',[PageController::class,'update_faq']);
    Route::get('/admin/page/voprosy-i-otvety/delete-faq/{id}',[PageController::class,'delete_faq']);
    Route::get('/admin/faq/{id}/active',[PageController::class,'active_faq']);
     //page Regulations
     Route::get('/admin/page/{slug}/sections',[PageController::class,'sections']);
     Route::get('/admin/page/normativnye-dokumenty/create-section',[PageController::class,'create_section']);
     Route::post('/admin/page/normativnye-dokumenty/section/store',[PageController::class,'store_section']);
     Route::get('/admin/page/normativnye-dokumenty/edit-section/{slug}',[PageController::class,'edit_section']);
     Route::post('/admin/page/normativnye-dokumenty/update-section/{id}',[PageController::class,'update_section']);
     Route::get('/admin/page/normativnye-dokumenty/delete-section/{id}',[PageController::class,'delete_section']);
    Route::get('/admin/section/{id}/active',[PageController::class,'active_section']);
    //documents
    Route::get('/admin/page/normativnye-dokumenty/section/{slug}',[PageController::class,'documents']);
    Route::get('/admin/page/normativnye-dokumenty/section/{slug}/create-document',[PageController::class,'creat_document']);
    Route::post('/admin/page/normativnye-dokumenty/section/{id}/store-document',[PageController::class,'store_document']);
    Route::get('/admin/page/normativnye-dokumenty/section/{sec_id}/edit-document/{doc_id}',[PageController::class,'edit_document']);
    Route::post('/admin/page/normativnye-dokumenty/section/{sec_id}/update-document/{doc_id}',[PageController::class,'update_document']);
    Route::get('/admin/document/{id}/active',[PageController::class,'active_document']);
    Route::get('/admin/page/normativnye-dokumenty/section/delete-document/{id}',[PageController::class,'delete_document']);
    //Reports documents
    Route::get('/admin/page/otchyetii-ipdo-tadzheekeestana/documents',[PageController::class,'report_documents']);
    Route::get('/admin/page/otchyetii-ipdo-tadzheekeestana/create-document',[PageController::class,'report_create_document']);
    Route::post('/admin/page/otchyetii-ipdo-tadzheekeestana/store-document',[PageController::class,'report_store_document']);
    Route::get('/admin/page/otchyetii-ipdo-tadzheekeestana/edit-document/{id}',[PageController::class,'report_edit_document']);
    Route::post('/admin/page/otchyetii-ipdo-tadzheekeestana/update/{id}',[PageController::class,'report_update_document']);
    Route::get('/admin/report/{id}/active',[PageController::class,'report_active_document']);
    Route::get('/admin/page/otchyetii-ipdo-tadzheekeestana/delete-document/{id}',[PageController::class,'report_delete_document']);


});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
