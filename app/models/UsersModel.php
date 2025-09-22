<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function page($q = '', $records_per_page = 10, $page = 1) {
        $offset = ($page - 1) * $records_per_page;

        // Search filter
        $where = '';
        $params = [];
        if (!empty($q)) {
            $where = "WHERE id LIKE :q OR first_name LIKE :q OR last_name LIKE :q OR email LIKE :q";
            $params[':q'] = "%$q%";
        }

        // Count total
        $count_sql = "SELECT COUNT(*) as count FROM {$this->table} $where";
        $count_stmt = $this->db->query($count_sql, $params);
        $count_row = $count_stmt->fetch();
        $total_rows = $count_row['count'] ?? 0;

        // Get records
        $sql = "SELECT * FROM {$this->table} $where LIMIT :limit OFFSET :offset";
        $params[':limit'] = (int)$records_per_page;
        $params[':offset'] = (int)$offset;

        $stmt = $this->db->query($sql, $params);
        $records = $stmt->fetchAll();

        return [
            'total_rows' => $total_rows,
            'records'    => $records
        ];
    }
}
