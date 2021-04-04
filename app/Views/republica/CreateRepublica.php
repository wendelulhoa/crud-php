<div class="col-8 m-auto">
    <div class="container-fluid mt-4">
        <form id="republica" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Endereco</label>
                    <input type="text" class="form-control" id="" value="<?php echo $this->content['content'][0]['endereco'] ?? '' ?>" name="endereco" placeholder="Endereço" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="nome">nome</label>
                    <input type="text" name="nome" value="<?php echo $this->content['content'][0]['nome'] ?? '' ?>" class="form-control" id="nome" placeholder="Digite seu nome..." required>
                </div>
            </div>       
            <button type="submit" class="btn btn-primary">Criar</button>
        </form>
    </div>
</div>