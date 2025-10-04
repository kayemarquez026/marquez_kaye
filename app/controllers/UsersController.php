<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller {

    public function __construct() {
        parent::__construct();
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    // ---------- INDEX ----------
    public function index() {
        $this->call->model('UsersModel');

        if (!isset($_SESSION['user'])) {
            redirect('/auth/login');
            exit;
        }

        $logged_in_user = $_SESSION['user'];
        $data['logged_in_user'] = $logged_in_user;

        // Admin → show all users with pagination
        if ($logged_in_user['role'] === 'admin') {
            $page = isset($_GET['page']) ? $this->io->get('page') : 1;
            $q = isset($_GET['q']) ? trim($this->io->get('q')) : '';
            $records_per_page = 10;

            $users = $this->UsersModel->page($q, $records_per_page, $page);
            $data['users'] = $users['records'];
            $total_rows = $users['total_rows'];

            $this->pagination->set_options([
                'first_link' => '⏮ First',
                'last_link'  => 'Last ⏭',
                'next_link'  => 'Next →',
                'prev_link'  => '← Prev',
                'page_delimiter' => '&page='
            ]);
            $this->pagination->set_theme('custom');
            $this->pagination->initialize($total_rows, $records_per_page, $page, 'users?q='.$q);
            $data['page'] = $this->pagination->paginate();
        } else {
            // Normal user → show only own data
            $user = $this->UsersModel->get_user_by_id($logged_in_user['id']);
            $data['users'] = [$user];
            $data['page'] = '';
        }

        $this->call->view('users/index', $data);
    }

    // ---------- CREATE ----------
    public function create() {
        $this->call->model('UsersModel');

        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $password = !empty($this->io->post('password')) ? password_hash($this->io->post('password'), PASSWORD_BCRYPT) : null;

            $data = ['username'=>$username, 'email'=>$email];
            if ($password) $data['password'] = $password;

            if ($this->UsersModel->insert($data)) {
                redirect('/users');
            } else {
                echo "Failed to create user.";
            }
        } else {
            $this->call->view('users/create');
        }
    }

    // ---------- UPDATE ----------
    public function update($id) {
        $this->call->model('UsersModel');

        $user = $this->UsersModel->get_user_by_id($id);
        if (!$user) {
            echo "User not found.";
            return;
        }

        $logged_in_user = $_SESSION['user'] ?? null;

        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');

            if (!empty($logged_in_user) && $logged_in_user['role'] === 'admin') {
                $role = $this->io->post('role');
                $password = $this->io->post('password');
                $data = ['username'=>$username, 'email'=>$email, 'role'=>$role];
                if (!empty($password)) $data['password'] = password_hash($password, PASSWORD_BCRYPT);
            } else {
                $data = ['username'=>$username, 'email'=>$email];
            }

            if ($this->UsersModel->update($id, $data)) {
                redirect('/users');
            } else {
                echo "Failed to update user.";
            }
        } else {
            $data['user'] = $user;
            $data['logged_in_user'] = $logged_in_user;
            $this->call->view('users/update', $data);
        }
    }

    // ---------- DELETE ----------
    public function delete($id) {
        $this->call->model('UsersModel');
        if ($this->UsersModel->delete($id)) {
            redirect('/users');
        } else {
            echo "Failed to delete user.";
        }
    }

    // ---------- REGISTER ----------
    public function register() {
        $this->call->model('UsersModel');

        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $password = password_hash($this->io->post('password'), PASSWORD_BCRYPT);

            $data = [
                'username' => $username,
                'email'    => $email,
                'password' => $password,
                'role'     => 'user',
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->UsersModel->insert($data)) {
                redirect('/auth/login');
            } else {
                echo "Failed to register user.";
            }
        } else {
            $this->call->view('auth/register');
        }
    }

    // ---------- LOGIN ----------
    public function login() {
        $this->call->model('UsersModel');
        $error = null;

        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            $user = $this->UsersModel->get_user_by_username($username);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role']
                ];
                redirect('/users');
            } else {
                $error = $user ? "Incorrect password!" : "Username not found!";
            }
        }

        $this->call->view('auth/login', ['error'=>$error]);
    }

    // ---------- LOGOUT ----------
    public function logout() {
        session_destroy();
        redirect('/auth/login');
    }

    // ---------- DASHBOARD ----------
    public function dashboard() {
        $this->call->model('UsersModel');

        $page = isset($_GET['page']) ? $this->io->get('page') : 1;
        $q = isset($_GET['q']) ? trim($this->io->get('q')) : '';
        $records_per_page = 10;

        $users = $this->UsersModel->page($q, $records_per_page, $page);
        $data['users'] = $users['records'];
        $total_rows = $users['total_rows'];

        $this->pagination->set_options([
            'first_link' => '⏮ First',
            'last_link'  => 'Last ⏭',
            'next_link'  => 'Next →',
            'prev_link'  => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap');
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'users?q='.$q);
        $data['page'] = $this->pagination->paginate();

        $this->call->view('users/dashboard', $data);
    }
}
