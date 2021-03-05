<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaveCategoryRequest;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function index(){

        $cates = Category::all();
        return view('backend.cates.index',compact('cates'));
    }
    public function create(){
        return view('backend.cates.add-form');
    }

    public function store(SaveCategoryRequest $request){
        $model = new Category();

        if($request->hasFile('logo')){
            $fileName = uniqid().'_'.$request->logo->getClientOriginalName();
            $filePath = $request->file('logo')->storeAs('uploads', $fileName, 'public');
            $model->logo = 'storage/'.$filePath;
        }

        $model->name = $request->name;
        $model->save();
        return redirect(route('cate.index'));
    }

    public function destroy($id){
        Category::destroy($id);
        return redirect(route('cate.index'));
    }

    public function edit($id){
        $model = Category::find($id);
        if(!$model) return redirect(route('cate.index'));

        return view('backend.cates.edit-form', ['model' => $model]);
    }

    public function update($id,SaveCategoryRequest $request){
        $model = Category::find($id);
        $model->name = $request->name;
        if($request->hasFile('logo')){
            $fileName = uniqid().'_'.$request->logo->getClientOriginalName();
            $filePath = $request->file('logo')->storeAs('uploads', $fileName, 'public');
            $model->logo = 'storage/'.$filePath;
        }
        $model->save();
        return redirect(route('cate.index'));
    }


    public function cateDetail($id){
        $cate = Category::find($id);
        $posts = Post::where('cate_id',$id)->orderBy('created_at')->paginate(10);
        return view('pages.cate-detail',['posts'=>$posts,'cate'=>$cate]);
    }
}