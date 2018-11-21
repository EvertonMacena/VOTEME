<?php if(!class_exists('Rain\Tpl')){exit;}?><script src="/templates/public/js/home.js"></script>
 <link rel="stylesheet" href="/templates/public/css/home.css">

<div class="container">
  <h2 class="section-title" style="text-align: center; padding: 20px">Governador</h2>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner row w-100 mx-auto">
    <?php $counter1=-1;  if( isset($candidatos) && ( is_array($candidatos) || $candidatos instanceof Traversable ) && sizeof($candidatos) ) foreach( $candidatos as $key1 => $value1 ){ $counter1++; ?>
      <div class="carousel-item col-md-4 active">
                            <div class="card" style="width: 18rem; height: 450px;">
                              <img class="card-img-top" src="<?php echo htmlspecialchars( $value1["photo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Card image cap" height="280" width="200">
                              <div class="card-body">
                                  <h5 class="card-title" style="text-align: center;"><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                                  <h3 class="card-title" style="text-align: center; color: black;"><?php echo htmlspecialchars( $value1["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                                  <a href="/candidatos/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalhe" class="btn btn-primary btn-block btn-lg">Veja mais</a>

                                  </div>
                              </div>

      </div>
      <?php } ?>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>


<!--
<div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                        <h2 class="section-title" style="text-align: center;">Governador</h2>
                        <div class="owl-carousel">

                            <?php $counter1=-1;  if( isset($candidatos) && ( is_array($candidatos) || $candidatos instanceof Traversable ) && sizeof($candidatos) ) foreach( $candidatos as $key1 => $value1 ){ $counter1++; ?>
                            <div class="collapse" id="candidatos" tabindex="-1" role="dialog" aria-labelledby="candidatos" aria-hidden="true">
                            <div class="card" style="width: 18rem; height: 450px;">
                              <img class="card-img-top" src="<?php echo htmlspecialchars( $value1["photo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Card image cap" height="280" width="200">
                              <div class="card-body">
                                  <h5 class="card-title" style="text-align: center;"><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                                  <h3 class="card-title" style="text-align: center; color: black;"><?php echo htmlspecialchars( $value1["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
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
                            <?php } ?>

                        </div>
                </div>
            </div>
        </div>
    </div> End main content area -->

</body>
</html>