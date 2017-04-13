<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Database extends CI_Model {

    protected $table_name = 'product';
    protected $primary_key = 'id';

    public function __construct() { 
        parent::__construct();

        $this->load->database();

        $this->load->helper('inflector');

        if (!$this->table_name) {
            $this->table_name = strtolower(plural(get_class($this)));
        }
    }

    public function get_id($id) {
        return $this->db->get_where($this->table_name, array($this->primary_key => $id))->row();
    }

    public function get_all($fields = '', $where = array(), $table = '', $limit = '', $order_by = '', $group_by = '') {
        $data = array();
        if ($fields != '') {
            $this->db->select($fields);
        }

        if (count($where)) {
            $this->db->where($where);
        }

        if ($table != '') {
            $this->table_name = $table;
        }

        if ($limit != '') {
            $this->db->limit($limit);
        }

        if ($order_by != '') {
            $this->db->order_by($order_by);
        }

        if ($group_by != '') {
            $this->db->group_by($group_by);
        }

        $Q = $this->db->get($this->table_name);

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();

        return $data;
    }


    public function get_count_by_params($fields = '', $where = array(), $table = '', $limit = '', $offse = '', $order_by = '', $group_by = '') {
        $data = 0;
        if ($fields != '') {
            $this->db->select($fields);
        }

        if (count($where)) {
            if ($where["ca_elct"] == 'true') $this->db->where("type_a", "전자제품");
            if ($where["ca_furn"] == 'true') $this->db->or_where("type_a", "가구");
            if ($where["ca_lapt"] == 'true') $this->db->or_where("type_b", "노트북");
            if ($where["ca_refr"] == 'true') $this->db->or_where("type_b", "냉장고");
            if ($where["ca_desk"] == 'true') $this->db->or_where("type_b", "책상");
            if ($where["ca_chir"] == 'true') $this->db->or_where("type_b", "의자");
        }

        if ($table != '') {
            $this->table_name = $table;
        }

        if ($limit != '') {
            $this->db->limit($limit);
            $this->db->offset($offset);
        }

        if ($order_by != '') {
            $this->db->order_by($order_by);
        }

        if ($group_by != '') {
            $this->db->group_by($group_by);
        }

        $Q = $this->db->get($this->table_name);

        $data = $Q->num_rows();
        $Q->free_result();

        return $data;
    }

    public function get_all_by_params($fields = '', $where = array(), $table = '', $limit = '', $offset, $order_by = '', $group_by = '') {
        $data = array();
        if ($fields != '') {
            $this->db->select($fields);
        }

        if (count($where)) {
            if ($where["ca_elct"] == 'true') $this->db->where("type_a", "전자제품");
            if ($where["ca_furn"] == 'true') $this->db->or_where("type_a", "가구");
            if ($where["ca_lapt"] == 'true') $this->db->or_where("type_b", "노트북");
            if ($where["ca_refr"] == 'true') $this->db->or_where("type_b", "냉장고");
            if ($where["ca_desk"] == 'true') $this->db->or_where("type_b", "책상");
            if ($where["ca_chir"] == 'true') $this->db->or_where("type_b", "의자");
        }

        if ($table != '') {
            $this->table_name = $table;
        }

        if ($limit != '') {
            $this->db->limit($limit);
            $this->db->offset($offset);
        }

        if ($order_by != '') {
            $this->db->order_by($order_by);
        }

        if ($group_by != '') {
            $this->db->group_by($group_by);
        }

        $Q = $this->db->get($this->table_name);

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();

        return $data;
    }


    public function insert($data) {
        $data['created_at'] = $data['updated_at'] = date('Y-m-d H:i:s');
        //$data['created_from_ip'] = $data['updated_from_ip'] = $this->input->ip_address();

        $success = $this->db->insert($this->table_name, $data);
        if ($success) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function update($data, $id) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        //$data['updated_from_ip'] = $this->input->ip_address();

        $this->db->where($this->primary_key, $id);
        return $this->db->update($this->table_name, $data);
    }

    public function delete($id) {
        $this->db->where($this->primary_key, $id);

        return $this->db->delete($this->table_name);
    }
}