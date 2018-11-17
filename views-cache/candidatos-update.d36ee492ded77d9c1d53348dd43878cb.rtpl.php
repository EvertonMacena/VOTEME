<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Candidatos
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/candidatos">Candidatos</a></li>
    <li class="active"><a href="/admin/candidatos/create">Cadastrar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Candidato</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/candidatos/<?php echo htmlspecialchars( $candidato["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/update" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="numero">Numero</label>
              <input type="number" class="form-control" id="numero" name="numero" placeholder="Digite o numero" value="<?php echo htmlspecialchars( $candidato["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="nome">Nome</label>
              <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome" value="<?php echo htmlspecialchars( $candidato["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="idtipo">Tipo de candidatura</label>
              <select class="form-control form-control-sm" name="idtipo" id = "idtipo">
                <option value="<?php echo htmlspecialchars( $candidato["idtipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $candidato["tipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php $counter1=-1;  if( isset($tipo) && ( is_array($tipo) || $tipo instanceof Traversable ) && sizeof($tipo) ) foreach( $tipo as $key1 => $value1 ){ $counter1++; ?>
                <option value="<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php } ?>

              </select>
            </div>
            <div class="form-group">
              <label for="partido">Partido</label>
              <select class="form-control form-control-sm" name="partido" id = "partido">
                <option value="<?php echo htmlspecialchars( $candidato["idpartido"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $candidato["partido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php $counter1=-1;  if( isset($partido) && ( is_array($partido) || $partido instanceof Traversable ) && sizeof($partido) ) foreach( $partido as $key1 => $value1 ){ $counter1++; ?>
                <option value="<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["sigla"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php } ?>

              </select>
            </div>
            <div class="form-group">
              <label for="idlocalidade">Localidade</label>
              <select class="form-control form-control-sm" name="idlocalidade" id = "idlocalidade">
                <option value="<?php echo htmlspecialchars( $candidato["idlocalidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $candidato["localidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php $counter1=-1;  if( isset($localidade) && ( is_array($localidade) || $localidade instanceof Traversable ) && sizeof($localidade) ) foreach( $localidade as $key1 => $value1 ){ $counter1++; ?>
                <option value="<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php } ?>

              </select>
            </div>
              <div class="form-group">
                  <label for="newfile">Envie uma imagem</label>
                  <input class="form-control-file" type="file" name="newfile" id="newfile" accept="image/*">
              </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Editar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->