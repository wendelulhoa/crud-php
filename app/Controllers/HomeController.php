<?php 
namespace App\Controllers;

use App\Models\User;

class HomeController{

    public function __construct()
    {
        $user = new User();
        $result = $user->getAllUsers();
        View::view('user/ListUser', ['users'=>$result ]);
    }
}