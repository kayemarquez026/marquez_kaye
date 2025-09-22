<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UsersModel
 */
class UsersModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get paginated users with optional search
     */
    public function page($q = '', $records_per_page = null, $page = null) {
        $builder = $this->db->builder($this->table);

        if ($q !== '') {
            $builder->like('id', $q)
                    ->orLike('first_name', $q)
                    ->orLike('last_name', $q)
                    ->orLike('email', $q);
        }

        // Count total rows
        $total_rows = $builder->countAllResults(false); // false = do not reset query

        // Pagination
        if ($records_per_page !== null && $page !== null) {
            $offset = ($page - 1) * $records_per_page;
            $builder->limit($records_per_page, $offset);
        }

        $records = $builder->get()->getResult(); // Fetch results

        return [
            'total_rows' => $total_rows,
            'records' => $records
        ];
    }

    /**
     * Insert a new user
     */
    public function insert_user($data) {
        return $this->db->builder($this->table)->insert($data);
    }

    /**
     * Update a user by id
     */
    public function update_user($id, $data) {
        $builder = $this->db->builder($this->table);
        $builder->where($this->primary_key, $id);
        return $builder->update($data);
    }

    /**
     * Find a user by id
    */public function find($id, $with_deleted = false) {
        return $this->db->builder($this->table)
                        ->where($this->primary_key, $id)
                        ->get()
                        ->getRow();
    }


    /**
     * Delete a user by id
     */
    public function delete_user($id) {
        $builder = $this->db->builder($this->table);
        $builder->where($this->primary_key, $id);
        return $builder->delete();
    }
}
