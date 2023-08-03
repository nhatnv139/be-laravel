<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function __construct()
    {
    }
    public function index(Request $request)
    {
        // $request = new Request();

        // $allData = $request->all();
        // echo $allData['id'];
        // dd($allData);
        if ($request->isMethod('GET')) {
            echo 'Phương thức Get';
        }
        // $header = $request->header();

        $user =  DB::select('SELECT * FROM user WHERE id > ?', [1]);
        dd($user);
        return view('clients/category/list');
    }
    public function getCategory($id)
    {
        return 'chi tiết chuyên  mục: ' . $id;
    }

    // public function updateCategory($id){

    // }
    // public function addCategory(){
    //     return "addCategory";

    // }
    // public function handelAddCategory(){

    // }public function deletedCategory(){

    // }
}
