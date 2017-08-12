<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estabelecimentos extends CI_Controller {

    private $data;
    
    public function __construct(){
        parent::__construct();

        //Models
        $this->load->model('estabelecimentos_model');
        $this->load->model('categorias_model');
        
        //Helper com funcoes de validacao
        $this->load->helper('validacao');
        
        //Javascripts e Css padrão
        $this->data['JavaScripts'][] = 'assets/js/jquery-3.2.1.min';
        $this->data['JavaScripts'][] = 'assets/js/bootstrap';
        $this->data['JavaScripts'][] = 'assets/js/bootstrap.min';
        $this->data['Css'][] = 'assets/css/bootstrap';
        $this->data['Css'][] = 'assets/css/bootstrap.min';
        
        //Config com o array de estados e regras de validacao
        $this->config->load('estabelecimentos');
    }

    public function index()
    {
        $this->data['estabelecimentos'] = $this->estabelecimentos_model->get();
        $this->data['view']             = 'tabela';
        $this->data['titulo']           = 'Gerenciar Estabelecimentos';

        $this->load->view('template', $this->data);
    }

    public function cadastrar($id = false){
        
        $this->_loadDataForm();
        
        if($id){
            $this->data['estabelecimento'] = $this->estabelecimentos_model->get($id);
        }
        
        $this->load->view('template', $this->data);
    }
    
    public function salvar(){
        if($this->_validar()){
            $estabelecimento = $this->_loadData();
            
            if(!isset($estabelecimento->est_id)){
                $this->estabelecimentos_model->insert($estabelecimento);
            }
            else{
                $this->estabelecimentos_model->update($estabelecimento);
            }
            
            redirect(base_url());
        }
        else{
            $this->_loadDataForm();
            $this->data['estabelecimentos'] = $this->_loadData();
            
            $this->load->view('template', $this->data);
        }
    }
    
    public function excluir($id){
        $this->estabelecimentos_model->delete($id);
        redirect(base_url());
    }
    
    private function _validar(){
        $this->form_validation->set_rules($this->config->item('regras'));
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        return $this->form_validation->run();
    }
    
    private function _loadData(){
        $estabelecimentos = new stdClass();
        $post = $this->input->post();
        
        $estabelecimentos->est_status           = (isset($post['status']))      ? 'Ativo' : 'Inativo';
        $estabelecimentos->est_razao_social     = $post['razao'];
        $estabelecimentos->est_nome_fantasia    = (isset($post['fantasia']))    ? $post['fantasia'] : null;
        $estabelecimentos->est_cnpj             = $post['cnpj'];
        $estabelecimentos->est_telefone         = (isset($post['telefone']))    ? $post['telefone'] : null;
        $estabelecimentos->est_email            = (isset($post['email']))       ? $post['email'] : null;
        $estabelecimentos->est_data_cadastro    = (isset($post['data']))        ? $this->_formataData($post['data']) : null;
        $estabelecimentos->est_cat_id           = $post['categoria'];
        $estabelecimentos->est_endereco         = (isset($post['endereco']))    ? $post['endereco'] : null;
        $estabelecimentos->est_cidade           = (isset($post['cidade']))      ? $post['cidade'] : null;
        $estabelecimentos->est_estado           = $post['estado'];
        if(isset($post['id'])){
            $estabelecimentos->est_id = $post['id'];
        }
        
        return $estabelecimentos;
    }
    
    private function _formataData($data){
        $data = explode('/', $data);
        return implode('-', array_reverse($data));
    }
    
    public function validaTel($telefone){
        $cat = $this->input->post('categoria');
        if($cat != 1){
            return true;
        }
        else if($cat == 1 && valTelefone($tel)){
            return true;
        }
        else{
            $this->form_validation->set_message('validaTel', "Telefone é obrigatório para supermercados");
            return false;
        }
    }
    
    private function _loadDataForm(){
        $this->data['view']         = 'form_estabelecimento';
        $this->data['titulo']       = 'Cadastrar Estabelecimento';
        $this->data['categorias']   = $this->categorias_model->get();
        
        //javascripts
        $this->data['JavaScripts'][] = 'assets/js/jquery.mask';
        $this->data['JavaScripts'][] = 'assets/js/pages/estabelecimentos';
        $this->data['JavaScripts'][] = 'assets/js/jquery.validate';
        $this->data['JavaScripts'][] = 'assets/js/bootstrap-toggle';
        
        //css
        $this->data['Css'][] = 'assets/css/bootstrap-toggle';
    }
}
