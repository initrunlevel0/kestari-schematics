<?php
class kartupeserta_model extends CI_Model {
    function __construct() {
        parent::__construct;
    }
    
    function generate_nlc($id_nlc) {
        $data_peserta = $this->peserta_model->lihat_peserta($id_nlc, "nlc");
        if($data_peserta != null) {
            
        }
    }
}
?>
