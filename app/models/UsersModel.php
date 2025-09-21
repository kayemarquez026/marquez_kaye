<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function page($q = '', $records_per_page = 5, $page = 1)
    {
        $offset = ($page - 1) * $records_per_page;
        $query = $this->db->table($this->table);

        if(!empty($q)){
            $query->like('first_name', $q)
                  ->or_like('last_name', $q)
                  ->or_like('email', $q);
        }

        $total_rows = $query->select_count('*', 'count')->get()['count'];
        $records = $query->limit($records_per_page, $offset)->get_all();

        return [
            'records' => $records,
            'total_rows' => $total_rows
        ];
    }

    public function find($id, $with_deleted = false)
    {
        return $this->db->where('id', $id)->get($this->table)->row();
    }


    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete($this->table);
    }
}
