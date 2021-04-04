<div class="col-8 m-auto">
    <div class="container-fluid mt-4">
        <form  method="post" id="user">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" value="<?php echo $this->content['content'][0]['nome'] ?? '' ?>" class="form-control" id="nome" placeholder="Digite seu nome..." required>
                </div>
                <div class="form-group col-md-6">
                    <label for="nome">Endereço</label>
                    <input type="text" name="endereco" value="<?php echo $this->content['content'][0]['endereco'] ?? '' ?>" class="form-control" placeholder="Endereço" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" value="<?php echo $this->content['content'][0]['email'] ?? '' ?>" name="email" id="inputEmail4" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Senha</label>
                    <input type="password" class="form-control" name="senha" id="inputPassword4" placeholder="Senha">
                    <input type="text" name="id" value="<?php echo $this->content['content'][0]['id'] ?? '' ?>" hidden>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Telefone</label>
                    <input type="text" class="form-control" id="" value="<?php echo $this->content['content'][0]['telefone'] ?? '' ?>" name="telefone" placeholder="Telefone">
                </div>
                <div class="form-group col-md-6">
                    <label for="republica">Republica</label>
                    <select id="republica" name="republica" class="form-control select2">
                        <?php
                            if(isset($this->content['content'][0]['cod_republica'])){
                                echo "<option value=".$this->content['content'][0]['cod_republica']." selected>".$this->content['content'][0]['republica']."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Criar</button>
        </form>
    </div>
</div>