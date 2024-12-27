<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Proses extends CI_Model
{
    // Fungsi untuk memeriksa login berdasarkan username dan password
    public function check_login($username, $hashed_password)
    {
        // Pengecekan untuk admin
        $this->db->where('username', $username);
        $this->db->where('password', $hashed_password); // Hash password langsung dibandingkan
        $query = $this->db->get('admin');
        if ($query->num_rows() > 0) {
            $user = $query->row();
            $user->user_type = 'Admin'; // Tambahkan tipe user
            return $user;
        }

        // Pengecekan untuk pasien
        $this->db->select('id, username, nama');
        $this->db->where('username', $username);
        $this->db->where('password', $hashed_password);
        $query = $this->db->get('pasien');
        if ($query->num_rows() > 0) {
            $user = $query->row();
            $user->user_type = 'Pasien'; // Tambahkan tipe user
            return $user;
        }

        // Pengecekan untuk dokter
        $this->db->select('id, username, nama');
        $this->db->where('username', $username);
        $this->db->where('password', $hashed_password);
        $query = $this->db->get('dokter');
        if ($query->num_rows() > 0) {
            $user = $query->row();
            $user->user_type = 'Dokter'; // Tambahkan tipe user
            return $user;
        }

        // Jika tidak ditemukan
        return false;
    }

    // Fungsi untuk cek duplikasi username dan no_ktp di tabel pasien
    public function check_username_exists($username)
    {
        // Cek apakah username sudah ada
        $this->db->where('username', $username);
        $query = $this->db->get('pasien');

        // Jika username sudah ada, return true
        if ($query->num_rows() > 0) {
            return true; // Ada duplikasi username
        }

        return false; // Tidak ada duplikasi
    }

    public function check_no_ktp_exists($no_ktp)
    {
        // Cek apakah no_ktp sudah ada
        $this->db->where('no_ktp', $no_ktp);
        $query = $this->db->get('pasien');

        // Jika no_ktp sudah ada, return true
        if ($query->num_rows() > 0) {
            return true; // Ada duplikasi no_ktp
        }

        return false; // Tidak ada duplikasi no_ktp
    }

    public function check_password($user_id, $hashed_password)
    {
        return $this->db->get_where('dokter', [
            'id' => $user_id,
            'password' => $hashed_password
        ])->row();
    }

    public function update_password($user_id, $hashed_password)
    {
        $this->db->where('id', $user_id);
        $this->db->update('dokter', ['password' => $hashed_password]);
    }

    // Fungsi untuk generate no_rm otomatis
    public function generate_no_rm()
    {
        // Ambil data pasien terakhir
        $this->db->select('no_rm');
        $this->db->order_by('no_rm', 'DESC');
        $query = $this->db->get('pasien', 1);
        $last_no_rm = $query->row();

        // Tentukan no_rm baru berdasarkan urutan
        $new_no_rm = 'PAS001'; // Default jika tidak ada pasien
        if ($last_no_rm) {
            // Ambil angka terakhir dan tambahkan 1
            $last_number = (int) substr($last_no_rm->no_rm, 3);
            $new_no_rm = 'PAS' . str_pad($last_number + 1, 3, '0', STR_PAD_LEFT);
        }

        return $new_no_rm;
    }

    public function register_user($data)
    {
        $this->db->insert('pasien', $data); // Gantilah 'users' dengan nama tabel sesuai database Anda
    }

    // Ambil semua data dokter
    public function get_all_dokter()
    {
        return $this->db->get('dokter')->result(); // Mengambil semua data dari tabel dokter
    }

    public function get_dokter($id_dokter)
    {
        return $this->db->get_where('dokter', ['id' => $id_dokter])->row();
    }


    // Ambil data dokter berdasarkan ID
    public function get_dokter_by_id($id)
    {
        return $this->db->get_where('dokter', ['id' => $id])->row(); // Mengambil data berdasarkan ID
    }

    // Menambah dokter baru
    public function insert_dokter($data)
    {
        $this->db->insert('dokter', $data); // Menambah data ke tabel dokter
    }

    // Mengupdate data dokter
    public function update_dokter($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('dokter', $data); // Mengupdate data berdasarkan ID
    }

    // Menghapus data dokter
    public function delete_dokter($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('dokter'); // Menghapus data berdasarkan ID
    }

    public function get_all_poli()
    {
        return $this->db->get('poli')->result();
    }

    public function get_poli_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('poli')->row();
    }

    public function insert_poli($data)
    {
        $this->db->insert('poli', $data);
    }

    public function update_poli($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('poli', $data);
    }

    public function delete_poli($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('poli'); // Menghapus data berdasarkan ID
    }

    public function get_all_obat()
    {
        return $this->db->get('obat')->result();
    }

    public function get_obat_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('obat')->row();
    }

    public function insert_obat($data)
    {
        $this->db->insert('obat', $data);
    }

    public function update_obat($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('obat', $data);
    }
    public function delete_obat($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('obat'); // Menghapus data berdasarkan ID
    }

    public function get_all_patient()
    {
        return $this->db->get('pasien')->result(); // Mengambil semua data dari tabel dokter
    }

    // Fungsi untuk mengecek apakah no_hp atau no_ktp sudah ada di database
    public function check_existing_user($no_hp, $no_ktp)
    {
        // Query untuk mengecek apakah no_hp atau no_ktp sudah ada
        $this->db->or_where('no_hp', $no_hp);
        $this->db->or_where('no_ktp', $no_ktp);
        $query = $this->db->get('pasien'); // Pastikan 'users' adalah nama tabel yang sesuai

        // Jika ada data yang cocok, maka pengguna sudah terdaftar
        return $query->num_rows() > 0;
    }

    public function insert_pasien($data)
    {
        $this->db->insert('pasien', $data);
    }

    public function update_pasien($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('pasien', $data);
    }

    public function delete_pasien($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pasien'); // Menghapus data berdasarkan ID
    }

    public function get_pasien_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('pasien')->row();
    }

    // Model untuk mengambil dokter berdasarkan id_poli
    public function get_dokter_by_poli($id_poli)
    {
        return $this->db->where('id_poli', $id_poli)->get('dokter')->result(); // Mengambil dokter berdasarkan poli
    }

    // Model untuk mengambil jadwal dokter berdasarkan id_dokter
    public function get_jadwal_by_dokter($id_dokter)
    {
        return $this->db->where('id_dokter', $id_dokter)->get('jadwal_periksa')->result(); // Mengambil jadwal dokter
    }

    public function get_jadwal_dokter_by_status($id_dokter)
    {
        // Mengambil jadwal dokter dengan status aktif
        $this->db->where('id_dokter', $id_dokter);
        $this->db->where('status', 'aktif');  // Filter berdasarkan status aktif
        $query = $this->db->get('jadwal_periksa');  // Mengambil data dari tabel jadwal_periksa
        return $query->result();  // Mengembalikan hasil sebagai array objek
    }


    // Fungsi untuk mengambil jadwal berdasarkan id
    public function get_jadwal_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('jadwal_periksa');
        return $query->row();
    }

    public function insert_daftar_poli($data)
    {
        // Memasukkan data ke tabel daftar_poli
        $this->db->insert('daftar_poli', $data);
    }

    // Fungsi untuk mendapatkan nomor antrian berikutnya berdasarkan tanggal
    public function get_next_antrian()
    {
        // Cek nomor antrian terakhir
        $this->db->select('no_antrian');
        $this->db->order_by('no_antrian', 'DESC'); // Urutkan nomor antrian secara menurun
        $query = $this->db->get('daftar_poli');
        $result = $query->row();

        // Cek apakah ada antrian sebelumnya
        if ($result && isset($result->no_antrian)) {
            // Mengambil nomor antrian terakhir tanpa awalan 'Q'
            $last_antrian = substr($result->no_antrian, 1); // Mengambil angka setelah 'Q'
            // Increment nomor antrian
            $next_antrian = (int) $last_antrian + 1;
        } else {
            // Jika tidak ada antrian sebelumnya, mulai dari Q001
            $next_antrian = 1;
        }

        // Kembalikan nomor antrian dengan awalan 'Q' dan padding
        return 'Q' . str_pad($next_antrian, 3, '0', STR_PAD_LEFT); // Format Q001, Q002, dst
    }

    public function get_nama_poli($id_poli)
    {
        // Query untuk mengambil nama poli
        $this->db->select('nama_poli');
        $this->db->from('poli');
        $this->db->where('id', $id_poli);
        $query = $this->db->get();

        // Mengembalikan nama poli jika ada
        if ($query->num_rows() > 0) {
            return $query->row()->nama_poli;
        }

        // Mengembalikan string kosong jika tidak ditemukan
        return '';
    }

    // Mengecek apakah jadwal dengan hari dan jam mulai yang sama sudah ada
    public function check_existing_jadwal($id_dokter, $hari, $jam_mulai, $id_jadwal = null)
    {
        $this->db->where('id_dokter', $id_dokter);
        $this->db->where('hari', $hari);
        $this->db->where('jam_mulai', $jam_mulai);

        if ($id_jadwal) {
            $this->db->where('id !=', $id_jadwal); // Jangan cek jadwal yang sedang diedit
        }

        $query = $this->db->get('jadwal_periksa');
        return $query->num_rows() > 0; // Mengembalikan true jika ada jadwal yang sama
    }

    public function insert_jadwal($data)
    {
        return $this->db->insert('jadwal_periksa', $data);
    }

    // Mengupdate jadwal yang ada
    public function update_jadwal($id_jadwal, $data)
    {
        $this->db->where('id', $id_jadwal);
        $this->db->update('jadwal_periksa', $data);
    }

    // Menghapus jadwal
    public function delete_jadwal($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jadwal_periksa');
    }

    // Mengambil data pasien yang sesuai dengan dokter
    public function get_pasien_by_dokter($id_dokter)
    {
        $this->db->select('daftar_poli.*, pasien.nama AS nama_pasien, poli.nama_poli, dokter.nama AS nama_dokter, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai');
        $this->db->from('daftar_poli');
        $this->db->join('pasien', 'pasien.id = daftar_poli.id_pasien');
        $this->db->join('poli', 'poli.id = daftar_poli.id_poli');
        $this->db->join('dokter', 'dokter.id = daftar_poli.id_dokter');
        $this->db->join('jadwal_periksa', 'jadwal_periksa.id = daftar_poli.id_jadwal');
        $this->db->where('daftar_poli.id_dokter', $id_dokter);
        $this->db->where('daftar_poli.status_periksa', 'belum'); // Hanya ambil yang belum diperiksa
        $this->db->order_by('daftar_poli.no_antrian', 'ASC'); // Urutkan berdasarkan nomor antrian

        $query = $this->db->get();
        return $query->result();
    }

    public function simpan_periksa($data_periksa)
    {
        $this->db->insert('periksa', $data_periksa);
        return $this->db->insert_id();  // Mengembalikan ID yang baru
    }

    public function simpan_detail_obat($data_detail_obat)
    {
        $this->db->insert('detail_periksa', $data_detail_obat);
    }


    // Update status pasien setelah diperiksa
    public function update_status_periksa($id_daftar_poli)
    {
        // Update status menjadi 'sudah diperiksa' untuk poli yang relevan
        $this->db->set('status_periksa', 'sudah');
        $this->db->where('id', $id_daftar_poli);
        $this->db->update('daftar_poli');
    }


    public function get_id_daftar_poli_by_pasien($id_pasien, $id_poli, $id_jadwal)
    {
        $this->db->select('id');
        $this->db->from('daftar_poli');
        $this->db->where('id_pasien', $id_pasien);
        $this->db->where('id_poli', $id_poli);  // Filter berdasarkan poli
        $this->db->where('id_jadwal', $id_jadwal);  // Filter berdasarkan jadwal juga
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->id;  // Kembalikan id_daftar_poli
        }

        return false;  // Tidak ditemukan
    }

    public function get_list_pasien_by_jadwal($iddokter)
    {
        $this->db->select('
        daftar_poli.id AS daftar_poli_id, daftar_poli.keluhan, daftar_poli.no_antrian, daftar_poli.status_periksa, daftar_poli.tanggal,
        pasien.id AS pasien_id, pasien.nama AS pasien_nama, pasien.no_rm, 
        dokter.id AS dokter_id, dokter.nama AS dokter_nama, dokter.id_poli, 
        poli.id AS poli_id, poli.nama_poli, 
        jadwal_periksa.id, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai');
        $this->db->from('daftar_poli');
        $this->db->join('jadwal_periksa', 'daftar_poli.id_jadwal = jadwal_periksa.id');
        $this->db->join('pasien', 'daftar_poli.id_pasien = pasien.id');
        $this->db->join('dokter', 'jadwal_periksa.id_dokter = dokter.id');
        $this->db->join('poli', 'dokter.id_poli = poli.id');
        $this->db->where('jadwal_periksa.id_dokter', $iddokter);
        return $this->db->get()->result_array();
    }
    public function get_daftar_poli($iddaftarpoli)
    {
        $this->db->select('daftar_poli.id AS daftar_poli_id, daftar_poli.id_dokter AS dokter_id, pasien.id AS pasien_id, pasien.nama');
        $this->db->from('daftar_poli');
        $this->db->join('pasien', 'daftar_poli.id_pasien = pasien.id');
        $this->db->where('daftar_poli.id', $iddaftarpoli);
        return $this->db->get()->row_array();
    }

    public function get_daftar_poli_belum($id_pasien)
    {
        $this->db->select('
        daftar_poli.*,
        poli.nama_poli,
        dokter.nama as nama_dokter,
        jadwal_periksa.hari,
        jadwal_periksa.jam_mulai,
        jadwal_periksa.jam_selesai
    ');
        $this->db->from('daftar_poli');
        $this->db->join('poli', 'poli.id = daftar_poli.id_poli', 'left');
        $this->db->join('dokter', 'dokter.id = daftar_poli.id_dokter', 'left');
        $this->db->join('jadwal_periksa', 'jadwal_periksa.id = daftar_poli.id_jadwal', 'left');
        $this->db->where('daftar_poli.id_pasien', $id_pasien);
        $this->db->where('daftar_poli.status_periksa', 'belum'); // Filter status belum
        $this->db->order_by('daftar_poli.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function get_riwayat_daftar_poli($id_pasien)
    {
        $this->db->select('
            daftar_poli.*,
            poli.nama_poli,
            dokter.nama as nama_dokter,
            jadwal_periksa.hari,
            jadwal_periksa.jam_mulai,
            jadwal_periksa.jam_selesai
        ');
        $this->db->from('daftar_poli');
        $this->db->join('poli', 'poli.id = daftar_poli.id_poli', 'left');
        $this->db->join('dokter', 'dokter.id = daftar_poli.id_dokter', 'left');
        $this->db->join('jadwal_periksa', 'jadwal_periksa.id = daftar_poli.id_jadwal', 'left');
        $this->db->where('daftar_poli.id_pasien', $id_pasien);
        $this->db->where('daftar_poli.status_periksa', 'sudah'); // Filter status sudah
        $this->db->order_by('daftar_poli.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    // Fungsi untuk mendapatkan riwayat pemeriksaan berdasarkan dokter
    public function get_riwayat_pemeriksaan_dokter($id_dokter)
    {
        $this->db->select('
            p.id AS periksa_id, 
            dp.id_pasien, 
            pas.nama AS nama_pasien, 
            pas.alamat, 
            pas.no_ktp, 
            pas.no_hp, 
            pas.no_rm,
            GROUP_CONCAT(DISTINCT dp.keluhan ORDER BY dp.keluhan) AS keluhan, 
            GROUP_CONCAT(DISTINCT dp.no_antrian ORDER BY dp.no_antrian) AS no_antrian, 
            GROUP_CONCAT(DISTINCT dp.tanggal ORDER BY dp.tanggal) AS tanggal,
            GROUP_CONCAT(DISTINCT dp.status_periksa ORDER BY dp.status_periksa) AS status_periksa, 
            GROUP_CONCAT(DISTINCT p.tgl_periksa ORDER BY p.tgl_periksa) AS tgl_periksa, 
            GROUP_CONCAT(DISTINCT p.catatan ORDER BY p.catatan) AS catatan, 
            GROUP_CONCAT(DISTINCT p.id_daftar_poli ORDER BY p.id_daftar_poli) AS id_daftar_poli,
            GROUP_CONCAT(DISTINCT ob.nama_obat ORDER BY ob.nama_obat) AS obat, 
            SUM(p.biaya_periksa) AS total_biaya_periksa, 
            dp.id_dokter,
            d.nama AS nama_dokter
        ');

        // Menggunakan JOIN untuk mengambil data dari tabel terkait
        $this->db->from('periksa p');
        $this->db->join('daftar_poli dp', 'p.id_daftar_poli = dp.id');
        $this->db->join('pasien pas', 'dp.id_pasien = pas.id');
        $this->db->join('detail_periksa dpkt', 'p.id = dpkt.id_periksa', 'left');
        $this->db->join('obat ob', 'dpkt.id_obat = ob.id', 'left');
        $this->db->join('dokter d', 'dp.id_dokter = d.id');

        // Menambahkan kondisi untuk mendapatkan data berdasarkan ID dokter dan status periksa
        $this->db->where('dp.id_dokter', $id_dokter);
        $this->db->where('dp.status_periksa', 'sudah');

        // Menambahkan GROUP BY untuk mengelompokkan hasil berdasarkan ID pasien dan dokter
        $this->db->group_by('dp.id_pasien, dp.id_dokter, pas.nama, pas.alamat, pas.no_ktp, pas.no_hp, pas.no_rm, 
                             d.nama');

        // Mengambil hasil query
        $query = $this->db->get();

        // Mengembalikan hasil query
        return $query->result();
    }

    // Mendapatkan detail pemeriksaan berdasarkan periksa_id
    public function get_detail_pemeriksaan_by_id($periksa_id)
    {
        // Menyiapkan query untuk mengambil detail pemeriksaan
        $this->db->select('
        p.id AS periksa_id, 
        p.tgl_periksa, 
        p.catatan,
        pas.id AS pasien_id,
        pas.nama AS nama_pasien,  
        dp.keluhan, 
        dp.no_antrian, 
        dp.tanggal, 
        dp.status_periksa, 
        dp.id_poli, 
        dp.id_jadwal, 
        dp.id_dokter,
        dp.id_pasien,
        GROUP_CONCAT(DISTINCT ob.nama_obat ORDER BY ob.nama_obat) AS obat, 
        p.biaya_periksa
    ');

        // Menggunakan JOIN untuk mengambil data dari tabel terkait
        $this->db->from('periksa p');
        $this->db->join('daftar_poli dp', 'p.id_daftar_poli = dp.id');
        $this->db->join('pasien pas', 'dp.id_pasien = pas.id');
        $this->db->join('detail_periksa dpkt', 'p.id = dpkt.id_periksa');
        $this->db->join('obat ob', 'dpkt.id_obat = ob.id');
        $this->db->join('dokter d', 'dp.id_dokter = d.id');

        // Menambahkan kondisi untuk mendapatkan data berdasarkan periksa_id
        $this->db->where('dp.id_pasien', $periksa_id);

        // Menambahkan GROUP BY untuk mengelompokkan hasil berdasarkan ID pemeriksaan
        $this->db->group_by('
        p.id, p.tgl_periksa, p.catatan, dp.keluhan, dp.no_antrian, dp.tanggal, dp.status_periksa, 
        dp.id_poli, dp.id_jadwal, dp.id_dokter, p.biaya_periksa
    ');

        // Mengambil hasil query
        $query = $this->db->get();

        // Mengembalikan hasil query
        return $query->result_array();  // Mengembalikan hasil sebagai array
    }

    public function get_detail_pemeriksaan_by_periksa_id($periksa_id)
    {
        // Menyiapkan query untuk mengambil detail pemeriksaan
        $this->db->select('
        p.id AS periksa_id, 
        p.tgl_periksa, 
        p.catatan,
        pas.id AS pasien_id,
        pas.nama AS nama_pasien,  
        ob.id AS obat_id,
        dp.keluhan, 
        dp.no_antrian, 
        dp.tanggal, 
        dp.status_periksa, 
        dp.id_poli, 
        dp.id_jadwal, 
        dp.id_dokter,
        dp.id_pasien,
        GROUP_CONCAT(DISTINCT ob.nama_obat ORDER BY ob.nama_obat) AS obat, 
        p.biaya_periksa
    ');

        // Menggunakan JOIN untuk mengambil data dari tabel terkait
        $this->db->from('periksa p');
        $this->db->join('daftar_poli dp', 'p.id_daftar_poli = dp.id');
        $this->db->join('pasien pas', 'dp.id_pasien = pas.id');
        $this->db->join('detail_periksa dpkt', 'p.id = dpkt.id_periksa');
        $this->db->join('obat ob', 'dpkt.id_obat = ob.id');
        $this->db->join('dokter d', 'dp.id_dokter = d.id');

        // Menambahkan kondisi untuk mendapatkan data berdasarkan periksa_id
        $this->db->where('p.id', $periksa_id);

        // Menambahkan GROUP BY untuk mengelompokkan hasil berdasarkan ID pemeriksaan
        $this->db->group_by('
        p.id, p.tgl_periksa, p.catatan, dp.keluhan, dp.no_antrian, dp.tanggal, dp.status_periksa, 
        dp.id_poli, dp.id_jadwal, dp.id_dokter, p.biaya_periksa
    ');

        // Mengambil hasil query
        $query = $this->db->get();

        // Mengembalikan hasil query
        return $query->result_array();  // Mengembalikan hasil sebagai array
    }

    public function get_pemeriksaan_detail($periksa_id)
    {
        // Ambil data pemeriksaan
        $this->db->select('
        p.id AS periksa_id, 
        p.tgl_periksa, 
        p.catatan,
        pas.id AS pasien_id,
        pas.nama AS nama_pasien,
        dp.keluhan, 
        dp.no_antrian, 
        dp.tanggal, 
        dp.status_periksa, 
        dp.id_poli, 
        dp.id_jadwal, 
        dp.id_dokter,
        dp.id_pasien,
        p.biaya_periksa
    ');
        $this->db->from('periksa p');
        $this->db->join('daftar_poli dp', 'p.id_daftar_poli = dp.id');
        $this->db->join('pasien pas', 'dp.id_pasien = pas.id');
        $this->db->where('p.id', $periksa_id);
        $query = $this->db->get();
        return $query->row_array(); // Hanya satu data
    }

    public function get_obat_by_periksa_id($periksa_id)
    {
        // Ambil data obat yang terkait dengan pemeriksaan
        $this->db->select('dpkt.id_periksa, ob.id AS obat_id, ob.nama_obat, ob.harga');
        $this->db->from('detail_periksa dpkt');
        $this->db->join('obat ob', 'dpkt.id_obat = ob.id');
        $this->db->where('dpkt.id_periksa', $periksa_id);
        $query = $this->db->get();
        return $query->result_array(); // Banyak data obat
    }


    public function update_riwayat($periksa_id, $data)
    {
        // Update data riwayat pemeriksaan berdasarkan ID pemeriksaan
        $this->db->where('id', $periksa_id);
        return $this->db->update('periksa', $data);
    }

}
