<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$id         = (isset($estabelecimento->est_id)) ? $estabelecimento->est_id              : set_value('id');
$razao      = (isset($estabelecimento))         ? $estabelecimento->est_razao_social    : set_value('razao');
$fantasia   = (isset($estabelecimento))         ? $estabelecimento->est_nome_fantasia   : set_value('fantasia');
$cnpj       = (isset($estabelecimento))         ? $estabelecimento->est_cnpj            : set_value('cnpj');
$email      = (isset($estabelecimento))         ? $estabelecimento->est_email           : set_value('email');
$telefone   = (isset($estabelecimento))         ? $estabelecimento->est_telefone        : set_value('telefone');
$endereco   = (isset($estabelecimento))         ? $estabelecimento->est_endereco        : set_value('endereco');
$cidade     = (isset($estabelecimento))         ? $estabelecimento->est_cidade          : set_value('cidade');
$estado     = (isset($estabelecimento))         ? $estabelecimento->est_estado          : set_value('estado');
$categoria  = (isset($estabelecimento))         ? $estabelecimento->est_cat_id          : 1;
$status     = (isset($estabelecimento))         ? $estabelecimento->est_status          : 'Ativo';
$data       = (isset($estabelecimento))         ? $estabelecimento->est_data_cadastro   : set_value('data');

foreach($categorias as $c){
    $dropCategoria[$c->cat_id] = $c->cat_nome;
}

echo form_open('index.php/estabelecimentos/salvar', 'id="form" name="form"');
if(isset($estabelecimento->est_id)){
    echo '<input type="hidden" name="id" id="id" value="'. $id .'">';
}

//Organiza a data do banco
$data = explode('-', $data);
$data = implode('/', array_reverse($data));

?>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="row form-group">
                <div class="col-lg-5">
                    <label for="razao" class="control-label">Razão Social<span style="color: red;">*</span></label>
                    <input type="text" name="razao" id="razao" class="form-control" value="<?php echo $razao;?>" maxlength="45" />
                    <?php echo form_error('razao');?>
                </div>
                <div class="col-lg-5">
                    <label for="fantasia" class="control-label">Nome Fantasia</label>
                    <input type="text" name="fantasia" id="fantasia" class="form-control" value="<?php echo $fantasia;?>" maxlength="45" />
                    <?php echo form_error('razao');?>
                </div>
                <div class="col-lg-2">
                    <label for="cnpj" class="control-label">CNPJ<span style="color: red;">*</span></label>
                    <input type="text" name="cnpj" id="cnpj" class="form-control" value="<?php echo $cnpj;?>" />
                    <?php echo form_error('cnpj');?>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-lg-3">
                    <label for="telefone" class="control-label">Telefone<span id="reqTel" style="color: red;<?php if($categoria != 1) echo 'display: none;'?>">*</span></label>
                    <input type="text" name="telefone" id="telefone" class="form-control" value="<?php echo $telefone; ?>"/>
                    <?php echo form_error('telefone');?>
                </div>
                <div class="col-lg-4">
                    <label for="email" class="control-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="<?php echo $email;?>" maxlength="45" />
                    <?php echo form_error('email');?>
                </div>
                <div class="col-lg-2">
                    <label for="data" class="control-label">Data de Cadastro</label>
                    <input type="text" name="data" id="data" class="form-control" value="<?php echo $data;?>"/>
                    <?php echo form_error('data');?>
                </div>
                <div class="col-lg-3">
                    <label for="categoria" class="control-label">Categoria</label>
                    <?php echo form_dropdown('categoria', $dropCategoria, $categoria, 'id="categoria" class="form-control"'); ?>
                    <?php echo form_error('categoria');?>
                </div>
            </div>
            
            <div class="row form-group">
                <div class="col-lg-6">
                    <label for="endereco" class="control-label">Endereço</label>
                    <input type="text" name="endereco" id="endereco" class="form-control" value="<?php echo $endereco;?>" maxlength="80"/>
                    <?php echo form_error('endereco');?>
                </div>
                <div class="col-lg-4">
                    <label for="cidade" class="control-label">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="form-control" value="<?php echo $cidade;?>" maxlength="45" />
                    <?php echo form_error('cidade');?>
                </div>
                <div class="col-lg-2">
                    <label for="estado" class="control-label">Estado</label>
                    <?php echo form_dropdown('estado', $this->config->item('ufs'), $estado, 'id="estado" class="form-control"'); ?>
                    <?php echo form_error('estado');?>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-2">
                    <label for="status" class="sr-only">Status</label>
                    <input type="checkbox" data-toggle="toggle" data-on="Ativo" class="form-control"
                           data-off="Inativo" data-onstyle="success" data-offstyle="danger"
                           id="status" name="status" <?php  if($status == 'Ativo') echo 'checked';?> />
                    <?php echo form_error('status');?>
                </div>
            </div>
        </div>
    </div>
</div>        
<div class="panel-footer">
    <div class="row">
        <div class="col-lg-2 col-lg-offset-8">
            <button type="button" class="btn btn-default form-control" onClick="history.go(-1)">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                &nbsp;Voltar
            </button>
        </div>
        <div class="col-lg-2">
            <button type="submit" class="btn btn-info form-control">Enviar&nbsp;
                <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</div>
<?php echo form_close();