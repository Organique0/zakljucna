<?php
class Pisi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        $this->load->helper('form');
        $this->load->model('model');
    }

    public function shrani(){
        $labirintCel=$_POST['posljiLabirint'];
        //prvi znak v labirintu je smer
        $zacetnaOrientacija=substr($labirintCel,0,1);
        //naslednja 3 so stopnja
        $stopnja=substr($labirintCel,1,3);
        $labirint=substr($labirintCel,4);
        $data = array(
            'labirint' => $labirint,
            'zacetnaOrientacija' => $zacetnaOrientacija,
            'stopnja' => $stopnja,
        );
        $this->model->shraniLabirint($data);
    }

//   public function brisi(){
//        $stopnja = $_POST['stopnja'];
//        $this->model->izbrisiLabirint($stopnja);
//    }

    public function levelKoncan(){
        $uporabnik = $_SESSION["upoIme"];
        $trenutniLevel = $_GET['trenutniLevel'];
        $this->model->shraniLevelKoncan($trenutniLevel, $uporabnik);
    }

    public function dodajAdmin2(){
        $idUporabnika = $_GET['idUporabnika'];
        $this->model->dodajAdmin3($idUporabnika);
    }
    public function odstraniAdmin2(){
        $idUporabnika = $_GET['idUporabnika'];
        $this->model->odstraniAdmin3($idUporabnika);
    }
    public function dodajSestavljalec2(){
        $idUporabnika = $_GET['idUporabnika'];
        $this->model->dodajSestavljalec3($idUporabnika);
    }
    public function odstraniSestavljalec2(){
        $idUporabnika = $_GET['idUporabnika'];
        $this->model->odstraniSestavljalec3($idUporabnika);
    }
};