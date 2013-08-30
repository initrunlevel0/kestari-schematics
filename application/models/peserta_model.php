<?php
class peserta_model extends CI_Model {
    function tambahkan_peserta($data, $jenis) {
        $this->db->insert($jenis, $data);
    }
    
    function sunting_peserta($id, $data, $jenis) {
        $this->db->where("id_".$jenis, $id);
        $this->db->update($jenis, $data);
    }
    
    function daftar_peserta_belum_diverifikasi($jenis) {
        $query = $this->db->get_where($jenis, array("status" => 0));
        return $query->result_array();
    }
    
    function verifikasikan_peserta($id, $jenis) {
        $this->db->where("id_".$jenis, $id);
        $this->db->update($jenis, array("status" => 1));
    }
    
    function lihat_peserta($id, $jenis) {
        $query = $this->db->get_where($jenis, array("id_".$jenis => $id));
        return $query->first_row("array");
    }
    
    function daftar_peserta($jenis) {
        $query = $this->db->get($jenis);
        return $query->result_array();
    }
}
?>
