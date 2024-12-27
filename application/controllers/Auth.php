<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Memuat library database dan session
        $this->load->database();
        $this->load->model('Proses');
        $this->load->library('session', 'form_validation');
    }

    // Halaman Login
    public function login()
    {
        // Jika user sudah login, arahkan ke dashboard
        if ($this->session->userdata('user_id')) {
            redirect('welcome'); // Jika sudah login, redirect ke dashboard
        }

        $this->load->view('login');
    }

    public function register()
    {
        if ($this->session->userdata('user_id')) {
            redirect('welcome'); // Jika sudah login, redirect ke dashboard
        }

        // Set aturan validasi
        $this->form_validation->set_rules('nama', 'Nama', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('no_ktp', 'Nomor KTP', 'required|numeric|min_length[16]|max_length[16]');
        $this->form_validation->set_rules('nomor_hp', 'Nomor HP', 'required|numeric|min_length[10]|max_length[15]');

        // Cek apakah validasi berhasil
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, muat kembali halaman registrasi dengan error
            $this->load->view('register');
        } else {
            // Jika validasi berhasil, lanjutkan ke proses registrasi
            $this->register_submit();
        }
    }


    // Menangani form submit dari register
    public function register_submit()
    {
        // Ambil data input dari form
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $alamat = $this->input->post('alamat');
        $no_ktp = $this->input->post('no_ktp');
        $no_hp = $this->input->post('no_hp');

        // Hash password menggunakan MD5
        $hashed_password = md5($password);

        // Cek apakah username sudah terdaftar
        $username_exists = $this->Proses->check_username_exists($username);
        if ($username_exists) {
            // Jika username sudah ada, set flashdata error
            $this->session->set_flashdata('username_error', 'Username sudah terdaftar!');
            redirect('auth/register');
        }

        // Cek apakah no_ktp sudah terdaftar
        $no_ktp_exists = $this->Proses->check_no_ktp_exists($no_ktp);
        if ($no_ktp_exists) {
            // Jika no_ktp sudah ada, set flashdata error
            $this->session->set_flashdata('no_ktp_error', 'No KTP sudah terdaftar!');
            redirect('auth/register');
        }

        // Generate no_rm secara otomatis
        $no_rm = $this->Proses->generate_no_rm();

        // Siapkan data untuk disimpan ke database
        $data = array(
            'nama' => $nama,
            'username' => $username,
            'password' => $hashed_password, // Simpan password yang sudah di-hash
            'alamat' => $alamat,
            'no_ktp' => $no_ktp,
            'no_hp' => $no_hp,
            'no_rm' => $no_rm // Menyimpan no_rm yang sudah digenerate
        );

        // Panggil model untuk menyimpan data pengguna
        $this->Proses->register_user($data);

        // Set flashdata untuk pesan sukses
        $this->session->set_flashdata('success', 'Registration successful, please wait...');

        // Redirect kembali ke form registrasi dengan pesan sukses
        redirect('auth/register');
    }



    // Fungsi Authenticate untuk memeriksa login
    public function authenticate()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if (empty($username) || empty($password)) {
            $this->session->set_flashdata('error', 'Username dan password harus diisi');
            redirect('auth/login');
        }

        $hashed_password = md5($password);
        $this->load->model('Proses');
        $user = $this->Proses->check_login($username, $hashed_password);

        if ($user) {
            // Set session for the user (admin, dokter, or pasien)
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('user_type', $user->user_type);
            $this->session->set_userdata('username', $user->username);

            if ($user->user_type == 'pasien') {
                // For pasien, fetch id_pasien from the pasien table
                $this->session->set_userdata('id_pasien', $user->id);
            }

            redirect('welcome');
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah');
            redirect('auth/login');
        }
    }

    // Fungsi Logout
    public function logout()
    {
        // Hapus semua session data
        $this->session->sess_destroy();
        redirect('auth/login'); // Redirect ke halaman login setelah logout
    }
}
