<?php

class Model_Logovanje  extends CI_Model{
    //put your code here
    public $id;
    public $ime;
    public $prezime;
    public $username;
    public $password;
    public $email;
    
    
    public function __construct() {
        parent::__construct();
    }
    public function korisnici() {
        $this->db->join("uloga","korisnik.id_uloge = uloga.id_uloge");
        return $this->db->get('korisnik')->result();
    }
    
    public function korisniciIzmena($id) {
        $this->db->where('id_korisnik', $id);
        $this->db->join("uloga","korisnik.id_uloge = uloga.id_uloge");
        return $this->db->get('korisnik')->result();
    }
    
    public function prijava($username, $password) 
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->join("uloga","korisnik.id_uloge = uloga.id_uloge");
        
        return $this->db->get('korisnik');
    }
    
    public function unesi($podaci) {
        $this->db->insert('korisnik', $podaci);
    }
    
    public function obrisi() {
        $uslov = array('id_korisnik'=>  $this->id);
        $this->db->where($uslov);
        $this->db->delete('korisnik');
    }
    
    public function izmeni($podaci) {
        $this->db->where('id_korisnik',  $this->id);
        $this->db->update('korisnik', $podaci);

    }
    
    public function autor() {
        return $this->db->get('autor')->result();
    }
    
    public function uloge() {
        return $this->db->get('uloga')->result();
    }
    
}
