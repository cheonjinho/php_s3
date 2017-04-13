<?php

class Test_Controller extends CI_Controller
{
    public function create()
    {
        $form_data = $this->input->post();
        if (0 != count($form_data)) {
            print_r("form_data is");
            print_r($form_data);
            $this->load->model(array('MY_Model'));
            $this->MY_Model->insert($form_data['product']);
            $data['list'] = $this->MY_Model->get_all();
            $this->load->view('test/test');
            
        } else {
            $this->load->view('test/new');
        }
    }

    public function view()
    {
        if (!file_exists('application/views/test/test.php'))
        {
            show_404();
        }
        
        $this->load->model(array('MY_Model'));
        $data['list'] = $this->MY_Model->get_all();
        
        $data['title'] = 'This is a Test1';
        $this->load->view('templates/header', $data);
        //print_r($data);
        $this->load->view('test/test', $data);
        //$this->load->view('templates/footer', $data);
    }


    public function list1()
    {
        if (!file_exists('application/views/test/test.php'))
        {
            show_404();
        }

        $params = $this->input->get();
        //print_r($params);

        $per_page = $params['per_page'];
        $offset = $params['per_page'] * ($params['page']-1);

        $data['page'] = $params['page'];
        $data['per_page'] = $per_page;

        $this->load->model(array('MY_Model'));
        $total_count = $this->MY_Model->get_count_by_params('', $params);
        $data['total_count'] = $total_count;
        $data['max_page'] = round($total_count/$per_page+0.49);
        $data['list'] = $this->MY_Model->get_all_by_params('', $params, '', $per_page, $offset);
        $this->load->view('test/list', $data);

    }
}

?>