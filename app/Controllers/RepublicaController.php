<?php 
namespace App\Controllers;
use App\Controllers\View;
use App\Models\Republica;
use Exception;

class RepublicaController {
    public function create($verify = null){
        try{
            $request = $_POST;
            $create = new Republica();
            
            View::view('republica/CreateRepublica', ['route'=> DIRPAGE.'republica/create/0']);
            if($verify != null){
                $create->create($request['nome'], $request['endereco']);
                header('Location: '.DIRPAGE.'republica/list');
            }
        }catch(Exception $e){

        }
        
    }
    
    public function list(){
        $list   = new Republica();
        $result = $list->getAllRepublics();
        View::view('republica/ListRepublica', ['users'=>$result ]);
    }

    public function getAllRepublics(){/*retorna um json com todas republicas*/
        $list   = new Republica();
        $result = $list->getAllRepublics();
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function edit($id = null){
        if($id != null){
            $edit = new Republica();
            $result = $edit->getRepublic($id); 
            View::view('republica/CreateRepublica',['content'=> $result ,'route'=> DIRPAGE.'republica/update']);
        }else{
            header('Location: '.DIRPAGE.'republica/list');
        }
    }

    public function delete($id){
        $delete = new Republica();
        $delete->delete($id);
    }

    public function update($id = null){
        if($id != null){
            $update = new Republica();
            $request = $_POST;
            $update->update($id, $request);
            header('Location: '.DIRPAGE.'republica/list');
        }else{
            header('Location: '.DIRPAGE.'republica/list');
        }
        
    }
}