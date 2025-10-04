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

    /** ============================
     * FIND USER BY ID
     * ============================ */
    public function find($id)
    {
        return $this->db->table($this->table)
                        ->where($this->primary_key, $id)
                        ->get();
    }

    /** ============================
     * FIND USER BY USERNAME
     * ============================ */
    public function find_by_username($username)
    {
        return $this->db->table($this->table)
                        ->where('username', $username)
                        ->get();
    }

    /** ============================
     * INSERT USER
     * ============================ */
    public function insert($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    /** ============================
     * UPDATE USER
     * ============================ */
    public function update($id, $data)
    {
        return $this->db->table($this->table)
                        ->where($this->primary_key, $id)
                        ->update($data);
    }

    /** ============================
     * DELETE USER
     * ============================ */
    public function delete($id)
    {
        return $this->db->table($this->table)
                        ->where($this->primary_key, $id)
                        ->delete();
    }

    /** ============================
     * UPDATE PASSWORD
     * ============================ */
    public function update_password($user_id, $new_password) 
    {
        return $this->db->table($this->table)
                        ->where($this->primary_key, $user_id)
                        ->update([
                            'password' => password_hash($new_password, PASSWORD_DEFAULT)
                        ]);
    }

    /** ============================
     * GET ALL USERS
     * ============================ */
    public function get_all_users()
    {
        return $this->db->table($this->table)->get_all();
    }

    /** ============================
     * GET LOGGED IN USER
     * ============================ */
    public function get_logged_in_user()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user']['id'])) {
            return $this->find($_SESSION['user']['id']);
        }

        return null;
    }

    /** ============================
     * PAGINATION WITH SEARCH
     * ============================ */
    public function page($q = '', $records_per_page = null, $page = null) 
    {
        // Base query
        $baseQuery = $this->db->table($this->table);

        // Search filter
        if (!empty($q)) {
            $baseQuery->group_start()
                      ->like('id', $q)
                      ->or_like('username', $q)
                      ->or_like('email', $q)
                      ->or_like('role', $q)
                      ->group_end();
        }

        // Count rows
        $countQuery = clone $baseQuery;
        $total_rows = $countQuery->select_count('*', 'count')->get()['count'];

        // No pagination → return all
        if (is_null($records_per_page) || is_null($page)) {
            return [
                'total_rows' => $total_rows,
                'records'    => $baseQuery->get_all()
            ];
        }

        // Paginated results
        $records = $baseQuery->pagination($records_per_page, $page)->get_all();

        return [
            'total_rows' => $total_rows,
            'records'    => $records
        ];
    }
}
