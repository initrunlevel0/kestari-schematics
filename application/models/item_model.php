<?php
class item_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function daftar_tempat_penyisihan() {
        $query = $this->db->get("tempatlomba");
        return $query->result_array();
    }
}
?>