<?php
class Prijave extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model');
        $this->load->library('encryption');
    }

    public function prijavniObrazec(){

        $this->load->helper('form');

        $data['title'] = 'Prijava';
        $this->load->view('templates/header', $data);
        $this->load->view('pages/prijava');
        $this->load->view('templates/footer');

    }

    public function preveriPrijavo(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $uporabnisko_ime=$this->input->post('upoIme');
        $geslo = $this->input->post('upoGeslo');
        
        $this->session->set_flashdata('ime',$uporabnisko_ime);

        $this->form_validation->set_message('required', 'Manjka {field}');

        $this->form_validation->set_rules('upoIme','uporabniško ime','required');
        $this->form_validation->set_rules('upoGeslo','geslo','required');
            
        if ($this->form_validation->run()){

            if($this->model->preveriUpoIme($uporabnisko_ime) === FALSE){

                $this->session->set_flashdata('napacnoIme','To uporabnisko ime ne obstaja');
                redirect('/prijava');
            }

            if($this->model->preveriUpoGeslo($uporabnisko_ime,$geslo)){ //uspela prijava
                $_SESSION["upoIme"]=$uporabnisko_ime;
                if ($this->model->aliJeAdmin($uporabnisko_ime)){//pogleda, če je administrator ali navaden uporabnik
                    $_SESSION["admin"]=1;
                    
                }
                else{
                    $_SESSION["admin"]=0;
                    
                }
                if ($this->model->aliJeSestavljalec($uporabnisko_ime)){
                    $_SESSION["sestavljalec"]=1;
                    
                }
                else{
                    $_SESSION["sestavljalec"]=0;
                    
                }
                redirect('/domov');
            }
            else{

                $this->session->set_flashdata('napacnoGeslo','To geslo ni pravilno');
                redirect('/prijava');
            }
        }
        else{

            if(empty($uporabnisko_ime)){

                $this->session->set_flashdata('niImena','Manjka uporabnisko ime');
            }

            if(empty($geslo)){

                $this->session->set_flashdata('niGesla','Manjka geslo');
            }

            redirect('/prijava');
        }
    }

    public function uspelaPrijava(){
        if($_SESSION("upoIme") !== null){

            $data['title'] = 'Prijava je bila uspesna';
            $this->load->view('templates/header', $data);
            $this->load->view('pages/success');
            $this->load->view('templates/footer');
        }
        else{

            redirect('/prijava');
        }
        
    }

    public function odjava(){
        session_destroy();
        redirect('/');
    }
}