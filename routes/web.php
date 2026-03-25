<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Services\FourSMS;
use Illuminate\Http\Request;
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

Route::get('/send-sms', function (FourSMS $fourSMS) {
    $response = $fourSMS->sendSMS('9876543210', 'Hello, this is a test message');
    return $response;
});

Route::get('test', 'App\Http\Controllers\AjaxController@passtest');


Route::get('lang/home', 'App\Http\Controllers\LangController@index');
Route::get('lang/change', 'App\Http\Controllers\LangController@change')->name('changeLang');



Route::get('/', 'App\Http\Controllers\Home@index')->name('dashboard');

Route::get('mainmenu', function () {
    return view('includes/menu-main');
});

Route::get('menu-colors', function () {
    return view('includes/menu-colors');
});

// Route::get('menufooter', 'App\Http\Controllers\Home@footer')->name('footer');
Route::get('menufooter', function () {
    return view('includes/menu-footer');
})->name('footer');



//Clear all caches
 Route::get('/cache/1', function() {
     \Artisan::call('route:cache');
     return 'Routes cache cleared';
 });
  Route::get('/cache/2', function() {
     \Artisan::call('config:cache');
     return 'Config cache cleared';
 });
  Route::get('/cache/3', function() {
     \Artisan::call('cache:clear');
     return 'Application cache cleared';
 });
  Route::get('/cache/4', function() {
     \Artisan::call('view:clear');
     return 'View cache cleared';
 });
 Route::get('/cache/5', function() {
     \Artisan::call('optimize:clear');
     return 'optimizer  cache cleared';
 });



//version routes
Route::get('versions', 'App\Http\Controllers\Admin\VersionController@home')->name('versions.home');

//testing
Route::any('developer', 'App\Http\Controllers\Home@otptest')->name('developer');
Route::get('otpregister', 'App\Http\Controllers\Home@form')->name('otp.register');
Route::any('otp', 'App\Http\Controllers\OtpController@form')->name('otp.form');
// Route::any('otp/store', 'App\Http\Controllers\OtpController@generate')->name('otp.store');
// Route::any('otp/store', 'App\Http\Controllers\otpC@generate')->name('otp.store');
Route::any('otp/verify/{id}', 'App\Http\Controllers\otpC@verify')->name('otp.verify');
Route::any('otp/verifycode', 'App\Http\Controllers\otpC@verifyOtp')->name('otp.verifycode');



Route::get('home', 'App\Http\Controllers\Home@index')->name('home');
Route::get('register/{id}', 'App\Http\Controllers\Home@register')->name('register');
Route::post('registerstore', 'App\Http\Controllers\Home@registerstore')->name('register.api');
Route::any('termsandconditions', 'App\Http\Controllers\Home@terms')->name('terms.conditions');

Route::get('listroles', 'App\Http\Controllers\AjaxController@listroles')->name('roles.list');
Route::get('listmodules', 'App\Http\Controllers\AjaxController@listmodules')->name('modules.list');
Route::post('listsubmodules', 'App\Http\Controllers\AjaxController@listsubmodules')->name('submodules.list');

Route::get('listregistercategory', 'App\Http\Controllers\AjaxController@listregistercategory')->name('registercategory.list');
Route::post('listregistersubcategory', 'App\Http\Controllers\AjaxController@listregistersubcategory')->name('registersubcategory.list');
Route::get('listregisterchapter', 'App\Http\Controllers\AjaxController@listregisterchapter')->name('registerchapter.list');
Route::get('listregisterstate', 'App\Http\Controllers\AjaxController@listregisterstate')->name('registerstate.list');
Route::post('listregistercountry', 'App\Http\Controllers\AjaxController@listregistercountry')->name('registercountry.list');
Route::get('listregisterdesignation', 'App\Http\Controllers\AjaxController@listregisterdesignation')->name('registerdesignation.list');
Route::get('listregisternature', 'App\Http\Controllers\AjaxController@listregisternature')->name('registernature.list');


Route::get('listopttype', 'App\Http\Controllers\AjaxController@listopttype')->name('listopttype.list');
Route::get('listoptto', 'App\Http\Controllers\AjaxController@listoptto')->name('listoptto.list');
Route::get('listoptreferal', 'App\Http\Controllers\AjaxController@listoptreferal')->name('listoptreferal.list');
Route::get('listoptreftype', 'App\Http\Controllers\AjaxController@listoptreftype')->name('listoptreftype.list');
Route::any('chapmemberlist', 'App\Http\Controllers\AjaxController@chapmemberlist')->name('chapmember.list');
Route::any('chapmemberdetlist', 'App\Http\Controllers\AjaxController@chapmemberdetlist')->name('chapmemberdet.list');
Route::any('subcategorymemlist', 'App\Http\Controllers\AjaxController@subcategorymemlist')->name('subcategorymem.list');
Route::any('memberonlylist', 'App\Http\Controllers\AjaxController@memberonlylist')->name('memberonly.list');
Route::any('membercategorylist', 'App\Http\Controllers\AjaxController@membercategorylist')->name('membercategory.list');

Route::any('oppocategorylist', 'App\Http\Controllers\AjaxController@oppocategorylist')->name('oppocategory.list');

Route::get('listallareas', 'App\Http\Controllers\AjaxController@listallareas')->name('area.list');
Route::post('listalltaluk', 'App\Http\Controllers\AjaxController@listalltaluk')->name('taluk.list');
Route::post('listalldistrict', 'App\Http\Controllers\AjaxController@listalldistrict')->name('district.list');
Route::post('listallcity', 'App\Http\Controllers\AjaxController@listallcity')->name('city.list');

Route::post('listmembersearch', 'App\Http\Controllers\AjaxController@listmembersearch')->name('members.search');
Route::post('listcatmembers', 'App\Http\Controllers\AjaxController@listcatmembers')->name('catmembers.list');
Route::post('listchaptmembers', 'App\Http\Controllers\AjaxController@listchaptmembers')->name('chaptmembers.list');
Route::post('listchaptercate', 'App\Http\Controllers\AjaxController@chaptercate')->name('chaptercate.list');

Route::get('listintrarea', 'App\Http\Controllers\AjaxController@listintrarea')->name('intrarea.list');



Route::get('listregisterresp', 'App\Http\Controllers\AjaxController@listregisterresp')->name('registerresp.list');
Route::post('listregisterrespsub', 'App\Http\Controllers\AjaxController@listregisterrespsub')->name('registerrespsub.list');

Route::get('checkstatus', 'App\Http\Controllers\Home@checkstatus')->name('checkstatus');
Route::post('verifymobile', 'App\Http\Controllers\Home@verifymobile')->name('verifymobile');







Route::post('listareasearch', 'App\Http\Controllers\AjaxController@listareasearch')->name('area.search');

Route::get('report/vibhag', 'App\Http\Controllers\Report@vibhag')->name('vibhag.dashboard');



Route::get('login', 'App\Http\Controllers\Home@loginind')->name('login');
Route::post('loginindex', 'App\Http\Controllers\Home@login')->name('login.api');

Route::any('login/dashboard', 'App\Http\Controllers\Home@logindashboard')->name('login.dashboard');
Route::any('login/events', 'App\Http\Controllers\Home@loginevents')->name('login.events');
Route::any('login/events/detail/{id}', 'App\Http\Controllers\Home@logineventsdetails')->name('login.events.detail');
Route::any('login/meetings', 'App\Http\Controllers\Home@loginmeetings')->name('login.meetings');
Route::any('login/meetings/detail/{id}', 'App\Http\Controllers\Home@loginmeetingsdetails')->name('login.meetings.detail');
Route::any('login/news', 'App\Http\Controllers\Home@loginnews')->name('login.news');
Route::any('login/news/detail/{id}', 'App\Http\Controllers\Home@loginnewsdetail')->name('login.news.detail');
Route::any('login/calender', 'App\Http\Controllers\Home@logincalender')->name('login.calender');
Route::any('login/calender/details/{id}', 'App\Http\Controllers\Home@logincalenderdetails')->name('login.calender.detail');
Route::any('login/profile', 'App\Http\Controllers\Home@loginprofile')->name('login.profile');
Route::any('login/gallery', 'App\Http\Controllers\Home@logingallery')->name('login.gallery');
Route::any('login/support', 'App\Http\Controllers\Home@loginsupport')->name('login.support');
Route::get('login/membersdirectory', 'App\Http\Controllers\Home@listmembers')->name('login.members.list');
Route::get('login/memberdetails/{id}', 'App\Http\Controllers\Home@memberdetails')->name('login.member.details');
Route::any('login/opportunity/add', 'App\Http\Controllers\Home@opportunityadd')->name('login.opportunity.add');
Route::any('login/opportunity/store', 'App\Http\Controllers\Home@opportunitystore')->name('login.opportunity.store');
Route::any('login/opportunity/list', 'App\Http\Controllers\Home@opportunitylist')->name('login.opportunity.list');
Route::get('login/opportunity/{id}', 'App\Http\Controllers\Home@opportunitydetails')->name('login.opportunity.details');
Route::any('login/allmedia', 'App\Http\Controllers\Home@allmedia')->name('login.media.list');
Route::any('login/allmedia/add', 'App\Http\Controllers\Home@addmedia')->name('login.media.add');
Route::any('login/allmedia/store', 'App\Http\Controllers\Home@addmediastore')->name('login.media.store');
Route::get('login/allmedia/posts/{id}', 'App\Http\Controllers\Home@allmediaposts')->name('login.media.posts');




    // Route::get('news/edit/{id}','App\Http\Controllers\Admin\AdminController@editnews')->name('admin.news.edit');
    // Route::put('news/update/{id}','App\Http\Controllers\Admin\AdminController@updatenews')->name('admin.news.update');
    
Route::any('login/enquiry/add/{id}', 'App\Http\Controllers\Home@enquiryadd')->name('login.enquiry.add');
Route::put('enquiry/store/{id}', 'App\Http\Controllers\Home@enquirystore')->name('login.enquiry.store');



Route::get('forgotpassword', 'App\Http\Controllers\Home@forgotpassword')->name('forgot-password');
Route::any('forgot/store', 'App\Http\Controllers\Home@forgotstore')->name('forgot.store');
// Route::post('forgotpasswordstore', 'App\Http\Controllers\Home@forgotpasswordstore')->name('forgot-password.api');
Route::any('forgotpassword/verify/{id}', 'App\Http\Controllers\Home@forgotverify')->name('otp.forgotverify');
Route::any('forgotpassword/verifycode', 'App\Http\Controllers\Home@forgotverifyOtp')->name('otp.forgotverifycode');
Route::post('confirmpasswordstore', 'App\Http\Controllers\Home@confirmpasswordstore')->name('confirm-password');

Route::get('newtickets', 'App\Http\Controllers\Home@newtickets')->name('newtickets');
Route::get('mytickets', 'App\Http\Controllers\Home@mytickets')->name('mytickets');
Route::post('newticketsstore', 'App\Http\Controllers\Home@newticketsstore')->name('newtickets.api');

Route::get('transformations', 'App\Http\Controllers\Home@transformations')->name('transformations');
Route::get('logout', 'App\Http\Controllers\Home@logout')->name('logout');

Route::any('category', 'App\Http\Controllers\Home@category')->name('category');

// Route::get('subcategory', 'App\Http\Controllers\Home@subcategory')->name('subcategory');

Route::get('subcategory', 'App\Http\Controllers\Home@subcategory')->name('subcategory');

Route::post('subcategoryajax', 'App\Http\Controllers\AjaxController@category')->name('subcategoryAjax');

Route::get('maintanence', 'App\Http\Controllers\Home@maintanence')->name('maintanence');
Route::get('joinus', 'App\Http\Controllers\Home@joinus')->name('join_us');
Route::get('media', 'App\Http\Controllers\Home@media')->name('media');
Route::get('transformation', 'App\Http\Controllers\Home@transformation')->name('transformation');


//Admin routes

Route::get('admin/login','App\Http\Controllers\Admin\Auth\AdminAuthController@getLogin')->name('adminLogin');
Route::post('admin/login', 'App\Http\Controllers\Admin\Auth\AdminAuthController@postLogin')->name('adminLoginPost');
Route::get('admin/logout', 'App\Http\Controllers\Admin\Auth\AdminAuthController@logout')->name('adminLogout');


Route::group(['middleware' => 'adminsession'], function () {
    
Route::group(['prefix' => 'admin'], function () {

    Route::get('edit_profile/{id}','App\Http\Controllers\Admin\AdminController@edit_profile')->name('adminprofile.edit');
    Route::put('edit_profile/update/{id}','App\Http\Controllers\Admin\AdminController@update_profile')->name('adminprofile.update');

    Route::get('dashboard','App\Http\Controllers\Admin\AdminController@dashboard')->name('admindashboard'); 
    
    Route::get('dashboard/vibhaglist','App\Http\Controllers\Admin\AdminController@vibhaglist')->name('vibhag.list'); 

    Route::get('news','App\Http\Controllers\Admin\AdminController@managenews')->name('adminnews');
    Route::get('news/add','App\Http\Controllers\Admin\AdminController@addnews')->name('adminnews.add');
    Route::post('news/store','App\Http\Controllers\Admin\AdminController@news')->name('admin.news.store');
    Route::get('news/edit/{id}','App\Http\Controllers\Admin\AdminController@editnews')->name('admin.news.edit');
    Route::put('news/update/{id}','App\Http\Controllers\Admin\AdminController@updatenews')->name('admin.news.update');
    Route::get('news/delete/{id}','App\Http\Controllers\Admin\AdminController@deletenews')->name('admin.news.delete');
    Route::get('news/view/{id}','App\Http\Controllers\Admin\AdminController@viewnews')->name('admin.news.view');

    Route::get('banner','App\Http\Controllers\Admin\BannerController@managebanner')->name('adminbanner');
    Route::get('banner/add','App\Http\Controllers\Admin\BannerController@addbanner')->name('adminbanner.add');
    Route::post('banner/store','App\Http\Controllers\Admin\BannerController@banner')->name('admin.banner.store');
    Route::get('banner/edit/{id}','App\Http\Controllers\Admin\BannerController@editbanner')->name('admin.banner.edit');
    Route::put('banner/update/{id}','App\Http\Controllers\Admin\BannerController@updatebanner')->name('admin.banner.update');
    Route::get('banner/delete/{id}','App\Http\Controllers\Admin\BannerController@deletebanner')->name('admin.banner.delete');
    Route::get('banner/view/{id}','App\Http\Controllers\Admin\BannerController@viewbanner')->name('admin.banner.view');

    Route::get('country','App\Http\Controllers\Admin\CountryController@managecountry')->name('admincountry');
    Route::get('country/add','App\Http\Controllers\Admin\CountryController@addcountry')->name('admincountry.add');
    Route::post('country/store','App\Http\Controllers\Admin\CountryController@country')->name('admin.country.store');
    Route::get('country/edit/{id}','App\Http\Controllers\Admin\CountryController@editcountry')->name('admin.country.edit');
    Route::put('country/update/{id}','App\Http\Controllers\Admin\CountryController@updatecountry')->name('admin.country.update');
    Route::get('country/delete/{id}','App\Http\Controllers\Admin\CountryController@deletecountry')->name('admin.country.delete');
    Route::get('country/view/{id}','App\Http\Controllers\Admin\CountryController@viewcountry')->name('admin.country.view');
    
    Route::get('state','App\Http\Controllers\Admin\StateController@managestate')->name('adminstate');
    Route::get('state/add','App\Http\Controllers\Admin\StateController@addstate')->name('adminstate.add');
    Route::post('state/store','App\Http\Controllers\Admin\StateController@state')->name('admin.state.store');
    Route::get('state/edit/{id}','App\Http\Controllers\Admin\StateController@editstate')->name('admin.state.edit');
    Route::put('state/update/{id}','App\Http\Controllers\Admin\StateController@updatestate')->name('admin.state.update');
    Route::get('state/delete/{id}','App\Http\Controllers\Admin\StateController@deletestate')->name('admin.state.delete');
    Route::get('state/view/{id}','App\Http\Controllers\Admin\StateController@viewstate')->name('admin.state.view');
    
    
    Route::get('chapter','App\Http\Controllers\Admin\ChapterController@managechapter')->name('adminchapter');
    Route::get('chapter/add','App\Http\Controllers\Admin\ChapterController@addchapter')->name('adminchapter.add');
    Route::post('chapter/store','App\Http\Controllers\Admin\ChapterController@chapter')->name('admin.chapter.store');
    Route::get('chapter/edit/{id}','App\Http\Controllers\Admin\ChapterController@editchapter')->name('admin.chapter.edit');
    Route::put('chapter/update/{id}','App\Http\Controllers\Admin\ChapterController@updatechapter')->name('admin.chapter.update');
    Route::get('chapter/delete/{id}','App\Http\Controllers\Admin\ChapterController@deletechapter')->name('admin.chapter.delete');
    Route::get('chapter/view/{id}','App\Http\Controllers\Admin\ChapterController@viewchapter')->name('admin.chapter.view');
    
    Route::get('category','App\Http\Controllers\Admin\CategoryController@managecategory')->name('admincategory');
    Route::get('category/add','App\Http\Controllers\Admin\CategoryController@addcategory')->name('admincategory.add');
    Route::post('category/store','App\Http\Controllers\Admin\CategoryController@category')->name('admin.category.store');
    Route::get('category/edit/{id}','App\Http\Controllers\Admin\CategoryController@editcategory')->name('admin.category.edit');
    Route::put('category/update/{id}','App\Http\Controllers\Admin\CategoryController@updatecategory')->name('admin.category.update');
    Route::get('category/delete/{id}','App\Http\Controllers\Admin\CategoryController@deletecategory')->name('admin.category.delete');
    Route::get('category/view/{id}','App\Http\Controllers\Admin\CategoryController@viewcategory')->name('admin.category.view');
    
    Route::get('subcategory','App\Http\Controllers\Admin\SubcategoryController@managesubcategory')->name('adminsubcategory');
    Route::get('subcategory/add','App\Http\Controllers\Admin\SubcategoryController@addsubcategory')->name('adminsubcategory.add');
    Route::post('subcategory/store','App\Http\Controllers\Admin\SubcategoryController@subcategory')->name('admin.subcategory.store');
    Route::get('subcategory/edit/{id}','App\Http\Controllers\Admin\SubcategoryController@editsubcategory')->name('admin.subcategory.edit');
    Route::put('subcategory/update/{id}','App\Http\Controllers\Admin\SubcategoryController@updatesubcategory')->name('admin.subcategory.update');
    Route::get('subcategory/delete/{id}','App\Http\Controllers\Admin\SubcategoryController@deletesubcategory')->name('admin.subcategory.delete');
    Route::get('subcategory/view/{id}','App\Http\Controllers\Admin\SubcategoryController@viewsubcategory')->name('admin.subcategory.view');

    Route::get('activities','App\Http\Controllers\Admin\ActivitiesController@manageactivities')->name('adminactivities');
    Route::get('activities/add','App\Http\Controllers\Admin\ActivitiesController@addactivities')->name('adminactivities.add');
    Route::post('activities/store','App\Http\Controllers\Admin\ActivitiesController@activities')->name('admin.activities.store');
    Route::get('activities/edit/{id}','App\Http\Controllers\Admin\ActivitiesController@editactivities')->name('admin.activities.edit');
    Route::put('activities/update/{id}','App\Http\Controllers\Admin\ActivitiesController@updateactivities')->name('admin.activities.update');
    Route::get('activities/delete/{id}','App\Http\Controllers\Admin\ActivitiesController@deleteactivities')->name('admin.activities.delete');
    Route::get('activities/view/{id}','App\Http\Controllers\Admin\ActivitiesController@viewactivities')->name('admin.activities.view');

    Route::get('about','App\Http\Controllers\Admin\AboutController@manageabout')->name('adminabout');
    Route::get('about/add','App\Http\Controllers\Admin\AboutController@addabout')->name('adminabout.add');
    Route::post('about/store','App\Http\Controllers\Admin\AboutController@about')->name('admin.about.store');
    Route::get('about/edit/{id}','App\Http\Controllers\Admin\AboutController@editabout')->name('admin.about.edit');
    Route::put('about/update/{id}','App\Http\Controllers\Admin\AboutController@updateabout')->name('admin.about.update');
    Route::get('about/delete/{id}','App\Http\Controllers\Admin\AboutController@deleteabout')->name('admin.about.delete');
    Route::get('about/view/{id}','App\Http\Controllers\Admin\AboutController@viewabout')->name('admin.about.view');

    Route::get('content','App\Http\Controllers\Admin\ContentController@managecontent')->name('admincontent');
    Route::get('content/add','App\Http\Controllers\Admin\ContentController@addcontent')->name('admincontent.add');
    Route::post('content/store','App\Http\Controllers\Admin\ContentController@content')->name('admin.content.store');
    Route::get('content/edit/{id}','App\Http\Controllers\Admin\ContentController@editcontent')->name('admin.content.edit');
    Route::put('content/update/{id}','App\Http\Controllers\Admin\ContentController@updatecontent')->name('admin.content.update');
    Route::get('content/delete/{id}','App\Http\Controllers\Admin\ContentController@deletecontent')->name('admin.content.delete');
    Route::get('content/view/{id}','App\Http\Controllers\Admin\ContentController@viewcontent')->name('admin.content.view');

    Route::get('services','App\Http\Controllers\Admin\ServicesController@manageservices')->name('adminservices');
    Route::get('services/add','App\Http\Controllers\Admin\ServicesController@addservices')->name('adminservices.add');
    Route::post('services/store','App\Http\Controllers\Admin\ServicesController@services')->name('admin.services.store');
    Route::get('services/edit/{id}','App\Http\Controllers\Admin\ServicesController@editservices')->name('admin.services.edit');
    Route::put('services/update/{id}','App\Http\Controllers\Admin\ServicesController@updateservices')->name('admin.services.update');
    Route::get('services/delete/{id}','App\Http\Controllers\Admin\ServicesController@deleteservices')->name('admin.services.delete');
    Route::get('services/view/{id}','App\Http\Controllers\Admin\ServicesController@viewservices')->name('admin.services.view');
    

    Route::get('resourcelist','App\Http\Controllers\Admin\ServicesController@resourcelist')->name('resourcelist');
     Route::get('report','App\Http\Controllers\Admin\ServicesController@managereports')->name('report');
    
    
    

    Route::get('scheme','App\Http\Controllers\Admin\SchemeController@managescheme')->name('adminscheme');
    Route::get('scheme/add','App\Http\Controllers\Admin\SchemeController@addscheme')->name('adminscheme.add');
    Route::post('scheme/store','App\Http\Controllers\Admin\SchemeController@scheme')->name('admin.scheme.store');
    Route::get('scheme/edit/{id}','App\Http\Controllers\Admin\SchemeController@editscheme')->name('admin.scheme.edit');
    Route::put('scheme/update/{id}','App\Http\Controllers\Admin\SchemeController@updatescheme')->name('admin.scheme.update');
    Route::get('scheme/delete/{id}','App\Http\Controllers\Admin\SchemeController@deletescheme')->name('admin.scheme.delete');
    Route::get('scheme/view/{id}','App\Http\Controllers\Admin\SchemeController@viewscheme')->name('admin.scheme.view');

    Route::get('events','App\Http\Controllers\Admin\EventsController@manageevents')->name('adminevents');
    Route::get('events/add','App\Http\Controllers\Admin\EventsController@addevents')->name('adminevents.add');
    Route::post('events/store','App\Http\Controllers\Admin\EventsController@events')->name('admin.events.store');
    Route::get('events/edit/{id}','App\Http\Controllers\Admin\EventsController@editevents')->name('admin.events.edit');
    Route::put('events/update/{id}','App\Http\Controllers\Admin\EventsController@updateevents')->name('admin.events.update');
    Route::get('events/delete/{id}','App\Http\Controllers\Admin\EventsController@deleteevents')->name('admin.events.delete');
    Route::get('events/view/{id}','App\Http\Controllers\Admin\EventsController@viewevents')->name('admin.events.view');
    
    
     Route::get('user','App\Http\Controllers\Admin\UserController@manageuser')->name('adminuser');
    Route::get('user/add','App\Http\Controllers\Admin\UserController@adduser')->name('adminuser.add');
    Route::post('user/store','App\Http\Controllers\Admin\UserController@user')->name('admin.user.store');
    Route::get('user/edit/{id}','App\Http\Controllers\Admin\UserController@edituser')->name('admin.user.edit');
    Route::put('user/update/{id}','App\Http\Controllers\Admin\UserController@updateuser')->name('admin.user.update');
    Route::get('user/delete/{id}','App\Http\Controllers\Admin\UserController@deleteuser')->name('admin.user.delete');
    Route::get('user/view/{id}','App\Http\Controllers\Admin\UserController@viewuser')->name('admin.user.view');
    Route::get('modules/list','App\Http\Controllers\Admin\UserController@modules')->name('admin.modules.list');
    
    
    
    Route::get('designation','App\Http\Controllers\Admin\DesignationController@managedesignation')->name('admindesignation');
    Route::get('designation/add','App\Http\Controllers\Admin\DesignationController@adddesignation')->name('admindesignation.add');
    Route::post('designation/store','App\Http\Controllers\Admin\DesignationController@designation')->name('admin.designation.store');
    Route::get('designation/edit/{id}','App\Http\Controllers\Admin\DesignationController@editdesignation')->name('admin.designation.edit');
    Route::put('designation/update/{id}','App\Http\Controllers\Admin\DesignationController@updatedesignation')->name('admin.designation.update');
    Route::get('designation/delete/{id}','App\Http\Controllers\Admin\DesignationController@deletedesignation')->name('admin.designation.delete');
    Route::get('designation/view/{id}','App\Http\Controllers\Admin\DesignationController@viewdesignation')->name('admin.designation.view');
    
    
    
    
     Route::get('nature','App\Http\Controllers\Admin\NatureController@managenature')->name('adminnature');
    Route::get('nature/add','App\Http\Controllers\Admin\NatureController@addnature')->name('adminnature.add');
    Route::post('nature/store','App\Http\Controllers\Admin\NatureController@nature')->name('admin.nature.store');
    Route::get('nature/edit/{id}','App\Http\Controllers\Admin\NatureController@editnature')->name('admin.nature.edit');
    Route::put('nature/update/{id}','App\Http\Controllers\Admin\NatureController@updatenature')->name('admin.nature.update');
    Route::get('nature/delete/{id}','App\Http\Controllers\Admin\NatureController@deletenature')->name('admin.nature.delete');
    Route::get('nature/view/{id}','App\Http\Controllers\Admin\NatureController@viewnature')->name('admin.nature.view');
    
    
    
    Route::get('opportunitytype','App\Http\Controllers\Admin\OpportunityController@manageopportunitytype')->name('adminopportunitytype');
    Route::get('opportunitytype/add','App\Http\Controllers\Admin\OpportunityController@addopportunitytype')->name('adminopportunitytype.add');
    Route::post('opportunitytype/store','App\Http\Controllers\Admin\OpportunityController@opportunitytype')->name('admin.opportunitytype.store');
    Route::get('opportunitytype/edit/{id}','App\Http\Controllers\Admin\OpportunityController@editopportunitytype')->name('admin.opportunitytype.edit');
    Route::put('opportunitytype/update/{id}','App\Http\Controllers\Admin\OpportunityController@updateopportunitytype')->name('admin.opportunitytype.update');
    Route::get('opportunitytype/delete/{id}','App\Http\Controllers\Admin\OpportunityController@deleteopportunitytype')->name('admin.opportunitytype.delete');
    Route::get('opportunitytype/view/{id}','App\Http\Controllers\Admin\OpportunityController@viewopportunitytype')->name('admin.opportunitytype.view');
    
    
    Route::get('opportunityconnect','App\Http\Controllers\Admin\OpportunityController@manageopportunityconnect')->name('adminopportunityconnect');
    Route::get('opportunityconnect/add','App\Http\Controllers\Admin\OpportunityController@addopportunityconnect')->name('adminopportunityconnect.add');
    Route::post('opportunityconnect/store','App\Http\Controllers\Admin\OpportunityController@opportunityconnect')->name('admin.opportunityconnect.store');
    Route::get('opportunityconnect/edit/{id}','App\Http\Controllers\Admin\OpportunityController@editopportunityconnect')->name('admin.opportunityconnect.edit');
    Route::put('opportunityconnect/update/{id}','App\Http\Controllers\Admin\OpportunityController@updateopportunityconnect')->name('admin.opportunityconnect.update');
    Route::get('opportunityconnect/delete/{id}','App\Http\Controllers\Admin\OpportunityController@deleteopportunityconnect')->name('admin.opportunityconnect.delete');
    Route::get('opportunityconnect/view/{id}','App\Http\Controllers\Admin\OpportunityController@viewopportunityconnect')->name('admin.opportunityconnect.view');
    
    
    
    Route::get('referencetype','App\Http\Controllers\Admin\ReferencetypeController@managereferencetype')->name('adminreferencetype');
    Route::get('referencetype/add','App\Http\Controllers\Admin\ReferencetypeController@addreferencetype')->name('adminreferencetype.add');
    Route::post('referencetype/store','App\Http\Controllers\Admin\ReferencetypeController@referencetype')->name('admin.referencetype.store');
    Route::get('referencetype/edit/{id}','App\Http\Controllers\Admin\ReferencetypeController@editreferencetype')->name('admin.referencetype.edit');
    Route::put('referencetype/update/{id}','App\Http\Controllers\Admin\ReferencetypeController@updatereferencetype')->name('admin.referencetype.update');
    Route::get('referencetype/delete/{id}','App\Http\Controllers\Admin\ReferencetypeController@deletereferencetype')->name('admin.referencetype.delete');
    Route::get('referencetype/view/{id}','App\Http\Controllers\Admin\ReferencetypeController@viewreferencetype')->name('admin.referencetype.view');
    
    
    
    Route::get('referalstatus','App\Http\Controllers\Admin\ReferalstatusController@managereferalstatus')->name('adminreferalstatus');
    Route::get('referalstatus/add','App\Http\Controllers\Admin\ReferalstatusController@addreferalstatus')->name('adminreferalstatus.add');
    Route::post('referalstatus/store','App\Http\Controllers\Admin\ReferalstatusController@referalstatus')->name('admin.referalstatus.store');
    Route::get('referalstatus/edit/{id}','App\Http\Controllers\Admin\ReferalstatusController@editreferalstatus')->name('admin.referalstatus.edit');
    Route::put('referalstatus/update/{id}','App\Http\Controllers\Admin\ReferalstatusController@updatereferalstatus')->name('admin.referalstatus.update');
    Route::get('referalstatus/delete/{id}','App\Http\Controllers\Admin\ReferalstatusController@deletereferalstatus')->name('admin.referalstatus.delete');
    Route::get('referalstatus/view/{id}','App\Http\Controllers\Admin\ReferalstatusController@viewreferalstatus')->name('admin.referalstatus.view');
    
    
    Route::get('approvals/members/download','App\Http\Controllers\Admin\ApprovalsController@adminmembersalldownload')->name('admin.members.alldownload');
    
    
    
    Route::get('approvals/member/download/{id}','App\Http\Controllers\Admin\ApprovalsController@downloadmembers')->name('adminmember.download');
    Route::get('approvals/member/view/{id}','App\Http\Controllers\Admin\ApprovalsController@viewmembers')->name('adminmember.view');
    Route::get('approvals/member/edit/{id}','App\Http\Controllers\Admin\ApprovalsController@editmembers')->name('adminmember.edit');
    Route::put('approvals/member/update/{id}','App\Http\Controllers\Admin\ApprovalsController@updatemembers')->name('adminmember.update');
    Route::get('approvals/member/delete/{id}','App\Http\Controllers\Admin\ApprovalsController@deletemembers')->name('adminmember.delete');
    Route::get('approvals','App\Http\Controllers\Admin\ApprovalsController@manageapprovals')->name('adminapprovals');
    // Route::any('approvals/memberstatus/{id}/{row}','App\Http\Controllers\Admin\ApprovalsController@statusapprovals')->name('adminapprovals.memberstatus');
    Route::get('approvals/socialmedia','App\Http\Controllers\Admin\ApprovalsController@managesocialmedia')->name('adminapprovals.socialmedia');
    Route::get('approvals/socialmediastatus/{id}/{row}','App\Http\Controllers\Admin\ApprovalsController@socialmediastatusapprovals')->name('adminapprovals.socialmediastatus');
    Route::post('statusapprovals','App\Http\Controllers\Admin\ApprovalsController@statusapprovalss')->name('statusapprovals');
    Route::post('approvals/opportunity/filter','App\Http\Controllers\Admin\ApprovalsController@adminopportunityfilter')->name('adminexcel.filter.opportunity');
    Route::get('approvals/opportunity','App\Http\Controllers\Admin\ApprovalsController@manageopportunity')->name('adminapprovals.opportunity');
    Route::post('approvals/opportunitystatus','App\Http\Controllers\Admin\ApprovalsController@opportunitystatus')->name('adminapprovals.opportunitystatus');
    Route::post('approvals/listsubcategory','App\Http\Controllers\Admin\ApprovalsController@listsubcategory')->name('adminapprovals.listsubcategory');
    Route::post('approvals/opportunitymemstatus','App\Http\Controllers\Admin\ApprovalsController@opportunitymemstatus')->name('adminapprovals.opportunitymemstatus');
    Route::get('approvals/opportunityrejected/{id}','App\Http\Controllers\Admin\ApprovalsController@opportunityrejected')->name('adminapprovals.opportunityrejected');
    
    
    Route::get('approvals/opportunity/delete/{id}','App\Http\Controllers\Admin\ApprovalsController@deleterequirement')->name('adminopp.delete');
    Route::get('approvals/media/delete/{id}','App\Http\Controllers\Admin\ApprovalsController@deletepost')->name('adminmedia.delete');
   
    
    Route::get('permissions','App\Http\Controllers\Admin\PermissionsController@managepermissions')->name('adminpermissions');
    Route::get('permissions/add','App\Http\Controllers\Admin\PermissionsController@addpermissions')->name('adminpermissions.add');
    Route::post('permissions/store','App\Http\Controllers\Admin\PermissionsController@permissions')->name('admin.permissions.store');
    Route::get('permissions/edit/{id}','App\Http\Controllers\Admin\PermissionsController@editpermissions')->name('admin.permissions.edit');
    Route::put('permissions/update/{id}','App\Http\Controllers\Admin\PermissionsController@updatepermissions')->name('admin.permissions.update');
    Route::get('permissions/delete/{id}','App\Http\Controllers\Admin\PermissionsController@deletepermissions')->name('admin.permissions.delete');
    Route::get('permissions/view/{id}','App\Http\Controllers\Admin\PermissionsController@viewpermissions')->name('admin.permissions.view');
    
    
     Route::get('meetings','App\Http\Controllers\Admin\MeetingsController@managemeetings')->name('adminmeetings');
    Route::get('meetings/add','App\Http\Controllers\Admin\MeetingsController@addmeetings')->name('adminmeetings.add');
    Route::post('meetings/store','App\Http\Controllers\Admin\MeetingsController@meetings')->name('admin.meetings.store');
    Route::get('meetings/edit/{id}','App\Http\Controllers\Admin\MeetingsController@editmeetings')->name('admin.meetings.edit');
    Route::put('meetings/update/{id}','App\Http\Controllers\Admin\MeetingsController@updatemeetings')->name('admin.meetings.update');
    Route::get('meetings/delete/{id}','App\Http\Controllers\Admin\MeetingsController@deletemeetings')->name('admin.meetings.delete');
    Route::get('meetings/view/{id}','App\Http\Controllers\Admin\MeetingsController@viewmeetings')->name('admin.meetings.view');
    Route::get('meetings/attendance/{id}','App\Http\Controllers\Admin\MeetingsController@attendancemeetings')->name('admin.meetings.attendance');
    Route::put('meetings/attendance/update/{id}','App\Http\Controllers\Admin\MeetingsController@updateattendancemeetings')->name('admin.meetings.attendance.update');
    
    
    Route::get('support','App\Http\Controllers\Admin\SupportController@managesupport')->name('adminsupport');
    Route::get('support/add','App\Http\Controllers\Admin\SupportController@addsupport')->name('adminsupport.add');
    Route::post('support/store','App\Http\Controllers\Admin\SupportController@support')->name('admin.support.store');
    Route::get('support/edit/{id}','App\Http\Controllers\Admin\SupportController@editsupport')->name('admin.support.edit');
    Route::put('support/update/{id}','App\Http\Controllers\Admin\SupportController@updatesupport')->name('admin.support.update');
    Route::get('support/delete/{id}','App\Http\Controllers\Admin\SupportController@deletesupport')->name('admin.support.delete');
    Route::get('support/view/{id}','App\Http\Controllers\Admin\SupportController@viewsupport')->name('admin.support.view');
    
    
    Route::get('department','App\Http\Controllers\Admin\DepartmentController@managedepartment')->name('admindepartment');
    Route::get('department/add','App\Http\Controllers\Admin\DepartmentController@adddepartment')->name('admindepartment.add');
    Route::post('department/store','App\Http\Controllers\Admin\DepartmentController@department')->name('admin.department.store');
    Route::get('department/edit/{id}','App\Http\Controllers\Admin\DepartmentController@editdepartment')->name('admin.department.edit');
    Route::put('department/update/{id}','App\Http\Controllers\Admin\DepartmentController@updatedepartment')->name('admin.department.update');
    Route::get('department/delete/{id}','App\Http\Controllers\Admin\DepartmentController@deletedepartment')->name('admin.department.delete');
    Route::get('department/view/{id}','App\Http\Controllers\Admin\DepartmentController@viewdepartment')->name('admin.department.view');
    
    
    Route::get('departmentmem','App\Http\Controllers\Admin\DepartmentmemController@managedepartmentmem')->name('admindepartmentmem');
    Route::get('departmentmem/add','App\Http\Controllers\Admin\DepartmentmemController@adddepartmentmem')->name('admindepartmentmem.add');
    Route::post('departmentmem/store','App\Http\Controllers\Admin\DepartmentmemController@departmentmem')->name('admin.departmentmem.store');
    Route::get('departmentmem/edit/{id}','App\Http\Controllers\Admin\DepartmentmemController@editdepartmentmem')->name('admin.departmentmem.edit');
    Route::put('departmentmem/update/{id}','App\Http\Controllers\Admin\DepartmentmemController@updatedepartmentmem')->name('admin.departmentmem.update');
    Route::get('departmentmem/delete/{id}','App\Http\Controllers\Admin\DepartmentmemController@deletedepartmentmem')->name('admin.departmentmem.delete');
    Route::get('departmentmem/view/{id}','App\Http\Controllers\Admin\DepartmentmemController@viewdepartmentmem')->name('admin.departmentmem.view');
    
    
    Route::get('mom','App\Http\Controllers\Admin\MomController@managemom')->name('adminmom');
    Route::get('mom/add','App\Http\Controllers\Admin\MomController@addmom')->name('adminmom.add');
    Route::post('mom/store','App\Http\Controllers\Admin\MomController@mom')->name('admin.mom.store');
    Route::get('mom/edit/{id}','App\Http\Controllers\Admin\MomController@editmom')->name('admin.mom.edit');
    Route::put('mom/update/{id}','App\Http\Controllers\Admin\MomController@updatemom')->name('admin.mom.update');
    Route::get('mom/delete/{id}','App\Http\Controllers\Admin\MomController@deletemom')->name('admin.mom.delete');
    Route::get('mom/view/{id}','App\Http\Controllers\Admin\MomController@viewmom')->name('admin.mom.view');
    Route::get('mom/agenda/{id}','App\Http\Controllers\Admin\MomController@addagenda')->name('admin.mom.addagenda');
    Route::post('mom/agenda/store','App\Http\Controllers\Admin\MomController@momagenda')->name('admin.mom.agenda.store');
    Route::post('mom/agenda/detaillist', 'App\Http\Controllers\Admin\MomController@detaillist')->name('detail.list');
    Route::post('mom/agenda/departlist', 'App\Http\Controllers\Admin\MomController@departlist')->name('depart.list');
    
    
    Route::get('mom/topiclist','App\Http\Controllers\Admin\MomController@momtopiclist')->name('admin.momtopiclist');
    Route::get('mom/memlist','App\Http\Controllers\Admin\MomController@mommemlist')->name('admin.mommemlist');
    // Route::get('listintrarea', 'App\Http\Controllers\AjaxController@listintrarea')->name('intrarea.list');
    
    
    
    
    Route::get('gallery','App\Http\Controllers\Admin\GalleryController@managegallery')->name('admingallery');
    Route::get('gallery/add','App\Http\Controllers\Admin\GalleryController@addgallery')->name('admingallery.add');
    Route::post('gallery/store','App\Http\Controllers\Admin\GalleryController@gallery')->name('admin.gallery.store');
    Route::get('gallery/edit/{id}','App\Http\Controllers\Admin\GalleryController@editgallery')->name('admin.gallery.edit');
    Route::put('gallery/update/{id}','App\Http\Controllers\Admin\GalleryController@updategallery')->name('admin.gallery.update');
    Route::get('gallery/delete/{id}','App\Http\Controllers\Admin\GalleryController@deletegallery')->name('admin.gallery.delete');
    Route::get('gallery/view/{id}','App\Http\Controllers\Admin\GalleryController@viewgallery')->name('admin.gallery.view');
    
    
    
    Route::get('document','App\Http\Controllers\Admin\DocumentController@managedocument')->name('admindocument');
    Route::get('document/add','App\Http\Controllers\Admin\DocumentController@adddocument')->name('admindocument.add');
    Route::post('document/store','App\Http\Controllers\Admin\DocumentController@document')->name('admin.document.store');
    Route::get('document/edit/{id}','App\Http\Controllers\Admin\DocumentController@editdocument')->name('admin.document.edit');
    Route::put('document/update/{id}','App\Http\Controllers\Admin\DocumentController@updatedocument')->name('admin.document.update');
    Route::get('document/delete/{id}','App\Http\Controllers\Admin\DocumentController@deletedocument')->name('admin.document.delete');
    Route::get('document/view/{id}','App\Http\Controllers\Admin\DocumentController@viewdocument')->name('admin.document.view');
    
    
    
    Route::any('terms/edit','App\Http\Controllers\Admin\TermsController@editterms')->name('admin.terms.edit');
    Route::put('terms/update/{id}','App\Http\Controllers\Admin\TermsController@updateterms')->name('admin.terms.update');
    
    
    
    
    Route::get('appversions','App\Http\Controllers\Admin\AppversionController@manageappversions')->name('adminappversions');
    Route::get('appversions/add','App\Http\Controllers\Admin\AppversionController@addappversions')->name('adminappversions.add');
    Route::post('appversions/store','App\Http\Controllers\Admin\AppversionController@appversions')->name('admin.appversions.store');
    Route::get('appversions/edit/{id}','App\Http\Controllers\Admin\AppversionController@editappversions')->name('admin.appversions.edit');
    Route::put('appversions/update/{id}','App\Http\Controllers\Admin\AppversionController@updateappversions')->name('admin.appversions.update');
    Route::get('appversions/delete/{id}','App\Http\Controllers\Admin\AppversionController@deleteappversions')->name('admin.appversions.delete');
    Route::get('appversions/view/{id}','App\Http\Controllers\Admin\AppversionController@viewappversions')->name('admin.appversions.view');
    
    
    
    Route::get('versions','App\Http\Controllers\Admin\VersionController@manageversions')->name('adminversions');
    Route::get('versions/add','App\Http\Controllers\Admin\VersionController@addversions')->name('adminversions.add');
    Route::post('versions/store','App\Http\Controllers\Admin\VersionController@versions')->name('admin.versions.store');
    Route::get('versions/edit/{id}','App\Http\Controllers\Admin\VersionController@editversions')->name('admin.versions.edit');
    Route::put('versions/update/{id}','App\Http\Controllers\Admin\VersionController@updateversions')->name('admin.versions.update');
    Route::get('versions/delete/{id}','App\Http\Controllers\Admin\VersionController@deleteversions')->name('admin.versions.delete');
    Route::get('versions/view/{id}','App\Http\Controllers\Admin\VersionController@viewversions')->name('admin.versions.view');


});

});
