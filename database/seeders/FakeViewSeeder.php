<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Carbon;
use App\Models\PostView;
use Faker;
class FakeViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1 lấy ra 20 bài viết cuối cùng
        // tạo vòng lặp cho từng bài viết
        // tạo vòng lặp 10 lần
        // trong mỗi vòng lặp lấy ngày hôm nay trừ đi 1
        // tạo object view
        // set thuộc tính cho object view như post_id, random views
        // set thuộc tính created_at là ngày vừa fake ra
        // lưu xuống

        $posts = Post::orderby('id','DESC')->take(20)->get();
        foreach($posts as $key=>$item){
            for($i=10;$i>0;$i--){
                $date = Carbon::now()->subDays($i)->format('Y-m-d h:i:s');
                $model = new PostView();
                $model->post_id = $item->id;
                $model->views = rand(10,500);
                $model->created_at = $date;
                $model->save();
            }
        }
    }
}
