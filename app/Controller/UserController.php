<?php

namespace App\Controller;

use App\Core\Config;
use App\Core\View;
use App\Core\Session;
use App\Model\User\UserRepository;
use App\Model\User\UserResource;

class UserController
{

    public function loginAction()
    {
        $view = new View();
        $view->render('login');
    }

    public function registerAction()
    {
        $session = Session::getInstance();
        // check if user exists, redirect to home
        $view = new View();
        $view->render('register');
    }

    public function registerSubmitAction()
    {
        $submittedData = $_POST;
        // check data submitted
        if (!$_POST['email'] || !$_POST['firstname'] || !$_POST['lastname'] || !$_POST['pass'])
        {
            return;
        }

        // check if user exists

        // insert user
        $resource = new UserResource();
        $resource->insertUser($submittedData);
        $url = Config::get('url') . 'user/login';
        // header('Location ' . $url);
    }

    public function loginSubmitAction()
    {
        $postData = $_POST;

        // check if submit data is missing
        $email = $postData['email'] ?? null;
        $pass = $postData['pass'] ?? null;
        if (!$email || !$pass) {
            return;
        }

        // check if user with this email exists
        $userRepo = new UserRepository();
        $user = $userRepo->getUserByEmail($email);
        // check password
        $databasePassword = $user->getPass();
        if(!password_verify($pass, $databasePassword))
        {
            return;
        }
        // set user to session

    }
}