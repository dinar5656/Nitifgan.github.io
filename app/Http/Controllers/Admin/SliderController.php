<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Requests\SliderFormRequest;


class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }
    public function create()
    {
        return view('admin.slider.create');
    }
    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->has('status') ? '1' : '0';
        if($request->hasFile('image')){
            $file =  $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() .'.'. $ext;
            $file->move('uploads/slider/', $filename);
            $validatedData['image'] = "uploads/slider/$filename";
        }
        $validatedData['status'] = $request->status == true ? '1':'0';
        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status'],
        ]);
        return redirect('admin/sliders')->with('message','Sliders Add Success');
    }
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit',compact('slider'));
    }
    public function update(SliderFormRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();
        if($request->hasFile('image')){
            $destination = $slider->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file =  $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() .'.'. $ext;
            $file->move('uploads/slider/', $filename);
            $validatedData['image'] = "uploads/slider/$filename";
        }
        $validatedData['status'] = $request->status == true ? '1':'0';
        Slider::where('id', $slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? $slider->image,
            'status' => $validatedData['status'],
        ]);
        return redirect('admin/sliders')->with('message','Sliders Update Success');
    }
    public function destroy(Slider $slider)
    {
        if($slider->count() > 0){
            $destination = $slider->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $slider->delete();
            return redirect('admin/sliders')->with('message','Sliders Deleted Success');
        }
        return redirect('admin/sliders')->with('message','Something Went Wrong');
    }
}
