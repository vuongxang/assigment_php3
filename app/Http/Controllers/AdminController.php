<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostView;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $postsCount = Post::all()->count();
        $catesCount = Category::all()->count();
        $views = PostView::all()->sum('views');

        $arrDay=[];
        $arrDayNames = [];
        for($i=0;$i<7;$i++){
            $now = Carbon::now();
            $arrDay[$i] = $now->subDay($i);
            $arrDayNames[$i] = $arrDay[$i]->format('D');
        }

        $arrViewDatas = [];
        foreach($arrDay as $key=> $item){
            $model = PostView::where('created_at', '>=', $item->format('Y-m-d'). " 00:00:00")
                                ->where('created_at', '<=', $item->format('Y-m-d'). " 23:59:59")
                                ->sum('views');
            $arrViewDatas[$key] = $model;
        }
        return view('backend.dashboard',compact('postsCount','catesCount','views','arrDayNames','arrViewDatas'));
    }


    public function dayData(){
        $arrDayNames = [];
        for($i=0;$i<7;$i++){
            $now = Carbon::now();
            $arrDay[$i] = $now->subDay($i);
            $arrDayNames[$i] = $arrDay[$i]->format('D');
        }

        return response()->json($arrDayNames);
    }

    public function viewsData(){
        $arrDay=[];
        for($i=0;$i<7;$i++){
            $now = Carbon::now();
            $arrDay[$i] = $now->subDay($i);
        }

        $arrViewDatas = [];
        foreach($arrDay as $key=> $item){
            $model = PostView::where('created_at', '>=', $item->format('Y-m-d'). " 00:00:00")
                                ->where('created_at', '<=', $item->format('Y-m-d'). " 23:59:59")
                                ->sum('views');
            $arrViewDatas[$key] = $model;
        }

        return response()->json($arrViewDatas);
    }
}
