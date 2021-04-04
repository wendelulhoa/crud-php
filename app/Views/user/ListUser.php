<div class="col-10 m-auto">
    <div class="container-fluid mt-4">
        <table class="table col-12 m-auto" id="users">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Republica</th>
                    <th scope="col">Endereço</th>
                    <th colspan="2"></th>

                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($this->content['users']) && count($this->content['users']) > 0){
                        foreach ($this->content['users'] as $key => $value) {
                            echo '
                                <tr class="person-'.$value['id'].'">
                                    <th scope="row">' . $value['position'] . '</th>
                                    <td>' . $value['nome'] . '</td>
                                    <td>' . $value['email'] . '</td>
                                    <td>' . $value['telefone'] . '</td>
                                    <td>' . $value['republica'] . '</td>
                                    <td>' . $value['endereco'] . '</td>
                                    <td ><a class="delete" href="'.DIRPAGE.'user/delete/'.$value['id'].'" id="'.$value['id'].'" style="color:red"><i class="fas fa-trash-alt"></i></a></td>
                                    <td><a class="edit" href="'.DIRPAGE.'user/edit/'.$value['id'].'"><i class="fas fa-edit"></i></a></td>
                                </tr> 
                            ';
                        }
                    }else{
                        echo "<tr><td colspan='2'>Não a registros</td></tr>";
                    }
                ?>


            </tbody>
        </table>
    </div>
</div>