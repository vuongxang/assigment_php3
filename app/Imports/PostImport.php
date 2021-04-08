<?php

namespace App\Imports;

use App\Xxx;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Post;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class PostImport implements ToModel,WithValidation
{
    use Importable;
    /**
     * @param array $row
     *
     * @return Xxx|null
     */
    public function model(array $row)
    {
        $post = Post::create([
           'title' => $row[1],
           'image' => $row[2], 
           'content' => $row[3], 
           'short_desc' => $row[4], 
           'author' => $row[5], 
           'cate_id' => $row[6] 
        ]);
    }
    public function rules(): array
    {
        return [
            '1' => 'unique:posts,title',
        ];
    }
}