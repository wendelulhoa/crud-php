<?php 
namespace App\Controllers;
use App\Controllers\View;
use App\Models\User;
use Exception;

class UserController {
    public function create($verify = null){
        try{
            $user = new User();
            $request = $_POST;
            View::view('user/CreateUser',['route'=> DIRPAGE.'user/create/0']);
            if($verify != null){
                $user->create($request);
                header('Location: '.DIRPAGE.'user/list');
            }

        }catch(Exception $e){

        }
    }
    
    public function list($user = null){
        $user = new User();
        $result = $user->getAllUsers();
        View::view('user/ListUser', ['users'=>$result ]);
    }

    public function edit($id = null){
        if($id != null){
            $user = new User();
            $result = $user->getUser($id);
            View::view('user/CreateUser',['content'=> $result ,'route'=> DIRPAGE.'user/update']);
        }else{
            header('Location: '.DIRPAGE.'user/list');
        }
    }

    public function delete($id){
        $user = new User();
        $user->delete($id);
    }

    public function update($id = null){
        if($id != null){
            $user = new User();
            $request = $_POST;
            $user->update($id, $request);
            header('Location: '.DIRPAGE.'user/list');
        }else{
            header('Location: '.DIRPAGE.'user/list');
        }
        
    }
}