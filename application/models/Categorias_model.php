<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {
	private $tabela;

	public function __construct(){
		parent::__construct();

		$this->tabela = 'categorias';
	}

	public function get($id = false){
            $this->db->select()
                     ->from($this->tabela);
            
            if($id){
                $this->db->where('cat_id', $id);
            }
            
            $query = $this->db->get();
            
            return $query->result();
	}
        
        public function insert($categoria){
            $this->db->insert($this->tabela, $categoria);
            
            return $this->db->insert_id();
        }
        
        public function update($categoria){
            $this->db->where('cat_id', $categoria->cat_id)
                     ->update($this->tabela, $categoria);
        }
        
        public function delete($param){
            $id = (is_object($param)) ? $param->cat_id : $param;
            
            $this->db->where('cat_id', $id)
                     ->delete($this->tabela);
        }
}