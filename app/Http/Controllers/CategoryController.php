<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequests\StoreRequest;
use App\Http\Requests\CategoryRequests\UpdateRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index')->with('categories',Category::all());
    }

    public function get_data(){
        /*tablodaki tüm verilere erismek istiyorsak*/
       //  $category = DB::table('categories')->get();
        /*eger sadece tek bir satır dondurmek istiyorsak*/
        // $category = DB::table('categories')->where('name','category6')->first();
        return view('test')->with('category',$category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        /* $data = $request->all();
      $category = new Category();
      $category->name = $data['name'];
      $category->save();*/

      Category::create([
        'name'=>$request->name,
    ]);

    session()->flash('success','category added');
    return redirect(route('categories.index'));
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
    public function edit(Category $category)
    {
          //$category = Category::find($id); //seklinde id alınabilir
          return view('category.create')->with('categoryEdit',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $category->update([
            'name'=>$request->name,
        ]);

        session()->flash('success','Category Updated!');
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->posts->count() > 0){
            session()->flash('warning','Category can not delete because it related one post or many post ');
            return redirect()->back();
        }

        $category->delete();
        session()->flash('info','Category removed');
        return redirect(route('categories.index'));
    }
}
