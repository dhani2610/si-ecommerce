<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Category';
        $data['category'] = Category::orderBy('id','desc')->get();
		return view('category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = new Category();
            $data->nama = $request->nama;
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/foto_category/');
                $image->move($destinationPath, $name);
                $data->foto = $name;
            }

            $data->save();
             return redirect()->back()->with('success','Data has been created');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed','Data Failed created');
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = Category::find($id);
            $data->nama = $request->nama;
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/foto_category/');
                $image->move($destinationPath, $name);
                $data->foto = $name;
            }

            $data->save();
             return redirect()->back()->with('success','Data has been updated');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed','Data Failed updated');
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = Category::find($id);
            $data->delete();

            return redirect()->back()->with('success','Data has been deleted');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed','Data Failed deleted');
         }
    }
}
