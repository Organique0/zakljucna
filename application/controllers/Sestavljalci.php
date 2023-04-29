<?php
class Sestavljalci extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model');
        $this->load->library('encryption');
    }
    
    public function prikazi(){
        $data['title'] = 'Naloga';
        $data['labirinti'] = $this->model->naloziLabirinte();
        $this->load->view('templates/header', $data);
        $this->load->view('pages/sestavljalec', $data);
        $this->load->view('templates/footer');

    }
}