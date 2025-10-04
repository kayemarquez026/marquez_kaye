<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct() {
        parent::__construct();
    }

    public function get_user_by_id($id) {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->get();
    }

    public function get_user_by_username($username) {
        return $this->db->table($this->table)
                        ->where('username', $username)
                        ->get();
    }

    public function update_password($user_id, $new_password) {
        return $this->db->table($this->table)
                        ->where('id', $user_id)
                        ->update([
                            'password' => password_hash($new_password, PASSWORD_DEFAULT)
                        ]);
    }

    public function get_all_users() {
        return $this->db->table($this->table)->get_all();
    }

    public function get_logged_in_user() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (isset($_SESSION['user']['id'])) {
            return $this->get_user_by_id($_SESSION['user']['id']);
        }
        return null;
    }

    // ---------- PAGINATION & SEARCH ----------
    public function page($q = '', $records_per_page = 10, $page = 1) {
        $query = $this->db->table($this->table);

        // Apply search filters
        if (!empty($q)) {
            $query->like('id', $q)
                  ->or_like('username', $q)
                  ->or_like('email', $q)
                  ->or_like('role', $q);
        }

        // Total rows
        $total_rows = $query->select_count('*', 'count')->get()['count'];

        // Offset for pagination
        $offset = ($page - 1) * $records_per_page;

        // Apply limit & offset
        $records = $query->limit($records_per_page, $offset)->get_all();

        return [
            'total_rows' => $total_rows,
            'records'    => $records
        ];
    }

    public function insert($data) {
        return $this->db->table($this->table)->insert($data);
    }

    public function update($id, $data) {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->update($data);
    }

    public function delete($id) {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->delete();
    }
}
