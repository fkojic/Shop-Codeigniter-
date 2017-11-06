<?php


class Model_Proizvod extends CI_Model{
    public $id_proizvod;
    public $naslov;
    public $opis;
    public $datum_postavljanja;
    public $id_kategorija;
    public $cena;
    public $slika = array();
    
    public function __construct() {
        parent::__construct();
    }
    
    public function proizvodi() {
        $this->db->join('kategorija','proizvod.id_kategorija = kategorija.id_kategorija');
        return $this->db->get('proizvod')->result();
        
    }
    public function proizvod($id_proizvod) {
        $this->db->where('id_proizvod',$id_proizvod);
        return $this->db->get('proizvod')->result();
    }
    
    public function proizvodjac($id_p) {
        $this->db->where('id_naslov',$id_p);
        return $this->db->get('kategorija')->result();
    }
    
    public function proizvodSlajder() 
    {
//        $this->db->limit(0,3);
        $this->db->order_by('datum_postavljanja', 'DESC');
        return $this->db->get('proizvod', 3, 0)->result();
    }
    
    public function proizvodKategorija($id) {
        $this->db->where('id_kategorija',$id);
        return $this->db->get('proizvod')->result();
    }
    
    
    public function unesiProizvod($podaci) {
        $this->db->insert('proizvod', $podaci);
    }
    
    public function obrisi() {
        $uslov = array('id_proizvod'=>  $this->id_proizvod);
        $this->db->where($uslov);
        $this->db->delete('proizvod');
    }
    public function izmeniProizvod($podaci) {
        $this->db->where('id_proizvod',  $this->id_proizvod);
        $this->db->update('proizvod', $podaci);
    }
    
    public function galerija() {
        $this->db->select('slika');
        return $this->db->get('proizvod')->num_rows();
    }
    
    public function pagination1($limit, $offset) {
        $upit = $this->db->get('proizvod', $limit, $offset);
        return $upit->result();
    }
    
    
    public function proizvodMax($id) {
        $this->db->select_max('cena');
        $this->db->where('id_kategorija',$id);
        return $this->db->get('proizvod')->result();
    }
    
    public function cena($cena, $id) {
        $this->db->where('cena <=', $cena);
        $this->db->where('id_kategorija',$id);
        return $this->db->get('proizvod')->result();
    }
}
