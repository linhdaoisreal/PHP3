<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TinController;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;
use function Laravel\Prompts\table;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tin', [TinController::class, 'index']);

Route::get('/tin/contact', [TinController::class, 'contact']);

Route::get('/tin/infor/{id}', [TinController::class, 'infor']);

Route::get('/users', [UserController::class, 'index']);

Route::get('/users/show/{id}', [UserController::class, 'show']);

//Insert 
Route::get('insert', function () {

    $data = [
        'name' => 'Kinh tế',
        'created_at' => date(format: 'Y-m-d H:i:s'),
        'updated_at' => date(format: 'Y-m-d H:i:s'),
    ];

    DB::table('categories')->insert($data);

    echo 'Insert thành công';
});

Route::get('insert-many', function () {

    $data = [
        [
            'name' => 'Xã hội',
            'created_at' => date(format: 'Y-m-d H:i:s'),
            'updated_at' => date(format: 'Y-m-d H:i:s'),
        ],
        [
            'name' => 'Văn hóa',
            'created_at' => date(format: 'Y-m-d H:i:s'),
            'updated_at' => date(format: 'Y-m-d H:i:s'),
        ],
        [
            'name' => 'Giáo dục',
            'created_at' => date(format: 'Y-m-d H:i:s'),
            'updated_at' => date(format: 'Y-m-d H:i:s'),
        ]
    ];

    DB::table('categories')->insert($data);

    echo 'Insert thành công';
});

Route::get('insert-getID', function () {

    $data = [
        'name' => 'Test',
        'created_at' => date(format: 'Y-m-d H:i:s'),
        'updated_at' => date(format: 'Y-m-d H:i:s'),
    ];

    $id = DB::table('categories')->insertGetId($data);

    echo 'Insert thành công bản ghi có ID:' . $id;
});

//SELECT
Route::get('/select', function () {
    //all
    $all = DB::table('categories')->get();

    //where
    $where1 = DB::table('categories')->where('id', 3)->get();
    $where2 = DB::table('categories')->where('id', '>', 3)->get();
    $where3 = DB::table('categories')->where('id', '<', 3)->get();

    //first
    $first = DB::table('categories')->where('id', 3)->first();

    //find
    $find = DB::table('categories')->find(3);

    // dd($first, $find);
    echo 1;
});

//UPDATE
Route::get('update', function () {
    $id = 5;

    $data = [
        'name' => 'Chính trị',
        'updated_at' => date(format: 'Y-m-d H:i:s'),
    ];

    DB::table('categories')->where('id', $id)->update($data);

    echo 'Updated Successfully';
});

//DELETE
Route::get('delete', function () {
    $id = 5;

    DB::table('categories')->where('id', $id)->delete();

    echo 'Deleted Successfully';
});

//LAP2
// Route::get('insert-many-posts', function () {

//     $data = [
//         [
//             'name' => 'Xã hội',
//             'category_id' => 1,
//             'title' => 'Bài viết về Xã hội',
//             'description' => 'Dưới đây là một bài viết về Xã hội',
//             'created_at' => date(format: 'Y-m-d H:i:s'),
//             'updated_at' => date(format: 'Y-m-d H:i:s'),
//         ],
//         [
//             'name' => 'Văn hóa',
//             'category_id' => 2,
//             'title' => 'Bài viết về Văn hóa',
//             'description' => 'Dưới đây là một bài viết về Văn hóa',
//             'created_at' => date(format: 'Y-m-d H:i:s'),
//             'updated_at' => date(format: 'Y-m-d H:i:s'),
//         ],
//         [
//             'name' => 'Học thuật',
//             'category_id' => 3,
//             'title' => 'Bài viết về Học thuật',
//             'description' => 'Dưới đây là một bài viết về Học thuật',
//             'created_at' => date(format: 'Y-m-d H:i:s'),
//             'updated_at' => date(format: 'Y-m-d H:i:s'),
//         ],
//         [
//             'name' => 'Chính trị',
//             'category_id' => 4,
//             'title' => 'Bài viết về Chính trị',
//             'description' => 'Dưới đây là một bài viết về Chính trị',
//             'created_at' => date(format: 'Y-m-d H:i:s'),
//             'updated_at' => date(format: 'Y-m-d H:i:s'),
//         ],
//         [
//             'name' => 'Mỹ thuật và Công nghệ',
//             'category_id' => 2,
//             'title' => 'Bài viết về Mỹ thuật và Công nghệ',
//             'description' => 'Dưới đây là một bài viết về Mỹ thuật và Công nghệ',
//             'created_at' => date(format: 'Y-m-d H:i:s'),
//             'updated_at' => date(format: 'Y-m-d H:i:s'),
//         ],
//         [
//             'name' => 'Kinh tế thị trường',
//             'category_id' => 1,
//             'title' => 'Bài viết về Kinh tế thị trường',
//             'description' => 'Dưới đây là một bài viết về Kinh tế thị trường',
//             'created_at' => date(format: 'Y-m-d H:i:s'),
//             'updated_at' => date(format: 'Y-m-d H:i:s'),
//         ],
//     ];

//     DB::table('posts')->insert($data);

//     echo 'Insert thành công các bài viết mới';
// });

// Route::get('show-10-post', function () {

//     $query = DB::table('posts')
//     ->select('id','title','name','category_id','description','created_at','updated_at')
//     ->orderBy('id', 'desc')
//     ->limit(10)->get();

//     // dd($query);

//     foreach ($query as $post ) {
//         echo "<p> {$post -> title} </p>";
//     }
// });

// Route::get('last-10-post', function () {

//     $query = DB::table('posts')
//     ->select('id','title','name','category_id','description','created_at','updated_at')
//     ->orderBy('created_at', 'desc')
//     ->limit(10)->get();

//     // dd($query);

//     return view('list-post', ['data'=>$query]);
// });

// Route::get('post-by-cate-id/{id}', function ($id) {
//     $cate = DB::table(table: 'categories')
//     ->where('id', '=', $id)
//     ->select('id','name')->first();

//     $query = DB::table('posts')
//     ->select('id','title','name','category_id','description','created_at','updated_at')
//     ->where('category_id', '=', $id)
//     ->orderBy('created_at', 'desc')->get();

//     // dd($query);

//     return view('list-post', ['data'=>$query, 'cate'=>$cate]);
// });

// Route::get('show-one-post/{id}', function ($id) {
//     $query = DB::table('posts')
//     ->select('id','title','name','category_id','description','created_at','updated_at')
//     ->where('id', '=', $id)
//     ->first();

//     // dd($query);

//     return view('tin-infor', ['data'=>$query]);
// });

//LAP 3
Route::get('/post', [PostController::class, 'index']);
Route::get('/post/{id}', [PostController::class, 'post_detail']);
Route::get('/post-by-cate/{id}', [PostController::class, 'post_by_cate']);

//BUỔI 4
Route::get('collect', function(){
    $max = DB::table('categories')->max('id');
    $min = DB::table('categories')->min('id');
    $avg = DB::table('categories')->avg('id');
    $sum = DB::table('categories')->sum('id');

    $count = DB::table('categories')->where('id', '>', 5)->count();

    $pluck = DB::table('categories')->pluck('name')->all();

    dd($max,$min,$avg,$sum,$count,$pluck);
    echo 1;
});

Route::get('join', function(){
    $join = DB::table('categories', 'c')
    ->join('posts as p', 'p.category_id', '=', 'c.id')
    ->where('c.id', '>', 3)
    ->select([
        'p.id       as p_id',
        'p.title    as p_title',
        'c.id       as c_id'
    ])->get();

    // dd($join);
    // dd($join->toRawSql());
    // $join->get();
    echo 1;
});

//Bài SQL bổ sung
Route::get('more-sql', function(){

    //SQL1
    $sql1 = DB::table('users', 'u')
    ->join('orders as o', 'u.order_id', '=', 'o.id')
    ->join('order_items as oi', 'oi.order_id', '=', 'o.id')
    ->join('products as p', 'oi.product_id', '=', 'p.id')
    ->whereRaw('o.order_date >= NOW() - INTERVAL 30 DAY')
    ->select([
        'u.name             as u_name',
        'p.product_name     as pro_name',
        'o.order_date       as order_date'
    ]);

    //SQL2
    $sql2 = DB::table('orders', 'o')
    ->select(DB::raw("DATE_FORMAT(o.order_date, '%Y-%m') AS order_month"))
    ->join('order_items as oi', 'oi.order_id', '=', 'o.id')
    ->where('o.status', '=', 'completed')
    ->groupBy('order_month')
    ->orderByDesc('order_month')
    ->selectRaw('SUM(oi.quantity * oi.price) AS total_revenue');

    //SQL3
    $sql3 = DB::table('users', 'u')
    ->join('orders as o', 'u.id', '=', 'o.user_id')
    ->select('u.name as u_name')
    ->selectRaw(' COUNT(o.id) AS order_count')
    ->groupBy('u_name');

    //SQL4
    $sql4 = DB::table('products', 'p')
    ->leftJoin('order_items as oi', 'oi.product_id', '=', 'p.id')
    ->select('p.product_name as p_name')
    ->whereNull('oi.product_id');

    //SQL5
    $subQ5 = DB::table('order_items')
    ->select('product_id', DB::raw('SUM(quantity * price) AS total'))
    ->groupBy('product_id');

    $sql5 = DB::table('products', 'p')
    ->joinSub($subQ5, 'oi', function($join){
        $join->on('p.id', '=' , 'oi.product_id');
    })
    ->select('p.category_id', 'p.product_name', DB::raw('MAX(oi.total) AS max_revenue'))
    ->groupBy('p.category_id', 'p.product_name')
    ->orderByDesc('max_revenue');

    //SQL6
    // Subquery cho việc tính tổng theo order_id và tính tổng giá trị
    $subQ6 = DB::table('order_items')
    ->select('order_id', DB::raw('SUM(quantity * price) AS total'))
    ->groupBy('order_id');

    // Tính giá trị trung bình từ subquery
    $avgSubQ6 = DB::table($subQ6, 'subquery')
    ->select(DB::raw('AVG(total) as avg_order_value'))->toSql();  // Convert subquery to raw SQL

    $sql6 = DB::table('orders', 'o')
    ->join('users as u', 'u.id', '=', 'o.user_id')
    ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
    ->select('o.id', 'u.name', 'o.order_date', DB::raw('SUM(oi.quantity * oi.price) AS total_value'))
    ->groupBy('o.id', 'u.name', 'o.order_date')
    ->havingRaw('SUM(oi.quantity * oi.price) > (' . $avgSubQ6 . ')');

    //SQL7
    $sql7 = DB::table('employees', 'e')
    ->join('order_assignees as oa', 'oa.employee_id', '=', 'e.id')
    ->join('order as o', 'oa.order_id', '=', 'o.id')
    ->join('users as u', 'o.user_id', '=', 'u.id')
    ->select([
        'e.name as employee_name',
        'u.name as customer_name',
        'o.order_date',
        'o.status'
    ])
    ->where('o.status', '=', 'completed');
    
    //SQL8
    $sql8 = DB::table('orders', 'o')
    ->join('users as u', 'o.user_id', '=', 'u.id')
    ->join('order_items  as oi', 'oi.order_id', '=', 'o.id')
    ->join('products as p', 'p.id', '=', 'oi.product_id')
    ->join('returns as r', 'oi.id', '=', 'r.order_item_id')
    ->select([
        'o.id as o_id',
        'u.name as u_name',
        'p.product_name as p_name',
        DB::raw('COUNT(r.id) AS return_count')
    ])
    ->groupBy('o.id', 'u.name', 'p.product_name')
    ->having('return_count', '>', '2');
    
    //SQL9
    $subQ9 = DB::table('order_items', 'oi')
    ->join('products as p', 'oi.product_id', '=', 'p.id')
    ->select('p.product_name', DB::raw('SUM(oi.quantity) AS total_sold'))
    ->whereColumn('p.category_id', 'p.category_id')
    ->groupBy('p.product_name');

    $sql9 = DB::table('products', 'p')
    ->join('order_items  as oi', 'oi.product_id', '=', 'p.id')
    ->select([
        'p.category_id',
        'p.product_name as p_name',
        DB::raw('SUM(oi.quantity) AS total_sold')
    ])
    ->havingRaw('total_sold = (SELECT MAX(sub.total_sold) FROM (' . $subQ9->toSql() . ') as sub)')
    ->groupBy('p.category_id', 'p.product_name');
    
    //SQL10
    $sql10=DB::table('users', 'u')
    ->join('orders as o', 'o.user_id', '=', 'u.id')
    ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
    ->select([
        'users.name as u_name',
        DB::raw('SUM(oi.quantity * oi.price) AS total_spent')
    ])
    ->groupBy('u.name')
    ->orderByDesc('total_spent')
    ->limit(10);

    dd($sql1->toRawSql(), 
            $sql2->toRawSql(), 
            $sql3->toRawSql(),
            $sql4->toRawSql(), 
            $sql5->toRawSql(), 
            $sql6->toRawSql(),
            $sql7->toRawSql(),
            $sql8->toRawSql(),
            $sql9->toRawSql(),
            $sql10->toRawSql()
        );
    echo 1;
});

//trang insert
Route::get('/insert-post', function () {
    return view('admin/insert-post');
});
