<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::orderBy('id','DESC')->paginate(5);
        return view('admin.category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data = $request->validate(
            [
                'title'=> 'required|max:255',
                'slug'=> 'required|max:255',
                'description'=> 'required|max:255',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'status'=> 'required',
            ],
            [
                'title.unique'=>'tên danh mục game đã có, xin điền tên khác',
                'title.required'=>'xin điền tên danh mục game',
                'slug.unique'=>'slug danh mục game đã có, xin điền tên khác',
                'slug.required'=>'xin điền slug danh mục game',
                'description.required'=>'xin điền mô tả danh mục game',
                'image.required'=>'xin chọn hình ảnh danh mục game',
            ]
            );
        $category= new Category();
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $get_image = $request->image;
        $path = 'uploads/category/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $category->image = $new_image;
        $category->save();
        return redirect()->route('category.index')->with('status','thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'title'=> 'required|max:255',
                'slug'=> 'required|max:255',
                'description'=> 'required|max:255',
                'status'=> 'required',
            ],
            [
                'title.unique'=>'tên danh mục game đã có, xin điền tên khác',
                'title.required'=>'xin điền tên danh mục game',
                'slug.unique'=>'slug danh mục game đã có, xin điền tên khác',
                'slug.required'=>'xin điền slug danh mục game',
                'description.required'=>'xin điền mô tả danh mục game',
            ]
            );        
        $category=  Category::find($id);
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $get_image = $request->image;
        if($get_image){
            $path_unlink = 'uploads/category/'.$category->image;
            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
            $path = 'uploads/category/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $category->image = $new_image;
        }
        $category->save();
        return redirect()->route('category.index')->with('status','cập nhập danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $path_unlink = 'uploads/category/'.$category->image;
        if(file_exists($path_unlink)){
            unlink($path_unlink);
        }
        $category->delete();
        return redirect()->back();
    }
}
