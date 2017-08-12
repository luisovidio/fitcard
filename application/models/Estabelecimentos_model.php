<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Estabelecimentos_model extends CI_Model {
	private $tabela;
        private $t_categorias;

	public function __construct(){
            parent::__construct();

            $this->tabela       = 'estabelecimentos';
            $this->t_categorias = 'categorias';
	}

	public function get($id = false){
            $this->db->select()
                     ->from($this->tabela)
                     ->join($this->t_categorias, 'est_cat_id = cat_id', 'inner');
            
            if($id){
                $this->db->where('est_id', $id);
            }
            
            $query = $this->db->get();
            
            if(!$id) return $query->result();
            return $query->row();
	}
        
        public function insert($estabelecimento){
            $this->db->insert($this->tabela, $estabelecimento);
            
            return $this->db->insert_id();
        }
        
        public function update($estabelecimento){
            $this->db->where('est_id', $estabelecimento->est_id)
                     ->update($this->tabela, $estabelecimento);
        }
        
        public function delete($param){
            $id = (is_object($param)) ? $param->est_id : $param;
            $this->db->where('est_id', $id)
                     ->delete($this->tabela);
        }
}