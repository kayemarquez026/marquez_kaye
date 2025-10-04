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
     * GET USER BY ID
     * ============================ */
    public function get_user_by_id($id)
    {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->get();
    }

    /** ============================
     * GET USER BY USERNAME
     * ============================ */
    public function get_user_by_username($username)
    {
        return $this->db->table($this->table)
                        ->where('username', $username)
                        ->get();
    }

    /** ============================
     * UPDATE PASSWORD
     * ============================ */
    public function update_password($user_id, $new_password) {
        return $this->db->table($this->table)
                        ->where('id', $user_id)
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
            return $this->get_user_by_id($_SESSION['user']['id']);
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

        // Apply search filter kung may $q
        if (!empty($q)) {
            $baseQuery->group_start()
                      ->like('id', $q)
                      ->or_like('username', $q)
                      ->or_like('email', $q)
                      ->or_like('role', $q)
                      ->group_end();
        }

        // Clone query for counting rows
        $countQuery = clone $baseQuery;
        $total_rows = $countQuery->select_count('*', 'count')->get()['count'];

        // Walang pagination → return lahat ng results
        if (is_null($records_per_page) || is_null($page)) {
            return [
                'total_rows' => $total_rows,
                'records'    => $baseQuery->get_all()
            ];
        }

        // Apply pagination
        $records = $baseQuery->pagination($records_per_page, $page)->get_all();

        return [
            'total_rows' => $total_rows,
            'records'    => $records
        ];
    }
}
