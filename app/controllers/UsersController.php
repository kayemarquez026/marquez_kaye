<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->call->model('UsersModel');
    }

    /**
     * Display paginated users with optional search
     */
    public function index()
    {
        // Get current page and search query safely
        $page = (int) $this->io->get('page', 1); // default 1
        $q    = trim($this->io->get('q', ''));   // default empty string
        $records_per_page = 10;

        // Fetch paginated data
        $user_data = $this->UsersModel->page($q, $records_per_page, $page);
        $data['user'] = $user_data['records'];
        $total_rows   = $user_data['total_rows'];

        // Pagination setup
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap');
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'users?q=' . urlencode($q));
        $data['page'] = $this->pagination->paginate();

        $this->call->view('users/index', $data);
    }

    /**
     * Create a new user
     */
    public function create()
    {
        if ($this->io->method() === 'post') {
            $data = [
                'first_name' => $this->io->post('first_name', ''),
                'last_name'  => $this->io->post('last_name', ''),
                'email'      => $this->io->post('email', '')
            ];

            if ($this->UsersModel->insert_user($data)) {
                redirect(); // success redirect
            } else {
                echo "Error: Failed to create user.";
            }
        } else {
            $this->call->view('users/create');
        }
    }

    /**
     * Update an existing user
     */
    public function update($id)
    {
        $user = $this->UsersModel->find($id, false); // ensure signature matches parent
        if (!$user) {
            echo "User not found.";
            return;
        }

        if ($this->io->method() === 'post') {
            $data = [
                'first_name' => $this->io->post('first_name', $user->first_name),
                'last_name'  => $this->io->post('last_name', $user->last_name),
                'email'      => $this->io->post('email', $user->email)
            ];

            if ($this->UsersModel->update_user($id, $data)) {
                redirect(); // success redirect
            } else {
                echo "Error: Failed to update user.";
            }
        } else {
            $data['user'] = $user;
            $this->call->view('users/update', $data);
        }
    }

    /**
     * Delete a user
     */
    public function delete($id)
    {
        if ($this->UsersModel->delete_user($id)) {
            redirect(); // success redirect
        } else {
            echo "Error: Failed to delete user.";
        }
    }
}
