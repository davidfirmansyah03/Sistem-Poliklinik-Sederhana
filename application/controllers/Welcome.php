<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Memuat library session
		$this->load->library('session');
		$this->load->model('Proses');
	}

	// Halaman Utama (Dashboard)
	public function index()
	{
		// Ambil username dari session
		$username = $this->session->userdata('username');

		$data['username'] = $username;
		// Pastikan user sudah login
		if (!$this->session->userdata('user_id')) {
			redirect('auth/login'); // Jika belum login, redirect ke halaman login
		}

		$user_type = $this->session->userdata('user_type');

		// Arahkan ke dashboard yang sesuai berdasarkan tipe pengguna
		if ($user_type == 'Admin') {
			$this->load->view('master/header');
			$this->load->view('master/sidebar');
			$this->load->view('v_admin_dashboard', $data);
			$this->load->view('master/footer');
		} elseif ($user_type == 'Pasien') {
			$id_pasien = $this->session->userdata('user_id');
			$data['daftar_poli'] = $this->Proses->get_daftar_poli_belum($id_pasien);

			$this->load->view('master/header');
			$this->load->view('master/sidebar');
			$this->load->view('v_pasien_dashboard', $data);
			$this->load->view('master/footer');
		} elseif ($user_type == 'Dokter') {
			$this->load->view('master/header');
			$this->load->view('master/sidebar');
			$this->load->view('v_dokter_dashboard', $data);
			$this->load->view('master/footer');
		}
	}
	public function home()
	{
		// Menampilkan halaman home.php
		$this->load->view('home');
	}

	// Admin
	// Kelola Dokter -->
	public function kelola_dokter()
	{
		// Pastikan hanya admin yang bisa mengakses
		if ($this->session->userdata('user_type') != 'Admin') {
			$this->session->set_flashdata('error', 'Akses ditolak');
			redirect('auth/login');
		}
		$data['dokters'] = $this->Proses->get_all_dokter();
		$data['poliklinik'] = $this->Proses->get_all_poli();

		$id_dokter = $this->uri->segment(3);

		if ($id_dokter) {
			// Jika ada id dokter, ambil data dokter untuk diedit
			$data['dokter'] = $this->Proses->get_dokter($id_dokter);
		}

		// Load view untuk kelola dokter
		$this->load->view('master/header');
		$this->load->view('master/sidebar');
		$this->load->view('v_admin_kelola_dokter', $data);
		$this->load->view('master/footer');
	}

	// Menambahkan dokter baru
	public function tambah_dokter()
	{
		// Mengambil data poli dari model
		$data['poliklinik'] = $this->Proses->get_all_poli();

		if ($this->input->method() === 'post') {
			// Ambil data dari form
			$password = $this->input->post('password'); // Ambil password dari input
			$hashed_password = md5($password); // Hash password dengan MD5

			// Siapkan data yang akan disimpan
			$data = array(
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'password' => $hashed_password, // Simpan password yang sudah di-hash
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_hp'),
				'id_poli' => $this->input->post('id_poli')
			);

			// Simpan data dokter ke dalam database
			$this->Proses->insert_dokter($data);

			// Redirect ke halaman daftar dokter
			redirect('welcome/kelola_dokter');
		} else {
			// Jika GET request, tampilkan form tambah
			$this->load->view('master/header');
			$this->load->view('master/sidebar');
			$this->load->view('v_admin_form_dokter', $data);
			$this->load->view('master/footer');
		}
	}


	// Fungsi untuk mengedit data dokter
	public function edit_dokter($id)
	{
		// Mengambil data poli dari model
		$data['poliklinik'] = $this->Proses->get_all_poli();
		if ($this->input->method() === 'post') {
			// Ambil data dari form
			$data = array(
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_hp'),
				'id_poli' => $this->input->post('id_poli')
			);
			// Update data dokter ke dalam database
			$this->Proses->update_dokter($id, $data);
			redirect('welcome/kelola_dokter'); // Redirect ke halaman daftar dokter
		} else {
			// Jika GET request, tampilkan form edit
			$data['dokter'] = $this->Proses->get_dokter_by_id($id);
			$this->load->view('master/header');
			$this->load->view('master/sidebar');
			$this->load->view('v_admin_form_dokter', $data);
			$this->load->view('master/footer');
		}
	}

	// Fungsi untuk menghapus data dokter
	public function hapus_dokter($id)
	{
		$this->Proses->delete_dokter($id);
		redirect('welcome/kelola_dokter');
	}
	// Tutup Kelola Dokter -->

	// Kelola Pasien -->
	public function kelola_pasien()
	{
		// Pastikan hanya admin yang bisa mengakses
		if ($this->session->userdata('user_type') != 'Admin') {
			$this->session->set_flashdata('error', 'Akses ditolak');
			redirect('auth/login');
		}
		// Mengambil data Dokter
		$data['pasiens'] = $this->Proses->get_all_patient();

		// Load view untuk kelola dokter
		$this->load->view('master/header');
		$this->load->view('master/sidebar');
		$this->load->view('v_admin_kelola_pasien', $data);
		$this->load->view('master/footer');
	}

	// Controller Welcome - Menambah dan Edit Pasien
	public function tambah_pasien($id = null)
	{
		if ($id) {
			// Edit pasien
			$data['pasien'] = $this->Proses->get_pasien_by_id($id); // Ambil data pasien yang akan diedit
		} else {
			$data['pasien'] = null; // Data kosong untuk tambah pasien baru
		}

		// Jika form disubmit
		if ($this->input->method() === 'post') {
			// Ambil data dari form
			$data_pasien = array(
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'alamat' => $this->input->post('alamat'),
				'no_ktp' => $this->input->post('no_ktp'),
				'no_hp' => $this->input->post('no_hp')
			);

			// Pastikan password di-hash menggunakan MD5
			$password = $this->input->post('password');
			if (!empty($password)) {
				$data_pasien['password'] = md5($password); // Menggunakan MD5 untuk password
			}

			// Jika pasien baru, generate no_rm
			if (!$id) {
				$data_pasien['no_rm'] = $this->Proses->generate_no_rm(); // Generate no_rm untuk pasien baru
			}

			if ($id) {
				// Update pasien
				$this->Proses->update_pasien($id, $data_pasien);
			} else {
				// Tambah pasien baru
				$this->Proses->insert_pasien($data_pasien);
			}

			redirect('welcome/kelola_pasien'); // Redirect ke halaman daftar pasien
		} else {
			// Jika GET request, tampilkan form
			$this->load->view('master/header');
			$this->load->view('master/sidebar');
			$this->load->view('v_admin_form_pasien', $data);
			$this->load->view('master/footer');
		}
	}

	public function hapus_pasien($id)
	{
		$this->Proses->delete_pasien($id);
		redirect('welcome/kelola_pasien');
	}
	// Tutup Kelola Pasien -->

	// Kelola Poli -->
	public function kelola_poli()
	{
		// Pastikan hanya admin yang bisa mengakses
		if ($this->session->userdata('user_type') != 'Admin') {
			$this->session->set_flashdata('error', 'Akses ditolak');
			redirect('auth/login');
		}
		$data['poliklinik'] = $this->Proses->get_all_poli();

		// Load view untuk kelola dokter
		$this->load->view('master/header');
		$this->load->view('master/sidebar');
		$this->load->view('v_admin_kelola_poli', $data);
		$this->load->view('master/footer');
	}

	public function tambah_poli($id = null)
	{
		if ($id) {
			// Edit Poli
			$data['poli'] = $this->Proses->get_poli_by_id($id); // Ambil data poli yang akan diedit
		} else {
			$data['poli'] = null; // Data kosong untuk tambah poli baru
		}

		// Jika form disubmit
		if ($this->input->method() === 'post') {
			// Ambil data dari form
			$data_poli = array(
				'nama_poli' => $this->input->post('nama_poli'),
				'keterangan' => $this->input->post('keterangan'),
			);

			if ($id) {
				// Update pasien
				$this->Proses->update_poli($id, $data_poli);
			} else {
				// Tambah pasien baru
				$this->Proses->insert_poli($data_poli);
			}

			redirect('welcome/kelola_poli'); // Redirect ke halaman daftar pasien
		} else {
			// Jika GET request, tampilkan form
			$this->load->view('master/header');
			$this->load->view('master/sidebar');
			$this->load->view('v_admin_form_poli', $data);
			$this->load->view('master/footer');
		}
	}

	public function hapus_poli($id)
	{
		$this->Proses->delete_poli($id);
		redirect('welcome/kelola_poli');
	}
	// Tutup Kelola Poli -->

	// Kelola Obat -->
	public function kelola_obat()
	{
		// Pastikan hanya admin yang bisa mengakses
		if ($this->session->userdata('user_type') != 'Admin') {
			$this->session->set_flashdata('error', 'Akses ditolak');
			redirect('auth/login');
		}

		$data['obats'] = $this->Proses->get_all_obat();

		// Load view untuk kelola dokter
		$this->load->view('master/header');
		$this->load->view('master/sidebar');
		$this->load->view('v_admin_kelola_obat', $data);
		$this->load->view('master/footer');
	}

	public function tambah_obat($id = null)
	{
		if ($id) {
			// Edit obat
			$data['obat'] = $this->Proses->get_obat_by_id($id); // Ambil data obat yang akan diedit
		} else {
			$data['obat'] = null; // Data kosong untuk tambah obat baru
		}

		// Jika form disubmit
		if ($this->input->method() === 'post') {
			// Ambil data dari form
			$data_obat = array(
				'nama_obat' => $this->input->post('nama_obat'),
				'kemasan' => $this->input->post('kemasan'),
				'harga' => $this->input->post('harga')
			);

			if ($id) {
				// Update pasien
				$this->Proses->update_obat($id, $data_obat);
			} else {
				// Tambah pasien baru
				$this->Proses->insert_obat($data_obat);
			}

			redirect('welcome/kelola_obat'); // Redirect ke halaman daftar pasien
		} else {
			// Jika GET request, tampilkan form
			$this->load->view('master/header');
			$this->load->view('master/sidebar');
			$this->load->view('v_admin_form_obat', $data);
			$this->load->view('master/footer');
		}
	}

	public function hapus_obat($id)
	{
		$this->Proses->delete_obat($id);
		redirect('welcome/kelola_obat');
	}
	// Tutup Kelola Obat -->
	// Tutup Admin -->

	// Pasien
	// Mendaftar Poli -->
	public function daftar_poli()
	{
		// Pastikan hanya pasien yang bisa mengakses
		if ($this->session->userdata('user_type') != 'Pasien') {
			$this->session->set_flashdata('error', 'Akses ditolak');
			redirect('auth/login');
		}
		$data['poliklinik'] = $this->Proses->get_all_poli();

		// Load view untuk kelola dokter
		$this->load->view('master/header');
		$this->load->view('master/sidebar');
		$this->load->view('v_pasien_form_poli', $data);
		$this->load->view('master/footer');
	}

	public function get_dokter_by_poli($id_poli)
	{
		// Ambil dokter berdasarkan poli
		$dokter = $this->Proses->get_dokter_by_poli($id_poli);
		echo json_encode($dokter); // Kirim data dokter dalam format JSON
	}

	// Fungsi untuk mengambil jadwal berdasarkan dokter yang dipilih
	public function get_jadwal_by_dokter($id_dokter)
	{
		// Ambil jadwal berdasarkan dokter
		$jadwal = $this->Proses->get_jadwal_by_dokter($id_dokter);
		echo json_encode($jadwal); // Kirim data jadwal dalam format JSON
	}

	public function get_jadwal_dokter_by_status($id_dokter)
	{
		// Ambil jadwal berdasarkan dokter
		$jadwal = $this->Proses->get_jadwal_dokter_by_status($id_dokter);
		echo json_encode($jadwal);
	}

	// Fungsi untuk menyimpan data pendaftaran poli pasien
	public function daftar_poli_submit()
	{
		// Ambil id_pasien dari session
		$id_pasien = $this->session->userdata('user_id');

		// Cek apakah id_pasien ada
		if (empty($id_pasien)) {
			// Jika id_pasien tidak ditemukan, tampilkan pesan error atau redirect ke login
			$this->session->set_flashdata('error', 'Anda harus login terlebih dahulu.');
			redirect('auth/login');
		}

		// Ambil data dari form
		$id_poli = $this->input->post('id_poli');
		$id_dokter = $this->input->post('id_dokter');
		$id_jadwal = $this->input->post('id_jadwal');
		$keluhan = $this->input->post('keluhan');
		$tanggal = date('Y-m-d'); // Menambahkan tanggal hari ini
		$no_antrian = $this->Proses->get_next_antrian(); // Ambil nomor antrian

		// Persiapkan data untuk insert
		$data = array(
			'id_pasien' => $id_pasien,
			'id_poli' => $id_poli,
			'id_dokter' => $id_dokter,
			'id_jadwal' => $id_jadwal,
			'keluhan' => $keluhan,
			'no_antrian' => $no_antrian, // Nomor antrian yang sudah ter-generate
			'tanggal' => $tanggal // Tanggal hari ini
		);

		// Memasukkan data ke tabel daftar_poli
		$this->db->insert('daftar_poli', $data);

		// Redirect atau tampilkan pesan sukses
		$this->session->set_flashdata('success', 'Pendaftaran berhasil.');
		redirect('welcome');
	}
	// Tutup Daftar Poli -->

	// Riwayat Daftar Poli -->
	public function riwayat_daftar_poli()
	{
		// Pastikan hanya pasien yang bisa mengakses
		if ($this->session->userdata('user_type') != 'Pasien') {
			$this->session->set_flashdata('error', 'Akses ditolak');
			redirect('auth/login');
		}
		// Ambil id_pasien dari session
		$id_pasien = $this->session->userdata('user_id');
		$data['riwayat_poli'] = $this->Proses->get_riwayat_daftar_poli($id_pasien);

		// Load view riwayat daftar poli
		$this->load->view('master/header');
		$this->load->view('master/sidebar');
		$this->load->view('v_pasien_riwayat_poli', $data);
		$this->load->view('master/footer');
	}

	// Tutup Riwayat Daftar Poli -->
	// Tutup Pasien -->

	// Dokter -->
	// Profil Dokter -->
	public function profil_dokter()
	{
		// Pastikan hanya dokter yang bisa mengakses
		if ($this->session->userdata('user_type') != 'Dokter') {
			$this->session->set_flashdata('error', 'Akses ditolak');
			redirect('auth/login');
		}
		// Ambil ID dokter dari session
		$dokter_id = $this->session->userdata('user_id');

		// Ambil data dokter berdasarkan ID
		$dokter = $this->Proses->get_dokter_by_id($dokter_id);

		if (!$dokter) {
			show_404(); // Menampilkan halaman 404 jika data dokter tidak ditemukan
		}

		// Ambil data poli untuk dropdown
		$data['poliklinik'] = $this->Proses->get_all_poli();
		$data['nama_poli'] = $this->Proses->get_nama_poli($dokter->id_poli);

		// Data dokter yang akan ditampilkan di form
		$data['dokter'] = $dokter;

		// Load view untuk menampilkan form
		$this->load->view('master/header');
		$this->load->view('master/sidebar');
		$this->load->view('v_dokter_form_profil', $data); // View untuk form update profil
		$this->load->view('master/footer');
	}

	public function profil_dokter_submit()
	{
		// Ambil id dokter dari session (misalnya id_dokter disimpan dalam session)
		$id = $this->session->userdata('user_id');

		// Cek apakah id_dokter ada
		if (empty($id)) {
			// Jika tidak ditemukan, tampilkan pesan error atau redirect ke login
			$this->session->set_flashdata('error', 'Anda harus login terlebih dahulu.');
			redirect('auth/login');
		}

		// Ambil data dari form
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');
		// $id_poli = $this->input->post('id_poli');

		// Persiapkan data untuk update
		$data = array(
			'nama' => $nama,
			'alamat' => $alamat,
			'no_hp' => $no_hp,
			// 'id_poli' => $id_poli
		);

		// Panggil method model untuk update data dokter
		$this->Proses->update_dokter($id, $data);

		// Set flash data sukses
		$this->session->set_flashdata('success', 'Profil berhasil diperbarui.');

		// Redirect kembali ke halaman profil
		redirect('welcome/profil_dokter');
	}
	// Tutup Profil Dokter -->

	// Kelola Jadwal Dokter -->
	public function kelola_jadwal()
	{
		// Pastikan hanya dokter yang bisa mengakses
		if ($this->session->userdata('user_type') != 'Dokter') {
			$this->session->set_flashdata('error', 'Akses ditolak');
			redirect('auth/login');
		}
		$id_dokter = $this->session->userdata('user_id');
		$data['jadwal_periksa'] = $this->Proses->get_jadwal_by_dokter($id_dokter);

		// Cek apakah ada ID untuk edit
		$id_jadwal = $this->uri->segment(3); // Mengambil ID dari URL jika ada
		if ($id_jadwal) {
			$data['jadwal_edit'] = $this->Proses->get_jadwal_by_id($id_jadwal);
		}

		$this->load->view('master/header');
		$this->load->view('master/sidebar');
		$this->load->view('v_dokter_form_jadwal', $data);
		$this->load->view('master/footer');
	}

	public function update_status_jadwal()
	{
		$jadwal_id = $this->input->post('jadwal_id'); // Ambil ID jadwal yang dipilih
		$id_dokter = $this->input->post('id_dokter'); // Ambil ID dokter yang dipilih

		// Nonaktifkan semua jadwal untuk dokter yang sama
		$this->db->where('id_dokter', $id_dokter);
		$this->db->update('jadwal_periksa', ['status' => 'nonaktif']);

		// Aktifkan jadwal yang dipilih
		$this->db->where('id', $jadwal_id);
		$this->db->where('id_dokter', $id_dokter); // Pastikan hanya jadwal dokter yang dipilih yang diperbarui
		$success = $this->db->update('jadwal_periksa', ['status' => 'aktif']);

		// Kirim respons JSON
		header('Content-Type: application/json');
		echo json_encode(['success' => $success]);
	}



	public function tambah_jadwal_submit()
	{
		$id_dokter = $this->session->userdata('user_id');
		$id_jadwal = $this->input->post('id_jadwal');
		$hari = $this->input->post('hari');
		$jam_mulai = $this->input->post('jam_mulai');
		$jam_selesai = $this->input->post('jam_selesai');

		// Validasi untuk memastikan tidak ada duplikasi jadwal
		$this->load->model('Proses');
		$is_jadwal_exist = $this->Proses->check_existing_jadwal($id_dokter, $hari, $jam_mulai, $id_jadwal);

		if ($is_jadwal_exist) {
			$this->session->set_flashdata('error', 'Jadwal yang sama sudah ada!');
			redirect('welcome/kelola_jadwal');
		}

		// Data untuk insert atau update jadwal
		$data = array(
			'id_dokter' => $id_dokter,
			'hari' => $hari,
			'jam_mulai' => $jam_mulai,
			'jam_selesai' => $jam_selesai
		);

		if ($id_jadwal) {
			// Update jadwal jika id_jadwal ada
			$this->Proses->update_jadwal($id_jadwal, $data);
		} else {
			// Insert jadwal baru jika id_jadwal kosong
			$this->Proses->insert_jadwal($data);
		}

		$this->session->set_flashdata('success', 'Jadwal berhasil diperbarui.');
		redirect('welcome/kelola_jadwal');
	}



	// Fungsi untuk menghapus jadwal
	public function delete_jadwal($id)
	{
		$this->load->model('Proses');
		$this->Proses->delete_jadwal($id);

		$this->session->set_flashdata('success', 'Jadwal berhasil dihapus.');
		redirect('welcome/kelola_jadwal');
	}
	// Tutup Kelola Jadwal Dokter -->

	// Periksa Pasien -->
	public function periksa_pasien()
	{
		// Pastikan hanya dokter yang bisa mengakses
		if ($this->session->userdata('user_type') != 'Dokter') {
			$this->session->set_flashdata('error', 'Akses ditolak');
			redirect('auth/login');
		}
		// Ambil id_dokter dari sesi (asumsikan sudah login)
		$id_dokter = $this->session->userdata('user_id');

		// Ambil data pasien yang sesuai dengan dokter
		$data['daftar_pasien'] = $this->Proses->get_pasien_by_dokter($id_dokter);
		$data['listpasien'] = $this->Proses->get_list_pasien_by_jadwal($this->session->userdata('user_id'));

		// Load view
		$this->load->view('master/header');
		$this->load->view('master/sidebar');
		$this->load->view('v_dokter_kelola_pasien', $data);
		$this->load->view('master/footer');
	}
	// Tutup Periksa Pasien -->

	// Tombol Periksa -->
	public function periksa_pasien_action($id_daftarpoli)
	{
		// Ambil semua obat yang tersedia
		$obat = $this->Proses->get_all_obat();

		$periksa = $this->Proses->get_daftar_poli($id_daftarpoli);

		// Kirim data pasien dan daftar obat ke view
		$data = [
			//'pasien' => $pasien,
			'obat' => $obat,
			'periksa' => $periksa
		];

		// Load view
		$this->load->view('master/header');
		$this->load->view('master/sidebar');
		$this->load->view('v_dokter_form_periksa', $data);
		$this->load->view('master/footer');
	}
	// Tutup Tombol Periksa -->

	// Periksa Pasien Submit -->
	public function periksa_pasien_submit()
	{
		// Ambil data dari form
		$obat = $this->input->post('obat');  // Obat yang dipilih
		$tgl = $this->input->post('tgl_periksa');  // Obat yang dipilih
		$biaya_periksa = $this->input->post('biaya_periksa');
		$catatan = $this->input->post('catatan');  // Ambil catatan
		$id_daftarpoli = $this->input->post('id_daftar_poli');

		// Siapkan data pemeriksaan
		$data_periksa = [
			'id_daftar_poli' => $id_daftarpoli,  // Gunakan id_daftar_poli yang benar
			'tgl_periksa' => $tgl,
			'catatan' => $catatan,  // Menyimpan catatan pemeriksaan
			'biaya_periksa' => str_replace(['Rp. ', ','], '', $biaya_periksa), // Format biaya menjadi angka
		];

		// Simpan data pemeriksaan ke tabel periksa dan ambil id_periksa yang baru
		$this->Proses->simpan_periksa($data_periksa);

		$id_periksa = $this->db->insert_id();

		// Simpan detail obat yang diresepkan ke tabel detail_periksa
		foreach ($obat as $id_obat) {
			$data_detail_obat = [
				'id_periksa' => $id_periksa,
				'id_obat' => $id_obat
			];
			$this->Proses->simpan_detail_obat($data_detail_obat);
		}

		// Update status pasien di tabel daftar_poli menjadi 'sudah' untuk poli ini setelah diperiksa
		$this->Proses->update_status_periksa($id_daftarpoli);  // Update hanya untuk poli tertentu

		// Set flashdata untuk pesan sukses
		$this->session->set_flashdata('success', 'Pemeriksaan berhasil dan resep telah disimpan.');

		// Redirect ke halaman periksa pasien
		redirect('welcome/periksa_pasien');
	}
	// Tutup Periksa Pasien Submit -->

	// Kelola Riwayat Pasien -->
	public function riwayat_pasien()
	{
		// Ambil id_dokter dari sesi (asumsikan sudah login)
		$id_dokter = $this->session->userdata('user_id');

		// Ambil data pasien yang sesuai dengan dokter
		$data['daftar_pasien'] = $this->Proses->get_pasien_by_dokter($id_dokter);
		$data['riwayat'] = $this->Proses->get_riwayat_pemeriksaan_dokter($id_dokter);

		// Load view
		$this->load->view('master/header');
		$this->load->view('master/sidebar');
		$this->load->view('v_dokter_kelola_riwayat', $data);
		$this->load->view('master/footer');
	}
	// Tutup Kelola Riwayat Pasien -->

	// Detail Riwayat Pasien -->
	public function detail_riwayat_pasien($id_pasien)
	{
		$data['detail'] = $this->Proses->get_detail_pemeriksaan_by_id($id_pasien);

		$this->load->view('master/header');
		$this->load->view('master/sidebar');
		$this->load->view('v_dokter_detail_riwayat', $data);
		$this->load->view('master/footer');
	}
	// Tutup Detail Riwayat Pasien -->

	// Edit Detail Riwayat Pemeriksaan -->
	public function edit_riwayat_pasien($periksa_id)
	{
		// Ambil data pemeriksaan
		$data['detail'] = $this->Proses->get_pemeriksaan_detail($periksa_id);
		// Ambil data obat terkait
		$data['obat'] = $this->Proses->get_obat_by_periksa_id($periksa_id);
		// Ambil semua daftar obat untuk dropdown
		$data['obat_list'] = $this->Proses->get_all_obat();

		// Load view
		if (!empty($data['detail'])) {
			$this->load->view('master/header');
			$this->load->view('master/sidebar');
			$this->load->view('v_dokter_form_riwayat', $data);
			$this->load->view('master/footer');
		} else {
			show_404();
		}
	}

	public function update_riwayat_pasien()
	{
		$periksa_id = $this->input->post('periksa_id');
		$data_pemeriksaan = [
			'tgl_periksa' => $this->input->post('tgl_periksa'),
			'catatan' => $this->input->post('catatan'),
			'biaya_periksa' => preg_replace('/[^\d]/', '', $this->input->post('biaya_periksa'))
		];
		$this->db->where('id', $periksa_id);
		$this->db->update('periksa', $data_pemeriksaan);

		// Hapus obat lama
		$this->db->where('id_periksa', $periksa_id);
		$this->db->delete('detail_periksa');

		// Tambahkan obat baru
		$obat = $this->input->post('obat');
		foreach ($obat as $obat_id) {
			$this->db->insert('detail_periksa', [
				'id_periksa' => $periksa_id,
				'id_obat' => $obat_id,
			]);
		}

		redirect('welcome/riwayat_pasien');
	}
	// Tutup Edit Detail Riwayat Pemeriksaan -->

	// Ganti Password Dokter
	public function ganti_password()
	{
		// Pastikan hanya dokter yang bisa mengakses
		if ($this->session->userdata('user_type') != 'Dokter') {
			$this->session->set_flashdata('error', 'Akses ditolak');
			redirect('auth/login');
		}

		$this->load->view('master/header');
		$this->load->view('master/sidebar');
		$this->load->view('v_dokter_ganti_password');
		$this->load->view('master/footer');
	}

	public function update_password()
	{
		// Pastikan hanya dokter yang bisa mengakses
		if ($this->session->userdata('user_type') != 'Dokter') {
			$this->session->set_flashdata('error', 'Akses ditolak');
			redirect('auth/login');
		}

		$user_id = $this->session->userdata('user_id');
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('new_password');
		$confirm_password = $this->input->post('confirm_password');

		// Validasi input
		if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
			$this->session->set_flashdata('error', 'Semua field harus diisi');
			redirect('welcome/ganti_password');
		}

		if ($new_password !== $confirm_password) {
			$this->session->set_flashdata('error', 'Password baru dan konfirmasi password tidak sama');
			redirect('welcome/ganti_password');
		}

		// Periksa password lama
		$hashed_old_password = md5($old_password);
		$user = $this->Proses->check_password($user_id, $hashed_old_password);

		if (!$user) {
			$this->session->set_flashdata('error', 'Password lama salah');
			redirect('welcome/ganti_password');
		}

		// Update password baru
		$hashed_new_password = md5($new_password);
		$this->Proses->update_password($user_id, $hashed_new_password);

		$this->session->set_flashdata('success', 'Password berhasil diperbarui');
		redirect('welcome/ganti_password');
	}
	// Tutup Dokter -->
}
