<?php
namespace App\Models;
use App\Models\Model;
use Exception;
use PDOException;

class Republica extends Model{

    /**
     * @param $id = id republica
     * @return void
     */
    public function getRepublic($id){
        try{
            $bfetch = $this->connection()->query("SELECT * FROM ".DB.".republica where id =".$id.";");
            $bfetch->execute();
            if(!empty($bfetch->errorInfo()[2])){
                throw new Exception($this->connection()->errorInfo()[2]);
            }
            $i = 0;
            $array = [];
            while($fetch = $bfetch->fetch(\PDO::FETCH_ASSOC)){
                $array[$i] = ['id'=>$fetch['id'],'nome'=> $fetch['nome'], 'endereco'=> $fetch['endereco']];
                $i++;
            }
            return $array;
        }catch(Exception $e){
            echo $e;
        }
    }
    
    public function getAllRepublics(){
        try{
            $bfetch = $this->connection()->query("SELECT * FROM ".DB.".republica;");
            $bfetch->execute();
            if(!empty($bfetch->errorInfo()[2])){
                throw new Exception($this->connection()->errorInfo()[2]);
            }
            $i = 0;
            $array = [];
            while($fetch = $bfetch->fetch(\PDO::FETCH_ASSOC)){
                $array[$i] = ['id'=>$fetch['id'],'nome'=> $fetch['nome'], 'endereco'=> $fetch['endereco']];
                $i++;
            }
            return $array;
        }catch(Exception $e){
            return [];
        }
    }

    /**
     * @param $nome    = nome republica
     * @param $endereco= endereço republica
     * @return void
     */
    public function create($nome, $endereco){
       try{
        $this->connection()->beginTransaction();
        
        $stmt = $this->connection()->prepare("insert into ".DB.".republica (nome, endereco) values(:nome, :endereco)");
        $stmt->bindParam(":nome", $nome, \PDO::PARAM_STR);
        $stmt->bindParam(":endereco", $endereco, \PDO::PARAM_STR);
        $stmt->execute();

        $this->connection()->commit();
        if(!empty($this->connection()->errorInfo()[2])){
            throw new Exception($this->connection()->errorInfo()[2]);
        }
       }catch(Exception $e){
        $this->connection()->rollback();
       }
    }

    /**
     * @param $id      = id republica
     * @return void
     */
    public function delete($id){
        
        try{
            $stmt = $this->connection()->prepare("DELETE FROM ".DB.".republica WHERE (`id` = $id);");
            $stmt->execute();
            if(!empty($this->connection()->errorInfo()[2])){
                throw new Exception($this->connection()->errorInfo()[2]);
            }
            
        }catch(\Throwable $e){
            throw $e;
        }
    }

    /**
     * @param $id      = id republica
     * @param $content = conteudo
     * @return void
     */
    public function update($id, $content){
        try{
            $stmt = $this->connection()->prepare("UPDATE ".DB.".republica SET nome = '".$content['nome']."', endereco = '".$content['endereco']."' WHERE (`id` = $id);");
            $stmt->execute();
            if(!empty($this->connection()->errorInfo()[2])){
                throw new Exception($this->connection()->errorInfo()[2]);
            }
            
        }catch(\Throwable $e){
            echo $e;
        }
    }

}
?>