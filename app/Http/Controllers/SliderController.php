<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slider=Slider::orderBy('id','DESC')->paginate(2);
        return view('admin.slider.index',compact('slider')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title'=> 'required|max:255',
                'description'=> 'required|max:255',
                'status'=> 'required',
            ],
            [
                'title.unique'=>'tên slider đã có, xin điền tên khác',
                'title.required'=>'xin điền tên slider',
                'description.required'=>'xin điền mô tả slider',
            ]
            );        
        $slider=  new Slider();
        $slider->title = $data['title'];
        $slider->description = $data['description'];
        $slider->status = $data['status'];
        $get_image = $request->image;
        $path = 'uploads/slider/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $slider->image = $new_image;
        $slider->save();
        return redirect()->route('slider.index')->with('status','thêm slider thành công');
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
        $slider = Slider::find($id);
        return view('admin.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'title'=> 'required|max:255',
                'description'=> 'required|max:255',
                'status'=> 'required',
            ],
            [
                'title.unique'=>'tên slider đã có, xin điền tên khác',
                'title.required'=>'xin điền tên slider',
                'description.required'=>'xin điền mô tả slider',
            ]
            );        
        $slider=  Slider::find($id);
        $slider->title = $data['title'];
        $slider->description = $data['description'];
        $slider->status = $data['status'];
        $get_image = $request->image;
        if($get_image){
            $path_unlink = 'uploads/slider/'.$slider->image;
            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
            $path = 'uploads/slider/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $slider->image = $new_image;
        }
        $slider->save();
        return redirect()->route('slider.index')->with('status','cập nhập slider thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::find($id);
        $path_unlink = 'uploads/slider/'.$slider->image;
        if(file_exists($path_unlink)){
            unlink($path_unlink);
        }
        $slider->delete();
        return redirect()->back();
    }
}
