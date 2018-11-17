<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Propostas candidado <?php echo htmlspecialchars( $candidato["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="/admin/candidados">Candidatos</a></li>
    <li class="active"><a href="#">Propostas</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">

            <div class="box-header">
              <a href="/admin/candidatos/<?php echo htmlspecialchars( $candidato["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/propostas/create" class="btn btn-success">Cadastrar proposta</a>
            </div>

            <div class="box-body no-padding">
                <?php $counter1=-1;  if( isset($tipos) && ( is_array($tipos) || $tipos instanceof Traversable ) && sizeof($tipos) ) foreach( $tipos as $key1 => $value1 ){ $counter1++; ?>

                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title"><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                  </div>
                  <?php $tipo = $value1["descricao"]; ?>
                  <!-- /.box-header -->
                  <div class="box-body">
                     <table class="table table-striped">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Descrição</th>
                          <th style="width: 240px">&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $counter2=-1;  if( isset($propostas) && ( is_array($propostas) || $propostas instanceof Traversable ) && sizeof($propostas) ) foreach( $propostas as $key2 => $value2 ){ $counter2++; ?>
                        <?php if( $value2["tipo"]==$tipo ){ ?>
                        <tr>
                          <td><?php echo htmlspecialchars( $value2["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                          <td><?php echo htmlspecialchars( $value2["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                          <td>
                            <a href="/admin/propostas/<?php echo htmlspecialchars( $value2["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/update" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Editar</a>
                            <a href="/admin/propostas/<?php echo htmlspecialchars( $value2["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                          </td>
                        </tr>
                        <?php } ?>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                  <!-- box-footer -->
                </div>

                <?php } ?>
            </div>
            <!-- /.box-body -->

            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>
                <li><a href="<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->