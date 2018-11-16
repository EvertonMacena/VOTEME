<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Vote.ME</title>
    <meta charset="utf-8">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/br/br-all.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <link rel="stylesheet" href="/templates/public/style.css"  media="screen">
  </head>
  <body>
      <div id="h-000">
          <div id="h-001">
              <h1>VOTE.ME</h1>
              <h3>As estatísticas mais confiaveis na internet</h3>
              <div id="h-002" class="container">
                <?php if( $errorRegister!='' ){ ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars( $errorRegister, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    </div>
                <?php } ?>
                <p><a href="/users/create" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#exampleModal">Cadastrar</a></p>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cadastrar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form  role="form" action="/users/create" method="post">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Digite seu email" value="<?php echo htmlspecialchars( $registerValues["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        <label for="cpf">CPF</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf"aria-describedby="emailHelp" placeholder="Digite seu cpf" value="<?php echo htmlspecialchars( $registerValues["cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        <label for="nascimento">Data de nascimento</label>
                                        <input type="date" class="form-control" id="nascimento"aria-describedby="emailHelp" placeholder=
                                        "Data de nascimento">
                                        <small id="emailHelp" class="form-text text-muted">Nunca iremos usar seus dados para outros fins que não os do site.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Senha</label>
                                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Insira uma senha">
                                    </div>
                                    <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Eu concordo com os termos.</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <p><a href="/login" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#log-in"> Entrar    </a></p>
                <!-- Modal -->
                <div class="modal fade" id="log-in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Log-in</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form  role="form" action="/login" method="post">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                    <label for="password">Senha</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                                    </div>
                                    <button type="submit" class="btn btn-primary" >Entrar</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <p><a href="/estatisticas" class="btn btn-primary btn-block btn-lg" > Estatísticas</a></p>

                <p><a href="#" class="btn btn-primary btn-block btn-lg" > Votações Anteriores</a></p>
            </div>
          </div>
        </div>
  </body>
</html>