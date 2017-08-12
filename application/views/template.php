<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Gerenciar Estabelecimentos</title>

        <meta charset="utf-8">
        <meta http-equiv="content-language" content="pt-br">

        <?php foreach($Css as $css){
                echo link_tag($css . '.css');
        }?>
        
        <style>
            .error{
                color: red
            }
            .valid{
                color: green
            }
        </style>
    </head>
    <body>   
        <div class="container">
            <div class="panel panel-default" style="margin-top: 20px;">
                <div class="panel-heading">
                    <h3><?php echo $titulo;?></h3>
                </div>
                <?php $this->load->view($view); ?>
            </div>
        </div>
    </body>
    <footer>
            <?php foreach($JavaScripts as $js){
                    echo '<script type="text/javascript" src="' . base_url($js) . '.js"></script>';
            }?>
        <script>
            $('.excluir').on('click', function(event){
                var c = confirm('Tem certeza que deseja excluir este estabelecimento?');
                if(!c){
                    event.preventDefault();
                }
            });
        </script>
    </footer>
</html>

