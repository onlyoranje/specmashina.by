<?php

use App\Http\Controllers\CreditController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BbsController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\NewsController;
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
Auth::routes();

// Новая главная (редизайн 2026): blade-шаблоны resources/views/redesign.
// В hero-виджет передаём категории ВЕРХНЕГО уровня (рубрики level 1,
// отсортированные по алфавиту) и областные города Беларуси из БД. Для каждой
// категории берём и корневую рубрику секции (root_id/root_title: «Аренда»
// id 1, «Продажа» id 118) — шаблон группирует их в <optgroup> и показывает
// в списке только категории активной вкладки Аренда/Продажа.
Route::get('/', function () {
    $categories = App\Models\Rubric::query()
        ->where('rubrics.level', 1)
        ->join('rubrics as root', 'root.id', '=', 'rubrics.parent_id')
        ->orderBy('root.sort')
        ->orderBy('rubrics.title') // алфавитный порядок в выпадающем списке
        ->select('rubrics.id', 'rubrics.title', 'rubrics.parent_id', 'root.id as root_id', 'root.title as root_title')
        ->get();

    $cities = App\Models\Location::query()
        ->whereIn('title', ['Минск', 'Брест', 'Витебск', 'Гомель', 'Гродно', 'Могилев'])
        ->orderBy('id')
        ->get(['id', 'title']);

    // Блок «Категории техники»: рубрики 1-го уровня с числом АКТИВНЫХ
    // объявлений (с учётом потомков), сортировка по количеству по убыванию.
    // Показываем только категории, где объявления есть, — максимум 6 блоков.
    // Колонка qualified (rubrics.level): scopeWithAdsCount делает self-join.
    // parent_rubric.title — название родительской категории («Аренда» /
    // «Продажа») для подписи карточек «Аренда погрузчика» и т.п.
    $cats = App\Models\Rubric::query()
        ->where('rubrics.level', 1)
        ->withAdsCount()
        ->join('rubrics as parent_rubric', 'parent_rubric.id', '=', 'rubrics.parent_id')
        ->addSelect('parent_rubric.title as parent_title')
        ->orderByDesc('ads_count')
        ->orderBy('rubrics.title') // qualified: в запросе теперь и parent_rubric.title
        ->having('ads_count', '>', 0) // фильтр по алиасу COALESCE из withAdsCount
        ->limit(6)
        ->get();

    // Секция «Популярная техника»: активные объявления с наибольшим
    // количеством просмотров (сумма по bb_statistics).
    $popular = App\Models\Bb::query()
        ->whereHas('status_bb', fn ($q) => $q->where('active', 'Y'))
        ->with(['location', 'bbprice.pricetype', 'BbParameters.parameters'])
        ->withSum('bbstatistic', 'views')        // → атрибут bbstatistic_sum_views
        ->orderByDesc('bbstatistic_sum_views')
        ->orderByDesc('lifted_at')
        ->limit(3)
        ->get();

    // Секция «Актуальные объявления»: те же карточки,
    // сортировка по дате обновления.
    $actual = App\Models\Bb::query()
        ->whereHas('status_bb', fn ($q) => $q->where('active', 'Y'))
        ->with(['location', 'bbprice.pricetype', 'BbParameters.parameters'])
        ->orderByDesc('updated_at')
        ->orderByDesc('id')
        ->limit(3)
        ->get();

    // Секция «Новости»: последние активные публикации.
    $posts = App\Models\Post::query()
        ->where('active', 'Y')
        ->orderByDesc('created_at')
        ->orderByDesc('id')
        ->limit(3)
        ->get();

    return view('redesign.home', [
        'categories' => $categories,
        'cities'     => $cities,
        'cats'       => $cats,
        'popular'    => $popular,
        'actual'     => $actual,
        'posts'      => $posts,
    ]);
})->name('home');

// Старая главная (доска объявлений) — временно доступна для отката редизайна.
// Чтобы вернуть её на «/», просто поменяйте местами эти два маршрута.
Route::get('/old-home', [BbsController::class, 'index'])->name('home.old');

/*
|--------------------------------------------------------------------------
| Разделы нового фронтенда (редизайн 2026)
|--------------------------------------------------------------------------
| Страницы-заглушки: наполняем контентом на следующих шагах редизайна.
| Нужны уже сейчас, чтобы шапка (<x-header>) ссылалась на валидные
| маршруты, а request()->routeIs() корректно подсвечивал active.
*/
// Каталог: «Аренда» и «Продажа» — общий шаблон resources/views/catalog/index.blade.php.
Route::get('/rent/{rubric?}', [CatalogController::class, 'index'])->name('rent.index');
Route::get('/sale/{rubric?}',  [CatalogController::class, 'index'])->name('sale.index');
// «Весь каталог»: страница со всеми категориями (рубрики 1-го уровня обеих секций).
Route::get('/catalog', [CatalogController::class, 'categories'])->name('catalog.all');
// «Все объявления»: полный список активных объявлений без привязки к секции.
Route::get('/ads', [CatalogController::class, 'ads'])->name('ads.index');
// Новости (Блог): список + детальная страница в стиле редизайна.
// Шаблоны: resources/views/news/{index,show}.blade.php · стили: /css/news.css.
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{article}', [NewsController::class, 'show'])->name('news.show');


Route::get('/dashboard', [App\Http\Controllers\ProfileController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/admin', [App\Http\Controllers\ProfileController::class, 'admin_dashboard'])->middleware(['auth', 'verified'])->name('admin_dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard/credits', [CreditController::class, 'index'])->name('credit.dashboard');
});


Route::get('/dashboard/organization', [App\Http\Controllers\ProfileController::class, 'MyOrganization'])->name('my_organization')->middleware('auth');
Route::get('/dashboard/organization/add', [App\Http\Controllers\ProfileController::class, 'addOrganization'])->name('organization_add')->middleware('auth');
Route::get('/dashboard/organization/edit', [App\Http\Controllers\ProfileController::class, 'editOrganization'])->name('organization_edit')->middleware('auth');
Route::get('/dashboard/organization/delete', [App\Http\Controllers\ProfileController::class, 'deleteOrganization'])->name('organization_delete')->middleware('auth');
Route::post('/dashboard/organization', [App\Http\Controllers\ProfileController::class, 'addOrganizationToDB'])->name('addOrganizationToDB')->middleware('auth');
Route::patch('/dashboard/organization/000',[App\Http\Controllers\ProfileController::class, 'updateOrganization'])->name('organization_update')->middleware('auth');
Route::delete('/dashboard/organization', [App\Http\Controllers\ProfileController::class, 'destroyOrganization'])->name('organization_destroy')->middleware('auth');
Route::get('organizations', [App\Http\Controllers\OrganizationController::class, 'list'])->name('organizations');
Route::get('organization/{id}', [App\Http\Controllers\OrganizationController::class, 'detail'])->name('organization');
Route::get('organization/{id}/site', [App\Http\Controllers\OrganizationController::class, 'organization_site_redirect'])->name('organization_site_redirect');


Route::get('/dashboard/mybb',[App\Http\Controllers\ProfileController::class, 'mybb'])->name('mybb');
Route::get('/dashboard/allbb',[App\Http\Controllers\ProfileController::class, 'allbb'])->name('allbb')->middleware('isadmin');;
Route::get('/dashboard/allusers',[App\Http\Controllers\ProfileController::class, 'allusers'])->name('allusers')->middleware('isadmin');;
Route::get('/dashboard/allorganizations',[App\Http\Controllers\ProfileController::class, 'allorganizations'])->name('allorganizations')->middleware('isadmin');;
Route::get('/dashboard/user/{user}',[App\Http\Controllers\ProfileController::class, 'user'])->name('user')->middleware('isadmin');;
Route::get('/dashboard/user/{user}/{status}',[App\Http\Controllers\ProfileController::class, 'changeUserStatus'])->name('change_user_status')->middleware('isadmin');;
Route::get('/dashboard/organization/{organization}/{status}',[App\Http\Controllers\ProfileController::class, 'changeOrganizationStatus'])->name('change_organization_status')->middleware('isadmin');;
Route::get('/dashboard/mybb/add', [App\Http\Controllers\ProfileController::class, 'addForm'])->name('addForm');
Route::post('/dashboard/mybb', [App\Http\Controllers\ProfileController::class, 'addBb'])->name('addBbToDB');
Route::get('/dashboard/mybb/{bb}/edit',[App\Http\Controllers\ProfileController::class, 'editBb'])->name('bb_edit')->middleware('can:update,bb');
Route::get('/dashboard/mybb/{bb}/status/{status}',[App\Http\Controllers\ProfileController::class, 'bb_edit_status'])->name('bb_edit_status');
Route::get('/dashboard/mybb/{bb}/active/{active}',[App\Http\Controllers\ProfileController::class, 'bb_active'])->name('bb_active');
Route::patch('/dashboard/mybb/{bb}',[App\Http\Controllers\ProfileController::class, 'updateBb'])->name('bb_update')->middleware('can:update,bb');
Route::get('/dashboard/mybb/{bb}/delete',[App\Http\Controllers\ProfileController::class, 'deleteBb'])->name('bb_delete')->middleware('can:destroy,bb');
Route::delete('/dashboard/mybb/{bb}',[App\Http\Controllers\ProfileController::class, 'destroyBb'])->name('bb_destroy')->middleware('can:destroy,bb');
Route::get('/dashboard/favorite',[App\Http\Controllers\ProfileController::class, 'favorite'])->name('favorite');
Route::get('/dashboard/mybb/{bb}/up_credit',[App\Http\Controllers\BbsController::class, 'upBb_credit'])->name('bb_up_credit');

Route::get('/dashboard/alerts',[App\Http\Controllers\ProfileController::class, 'alerts'])->name('alerts');
Route::patch('/read_alert', [App\Http\Controllers\ProfileController::class, 'read_alert'])->middleware(['auth', 'verified'])->name('read_alert');

Route::get('/rubric', [App\Http\Controllers\RubricsController::class, 'rubric'])->name('rubrics');
Route::get('/rubric/{rubric}', [App\Http\Controllers\RubricsController::class, 'rubric'])->name('rubric');
Route::get('/dashboard/rubric', [App\Http\Controllers\RubricsController::class, 'rubrics'])->name('rubric_dashboard')->middleware('isadmin');
Route::post('/dashboard/rubric', [App\Http\Controllers\RubricsController::class, 'addRubric'])->name('addRubricToDB')->middleware('isadmin');
Route::get('/dashboard/rubric/add', [App\Http\Controllers\RubricsController::class, 'addRubricForm'])->name('rubric_dashboard_add')->middleware('isadmin');
Route::get('/dashboard/rubric/{rubric}', [App\Http\Controllers\RubricsController::class, 'detail'])->name('rubric_dashboard_edit')->middleware('isadmin');
Route::patch('/dashboard/rubric/{rubric}', [App\Http\Controllers\RubricsController::class, 'editRubric'])->name('editRubricToDB')->middleware('isadmin');
Route::get('/dashboard/rubric/{rubric}/delete', [App\Http\Controllers\RubricsController::class, 'delete'])->name('rubric_dashboard_delete')->middleware('isadmin');
Route::delete('/dashboard/rubric/{rubric}', [App\Http\Controllers\RubricsController::class, 'destroyRubric'])->name('rubric_dashboard_destroy')->middleware('isadmin');

Route::get('/location', [App\Http\Controllers\LocationsController::class, 'list'])->name('locations');
Route::get('/location/{location}', [App\Http\Controllers\LocationCatalogController::class, 'show'])->name('location');
Route::get('/dashboard/location', [App\Http\Controllers\LocationsController::class, 'locations'])->name('location_dashboard')->middleware('isadmin');
Route::post('/dashboard/location', [App\Http\Controllers\LocationsController::class, 'addLocation'])->name('addLocationToDB')->middleware('isadmin');
Route::get('/dashboard/location/add', [App\Http\Controllers\LocationsController::class, 'addLocationForm'])->name('location_dashboard_add')->middleware('isadmin');
Route::get('/dashboard/location/{location}', [App\Http\Controllers\LocationsController::class, 'detail'])->name('location_dashboard_edit')->middleware('isadmin');
Route::patch('/dashboard/location/{location}', [App\Http\Controllers\LocationsController::class, 'editLocation'])->name('editLocationToDB')->middleware('isadmin');
Route::get('/dashboard/location/{location}/delete', [App\Http\Controllers\LocationsController::class, 'delete'])->name('location_dashboard_delete')->middleware('isadmin');
Route::delete('/dashboard/location/{location}', [App\Http\Controllers\LocationsController::class, 'destroyLocation'])->name('location_dashboard_destroy')->middleware('isadmin');

Route::get('/dashboard/parameter', [App\Http\Controllers\ParametersController::class, 'parameters'])->name('parameter_dashboard')->middleware('isadmin');
Route::post('/dashboard/parameter', [App\Http\Controllers\ParametersController::class, 'addParameter'])->name('addParameterToDB')->middleware('isadmin');
Route::get('/dashboard/parameter/add', [App\Http\Controllers\ParametersController::class, 'addParameterForm'])->name('parameter_dashboard_add')->middleware('isadmin');
Route::get('/dashboard/parameter/{parameter}', [App\Http\Controllers\ParametersController::class, 'detail'])->name('parameter_dashboard_edit')->middleware('isadmin');
Route::patch('/dashboard/parameter/{parameter}', [App\Http\Controllers\ParametersController::class, 'editParameter'])->name('editParameterToDB')->middleware('isadmin');
Route::get('/dashboard/parameter/{parameter}/delete', [App\Http\Controllers\ParametersController::class, 'delete'])->name('parameter_dashboard_delete')->middleware('isadmin');
Route::delete('/dashboard/parameter/{parameter}', [App\Http\Controllers\ParametersController::class, 'destroyParameter'])->name('parameter_dashboard_destroy')->middleware('isadmin');

Route::get('/dashboard/parameter_type', [App\Http\Controllers\ParameterTypesController::class, 'types'])->name('parameter_type_dashboard')->middleware('isadmin');
Route::post('/dashboard/parameter_type', [App\Http\Controllers\ParameterTypesController::class, 'addTypetoDB'])->name('addTypeToDB')->middleware('isadmin');
Route::get('/dashboard/parameter_type/add', [App\Http\Controllers\ParameterTypesController::class, 'addTypeForm'])->name('parameter_type_add')->middleware('isadmin');
Route::get('/dashboard/parameter_type/{type}', [App\Http\Controllers\ParameterTypesController::class, 'detail'])->name('parameter_type_edit')->middleware('isadmin');
Route::patch('/dashboard/parameter_type/{type}', [App\Http\Controllers\ParameterTypesController::class, 'editType'])->name('editTypetoDB')->middleware('isadmin');
Route::get('/dashboard/parameter_type/{type}/delete', [App\Http\Controllers\ParameterTypesController::class, 'delete'])->name('parameter_type_delete')->middleware('isadmin');
Route::delete('/dashboard/parameter_type/{type}', [App\Http\Controllers\ParameterTypesController::class, 'destroy'])->name('parameter_type_destroy')->middleware('isadmin');

Route::get('/dashboard/price_type', [App\Http\Controllers\PriceTypesController::class, 'types'])->name('price_type_dashboard')->middleware('isadmin');
Route::post('/dashboard/price_type', [App\Http\Controllers\PriceTypesController::class, 'addTypetoDB'])->name('addPriceTypeToDB')->middleware('isadmin');
Route::get('/dashboard/price_type/add', [App\Http\Controllers\PriceTypesController::class, 'addTypeForm'])->name('price_type_add')->middleware('isadmin');
Route::get('/dashboard/price_type/{type}', [App\Http\Controllers\PriceTypesController::class, 'detail'])->name('price_type_edit')->middleware('isadmin');
Route::patch('/dashboard/price_type/{type}', [App\Http\Controllers\PriceTypesController::class, 'editType'])->name('editPriceTypetoDB')->middleware('isadmin');
Route::get('/dashboard/price_type/{type}/delete', [App\Http\Controllers\PriceTypesController::class, 'delete'])->name('price_type_delete')->middleware('isadmin');
Route::delete('/dashboard/price_type/{type}', [App\Http\Controllers\PriceTypesController::class, 'destroy'])->name('price_type_destroy')->middleware('isadmin');

Route::get('/dashboard/contact_type', [App\Http\Controllers\ContactTypesController::class, 'types'])->name('contact_type_dashboard')->middleware('isadmin');
Route::post('/dashboard/contact_type', [App\Http\Controllers\ContactTypesController::class, 'addTypetoDB'])->name('addContactTypeToDB')->middleware('isadmin');
Route::get('/dashboard/contact_type/add', [App\Http\Controllers\ContactTypesController::class, 'addTypeForm'])->name('contact_type_add')->middleware('isadmin');
Route::get('/dashboard/contact_type/{type}', [App\Http\Controllers\ContactTypesController::class, 'detail'])->name('contact_type_edit')->middleware('isadmin');
Route::patch('/dashboard/contact_type/{type}', [App\Http\Controllers\ContactTypesController::class, 'editType'])->name('editContactTypetoDB')->middleware('isadmin');
Route::get('/dashboard/contact_type/{type}/delete', [App\Http\Controllers\ContactTypesController::class, 'delete'])->name('contact_type_delete')->middleware('isadmin');
Route::delete('/dashboard/contact_type/{type}', [App\Http\Controllers\ContactTypesController::class, 'destroy'])->name('contact_type_destroy')->middleware('isadmin');


Route::get('/vendor', [App\Http\Controllers\VendorsController::class, 'vendor'])->name('vendors');
Route::get('/vendor/{vendor}', [App\Http\Controllers\VendorsController::class, 'vendor'])->name('vendor');
Route::get('/dashboard/vendor', [App\Http\Controllers\VendorsController::class, 'vendors'])->name('vendor_dashboard')->middleware('isadmin');
Route::post('/dashboard/vendor', [App\Http\Controllers\VendorsController::class, 'addVendor'])->name('addVendorToDB')->middleware('isadmin');
Route::get('/dashboard/vendor/add', [App\Http\Controllers\VendorsController::class, 'addVendorForm'])->name('vendor_dashboard_add')->middleware('isadmin');
Route::get('/dashboard/vendor/{vendor}', [App\Http\Controllers\VendorsController::class, 'detail'])->name('vendor_dashboard_edit')->middleware('isadmin');
Route::patch('/dashboard/vendor/{vendor}', [App\Http\Controllers\VendorsController::class, 'editVendor'])->name('editVendorToDB')->middleware('isadmin');
Route::get('/dashboard/vendor/{vendor}/delete', [App\Http\Controllers\VendorsController::class, 'delete'])->name('vendor_dashboard_delete')->middleware('isadmin');
Route::delete('/dashboard/vendor/{vendor}', [App\Http\Controllers\VendorsController::class, 'destroyVendor'])->name('vendor_dashboard_destroy')->middleware('isadmin');


Route::get('/dashboard/status_bb', [App\Http\Controllers\StatusBbController::class, 'statuses'])->name('status_dashboard')->middleware('isadmin');
Route::post('/dashboard/status_bb', [App\Http\Controllers\StatusBbController::class, 'addStatus'])->name('addStatusToDB')->middleware('isadmin');
Route::get('/dashboard/status_bb/add', [App\Http\Controllers\StatusBbController::class, 'addStatusForm'])->name('status_dashboard_add')->middleware('isadmin');
Route::get('/dashboard/status_bb/{status}', [App\Http\Controllers\StatusBbController::class, 'detail'])->name('status_dashboard_edit')->middleware('isadmin');
Route::patch('/dashboard/status_bb/{status}', [App\Http\Controllers\StatusBbController::class, 'editStatus'])->name('editStatusToDB')->middleware('isadmin');
Route::get('/dashboard/status_bb/{status}/delete', [App\Http\Controllers\StatusBbController::class, 'delete'])->name('status_dashboard_delete')->middleware('isadmin');
Route::delete('/dashboard/status_bb/{status}', [App\Http\Controllers\StatusBbController::class, 'destroyStatus'])->name('status_dashboard_destroy')->middleware('isadmin');

Route::get('/dashboard/posts/', [App\Http\Controllers\PostsController::class, 'posts_dashboard'])->name('posts_dashboard')->middleware('isadmin');
Route::post('/dashboard/post', [App\Http\Controllers\PostsController::class, 'post_add_db'])->name('post_add_db')->middleware('isadmin');
Route::get('/dashboard/post/add', [App\Http\Controllers\PostsController::class, 'post_add'])->name('post_add')->middleware('isadmin');
Route::get('/dashboard/post/{post}', [App\Http\Controllers\PostsController::class, 'post_dashboard'])->name('post_dashboard')->middleware('isadmin');
Route::patch('/dashboard/post/{post}', [App\Http\Controllers\PostsController::class, 'edit_post'])->name('edit_post')->middleware('isadmin');
Route::get('/dashboard/post/{post}/delete', [App\Http\Controllers\PostsController::class, 'delete_post'])->name('delete_post')->middleware('isadmin');
Route::delete('/dashboard/post/{post}', [App\Http\Controllers\PostsController::class, 'destroy_post'])->name('destroy_post')->middleware('isadmin');
Route::get('/posts/', [App\Http\Controllers\PostsController::class, 'posts'])->name('posts');
Route::get('/post/{post}', [App\Http\Controllers\PostsController::class, 'post'])->name('post');

Route::get('/dashboard/banners/', [App\Http\Controllers\BannersController::class, 'banners_dashboard'])->name('banners_dashboard')->middleware('isadmin');
Route::get('/banner/{banner}', [App\Http\Controllers\BannersController::class, 'banner'])->name('banner');

Route::get('/dashboard/banner/add', [App\Http\Controllers\BannersController::class, 'banner_add'])->name('banner_add')->middleware('isadmin');
Route::post('/dashboard/banner', [App\Http\Controllers\BannersController::class, 'banner_add_db'])->name('banner_add_db')->middleware('isadmin');
Route::patch('/dashboard/banner/{banner}', [App\Http\Controllers\BannersController::class, 'edit_banner'])->name('edit_banner')->middleware('isadmin');
Route::get('/dashboard/banner/{banner}/delete', [App\Http\Controllers\BannersController::class, 'delete_banner'])->name('delete_banner')->middleware('isadmin');
Route::get('/dashboard/banner/{banner}', [App\Http\Controllers\BannersController::class, 'banner_dashboard'])->name('banner_dashboard')->middleware('isadmin');
require __DIR__.'/auth.php';
Route::get('/item/{bb}', [BbsController::class, 'detail'])->name('bb');

// Псевдоним для нового фронтенда (редизайн 2026): карточки объявлений
// (<x-equipment-card>) ссылаются на listings.show.
Route::get('/listing/{bb}', [BbsController::class, 'detail'])->name('listings.show');

/*
|--------------------------------------------------------------------------
| Правовые документы (редизайн 2026)
|--------------------------------------------------------------------------
| Страницы-заглушки: наполняются текстами документов позже.
| Ссылки на них выводятся в футере (<x-footer />).
*/
Route::view('/legal/user-agreement', 'redesign.placeholder', ['section' => 'Пользовательское соглашение'])->name('legal.user-agreement');
Route::view('/legal/privacy-policy', 'redesign.placeholder', ['section' => 'Политика обработки персональных данных'])->name('legal.privacy-policy');
Route::view('/legal/offer', 'redesign.placeholder', ['section' => 'Публичная оферта'])->name('legal.offer');
Route::get('/item/{bb}/approve', [BbsController::class, 'approve'])->name('approve')->middleware('isadmin');
Route::patch('/item/{bb}/reject', [BbsController::class, 'reject'])->name('reject')->middleware('isadmin');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search_result'])->name('search');

Route::get('/messages', [App\Http\Controllers\ImsController::class, 'index'])->middleware(['auth', 'verified'])->name('messages');
Route::get('/chats/{id}', [App\Http\Controllers\ImsController::class, 'chat'])->middleware(['auth', 'verified'])->name('chat');
Route::get('/chats', [App\Http\Controllers\ImsController::class, 'chats'])->middleware(['auth', 'verified'])->name('chats');

Route::patch('/read_message/{id}', [App\Http\Controllers\ImsController::class, 'read_msg'])->middleware(['auth', 'verified'])->name('read_msg');
Route::patch('/read_alert/{id}', [App\Http\Controllers\NotificationController::class, 'read_alert'])->middleware(['auth', 'verified'])->name('read_msg');
Route::patch('/new_msg', [App\Http\Controllers\ImsController::class, 'new_msg'])->middleware(['auth', 'verified'])->name('new_msg');
Route::patch('/notification', [App\Http\Controllers\NotificationController::class, 'index'])->middleware(['auth', 'verified'])->name('notification');

Route::patch('/bookmarked', [App\Http\Controllers\BookmarkController::class, 'bookmarked'])->middleware(['auth', 'verified'])->name('bookmarked');

# Google Auth routes
Route::get('/google-auth/redirect', [App\Http\Controllers\GoogleAuthController::class, 'redirect'])->name("google.redirect");
Route::get('/google-auth/callback', [App\Http\Controllers\GoogleAuthController::class, 'callback'])->name("google.callback");


# Static Pages
Route::get('/page/{page}', [App\Http\Controllers\StaticPageController::class, 'page'])->name('page');
Route::get('/dashboard/pages/', [App\Http\Controllers\StaticPageController::class, 'pages_dashboard'])->name('pages_dashboard')->middleware('isadmin');
Route::post('/dashboard/page', [App\Http\Controllers\StaticPageController::class, 'page_add_db'])->name('page_add_db')->middleware('isadmin');
Route::get('/dashboard/page/add', [App\Http\Controllers\StaticPageController::class, 'page_add'])->name('page_add')->middleware('isadmin');
Route::get('/dashboard/page/{page}', [App\Http\Controllers\StaticPageController::class, 'page_dashboard'])->name('page_dashboard')->middleware('isadmin');
Route::patch('/dashboard/page/{page}', [App\Http\Controllers\StaticPageController::class, 'edit_page'])->name('edit_page')->middleware('isadmin');
Route::get('/dashboard/page/{page}/delete', [App\Http\Controllers\StaticPageController::class, 'delete_page'])->name('delete_page')->middleware('isadmin');
Route::delete('/dashboard/page/{page}', [App\Http\Controllers\StaticPageController::class, 'destroy_page'])->name('destroy_page')->middleware('isadmin');
Route::get('/pages/', [App\Http\Controllers\StaticPageController::class, 'pages'])->name('pages');


//Route::get('sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index']);
