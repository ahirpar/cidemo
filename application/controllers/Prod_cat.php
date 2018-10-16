<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Prod_cat extends CI_Controller {

    var $controller = "prod_cat";

    public function __construct() {
        parent::__construct();
        $this->load->model($this->controller . '_model');
//        $this->load->model('common_model');
    }

    function index() {
        $getCatdata = $this->prod_cat_model->get_cat_entries();
        $data['getProdCatData'] = $getCatdata;
        $this->load->view($this->controller, $data);
    }

    public function insert() {
        $this->prod_cat_model->insert_entry();

        redirect(base_url() . $this->controller);
    }
    public function delete() {
        $this->prod_cat_model->delete_entry();
    }

    public function getEditData() {
        $someArray = $this->prod_cat_model->get_edit_entry();
        $someJSON = json_encode($someArray);
        echo $someJSON;
    }

}
