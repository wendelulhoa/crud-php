<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />  <title></title>
</head>

<body>
  <header>
    <nav class="navbar navbar-dark bg-primary navbar-expand-lg">
      <a class="navbar-brand" href="#">Projeção</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Inicio<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Estudantes
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo DIRPAGE;?>user/list">Todos Estudantes</a>
              <a class="dropdown-item" href="<?php echo DIRPAGE;?>user/create">Criar Estudante</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Republica
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo DIRPAGE;?>republica/list">Todas Republicas</a>
              <a class="dropdown-item" href="<?php echo DIRPAGE;?>republica/create">Criar Republica</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

  </header>
  <div class="alerts col-8 m-auto pt-3 ">
      
  </div>
  <div class="main">
    <?php echo $this->addMain() ?>
  </div>
  <div class="footer">

  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  

  <script>
        /*deleta um item*/
        $('#republica, #users').on('click', '.delete', function (e) {
          e.preventDefault();
          var elementTr = $(this);
          Swal.fire({
            title: 'Tem certeza que deseja excluir este registro?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'confirmar',
            cancelButtonText:'cancelar'
          }).then((result)=>{
            if(result.isConfirmed){
              $.ajax({
                url:$(this).attr('href'),
                success: function(){
                  elementTr.closest('tr').fadeOut();
                },
                error: function(){
                  
                }
              });
            }
          }); 

        });

        /*se for a rota de create de user ou edit pega as republicas via ajax*/
        if("<?php echo DIRPAGE;?>user/create" == window.location.href || "<?php echo isset($this->content['content'][0]['id']) ? DIRPAGE.'user/edit/'. $this->content['content'][0]['id'] : DIRPAGE;?>" == window.location.href){
          $(document).ready(function(){
            $.ajax({
              url: '<?php echo DIRPAGE.'republica/getAllRepublics';?>',
              success: function(data){
                for(i = 0; data.length > i; i++ ){
                  $('#republica').append(`<option value="${data[i]['id']}">${data[i]['nome']} | ${data[i]['endereco']}</option>`);
                }
                if(data.length == 0){
                  Swal.fire({
                    title: 'Não tem nenhum republica cadastrada, clique em confirmar e será redirecionado para o create!',
                    icon: 'error',
                    confirmButtonText: 'confirmar'
                  }).then((e)=>{
                    window.location.href = "<?php echo DIRPAGE?>republica/create";
                  })
                  
                }
              }
            })
            
         });
        }

        /*cadastra aluno ou republica via ajax*/
        $('form').submit(function(e){
          e.preventDefault();
          var route = '';
          switch($(this).attr('id')){
            case 'user':
              route = "<?php echo isset($this->content['route']) && isset($this->content['content'][0]['id']) ? $this->content['route'] . '/' . $this->content['content'][0]['id'] : $this->content['route'] ?? ''; ?>";
              break;
            case 'republica':
              route = "<?php echo isset($this->content['route']) && isset ($this->content['content'][0]['id']) ? $this->content['route'] .'/'. $this->content['content'][0]['id'] : $this->content['route'] ?? ''; ?>";
              break;
          }
          $.ajax({
            url: route,
            data: $(this).serializeArray(),
            method: 'POST',
            success: function(){
              $('.alerts').append(`<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Parabéns cadastro realizado, vamos te redirecionar para o inicio!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>`);
              $('form input').val('');
              setTimeout(function(){
                window.location.href = "<?php echo DIRPAGE;?>";
              }, 500)
            },
            error: function(){
              $('.alerts').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Ocorreu um erro ao cadastrar!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>`);
            }
          })
        });
  </script>
</body>

</html>