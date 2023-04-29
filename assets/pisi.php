<?php
class Pisi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
    }

    public function pisi(){
        $data = $_GET['text'];
    if ( ! write_file('assets/labirinti.json', $data))
    {
            echo 'Unable to write the file';
    }
    else
    {
            echo 'File written!';
    }

    

}
}  