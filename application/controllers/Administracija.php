<?php
class Administracija extends Frontend_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->podaci['kategorija_naslov'] = $this->Model_Kategorija->dohvati_naslov();
        $this->podaci['proizvodi'] = $this->Model_Proizvod->proizvodi();        
        $this->podaci['proizvodjac'] = $this->Model_Kategorija->proizvodjac();
        if($this->session->userdata("ulogovan")){
            $this->podaci["ulogovan"] = true;
            $this->podaci["uloga"] = $this->session->userdata("uloga");
            if($this->podaci["uloga"]=="admin"){
                
                $this->podaci["ime"] = $this->session->userdata("ime");
                
            }
        }
        else{
            $this->podaci["ulogovan"] = false;
            redirect();
        }
    }

    public function index() 
    {    
        $this->podaci["title"] = "Administracija";
        
        $prezime = $this->session->userdata('prezime');
        $username = $this->session->userdata('username');
        $sifra = $this->session->userdata('password');
        $mail = $this->session->userdata('email');
        
        $dugme = $this->input->post('btnUnesi');
                
                 if($dugme!="")
                 { 
                     $this->form_validation->set_rules('tbIme','Ime ponovo','trim|required');
                     $this->form_validation->set_rules('tbPrezime','Prezime ponovo','trim|required');
                     $this->form_validation->set_rules('tbUsername','Korisnicko ime','trim|required|min_length[3]');
                     $this->form_validation->set_rules('tbLozinka','Lozinka','trim|required|matches[tbLozinkaPonovo]');
                     $this->form_validation->set_rules('tbLozinkaPonovo','Lozinka ponovo','trim|required');
                     $this->form_validation->set_rules('tbEmail','E-mail','trim|required|valid_email');
                     
                     $this->form_validation->set_message('required','Poje %s je prazno.');
                     $this->form_validation->set_message('min_length','Poje %s mora imati minimalno %d karaktera.');
                     $this->form_validation->set_message('matches','Polja %s i %s se ne poklapaju!');
                     $this->form_validation->set_message('valid_email','Poje %s je neispravno.');
                     
                     if($this->form_validation->run()== false)
                     {
                         
                     }
                    else {
                        $id = $this->input->post('idKorisnik');
                        $this->Model_Logovanje->id = $id;
                        $podaciUnos = array(
                            'ime' => $this->input->post('tbIme'),
                            'prezime' => $this->input->post('tbPrezime'),
                            'username' => $this->input->post('tbUsername'),
                            'password' => md5($this->input->post('tbLozinka')),
                            'email' => $this->input->post('tbEmail'),
                        );
                        $this->Model_Logovanje->izmeni($podaciUnos);
                        $this->podaci['obavestenje'] = "Podaci su promenjeni!";
                    }
                 }
        
        $this->podaci['tbIme']= array(
                 'name'=>"tbIme",
                 'id'=>"tbIme", 
                 'value'=>$this->podaci["ime"], 
                 'size'=>"30", 
                 'class'=>'form-control'
            );
             $this->podaci['tbPrezime']= array(
                 'name'=>"tbPrezime",
                 'id'=>"tbPrezime", 
                 'value'=>$prezime, 
                 'size'=>"30", 
                 'class'=>'form-control'
            );
             $this->podaci['tbUsername']= array(
                 'name'=>"tbUsername",
                 'id'=>"tbUsername", 
                 'value'=>$username, 
                 'size'=>"30", 
                 'class'=>'form-control'
            );
             $this->podaci['tbLozinka'] = array(
                 "name"=>"tbLozinka", 
                 "id"=>"tbLozinka", 
                 "value"=>$sifra, 
                 "size"=>"30", 
                 'class'=>'form-control'
            );
             $this->podaci['tbEmail'] =array(
                 "name"=>"tbEmail", 
                 "id"=>"tbEmail", 
                 "value"=>$mail, 
                 "size"=>"30", 
                 'class'=>'form-control'
            );
        $this->load_view("administracija", $this->podaci);
        
        
    }
    
    public function unesi() 
    {    
        $this->podaci["title"] = "Unesi";
        
        $is_post=$this->input->server('REQUEST_METHOD') == 'POST'; 

        $dugme = $this->input->post('btnUnesi');
        $uneti_podaci = array();  
            if($is_post){
                 if($dugme!="")
                 { 
                     
                    $config['upload_path'] = './assets/img/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']	= '200';
                    $config['max_width']  = '1024';
                    $config['max_height']  = '768';
                    $this->load->library('upload', $config);
                     if(!$this->upload->do_upload('tbSlike'))
                     {
                        $error = array('error' => $this->upload->display_errors());
                        $this->podaci['greske'] = $error; 
                         
                     }
                    else {
                        $data = array('upload_data' => $this->upload->data());
                        //
                        $image_path = $this->upload->data();
                        $podaciUnos = array(
                            'naslov' => $this->input->post('tbIme'),
                            'opis' => $this->input->post('tbOpis'),
                            'datum_postavljanja' => $this->input->post('tbDatum'),
                            'id_kategorija' => $this->input->post('ddlKategorija'),
                            'cena' => $this->input->post('tbCena'),
                            'slika' => $image_path['file_name'],
                            'id_proizvodjac' => $this->input->post('ddlProizvodjac')
                        );
                        $this->Model_Proizvod->unesiProizvod($podaciUnos);
                        
                    }
                 }
            }
             $this->podaci['tbIme']= array(
                 'name'=>"tbIme",
                 'id'=>"tbIme", 
                 'value'=>isset($uneti_podaci['ime']) ? $uneti_podaci['ime'] : '', 
                 'size'=>"30", 
                 'class'=>'form-control'
            );
             $this->podaci['tbOpis']= array(
                 'id' => 'tbOpis', 
                 'name' => 'tbOpis',
                 'size'=>"100", 
                 'class'=>'form-control'
            );
             $this->podaci['tbDatum']= array(
                 'name'=>"tbDatum",
                 'id'=>"tbDatum", 
            );
             $this->podaci['tbKategorija'] = array(
                 "name"=>"tbKategorija", 
                 "id"=>"tbKategorija", 
                 "value"=>isset($uneti_podaci['kategorija']) ? $uneti_podaci['kategorija'] : '', 
                 "size"=>"30", 
                 'class'=>'form-control'
            );
             $this->podaci['tbCena'] =array(
                 "name"=>"tbCena", 
                 "id"=>"tbCena", 
                 "value"=>isset($uneti_podaci['cena']) ? $uneti_podaci['cena'] : '', 
                 "size"=>"30", 
                 'class'=>'form-control'
            );
             $this->podaci['tbProizvodjac'] =array(
                 "name"=>"tbProizvodjac", 
                 "id"=>"tbProizvodjac", 
                 "value"=>isset($uneti_podaci['proizvodjac']) ? $uneti_podaci['proizvodjac'] : '', 
                 "size"=>"30", 
                 'class'=>'form-control'
            );
            $proizvodi = $this->Model_Proizvod->proizvodi();
            
            $this->load->library('table');
            
            $this->table->set_template(array('table_open'=>'<table class="table">'));
            $this->table->set_heading('ID', 'Ime', 'Opis', 'Datum postavljanja', 'Id_K', 'Cena', 'Slika', 'Id_P');

            foreach ($proizvodi as $proi)
            {
                
                $this->table->add_row($proi->id_proizvod, $proi->naslov, $proi->opis, $proi->datum_postavljanja, $proi->id_kategorija, $proi->cena.' €','<img src="'.base_url('assets/img/').$proi->slika.'" width="100px" height="100px">', $proi->id_proizvodjac);
            }
            $this->podaci['tabela'] = $this->table->generate();
        $this->load_view("admin/unesi", $this->podaci);
        
    }
    
    public function izmeni() 
    {    
        $this->podaci['title'] = 'Izmeni';
        
       $is_post=$this->input->server('REQUEST_METHOD') == 'POST'; 
       
        
       
        $dugme = $this->input->post('btnUnesi');
        $uneti_podaci = array();  
            if($is_post){
                 if($dugme!="")
                 { 
                     
                    $config['upload_path'] = './assets/img/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']	= '100';
                    $config['max_width']  = '1024';
                    $config['max_height']  = '768';
                    $this->load->library('upload', $config);
                    
                     if(!$this->upload->do_upload('tbSlike'))
                     {
                        $error = array('error' => $this->upload->display_errors());
                        $this->podaci['greske'] = $error; 
                         
                     }
                    else {
                        $data = array('upload_data' => $this->upload->data());
                        $id = $this->input->get('idIzmena');
                        $this->Model_Proizvod->id_proizvod = $id;
                        $image_path = $this->upload->data();
                        $podaciUnos = array(
                            'naslov' => $this->input->post('tbIme'),
                            'opis' => $this->input->post('tbOpis'),
                            'datum_postavljanja' => $this->input->post('tbDatum'),
                            'id_kategorija' => $this->input->post('ddlKategorija'),
                            'cena' => $this->input->post('tbCena'),
                            'slika' => $image_path['file_name'],
                            'id_proizvodjac' => $this->input->post('ddlProizvodjac')
                        );
                        $this->Model_Proizvod->izmeniProizvod($podaciUnos);
                        
                    }
                 }
            }
            $id = $this->input->get('idIzmena');
            $proizvodi = $this->Model_Proizvod->proizvod($id);
            foreach ($proizvodi as $proizvod) {
                
            
             $this->podaci['tbIme']= array(
                 'name'=>"tbIme",
                 'id'=>"tbIme", 
                 'value'=>$proizvod->naslov, 
                 'size'=>"30", 
                 'class'=>'form-control'
            );
             $this->podaci['tbOpis']= array(
                 'id' => 'tbOpis', 
                 'name' => 'tbOpis',
                 'value'=>$proizvod->opis, 
                 'size'=>"100", 
                 'class'=>'form-control'
            );
             $this->podaci['tbCena'] =array(
                 "name"=>"tbCena", 
                 "id"=>"tbCena", 
                 "value"=>$proizvod->cena, 
                 "size"=>"30", 
                 'class'=>'form-control'
            );
            }
            $proizvodi = $this->Model_Proizvod->proizvodi();
            
            $this->load->library('table');
            
            $this->table->set_template(array('table_open'=>'<table class="table">'));
            $this->table->set_heading('ID', 'Ime', 'Opis', 'Datum postavljanja', 'Id_K', 'Cena', 'Slika', 'Id_P', 'Izmeni');

            foreach ($proizvodi as $proi)
            {
                $link = anchor('administracija/izmeni?idIzmena='.$proi->id_proizvod, 'Izmeni');
                $this->table->add_row($proi->id_proizvod, $proi->naslov, $proi->opis, $proi->datum_postavljanja, $proi->id_kategorija, $proi->cena.' €','<img src="'.base_url('assets/img/').$proi->slika.'" width="100px" height="100px">', $proi->id_proizvodjac, $link);
            }
            $this->podaci['tabela'] = $this->table->generate();
        
        $this->load_view('admin/izmeni', $this->podaci);
    }
    
    
    public function obrisi() 
    {    
        $this->podaci["title"] = "Obrisi";
        
        $proizvodi = $this->Model_Proizvod->proizvodi();
        
        $id = $this->uri->segment(3);
        $this->Model_Proizvod->id_proizvod = $id;
        $this->Model_Proizvod->obrisi();
        
        $this->load->library('table');
            
        $this->table->set_template(array('table_open'=>'<table class="table">'));
        $this->table->set_heading('Proizvod', 'Opis', 'Datum postavljanja', 'Kategorija', 'Cena', 'Slika', 'Obrisi');

        foreach ($proizvodi as $k)
        {
            $link = anchor('administracija/obrisi/'.$k->id_proizvod, 'Obrisi');
            $this->table->add_row($k->naslov, $k->opis, $k->datum_postavljanja, $k->kategorija_naziv, $k->cena, '<img src="'.base_url('assets/img/').$k->slika.'" width="100px" height="100px">', $link);
        }
        $this->podaci['tabelaProizvodi'] = $this->table->generate();
        
        $this->load_view('admin/obrisiProizvode', $this->podaci);
    }
    
    public function korisnici() 
    {    
        $this->podaci["title"] = "Korisnici";
        $idIzmena = $this->input->get('idIzmenaKorisnika');
        $this->podaci['korisniciIzmena'] = $this->Model_Logovanje->korisniciIzmena($idIzmena);
        $this->podaci['uloge'] = $this->Model_Logovanje->uloge();
        $dugme = $this->input->post('btnIzmeni');
        if(!$dugme=''){

            $this->form_validation->set_rules('ddlUloga','Uloga ponovo','trim|required');
            $this->form_validation->set_message('required','Poje %s je prazno.');
            
            if($this->form_validation->run()== false)
            {

            }
           else 
            {
                $idIzmena = $this->input->post('idIzmenaKorisnika');
                $this->Model_Logovanje->id = $idIzmena;
                $podaciUnos = array(
                    'id_uloge' => $this->input->get('ddlUloga')
                );
                $this->Model_Logovanje->izmeni($podaciUnos);
                $this->podaci['obavestenje'] = "Podaci su promenjeni!";
            }
        }
      
        $korisnici = $this->Model_Logovanje->korisnici();
        
        
        $id = $this->uri->segment(3);
        $this->Model_Logovanje->id = $id;
        $this->Model_Logovanje->obrisi();
        
        $this->load->library('table');
            
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered table-striped">'));
        $this->table->set_heading('Ime', 'Prezime', 'Username', 'Lozinka', 'Email', 'Uloga', 'Izmena', 'Obrisi');

        foreach ($korisnici as $k)
        {
            $link = anchor('administracija/korisnici/'.$k->id_korisnik, 'Obrisi', array('class' => 'brisanje'));
            $izmena = anchor('administracija/korisnici?idIzmenaKorisnika='.$k->id_korisnik, 'Izmeni');
            $this->table->add_row($k->ime, $k->prezime, $k->username, $k->password, $k->email, $k->naziv, $izmena, $link);
        }
        $this->podaci['tabelaKorisnici'] = $this->table->generate();
        
        
        $this->load_view("admin/korisnici", $this->podaci);
    }
    
    public function izmeniKorisnika() 
    {
        
    }
}
