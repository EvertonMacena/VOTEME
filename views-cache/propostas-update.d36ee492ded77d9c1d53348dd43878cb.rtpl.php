<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Proposta para <?php echo htmlspecialchars( $candidato["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/candidatos">Candidados</a></li>
    <li class="active"><a href="/admin/candidatos/<?php echo htmlspecialchars( $candidato["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/propostas">Propostas</a></li>
    <li class="active"><a href="#">Editar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Proposta</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/propostas/<?php echo htmlspecialchars( $proposta["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/update" method="post">
          <div class="box-body">
            <input type="hidden" id="idcandidato" name="idcandidato" value="<?php echo htmlspecialchars( $candidato["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            <div class="form-group">
              <label for="idtipo">Área</label>
              <select class="form-control form-control-sm" name="idtipo" id = "idtipo">
                <option value="<?php echo htmlspecialchars( $proposta["idtipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $proposta["tipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php $counter1=-1;  if( isset($tipo) && ( is_array($tipo) || $tipo instanceof Traversable ) && sizeof($tipo) ) foreach( $tipo as $key1 => $value1 ){ $counter1++; ?>
                <option value="<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php } ?>

              </select>
            </div>
            <div class="form-group">
              <label for="senha">Descrição da proposta</label>
              <textarea class="form-control" rows="5" id="descricao" name="descricao"><?php echo htmlspecialchars( $proposta["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Cadastrar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->