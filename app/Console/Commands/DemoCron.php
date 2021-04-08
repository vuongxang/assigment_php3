<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use App\Models\Post;
use Exception;
use Goutte\Client;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        $client = new Client();
        $crawler = $client->request('GET', 'https://vnexpress.net/tin-tuc-24h');
        try{
            $crawler->filter('div.list-news-subfolder > article.item-news')->each(function ($node) {
                $a = $node->filter('h3.title-news>a');
                $img = $node->filter('div.thumb-art img');
                $src = $img->extract(array('src'));
                $href = $a->extract(array('href'));
                var_dump($href);
                // var_dump($href);
                    $cates = Category::all();

                    $client1 = new Client();
                    $crawlerPost = $client1->request('GET', $href[0]);
                    $title = $crawlerPost->filter('h1.title-detail')->text();
                    $cate_name = $crawlerPost->filter('ul.breadcrumb li')->text();
                    $cate_id = 1;
                    $cate = Category::where('name','like',"%".$cate_name."%")->first();
                    if($cate) $cate_id = $cate->id;

                    $image = $src[0];
                    $short_desc = $crawlerPost->filter('p.description')->text();
                    $content = $crawlerPost->filter('article.fck_detail')->html();
                    $author = $crawlerPost->filter('p.author_mail>strong')->text();
                    $model = new Post();
                    $model->title = $title;
                    $model->image = $image;
                    $model->short_desc = $short_desc;
                    $model->content = $content;
                    $model->author = $author;
                    $model->cate_id = $cate_id;
                    $check_title = Post::where('title','like',"%".$title."%")->first();
                    var_dump($check_title);
                    if(!$check_title){
                        $model->save();
                    }
            });
    
        }catch(Exception $e){

        }
        // $client = new Client();
        // $crawler = $client->request('GET', 'https://dantri.com.vn/the-thao.htm');

        // $crawler->filter('ul.dt-list > li > div.news-item')->each(function ($node) {
        //     $a = $node->filter('a.news-item__avatar');
        //     $img = $node->filter('div.dt-thumbnail > img');
        //     $images = $img->extract(array('src'));
        //     $href = $a->extract(array('href'));
        //     echo "<pre>";
        //     var_dump($images);
   
        //     foreach($href as $key => $item){
        //         $client1 = new Client();
        //         $postUrl = 'https://dantri.com.vn/'.$item;
        //         $crawlerPost = $client1->request('GET', $postUrl);
        //         $title = $crawlerPost->filter('h1.dt-news__title')->text();
        //         $short_desc = $crawlerPost->filter('div.dt-news__sapo > h2')->text();
        //         $content = $crawlerPost->filter('div.dt-news__content')->html();
        //         // var_dump($content);die;
        //          $model = new Post();

        //          $model->title = $title;
        //          $model->short_desc = $short_desc;
        //          $model->content = $content;
        //          $model->author = "Vuong";
        //          $model->image = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBI21FVjcM5YktkfflEZd52qXQDiuCoV4Ciw&usqp=CAU";
        //          $model->cate_id = 2;
        //         //  $model->save();
        //     }           
        // });
        $this->info('Demo:Cron Cummand Run successfully!');
    }
}
