<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="panel-body">
    <div class="row form-group">
        <div class="col-lg-3">
            <a class="btn btn-primary form-control" href="<?php echo base_url('index.php/estabelecimentos/cadastrar');?>">Novo Estabelecimento</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php 
            $template = array(
                'table_open'            => '<table class="table table-striped table-hover">',
                'thead_open'            => '<thead class="bg-primary">',
                'heading_cell_start'    => '<th style="text-align: center;">',
                'cell_start'            => '<td style="text-align: center;">',
                'cell_alt_start'        => '<td style="text-align: center;">'
            );

            $this->table->set_heading('Razão Social', 'CNPJ', 'Categoria', 'Status', 'Ações');

            if(empty($estabelecimentos)){
                $row = array('-', '-', '-', '-', '-');
                $this->table->add_row($row);
            }
            else{
                foreach($estabelecimentos as $e){
                    $editar     = '<a class="btn btn-warning" href="'. 
                                        base_url('index.php/estabelecimentos/cadastrar/' . $e->est_id) .
                                   '">Editar</a>';
                    $excluir    = '<a class="btn btn-danger excluir" href="'.
                                        base_url('index.php/estabelecimentos/excluir/' . $e->est_id) .
                                  '">Excluir</a>';

                    $acoes = '<div class="btn-group">' . $editar . $excluir . '</div>';
                    
                    $label = ($e->est_status == 'Ativo') ? 'label-success' : 'label-danger';
                    $status = '<label class="label ' . $label . '">' .  $e->est_status . '</label>';

                    $row = array(
                        $e->est_razao_social,
                        $e->est_cnpj,
                        $e->cat_nome,
                        $status,
                        $acoes
                    );

                    $this->table->add_row($row);
                }
            }

            $this->table->set_template($template);
            echo $this->table->generate();
            ?>
        </div>
    </div>
</div>
