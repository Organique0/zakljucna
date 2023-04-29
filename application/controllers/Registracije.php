<?php
class Registracije extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model');
        $this->load->library('encryption');
    }

    public function registracijskiObrazec(){

        $this->load->helper('form');

        $data['title'] = 'Registracija';
        $this->load->view('templates/header', $data);
        $this->load->view('pages/registracija');
        $this->load->view('templates/footer');

    }

    public function preveriRegistracijo(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $uporabnisko_ime=$this->input->post('upoIme');
        $geslo = $this->input->post('upoGeslo');
        $geslo2 = $this->input->post('upoGeslo2');
        $geslo_enc = $this->encryption->encrypt($geslo);
        $Eposta = $this->input->post('upoMail');
        $Eposta_enc = $this->encryption->encrypt($Eposta);//nepotrebno delo

        $this->session->set_flashdata('ime',$uporabnisko_ime);
        $this->session->set_flashdata('mail',$Eposta);

        $this->form_validation->set_message('required', 'Manjka {field}');

        $this->form_validation->set_rules('upoIme','uporabniško ime','required');
        $this->form_validation->set_rules('upoGeslo','geslo','required');
        $this->form_validation->set_rules('upoGeslo2','geslo','required');
        $this->form_validation->set_rules('upoMail','geslo','required');
        
        if ($this->form_validation->run()){
            if($this->model->preveriUpoIme($uporabnisko_ime) === FALSE){
                if($this->model->preveriUpoMail($Eposta) === FALSE){
                    if($geslo==$geslo2){
                        if(strlen($geslo)>=6){
                            $this->model->registriraj($uporabnisko_ime,$geslo_enc,$Eposta);
                            redirect('/prijava');
                        }
                        else{
                            $this->session->set_flashdata('prekratkoGeslo','Geslo mora vsebovati vsaj 6 znakov');
                            redirect('/registracija');
                        }
                    }
                    else{
                        $this->session->set_flashdata('gesliNeUjemata','Gesli se ne ujemata');
                        redirect('/registracija');
                    }
                }
                else{
                    $this->session->set_flashdata('obstajaMail','Ta e-mail že obstaja');
                    redirect('/registracija');
                }
            }
            else {
                $this->session->set_flashdata('obstajaIme','To ime že obstaja');
                redirect('/registracija');
            }
        }
        else{
            if(empty($uporabnisko_ime)){
                $this->session->set_flashdata('niImena','Manjka uporabnisko ime');
            }
            if(empty($Eposta)){
                $this->session->set_flashdata('niENaslova','Manjka E-pošta');
            }
            if(empty($geslo)){
                $this->session->set_flashdata('niGesla','Manjka geslo');
            }
            if(empty($geslo2)){
                $this->session->set_flashdata('niGesla2','Manjka geslo');
            }

            redirect('/registracija');
        }
    }
}