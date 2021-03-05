<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
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
        $crawler = $client->request('GET', 'https://dantri.com.vn/the-thao.htm');

        $crawler->filter('ul.dt-list > li > div.news-item')->each(function ($node) {
            $a = $node->filter('a.news-item__avatar');
            $img = $node->filter('div.dt-thumbnail > img');
            $images = $img->extract(array('src'));
            $href = $a->extract(array('href'));
            echo "<pre>";
            var_dump($images);
   
            foreach($href as $key => $item){
                $client1 = new Client();
                $postUrl = 'https://dantri.com.vn/'.$item;
                $crawlerPost = $client1->request('GET', $postUrl);
                $title = $crawlerPost->filter('h1.dt-news__title')->text();
                $short_desc = $crawlerPost->filter('div.dt-news__sapo > h2')->text();
                $content = $crawlerPost->filter('div.dt-news__content')->html();
                // var_dump($content);die;
                 $model = new Post();

                 $model->title = $title;
                 $model->short_desc = $short_desc;
                 $model->content = $content;
                 $model->author = "Vuong";
                 $model->image = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBI21FVjcM5YktkfflEZd52qXQDiuCoV4Ciw&usqp=CAU";
                 $model->cate_id = 2;
                //  $model->save();
            }           
        });
        $this->info('Demo:Cron Cummand Run successfully!');
    }
}
