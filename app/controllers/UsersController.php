<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UsersModel'); // load once
    }

    /** Users List with Pagination */
    public function index()
    {
        $page = 1;
        if(isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && !empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 5;
        $users = $this->UsersModel->page($q, $records_per_page, $page);

        $data['users'] = $users['records'];
        $total_rows = $users['total_rows'];

        $this->pagination->set_options([
            'first_link'     => '⏮',
            'last_link'      => '⏭',
            'next_link'      => '→',
            'prev_link'      => '←',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap');
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'users?q='.$q);
        $data['page'] = $this->pagination->paginate();

        $this->call->view('users/index', $data);
    }

    /** Create User */
    public function create()
    {
        if($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $email    = $this->io->post('email');

            $data = [
                'username' => $username,
                'email'    => $email
            ];

            if($this->UsersModel->insert($data)) {
                redirect(site_url('users')); // balik sa list
            } else {
                echo "Error in creating user.";
            }
        } else {
            $this->call->view('users/create');
        }
    }

    /** Update User */
    public function update($id)
    {
        $user = $this->UsersModel->find($id);
        if(!$user) {
            echo "User not found.";
            return;
        }

        if($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $email    = $this->io->post('email');

            $data = [
                'username' => $username,
                'email'    => $email
            ];

            if($this->UsersModel->update($id, $data)) {
                redirect(site_url('users'));
            } else {
                echo "Error in updating user.";
            }
        } else {
            $data['user'] = $user;
            $this->call->view('users/update', $data);
        }
    }

    /** Delete User */
    public function delete($id)
    {
        if($this->UsersModel->delete($id)) {
            redirect(site_url('users'));
        } else {
            echo "Error in deleting user.";
        }
    }

    /** Login */
    public function login()
    {
        if($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            $user = $this->UsersModel->find_by_username($username);

            if($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                redirect(site_url('users/dashboard'));
            } else {
                $data['error'] = "Invalid username or password.";
                $this->call->view('auth/login', $data);
            }
        } else {
            $this->call->view('auth/login');
        }
    }

    /** Register */
    public function register()
    {
        if($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $email    = $this->io->post('email');
            $password = password_hash($this->io->post('password'), PASSWORD_BCRYPT);

            $data = [
                'username' => $username,
                'email'    => $email,
                'password' => $password
            ];

            if($this->UsersModel->insert($data)) {
                redirect(site_url('auth/login'));
            } else {
                echo "Error in registration.";
            }
        } else {
            $this->call->view('auth/register');
        }
    }

    /** Logout */
    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        redirect(site_url('auth/login'));
    }

    /** Dashboard */
    public function dashboard()
    {
        if(!isset($_SESSION['user'])) {
            redirect(site_url('auth/login'));
        }

        $data['user'] = $_SESSION['user'];
        $this->call->view('users/dashboard', $data);
    }
}
