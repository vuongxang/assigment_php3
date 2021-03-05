<?php

namespace App\Imports;

use App\Xxx;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Post;

class PostImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Xxx|null
     */
    public function model(array $row)
    {
        return new Post([
           'title' => $row[1],
           'image' => $row[2], 
           'content' => $row[3], 
           'short_desc' => $row[4], 
           'author' => $row[5], 
           'cate_id' => $row[6] 
        ]);
    }
}