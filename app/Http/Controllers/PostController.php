<?php

namespace App\Http\Controllers;

use App\Exports\PostExport;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\SavePostRequest;
use App\Imports\PostImport;
use App\Models\PostView;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    public function index(){
        $posts = Post::paginate(10);
        $posts->load('category');
        return view('backend.posts.index',compact('posts'));
    }
    public function create(){
        $cates = Category::all();
        return view('backend.posts.add-form',compact('cates'));
    }

    public function store(SavePostRequest $request){
        $model = new Post();
        $model->fill($request->all());
        if($request->hasFile('image')){
            $fileName = uniqid().'_'.$request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
            $model->image = 'storage/'.$filePath;
        }
        $model->save();
        return redirect(route('post.index'));
    }

    public function destroy($id){
        Post::destroy($id);
        return redirect(route('post.index'));
    }

    public function edit($id){
        $cates = Category::all();
        $model = Post::find($id);
        if(!$model) return redirect(route('post.index'));
        return view('backend.posts.edit-form', ['model' => $model,'cates'=>$cates]);
    }

    public function update($id,SavePostRequest $request){
        $model = Post::find($id);
        $model->fill($request->all());
        if($request->hasFile('image')){
            $fileName = uniqid().'_'.$request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
            $model->image = 'storage/'.$filePath;
        }
        $model->save();
        return redirect(route('post.index'));
    }

    public function detail($id){
        $model = Post::find($id);
        $totalViews = PostView::where('post_id', $id)->sum('views');
        $posts = Post::where('cate_id',$model->cate_id)->take(6)->get();
        return view('pages.post-detail',['model'=>$model,'totalViews'=>$totalViews,'posts'=>$posts]);
    }

    public function tangView(Request $request){
        // 1 kiểm tra xem có views của sản phẩm đang cần tìm trong ngày hôm nay không ?
        // nếu có thì tăng view
        // nếu không có thì tạo mới và add views = 1
        $today = Carbon::today()->format('Y-m-d');
        $postView = PostView::where('post_id', $request->id)
                                ->where('created_at', '>=', $today . " 00:00:00")
                                ->where('created_at', '<=', $today . " 23:59:59")
                                ->first();
        if($postView){
            $postView->views += 1;
        }else{
            $postView = new PostView();
            $postView->post_id = $request->id;
            $postView->views = 1;
        }
        $postView->save();
        return response()->json($postView);
    }


    public function exportPost() 
       {
           return Excel::download(new PostExport, 'xxx.xlsx'); //download file export
           return Excel::store(new PostExport, 'xxx.xlsx', storage_path('excel/exports')); //lưu file export trên ổ cứng
       }


       public function import(Request $request) 
    {
        if($request->hasFile('post_file')){
            $fileName = uniqid().'_'.$request->post_file->getClientOriginalName();
            $filePath = $request->file('post_file')->storeAs('uploads', $fileName, 'public');
            $post_file = 'storage/'.$filePath;
        }

        Excel::import(new PostImport, $post_file);

        return redirect()->route('post.index');
    }
}