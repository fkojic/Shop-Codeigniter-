<?php

class Home extends Frontend_Controller{
     
    public function __construct() {
        parent::__construct();
        
        $this->podaci['kategorija_naslov'] = $this->Model_Kategorija->dohvati_naslov();
        $this->podaci['proizvodi'] = $this->Model_Proizvod->proizvodi();
        $sesija =$this->session->userdata('ulogovan');
        $uloga = $this->session->userdata('uloga');
        if($uloga =='admin'){
            redirect('administracija');
        }
        
    }
    
    public function index() 
    {    
        $this->podaci["title"] = "Pocetna";
        $this->podaci['proizvodSlajder'] = $this->Model_Proizvod->proizvodSlajder();
        $this->load_view("sadrzaj", $this->podaci);
    }
    
    public function proizvod_detalji() 
    {
        $this->podaci["title"] = "Proizvod";
        $id = $this->input->get('idProizvod');
        $this->podaci['proizvod'] = $this->Model_Proizvod->proizvod($id);
        
        $this->load_view("proizvod_detalji", $this->podaci);
    }
    
    public function registracija() 
    {
        
        
        $this->podaci["title"] = "Registracija";
        
        $dugme = $this->input->post('btnUnesi');
        $uneti_podaci = array();         
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
                        $podaciUnos = array(
                            'ime' => $this->input->post('tbIme'),
                            'prezime' => $this->input->post('tbPrezime'),
                            'username' => $this->input->post('tbUsername'),
                            'password' => md5($this->input->post('tbLozinka')),
                            'email' => $this->input->post('tbEmail'),
                            'id_uloge' => '2'
                        );
                        $this->Model_Logovanje->unesi($podaciUnos);
                        $this->podaci['obavestenje'] = "Podaci su uneti u bazu!";
                    }
                 }
             
             $this->podaci['tbIme']= array(
                 'name'=>"tbIme",
                 'id'=>"tbIme", 
                 'value'=>isset($uneti_podaci['ime']) ? $uneti_podaci['ime'] : '', 
                 'size'=>"30", 
                 'class'=>'form-control'
            );
             $this->podaci['tbPrezime']= array(
                 'name'=>"tbPrezime",
                 'id'=>"tbPrezime", 
                 'value'=>isset($uneti_podaci['prezime']) ? $uneti_podaci['prezime'] : '', 
                 'size'=>"30", 
                 'class'=>'form-control'
            );
             $this->podaci['tbUsername']= array(
                 'name'=>"tbUsername",
                 'id'=>"tbUsername", 
                 'value'=>isset($uneti_podaci['username']) ? $uneti_podaci['username'] : '', 
                 'size'=>"30", 
                 'class'=>'form-control'
            );
             $this->podaci['tbLozinka'] = array(
                 "name"=>"tbLozinka", 
                 "id"=>"tbLozinka", 
                 "value"=>isset($uneti_podaci['lozinka']) ? $uneti_podaci['lozinka'] : '', 
                 "size"=>"30", 
                 'class'=>'form-control'
            );
             $this->podaci['tbEmail'] =array(
                 "name"=>"tbEmail", 
                 "id"=>"tbEmail", 
                 "value"=>isset($uneti_podaci['email']) ? $uneti_podaci['email'] : '', 
                 "size"=>"30", 
                 'class'=>'form-control'
            );
            
        $this->load_view("registracija", $this->podaci);
    }
    
    public function proizvodi()
    {
        $this->podaci["title"] = "Proizvodi";
        $id = $this->uri->segment(3);
        $this->podaci["id"] = $id;
        $this->podaci['proizvodKategorija'] = $this->Model_Proizvod->proizvodKategorija($id);
        $this->podaci['proizvodMax'] = $this->Model_Proizvod->proizvodMax($id);
        $this->podaci['proizvodjac'] = $this->Model_Proizvod->proizvodjac($id);
        
        $this->load_view("proizvodi", $this->podaci);
    }
    
    public function ajaxProizvod($id) 
    {
        
        $rows = $this->Model_Proizvod->proizvodKategorija($id);

        if(isset($rows)){
            foreach ($rows as $row) {
//            echo 'ima';
        echo '<div class="well well-small"><div class="row-fluid">	  
		<div class="span2">
                    <img src="'.base_url('assets/img/').$row->slika.'" alt=""></div>';
        echo '<div class="span6"><h5>'.$row->naslov.'</h5>
			<p>'.$row->opis.'</p></div>';
        echo '<div class="span4 alignR">
		<form class="form-horizontal qtyFrm">
		<h3>'.$row->cena.' €</h3><br>
		</form>';
        echo '<a href="'.base_url('Home/proizvod_detalji?idProizvod=').$row->id_proizvod.'" class="btn btn-primary pull-left">Više</a>';
        $btn = array(
                          'class' => 'shopBtn',
                          'value' => 'Dodaj u korpu',
                          'name' => 'action'
                          );
                        echo form_open("home/korpa");
                        echo form_hidden('id', $row->id_proizvod);
                        echo form_hidden('name', $row->naslov);
                        echo form_hidden('price', $row->cena);
                        echo form_hidden('slika', $row->slika);
                        echo form_submit($btn);
                        echo form_close();
                        
                        echo '<div class="btn-group"></div></div></div>
                            <hr class="soften"></div>';
            }
        }
        else{
            echo 'nema';
        }
    }
    
    public function korpa() 
    {
        $uloga = $this->session->userdata('uloga');
        if($uloga =="korisnik")
        {        
        $this->podaci["title"] = "Korpa";
        $this->load->library('cart');
        $insert_data = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'qty' => 1,
            'slika' => $this->input->post('slika'),
        );
        
        $this->cart->insert($insert_data);

        $this->load_view('korpa', $this->podaci);
        }
        else
        {
            redirect('home/registracija');
        }
    }
    
    public function update_cart(){
        $uloga = $this->session->userdata('uloga');
        if($uloga =="korisnik")
        {
        $this->podaci["title"] = "Korpa";
        $cart_info = $_POST['cart'] ;
        foreach( $cart_info as $id => $cart)
        {
        $rowid = $cart['rowid'];
        $price = $cart['price'];
        $amount = $price * $cart['qty'];
        $qty = $cart['qty'];
        $slika = $cart['slika'];

        $data = array(
        'rowid' => $rowid,
        'price' => $price,
        'amount' => $amount,
        'qty' => $qty,
        'slika' => $slika
        
        );

        $this->cart->update($data);
        }
        $this->load_view('korpa', $this->podaci);
        }
        else
        {
            redirect('home/registracija');
        }
    }
    
    function remove($rowid) {
        $uloga = $this->session->userdata('uloga');
        if($uloga =="korisnik")
        {
        $this->podaci["title"] = "Korpa";
        if ($rowid==="all"){
        $this->cart->destroy();
        }else{
        $data = array(
        'rowid' => $rowid,
        'qty' => 0
        );
        $this->cart->update($data);
        }
        $this->load_view('korpa', $this->podaci);
        }
        else
        {
            redirect('home/registracija');
        }
    }
    
    public function profil() 
    {    
        $this->podaci["title"] = "Profil";
        
        $prezime = $this->session->userdata('prezime');
        $username = $this->session->userdata('username');
        $sifra = $this->session->userdata('password');
        $mail = $this->session->userdata('email');
        $ime = $this->session->userdata('ime');
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
                        $this->podaci['obavestenje'] = "Podaci su promenjeni! Da biste videli rezultate promene morate se ponovo ulogovati, hvala.";
                    }
                 }
        
        $this->podaci['tbIme']= array(
                 'name'=>"tbIme",
                 'id'=>"tbIme", 
                 'value'=>$ime, 
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
        $this->load_view("profil", $this->podaci);
        
        
    }
    
    public function autor() 
    {
       $this->load->model('Model_Anketa');
       
       $this->podaci["title"] = "Autor";
        
       $this->podaci['autor'] = $this->Model_Logovanje->autor();
       $this->podaci['anketa'] = $this->Model_Anketa->dohvati();
       
       $this->load_view("autor", $this->podaci);
    }
    public function ajax($odgovor,$id) 
    {
        $this->load->model('Model_Anketa');
        if($odgovor==1){
            $row=$this->Model_Anketa->dohvatiAnketu($id);
            $this->Model_Anketa->glasaj($id,$row->pitanje,$row->da+1,$row->ne);
            $row=$this->Model_Anketa->dohvatiAnketu($id);
            echo 'Da : '.$row->da.br().'Ne : '.$row->ne;
        }else if($odgovor==0){
            $row=$this->Model_Anketa->dohvatiAnketu($id);
            $this->Model_Anketa->glasaj($id,$row->pitanje,$row->da,$row->ne+1);
            $row=$this->Model_Anketa->dohvatiAnketu($id);
            echo 'Da : '.$row->da.br().'Ne : '.$row->ne;
        }else{
            echo 'nista';
        }
    }
    public function galerija($offset= null) 
    {
       
       $this->podaci["title"] = "Galerija";
       $this->load->library('pagination');
       $config['base_url'] = base_url().'home/galerija/';
       $config['total_rows'] = $this->Model_Proizvod->galerija();
       $config['per_page'] = 1;

       $this->pagination->initialize($config);
       $this->podaci['galerija'] = $this->Model_Proizvod->pagination1($config['per_page'],$offset); 
       
       
       $this->load_view("galerija", $this->podaci);
    }
    
    public function cena($cena, $id) 
    {
        $rows = $this->Model_Proizvod->cena($cena, $id);
        
        if(isset($rows)){
            foreach ($rows as $row) {
//            echo 'ima';
        echo '<div class="well well-small"><div class="row-fluid">	  
		<div class="span2">
                    <img src="'.base_url('assets/img/').$row->slika.'" alt=""></div>';
        echo '<div class="span6"><h5>'.$row->naslov.'</h5>
			<p>'.$row->opis.'</p></div>';
        echo '<div class="span4 alignR">
		<form class="form-horizontal qtyFrm">
		<h3>'.$row->cena.' €</h3><br>
		</form>';
        echo '<a href="'.base_url('Home/proizvod_detalji?idProizvod=').$row->id_proizvod.'" class="btn btn-primary pull-left">Više</a>';
        $btn = array(
                          'class' => 'shopBtn',
                          'value' => 'Dodaj u korpu',
                          'name' => 'action'
                          );
                        echo form_open("home/korpa");
                        echo form_hidden('id', $row->id_proizvod);
                        echo form_hidden('name', $row->naslov);
                        echo form_hidden('price', $row->cena);
                        echo form_hidden('slika', $row->slika);
                        echo form_hidden('idC', $row->id_kategorija);
                        echo form_submit($btn);
                        echo form_close();
                        
                        echo '<div class="btn-group"></div></div></div>
                            <hr class="soften"></div>';
            }
        }
        else{
            echo 'nema';
        }
        
    }
    public function cenaPromena($cena) {
        echo $cena;
    }
}