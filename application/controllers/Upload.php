<?php

class Upload extends CI_Controller
{
    function __construct()
    {
        // this is your constructor
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function imgupload() {
        $this->load->view('uploadfile');
    }

    public function create()
    {
        $form_data = $this->input->post();
        if (0 != count($form_data)) {
            $this->load->model(array('Database'));
            $this->Database->insert($form_data['product']);
            $data['list'] = $this->Database->get_all();
            redirect('');
        } else {
            print_r('Created failed');
        }
    }

    public function view()
    {
        $this->load->model(array('Database'));
        $data['list'] = $this->Database->get_all();
        
        $data['title'] = 'This is a Test1';
        $this->load->view('templates/header', $data);
        //print_r($data);
        $this->load->view('test/test', $data);
        //$this->load->view('templates/footer', $data);
    }


    public function list()
    {
        $this->load->model(array('Database'));
        $data['list'] = $this->Database->get_all();
        //$params = $this->Database->get_all();
        //print_r($params);

        //$per_page = $params['per_page'];
        //$offset = $params['per_page'] * ($params['page']-1);

        //$data['page'] = $params['page'];
        //$data['per_page'] = $per_page;

        //$total_count = $this->Database->get_count_by_params('', $params);
        //$data['total_count'] = $total_count;
        //$data['max_page'] = round($total_count/$per_page+0.49);
        //$data['list'] = $this->Database->get_all_by_params('', $params, '', $per_page, $offset);
        $this->load->view('products_view', $data);

    }
}

?>