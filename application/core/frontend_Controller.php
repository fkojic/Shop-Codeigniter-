<?php

class Frontend_Controller extends CI_Controller{
    private $data = array();
    public function __construct() {
        parent::__construct();
        $this->podaci['css_data'][] = link_tag("assets/css/bootstrap.css", "stylesheet", "text/css");
        $this->podaci['css_data'][] = link_tag("assets/css/lightbox.css", "stylesheet", "text/css");
        $this->podaci['css_data'][] = link_tag("assets/style.css", "stylesheet", "text/css");
        $this->podaci['css_data'][] = link_tag("assets/font-awesome/css/font-awesome.css", "stylesheet", "text/css");
        
        
        $this->podaci['meta_data'][] = meta("viewport", "width=device-width, initial-scale=1.0");
        $this->podaci['meta_data'][] = meta("description", "Početna");
        $this->podaci['meta_data'][] = meta("author", "Filip");
        
        $this->load->model("Model_Kategorija");
        $this->load->model("Model_Proizvod");
        $this->load->model("Model_Meni");
        $this->load->model("Model_Logovanje");
        $id = $this->session->userdata('id_uloge');
        $this->podaci['meni'] = $this->Model_Meni->meni($id);
        
        $this->load->library('cart');
    }
    
    public function load_view($view, $data)
    {
        $this->load->helper('form') ;
        $this->load->view('header', $data);
        $this->load->view('meni', $data);
//
        $this->load->view($view, $data);
        $this->load->view('footer', $data);
    }
}
