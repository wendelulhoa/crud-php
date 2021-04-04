<div class="col-10 m-auto">
    <div class="container-fluid mt-4">
        <table class="table col-8 m-auto" id="republica">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereco</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($this->content['users']) && count($this->content['users']) > 0){
                        foreach ($this->content['users'] as $key => $value) {
                            echo '
                                <tr">
                                    <th scope="row">' . $value['id'] . '</th>
                                    <td>' . $value['nome'] . '</td>
                                    <td>' . $value['endereco'] . '</td>
                                    <td><a class="edit" href="'.DIRPAGE.'republica/edit/'.$value['id'].'"><i class="fas fa-edit"></i></a></td>
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