<?php


namespace App\Controller;

use App\Core\View;
use App\Model\Post\PostRepository;

class HomeController
{

    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    public function indexAction()
    {
        $posts = $this->postRepository->getList();
        $view = new View();
        $data = [
            'posts' => $posts,
        ];
        $view->render('index', $data);
    }
}