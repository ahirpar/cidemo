<?php

class Product_model extends CI_Model {

    public function get_product_entries() {
        $query = $this->db->get('product');
        return $query->result_array();
    }

    public function get_edit_entry() {
        $id = $this->input->get_post('int_id');
        $query = $this->db->query('SELECT * FROM product where int_id="' . $id . '"');
        return $query->row_array();
    }

    public function get_cat_entries() {
        $query = $this->db->query('SELECT * FROM prod_cat order by int_id');
        $data = $query->result_array();
        $html = "";
        $html .= "<select id='intCategory' name='intCategory[]' class='form-control' multiple size='5'>";
        foreach ($data as $row) {
            $html .= "<option value='" . $row['int_id'] . "'>" . $row['varName'] . "</option>";
        }
        $html .= "</select>";
        return $html;
    }

    public function insert_entry() {
        $category = $this->input->get_post('intCategory');
        $category_data = implode(",", $category);
        $name = $this->input->get_post('varName');
        $id = $this->input->get_post('eid');
        $data = array(
            'intCategory' => $category_data,
            'varName' => $name,
            'dtDateTime' => date('Y-m-d H:i:s')
        );
//        print_R($data);exit;
        if ($id == '') {
            $this->db->insert('product', $data);
        } else {
            $this->db->update('product', $data, array('int_id' => $id));
        }
    }

    public function delete_entry() {
        $id = $this->input->get_post('int_id');
        $this->db->where('int_id', $id);
        $this->db->delete('product');
    }

}

?>