<?php

class Prod_cat_model extends CI_Model {

    public function get_cat_entries() {
        $query = $this->db->get('prod_cat');
        return $query->result_array();
    }

    public function get_edit_entry() {
        $id = $this->input->get_post('int_id');
        $query = $this->db->query('SELECT * FROM prod_cat where int_id="' . $id . '"');
        return $query->row_array();
    }

    public function insert_entry() {
        $name = $this->input->get_post('varName');
        $id = $this->input->get_post('eid');
        $data = array(
            'varName' => $name,
            'dtDateTime' => date('Y-m-d H:i:s')
        );
        if ($id == '') {
            $this->db->insert('prod_cat', $data);
        } else {
            $this->db->update('prod_cat', $data, array('int_id' => $id));
        }
    }

    public function delete_entry() {
        $id = $this->input->get_post('int_id');
        $this->db->where('int_id', $id);
        $this->db->delete('prod_cat');
    }

}
?>