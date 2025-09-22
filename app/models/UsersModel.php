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
     *
     * @param string $q Search query
     * @param int|null $records_per_page Number of records per page
     * @param int|null $page Current page
     * @return array ['total_rows' => int, 'records' => array]
     */
    public function page($q = '', $records_per_page = null, $page = null) {
        $builder = $this->db->builder($this->table);

        // Apply search filter if query is not empty
        if ($q !== '') {
            $builder->like('id', $q)
                    ->orLike('first_name', $q)
                    ->orLike('last_name', $q)
                    ->orLike('email', $q);
        }

        // Count total rows without resetting the query
        $total_rows = $builder->countAllResults(false);

        // Apply pagination if requested
        if ($records_per_page !== null && $page !== null) {
            $offset = ($page - 1) * $records_per_page;
            $builder->limit($records_per_page, $offset);
        }

        // Fetch results
        $records = $builder->get()->getResult();

        return [
            'total_rows' => $total_rows,
            'records'    => $records
        ];
    }

    /**
     * Insert a new user
     */
    public function insert_user(array $data) {
        return $this->db->builder($this->table)->insert($data);
    }

    /**
     * Update a user by ID
     */
    public function update_user($id, array $data) {
        $builder = $this->db->builder($this->table);
        $builder->where($this->primary_key, $id);
        return $builder->update($data);
    }

    /**
     * Find a user by ID
     *
     * Signature matches parent Model::find($id, $with_deleted = false)
     */
    public function find($id, $with_deleted = false) {
        return $this->db->builder($this->table)
                        ->where($this->primary_key, $id)
                        ->get()
                        ->getRow();
    }

    /**
     * Delete a user by ID
     */
    public function delete_user($id) {
        $builder = $this->db->builder($this->table);
        $builder->where($this->primary_key, $id);
        return $builder->delete();
    }
}
