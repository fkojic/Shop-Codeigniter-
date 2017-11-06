<?php

class Model_Anketa extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    public function dohvati(){
        $this->db->where('status',1);
        return $this->db->get('anketa');
    }
    
    public function dohvatiAnketu($id){
    $this->db->where('id_ankete',$id);
    return $this->db->get('anketa')->row();
    }
 
    public function glasaj($id,$pitanje,$da,$ne){
    $this->db->where('id_ankete',$id);
    $this->db->update('anketa',array('da'=>$da,'ne'=>$ne));
    }
}
