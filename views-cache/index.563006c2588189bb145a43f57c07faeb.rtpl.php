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
    <link rel="stylesheet" href="style.css"  media="screen">
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
                <p id="p_text"><a href="/users/create" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#exampleModal">Cadastrar</a></p>
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
                <p id="p_text"><a href="/login" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#log-in"> Entrar    </a></p>
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
                                        <label for="log_email">Email</label>
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
                <p id="p_text"><button class="btn btn-primary btn-block btn-lg" data-toggle="collapse" id="btn-01" data-target="#est" onclick="document.body.style.backgroundColor = 'white';" > Estatísticas</button>                   <script>
                    $("#btn-01").click(function(){
                        $("#h-000").hide(500);
                    });
                        
    
                       

                    </script></p>

                <p id="p_text"><a href="#" class="btn btn-primary btn-block btn-lg" > Votações Anteriores</a></p>
            </div>
          </div>
        </div>
      <!-- Estatisticas -->
          <div class="collapse" id="est" tabindex="-1" role="dialog" aria-hidden="true">
          <nav class="navbar navbar-expand-lg navbar-light bg-primary">
          <a class="navbar-brand text-light" href="#" data-toggle="collapse" id="btn-02" data-target="#est" onclick="document.body.style.backgroundColor = '#0096fa';" >Vote.ME
              
              
                      <script>
                    $("#btn-02").click(function(){
                        $("#h-000").show(500);
                    });
                      </script>
              
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

           <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav mr-auto">
           <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Opções
           </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="#" data-toggle="collapse" data-target="#heatmap">Mapa de calor</a>
           <a class="dropdown-item" href="#">Graficos</a>
           <div class="dropdown-divider"></div>
        
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Candidatos
           </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="#" data-toggle="collapse" data-target="#presidentes">Presidentes</a>
           <a class="dropdown-item" href="#" data-toggle="collapse" data-target="#governadores">Governadores</a>
           </div>
           <a class="dropdown-item" href="#">Votar</a>
           </div>
           </li>
           </ul>
           <form class="form-inline my-2 my-lg-0">
           <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
           <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
           </form>
          </div>
          </nav>
 

            <div class="collapse" id="heatmap" tabindex="-1" role="dialog" aria-labelledby="heatmap" aria-hidden="true">                
            <div id="container">
                <script src="/templates/public/heatmap.js">
                </script>
                <button type="button" class="btn btn-secondary"  data-toggle="collapse" data-target="#heatmap">Fechar</button>
            </div>
            </div>
            </div>
      
      <div class="collapse" id="presidentes">
       <div class="collapse" id="candidatos" tabindex="-1" role="dialog" aria-labelledby="candidatos" aria-hidden="true">
        <div class="card" style="width: 18rem; height: 450px;">
          <img class="card-img-top" src="/img/hillary_blue-512.png" alt="Card image cap">
          <div class="card-body">
            
            <h5 class="card-title" style="text-align: center;">Candidato A</h5>
              <a href="#" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#cA">Veja mais</a>
              <div class="modal fade" id="cA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <img class="card-img-top" src="/img/hillary_blue-512.png" alt="Card image cap">
                            </div>
                            <div class="modal-body">
                                    <p class="card-text" id="card-text">Eu sou a favor de tudo.</p>
                                    </div>
                                    <button type="submit" class="btn btn-primary" >Votar</button>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
            
          </div>
        </div>
      </div>
             <div class="collapse" id="candidatos" tabindex="-1" role="dialog" aria-labelledby="candidatos" aria-hidden="true">
        <div class="card" style="width: 18rem; height: 450px;">
          <img class="card-img-top" src="/img/hillary_blue-512.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title" style="text-align: center;">Candidato B</h5>
              <a href="#" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#cB">Veja mais</a>
              <div class="modal fade" id="cB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <img class="card-img-top" src="/img/hillary_blue-512.png" alt="Card image cap">
                            </div>
                            <div class="modal-body">
                                    <p class="card-text" id="card-text">Eu sou a favor de tudo.</p>
                                    </div>
                                    <button type="submit" class="btn btn-primary" >Votar</button>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
          </div>
        </div>
      </div>
             <div class="collapse" id="candidatos" tabindex="-1" role="dialog" aria-labelledby="candidatos" aria-hidden="true">
        <div class="card" style="width: 18rem; height: 450px;">
          <img class="card-img-top" src="/img/hillary_blue-512.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title" style="text-align: center;">Candidato C</h5>
              <a href="#" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#cC">Veja mais</a>
              <div class="modal fade" id="cC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <img class="card-img-top" src="/img/hillary_blue-512.png" alt="Card image cap">
                            </div>
                            <div class="modal-body">
                                    <p class="card-text" id="card-text">Eu sou a favor de tudo.</p>
                                    </div>
                                    <button type="submit" class="btn btn-primary" >Votar</button>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
          </div>
        </div>
      </div>
             <div class="collapse" id="candidatos" tabindex="-1" role="dialog" aria-labelledby="candidatos" aria-hidden="true">
        <div class="card" style="width: 18rem; height: 450px;">
          <img class="card-img-top" src="/img/hillary_blue-512.png" alt="Card image cap">
          <div class="card-body">
              <h5 class="card-title" style="text-align: center;">Candidato D</h5>
              <a href="#" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#cD">Veja mais</a>
              <div class="modal fade" id="cD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <img class="card-img-top" src="/img/hillary_blue-512.png" alt="Card image cap">
                            </div>
                            <div class="modal-body">
                                    <p class="card-text" id="card-text">Eu sou a favor de tudo.</p>
                                    </div>
                                    <button type="submit" class="btn btn-primary" >Votar</button>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
              
              </div>
          </div>
        </div>
      </div>
      
      <div class="collapse" id="governadores">
       <div class="collapse" id="candidatos" tabindex="-1" role="dialog" aria-labelledby="candidatos" aria-hidden="true">
        <div class="card" style="width: 18rem; height: 450px;">
          <img class="card-img-top" src="/img/hillary_blue-512.png" alt="Card image cap">
          <div class="card-body">
            
            <h5 class="card-title" style="text-align: center;">Candidato A</h5>
              <a href="#" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#g-cA">Veja mais</a>
              <div class="modal fade" id="g-cA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <img class="card-img-top" src="/img/hillary_blue-512.png" alt="Card image cap">
                            </div>
                            <div class="modal-body">
                                    <p class="card-text" id="card-text">Eu sou a favor de quase tudo.</p>
                                    </div>
                                    <button type="submit" class="btn btn-primary" >Votar</button>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
          </div>
        </div>
      </div>

             <div class="collapse" id="candidatos" tabindex="-1" role="dialog" aria-labelledby="candidatos" aria-hidden="true">
        <div class="card" style="width: 18rem; height: 450px;">
          <img class="card-img-top" src="/img/hillary_blue-512.png" alt="Card image cap">
          <div class="card-body">
              <h5 class="card-title" style="text-align: center;">Candidato B</h5>
              <a href="#" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#g-cB">Veja mais</a>
              <div class="modal fade" id="g-cB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <img class="card-img-top" src="/img/hillary_blue-512.png" alt="Card image cap">
                            </div>
                            <div class="modal-body">
                                    <p class="card-text" id="card-text">Eu sou a favor de tudo.</p>
                                    </div>
                                    <button type="submit" class="btn btn-primary" >Votar</button>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
              
              </div>
          </div>
        </div>
          
      </div>
      
  </body>
</html>