<?php
class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model');
        if( ! $this->session->has_userdata('upoIme')){
            redirect(prijava);
        }
    }

    public function reIskanje()
    {
        redirect('admin');
    }

    public function izpisiVseUporabnike()
    {
    
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'prikaz vseh uporabnikov';
        $data['ime'] = $this->input->post('iskalnik');
        $data['vsiUporabniki'] = $this->model->vrniVseUporabnike($data['ime']);

        $this->load->view('templates/header',$data);
        $this->load->view('pages/vnosIskanja', $data);
        $this->load->view('pages/izpisUporabnikov', $data);
        $this->load->view('templates/footer');
        
    }

    public function pregledUporabnika(){
        $data['title'] = 'prikaz uporabnika';
        $data['ime'] = $this->input->get('uporabnisko_ime');
        $data['podatkiUporabnika'] = $this->model->vrniUporabnika($data['ime']);
        
        $data['admin'] = $this->model->aliJeAdmin($data['ime']);
        $data['sestavljalec'] = $this->model->aliJeSestavljalec($data['ime']);

        $data['reseniLeveli'] = $this->model->vrniKoncaneLeveleUporabnika($data['ime']);

        $this->load->view('templates/header',$data);
        $this->load->view('pages/pregledUporabnika', $data);
        $this->load->view('templates/footer');
    }

}

    