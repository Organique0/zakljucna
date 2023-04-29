<?php
class model extends CI_Model {

    public function __construct(){
            $this->load->database();
            
    }

    public function vrniVseUporabnike($uporabnisko_ime = NULL){
        if($uporabnisko_ime == NULL){

            $query = $this->db->get('uporabniki');
        }
        else{
            $this->db->like(array('uporabnisko_ime' => $uporabnisko_ime),'after');
            $query = $this->db->get_where('uporabniki',);
        }

        return $query->result_array();
        
    }

    public function vrniUporabnika($uporabnisko_ime){
        $this->db->like(array('uporabnisko_ime' => $uporabnisko_ime),'after');
        $query = $this->db->get_where('uporabniki',);
        return $query->row();
    }
    
    public function preveriUpoIme($uporabnisko_ime){
        $query = $this->db->get_where('uporabniki', array('uporabnisko_ime' => $uporabnisko_ime));

        if($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function preveriUpoMail($Eposta){
        $query = $this->db->get_where('uporabniki', array('Eposta' => $Eposta));

        if($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function preveriUpoGeslo($uporabnisko_ime,$geslo){
        $arr['uporabnisko_ime'] = $uporabnisko_ime;
        $arr['geslo'] = $geslo;

        $query = $this->db->get_where('uporabniki', $arr[0]);//najde vnos v bazi od določenega uporabniskega imena
        $vrstica = $query->row();
        $geslo2 = $this->encryption->decrypt($vrstica->geslo);//dekriptira njegovo geslo

        if($query->num_rows() > 0 and $geslo2 = $geslo){
            return true;
        }
        else{
            return false;
        }
    }
    public function aliJeAdmin($uporabnisko_ime){
        $this->db->select('uporabniki.idUporabnika,uporabniki.uporabnisko_ime');
        $this->db->from('uporabniki');
        $this->db->join('admin', 'admin.idUporabnika = uporabniki.idUporabnika');
        $this->db->where('uporabniki.uporabnisko_ime',$uporabnisko_ime);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function aliJeSestavljalec($uporabnisko_ime){
        $this->db->select('uporabniki.idUporabnika,uporabniki.uporabnisko_ime');
        $this->db->from('uporabniki');
        $this->db->join('sestavljalec', 'sestavljalec.idUporabnika = uporabniki.idUporabnika');
        $this->db->where('uporabniki.uporabnisko_ime',$uporabnisko_ime);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function odstraniAdmin3($idUporabnika){
        $this->db->delete('admin', array('idUporabnika' => $idUporabnika));
    }

    public function dodajAdmin3($idUporabnika){
        $this->db->insert('admin', array('idUporabnika' => $idUporabnika));
    }

    public function odstraniSestavljalec3($idUporabnika){
        $this->db->delete('sestavljalec', array('idUporabnika' => $idUporabnika));
    }

    public function dodajSestavljalec3($idUporabnika){
        $this->db->insert('sestavljalec', array('idUporabnika' => $idUporabnika));
    }

    public function registriraj($uporabnisko_ime,$geslo,$Eposta){
        $data = array(
            'idUporabnika' => md5($uporabnisko_ime),
            'uporabnisko_ime' => $uporabnisko_ime,
            'geslo' => $geslo,
            'Eposta' => $Eposta,
            );

            $query = $this->db->insert('uporabniki', $data);        
    }
    
    public function shraniLabirint($data){
        if($data["stopnja"] <= $this->model->kolikoStopenjObstaja()){
            $this->db->where('stopnja', $data["stopnja"]);
            $this->db->update('naloga', $data);
        }
        else{
            $query = $this->db->insert('naloga', $data);
        }
    }

//    public function izbrisiLabirint($stopnja){
//        $this->db->where('stopnja', $stopnja);
//        $this->db->delete('naloga', $data);
//    }

    public function naloziLabirinte(){ //vrne vse labirinte v podatkovni bazi kot array objektov
        $labirinti = [];
        $this->db->from('naloga');
        $this->db->order_by("stopnja", "asc");
        $query = $this->db->get();
        foreach($query->result() as $row){
            array_push($labirinti, $row);   
        }
        return $labirinti;
    }

    public function kolikoStopenjObstaja(){
        $this->db->select('*');
        $this->db->from('naloga');
        $Ststopnje=$this->db->count_all_results();//preveri koliko levelov že obstaja in nastavi trenuten level na, za eno večjo, vrednost
        return $Ststopnje;
    }

    public function shraniLevelKoncan($trenutniLevel, $uporabnik){
        #najde id trenutnega uporabnika (nevem zakaj sem sploh uporabil id-je. Tako ali tako so uporabniška imena unique)
        $idUporabnika = $this->model->vrniIdUporabnika($uporabnik);

        #ponovimo postopek, da dobimo id naloge.
        $this->db->select('idNaloge'); 
        $this->db->from('naloga');
        $this->db->where('stopnja', $trenutniLevel);
        $idNaloge = $this->db->get()->row()->idNaloge;
        
        $data = array(
            'uporabnik_idUporabnika' => $idUporabnika,
            'naloga_idNaloge' => $idNaloge,
            'datumResevanja' => date("Y-m-d"),
        );

        $query = $this->db->insert('uporabnik_resi_naloga', $data);
    }

    public function vrniKoncaneLeveleUporabnika($uporabnik){
        $idUporabnika = $this->model->vrniIdUporabnika($uporabnik);

        $this->db->select('stopnja, uporabnik_resi_naloga.datumResevanja as datum');
        $this->db->from('naloga');
        $this->db->join('uporabnik_resi_naloga', 'uporabnik_resi_naloga.naloga_idNaloge = naloga.idNaloge AND uporabnik_idUporabnika ='.$idUporabnika);
        $this->db->order_by('stopnja ASC');
        //vrne rezultate kot polje npr. (Array ([0] => Array ([naloga_idNaloge] => 82 )))
        $stopnje = $this->db->get()->result_array();
        return $stopnje;
    }

    public function vrniIdUporabnika($uporabnik){
        $this->db->select('idUporabnika'); 
        $this->db->from('uporabniki');
        $this->db->where('uporabnisko_ime', $uporabnik);
        return ($this->db->get()->row()->idUporabnika);
    }

}
