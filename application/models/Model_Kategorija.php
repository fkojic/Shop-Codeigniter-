<?php

class Model_Kategorija extends CI_Model{
    private $id_naslov;
    private $naslov;
    private $id_kategorija;
    private $kategorija_naziv;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function dohvati_naslov(){
        $upit = "SELECT * FROM kategorija_naslov";
        return $this->db->query($upit)->result();
    }
    
    public function dohvati(){
        $upit = "SELECT * FROM kategorija";
        return $this->db->query($upit)->result();
    }
    
    public function proizvodjac() {
        
        return $this->db->get('proizvodjac')->result();
        
    }
}
