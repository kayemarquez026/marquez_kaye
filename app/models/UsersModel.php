<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UsersModel
 * 
 * Automatically generated via CLI.
 */
class UsersModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct() {
        parent::__construct();
    }

    // ---------- GET USER BY ID ----------
    public function get_user_by_id($id) {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->get();
    }

    // ---------- GET USER BY USERNAME ----------
    public function get_user_by_username($username) {
        return $this->db->table($this->table)
                        ->where('username', $username)
                        ->get();
    }

    // ---------- UPDATE PASSWORD ----------
    public function update_password($user_id, $new_password) {
        return $this->db->table($this->table)
                        ->where('id', $user_id)
                        ->update([
                            'password' => password_hash($new_password, PASSWORD_DEFAULT)
                        ]);
    }

    // ---------- GET ALL USERS ----------
    public function get_all_users() {
        return $this->db->table($this->table)->get_all();
    }

    // ---------- GET LOGGED IN USER ----------
    public function get_logged_in_user() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (isset($_SESSION['user']['id'])) {
            return $this->get_user_by_id($_SESSION['user']['id']);
        }
        return null;
    }

    // ---------- PAGINATION & SEARCH ----------
    public function page($q = '', $records_per_page = null, $page = null) {
        $query = $this->db->table($this->table);

        // Apply search filters if $q is not empty
        if (!empty($q)) {
            $query->like('id', '%'.$q.'%')
                  ->or_like('username', '%'.$q.'%')
                  ->or_like('email', '%'.$q.'%')
                  ->or_like('role', '%'.$q.'%');
        }

        // If no pagination requested, return all records
        if (is_null($page)) {
            return [
                'total_rows' => $query->select_count('*', 'count')->get()['count'],
                'records'    => $query->get_all()
            ];
        }

        // Clone query for counting total rows
        $countQuery = clone $query;
        $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];

        // Apply pagination
        $data['records'] = $query->pagination($records_per_page, $page)->get_all();

        return $data;
    }

    // ---------- INSERT ----------
    public function insert($data) {
        return $this->db->table($this->table)->insert($data);
    }

    // ---------- UPDATE ----------
    public function update($id, $data) {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->update($data);
    }

    // ---------- DELETE ----------
    public function delete($id) {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->delete();
    }
}
