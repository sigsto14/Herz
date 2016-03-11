<?php

namespace App\Http\Controllers;

use App\User;
use App\Channel;
use App\Sound;
use App\Favorite;
use App\Category;
use Auth;
use Fetch;
use Validator;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Symfony\Component\HttpFoundation\File;
use Eloquent;
use Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
/* skapa cathegory */
        $validator = Validator::make($request->all(), [
                'categoryname' => 'required|unique:category|max:15',
            ]);

          if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();

          }

       $category = new Category();
       $category->categoryname = $request->get('categoryname');
       $category->save();

       return back()
            ->withMessage('Kategori {{ $category->categoryname }} tillagd!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
/* gör en variabel så man inte kan radera någon kategori om något sound ligger på kategorin */
        
        $delete = $request->get('categoryID');
       
        $check = DB::table('sounds')->where('categoryID', '=', $delete)->first();

        if(is_null($check)){
            $category = Category::where('categoryID', '=', $delete);
          $category->delete();
        return back()->withMessage('Kategori raderad!');
    }
        else{
            return back()->withMessage('Kategori i användning!');
        }

    }
}
