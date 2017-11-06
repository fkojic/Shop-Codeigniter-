<?php

class Model_Meni extends CI_Model{
    private $id_meni;
    private $link;
    private $naziv;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function meni($id) {
        if($this->session->userdata('id_uloge')!= null){
        $this->db->where('id_uloge', $id);
        }
        else
        {
            $this->db->where('(id_uloge="2" or id_uloge="0")');
        }
        return $this->db->get('meni')->result();
    }
}
