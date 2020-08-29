<?php
class m_auth extends CI_Model
{
    private function _uploadImage()
    {
        $config['upload_path']          = './assets/img/pengaduan/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data();
        }
        print_r($this->upload->display_errors());

        return "default.jpg";
    }
    
    public function aksi_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('login', ['email' => $email])->row_array();
        // Nyari User
        if ($user) {
            // Ini kalo passwordnya bener
            if (password_verify($password, $user['password']))
            // ini gua gk tau apaan namanya
            {
                $data = [
                    'email' => $user['email'],
                    'level' => $user['level']
                ];
                $this->session->set_userdata($data);
                // nentuin dia nanti masuknya kemana berdasarkan level
                if ($user['level'] == "admin") {
                    redirect('admin/index');
                } elseif ($user['level'] == "petugas") {
                    redirect('petugas/index');
                } else {
                    redirect('masyarakat/index');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kata Sandi yang anda masukkan salah!</div>');
                redirect('auth/login');
            }
        } else {
            // ini kalo email belum terdaftar
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email anda belum terdaftar!</div>');
            redirect('auth/login');
        }
    }

    public function aksi_logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('password');

        $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissible fade show" role="alert"> Kamu berhasil keluar!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('auth/login');
    }

    public function register_m()
    {
        $this->form_validation->set_rules('nik', 'Nik', 'required|trim|min_length[15]|max_length[16]', [
            'required' => 'Mohon masukkan NIK!',
            'min_length' => 'NIK tidak boleh kurang dari 15 suku kata',
            'max_length' => 'NIK tidak boleh melibihi 16 suku kata'
        ]);
        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Mohon masukkan nama lengkap anda!'
        ]);
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[petugas.email]', [
            'required' => 'Mohon masukkan email anda!',
            'valid_email' => 'Mohon masukkan email yang tepat!',
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'Mohon masukkan kata sandi!',
            'min_length' => 'Kata Sandi terlalu pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]', [
            'matches' => 'Kata sandi tidak cocok!'
        ]);
        $this->form_validation->set_rules('telp', 'Telephone', 'required|trim|min_length[10]|max_length[13]', [
            'required' => 'Mohon masukkan Nomor Telepon!',
            'min_length' => 'Nomor terlalu pendek',
            'max_length' => 'Nomor tidak boleh melebihi 13 angka'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/m_register');
        } else {
            $data = array(
                'nik' => $this->input->post('nik'),
                'nama' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'telp' => $this->input->post('telp', true),
                'image' => $this->_uploadImage(),
                'date_created' => time()
            );

            $this->db->insert('masyarakat', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Akun anda berhasil di tambahkan</div>');
            redirect('auth/login');
        }
    }

    public function register_ap()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Mohon masukkan nama lengkap anda!'
        ]);
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[petugas.email]', [
            'required' => 'Mohon masukkan email anda!',
            'valid_email' => 'Mohon masukkan email yang tepat!',
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'Mohon masukkan kata sandi!',
            'min_length' => 'Kata Sandi terlalu pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]', [
            'matches' => 'Kata sandi tidak cocok!'
        ]);
        $this->form_validation->set_rules('telp', 'Telephone', 'required|trim|min_length[10]|max_length[13]', [
            'required' => 'Mohon masukkan Nomor Telepon!',
            'min_length' => 'Nomor terlalu pendek',
            'max_length' => 'Nomor tidak boleh melebihi 13 angka'
        ]);
        $this->form_validation->set_rules('level', 'Level', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/register');
        } else {
            $data = array(
                'nama' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'telp' => $this->input->post('telp', true),
                'image' => $this->_uploadImage(),
                'level' => $this->input->post('level'),
                'date_created' => time()
            );

            $this->db->insert('petugas', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Akun anda berhasil di tambahkan</div>');
            redirect('auth/login');
        }
    }
}