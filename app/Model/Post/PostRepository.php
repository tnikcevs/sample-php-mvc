<?php

namespace App\Model\Post;

use App\Core\Db;

class PostRepository
{
    public function getList()
    {
        $list = [];
        $db = Db::getInstance();
        $statement = $db->prepare(
            'select id, content, date from post'
        );

        $statement->execute();
        $fetched = $statement->fetchAll();
        foreach ($fetched as $post) {
            $list[] = new Post([
                'id' => $post->id,
                'date' => $post->date,
                'content' => $post->content,
            ]);
        }

        return $list;
    }
}