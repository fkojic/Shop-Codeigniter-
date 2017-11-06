<?php

class Logovanje extends Frontend_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function login()
    {
        $is_post=$this->input->server('REQUEST_METHOD') == 'POST';
        if($is_post){
        $username = $this->input->post('tbKorIme');
        $password = md5($this->input->post('tbLozinka'));
        $rezultat = $this->Model_Logovanje->prijava($username, $password);
        if($rezultat->num_rows()==1)
        {
            $podaci_korisnik = $rezultat->row_array();
            $sesija = array(
                "ulogovan" => true,
                "id" => $podaci_korisnik["id_korisnik"],
                "uloga" => $podaci_korisnik["naziv"],
                "username" => $podaci_korisnik["username"],
                "prezime" => $podaci_korisnik["prezime"],
                "ime" => $podaci_korisnik["ime"],
                "id_uloge" => $podaci_korisnik["id_uloge"],
                "email" => $podaci_korisnik["email"],
                "password" => $podaci_korisnik["password"]
            );
            
            $this->session->set_userdata($sesija);
            
            if($podaci_korisnik["naziv"]=="admin"){
                redirect('administracija'); 
            }
            else if($podaci_korisnik["naziv"]=="korisnik"){
                redirect('home');         
            }
        }
        else
        {
            redirect('home');
        }
        }
        
        
    } 
    public function logout()
    {
        $this->session->sess_destroy();
        redirect();
    }   
}
