<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    var $controller = "product";

    public function __construct() {
        parent::__construct();
        $this->load->model($this->controller . '_model');
//        $this->load->model('common_model');
    }

    function index() {
        $getdata = $this->product_model->get_product_entries();
        $data['getProdData'] = $getdata;
        
        $getCatdata = $this->product_model->get_cat_entries();
        $data['getProductCatData'] = $getCatdata;
        $this->load->view($this->controller, $data);
    }

    public function insert() {
        $this->product_model->insert_entry();

        redirect(base_url() . $this->controller);
    }
    public function delete() {
        $this->product_model->delete_entry();
    }

    public function getEditData() {
        $someArray = $this->product_model->get_edit_entry();
        $someJSON = json_encode($someArray);
        echo $someJSON;
    }

}
