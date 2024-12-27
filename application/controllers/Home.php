<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    // Halaman Landing Page
    public function index()
    {
        // Jika sudah login, arahkan ke dashboard
        if ($this->session->userdata('user_id')) {
            redirect('home'); // Jika sudah login, redirect ke dashboard
        }

        // Tampilkan landing page
        $this->load->view('home');
    }
}
