<?php
namespace App\Models;
use App\Models\Model;
use Exception;
use PDOException;

class User extends Model{
    
    /**
     * @param $id = id estudante
     * @return void
     */
    public function getUser($id){
        try{
            $bfetch = $this->connection()->query("SELECT ".DB.".estudante.email, ".DB.".estudante.cod_republica, ".DB.".pessoa.nome, ".DB.".pessoa.id,
            ".DB.".pessoa.endereco, ".DB.".republica.nome as republica, ".DB.".telefone.numero
            FROM ".DB.".estudante 
            INNER JOIN ".DB.".pessoa ON ".DB.".estudante.cod_pessoa= ".DB.".pessoa.id
            INNER JOIN ".DB.".republica ON ".DB.".republica.id= ".DB.".estudante.cod_republica
            INNER JOIN ".DB.".telefone ON ".DB.".telefone.cod_pessoa= ".DB.".pessoa.id
            where ".DB.".pessoa.id = $id;");
            $bfetch->execute();
            if(!empty($bfetch->errorInfo()[2])){
                throw new Exception($this->connection()->errorInfo()[2]);
            }
            $i     = 0;
            $array = [];

            while($fetch = $bfetch->fetch(\PDO::FETCH_ASSOC)){
                $array[$i] = ['id'=>$fetch['id'],'nome'=> $fetch['nome'], 'endereco'=> $fetch['endereco'], 'email'=>$fetch['email'], 'republica'=>$fetch['republica'],'cod_republica'=>$fetch['cod_republica'], 'telefone'=>isset($fetch['numero']) ? $fetch['numero'] : ''];
                $i++;
            }
            return $array;
        }catch(Exception $e){
            echo $e;
        }
    }
    
    public function getAllUsers(){
        try{
            $bfetch = $this->connection()->prepare
            ("SELECT ".DB.".estudante.email, ".DB.".estudante.cod_republica, ".DB.".pessoa.nome, ".DB.".pessoa.id,
            ".DB.".pessoa.endereco, ".DB.".republica.nome as republica, ".DB.".telefone.numero
            FROM ".DB.".estudante
            INNER JOIN ".DB.".pessoa ON ".DB.".estudante.cod_pessoa = ".DB.".pessoa.id
            INNER JOIN ".DB.".republica ON ".DB.".republica.id      = ".DB.".estudante.cod_republica
            INNER JOIN ".DB.".telefone ON ".DB.".telefone.cod_pessoa= ".DB.".pessoa.id;");
            $bfetch->execute();
            if(!empty($bfetch->errorInfo()[2])){
                throw new Exception($this->connection()->errorInfo()[2]);
            }
            $i = 0;
            $index = 1;
            $array = [];
            while($fetch = $bfetch->fetch(\PDO::FETCH_ASSOC)){
                $array[$i] = ['id'=>$fetch['id'],'nome'=> $fetch['nome'], 'endereco'=> $fetch['endereco'], 'email'=>$fetch['email'], 'republica'=>$fetch['republica'], 'telefone'=>$fetch['numero'], 'position'=> $index ];
                $i++;
                $index++;
            }
            return $array;
        }catch(Exception $e){
            echo 'ocorreu um erro';
        }
    }

     /**
     * @param $content = conteudo para gravar no banco
     * @return void
     */
    public function create($content){
       try{
        $this->connection()->beginTransaction();
        
        $stmt = $this->connection()->prepare("insert into ".DB.".pessoa (nome, endereco) values(:nome, :endereco)");
        $stmt->bindParam(":nome", $content['nome'], \PDO::PARAM_STR);
        $stmt->bindParam(":endereco", $content['endereco'], \PDO::PARAM_STR);
        $stmt->execute();

        /*pega o id que foi salvo*/
        $stmt = $this->connection()->query("SELECT * FROM ".DB.".pessoa;");
        $stmt->execute();

        $id = [];
        while($fetch = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $id[]= $fetch['id']; 
        }
        $id = $id[count($id) - 1];
        $content['email'] = isset($content['email']) ? $content['email'] : '';
        /*salva tabela de estudante*/
        $stmt = $this->connection()->prepare("INSERT INTO ".DB.".estudante (email, cod_pessoa, cod_republica)
        VALUES (:email, :cod_pessoa , :cod_republica);");
        $stmt->bindParam(":email", $content['email'], \PDO::PARAM_STR);
        $stmt->bindParam(":cod_pessoa", $id , \PDO::PARAM_INT);
        $stmt->bindParam(":cod_republica", $content['republica'], \PDO::PARAM_INT);
        $stmt->execute();

        $content['telefone'] = isset( $content['telefone']) ?  $content['telefone'] : '';

        $stmt = $this->connection()->prepare("insert into ".DB.".telefone (numero, cod_pessoa) values(:numero, :cod_pessoa)");
        $stmt->bindParam(":numero", $content['telefone'], \PDO::PARAM_STR);
        $stmt->bindParam(":cod_pessoa", $id, \PDO::PARAM_INT);
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
     * @param $id = id do estudante 
     * @return void
     */
    public function delete($id){
        
        try{
        
            $stmt = $this->connection()->prepare("DELETE FROM ".DB.".pessoa WHERE (`id` = $id);");
            $stmt->execute();

            $stmt = $this->connection()->prepare("DELETE FROM ".DB.".estudante WHERE (`cod_pessoa` = $id);");
            $stmt->execute();

            $content['telefone'] = isset( $content['telefone']) ?  $content['telefone'] : '';
            $stmt = $this->connection()->prepare("DELETE FROM ".DB.".telefone WHERE (`cod_pessoa` = $id);");
            $stmt->execute();

            if(!empty($this->connection()->errorInfo()[2])){
                throw new Exception($this->connection()->errorInfo()[2]);
            }
            
        }catch(\Throwable $e){
            throw $e;
            echo 'aa';
        }
    }
    public function update($id, $content){
        try{
            $stmt = $this->connection()->prepare("UPDATE ".DB.".pessoa SET nome = '".$content['nome']."', endereco = '".$content['endereco']."' WHERE (`id` = $id);");
            $stmt->execute();

            $stmt = $this->connection()->prepare("UPDATE ".DB.".estudante SET email = '".$content['email']."', cod_republica = '".$content['republica']."' WHERE (`id` = $id);");
            $stmt->execute();

            $stmt = $this->connection()->prepare("UPDATE ".DB.".telefone SET numero = '".$content['telefone']."' WHERE (`cod_pessoa` = $id);");
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