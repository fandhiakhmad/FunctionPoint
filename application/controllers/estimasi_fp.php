<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Estimasi_fp extends CI_Controller
{
    /**
     * Ini merupakan Sebuah controller untuk menghubungkan view uc dan model uc
     * Semua CRUD yang berhubungan dengan uc memanggil controller ini
     * Created by Fandhi Akhmad
     * V.1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url'
        ));
        require_once(APPPATH . 'controllers/mailler.php');

        $this->load->model('tim_model');
        $this->load->model('anggota_model');
        $this->load->model('aplikasi_model');
        $this->load->model('client_model');
        $this->load->model('fitur_model');
        $this->load->model('log_konstanta_effort_model');
        $this->load->model('log_biaya_model');
        $this->load->model('aktivitas_model');
		$this->load->model('user_model');
        $this->load->model('cfp_model');
        $this->load->model('rcaf_model');
        $this->load->model('log_cfp_model');
        $this->load->model('log_rcaf_model');
        
        if ($this->session->userdata('id_user') == NULL) 
        {    
            redirect('login');   
        }
    }
    
    public function index()
    {
        redirect('form_client');
    }

    function current_step($get_value)
    {
        $inputSplit  = explode("-", $get_value);
        $id_aplikasi = $inputSplit[0];
        
        // error handling
        $step        = isset($inputSplit[1]) ? $inputSplit[1] : 0;
        
        if ($step == 1) 
        {
            $this->session->set_userdata('step', $step);
            $this->session->set_userdata('id_aplikasi', $id_aplikasi);
            redirect('estimasi_fp/form_aplikasi/' . $id_aplikasi);
        }
        
        if ($step == 2) 
        {
            $this->session->set_userdata('id_aplikasi', $id_aplikasi);
            redirect('estimasi_fp/form_edit_aplikasi/' . $id_aplikasi);
        }
        
        else if ($step == 3) 
        {
            $this->session->set_userdata('id_aplikasi', $id_aplikasi);
            redirect('estimasi_fp/form_cfp');
        }
        
        else if ($step == 4) 
        {
            $this->session->set_userdata('id_aplikasi', $id_aplikasi);
            redirect('estimasi_fp/form_rcaf');
        }
        
        // else if ($step == 5) 
        // {
        //     //$this->session->set_userdata('step', $step);
        //     $this->session->set_userdata('id_aplikasi', $id_aplikasi);
        //     redirect('estimasi_fp/edit_log_tcf/' . $id_aplikasi);
        // }
        
        // else if ($step == 6) 
        // {
        //     //$this->session->set_userdata('step', $step);
        //     $this->session->set_userdata('id_aplikasi', $id_aplikasi);
        //     redirect('estimasi_fp/edit_log_ecf/' . $id_aplikasi);
        // }

        else if ($step == 7) 
        {
            $this->session->set_userdata('id_aplikasi', $id_aplikasi);
            redirect('estimasi_fp/result');
        }
		
        else if ($step == 8) 
        {
			$this->session->set_userdata('id_aplikasi', $id_aplikasi);
            redirect('estimasi_fp/result');
        }
		
		else if ($step == 9) 
        {
			$this->session->set_userdata('id_aplikasi', $id_aplikasi);
            redirect('estimasi_fp/result');
        }
    }
	
	public function lihat_tim($id_aplikasi)
    {
		
		$this->session->set_userdata('id_aplikasi',$id_aplikasi);
		redirect('estimasi_fp/form_edit_aplikasi/' . $id_aplikasi);
	}
    

    public function form_client()
    {
		$this->session->set_userdata('id_aplikasi',null);
        $isi['anggota']     = $this->anggota_model->get_data_anggota();
        $isi['anggota_tim'] = $this->aplikasi_model->get_anggota_tim(0);
        $isi['pesan_error'] = "";
        $isi['step'] = 0;
        
        if ($this->session->flashdata('pesan') != "") 
        {
            $isi['kirim'] = $this->session->flashdata('pesan');
        }
        
        $user['nama']      = $this->session->userdata('nama');
		$user['id_user']   = $this->session->userdata('id_user');
        $data['header']    = $this->load->view('backend_fp/header', $user, true);
        $user['nama']      = $this->session->userdata('nama');
		$user['id_user']   = $this->session->userdata('id_user');
		$role['role']      = $this->session->userdata('role');
		$data['menu_kiri'] = $this->load->view('backend_fp/menu_kiri',$role, true);
        $data['content']   = $this->load->view('frontend_fp/form_client', $isi, true);
        $this->load->view('/backend_fp/main', $data);
    }
    
    public function form_edit_client($id)
    {
        $id_aplikasi=$this->session->userdata('id_aplikasi');
        $isi['id_aplikasi'] = 
        $isi['nama_client'] = $this->client_model->get_client($id)->row()->NAMA;
        $isi['alamat']      = $this->client_model->get_client($id)->row()->ALAMAT;
        $isi['tanggal']     = $this->client_model->get_client($id)->row()->TANGGAL_PENGAJUAN;
        $isi['id_client']   = $this->client_model->get_client($id)->row()->ID_CLIENT;
        $isi['edit']        = true;
        
        if ($this->session->flashdata('pesan') != "") 
        {
            $isi['kirim'] = $this->session->flashdata('pesan');
        }
        
        if ($this->session->flashdata('pesan_error') != "") 
        {
            $isi['pesan_error'] = $this->session->flashdata('pesan_error');
        } else 
        {
            $isi['pesan_error'] = "";
        }
        
        $isi['step']       = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->STEP;
        $user['nama']      = $this->session->userdata('nama');
		$user['id_user']   = $this->session->userdata('id_user');
        $data['header']    = $this->load->view('backend_fp/header', $user, true);
        $role['role']      = $this->session->userdata('role');
		$data['menu_kiri'] = $this->load->view('backend_fp/menu_kiri',$role, true);
        $data['content']   = $this->load->view('frontend_fp/form_client', $isi, true);
        $this->load->view('/backend_fp/main', $data);
    }
    
    public function add_client()
    {
        $nama_client = $this->input->post('nama_client');
        $alamat      = $this->input->post('alamat');
        $tanggal     = $this->input->post('tanggal');
        $valid = true;
        
        if ($nama_client == "") 
        {
            $valid            = true;
            $isi['errclient'] = "Nama Client belum dimasukan";
            
        }
        if ($alamat == "") 
        {
            $valid            = false;
            $isi['erralamat'] = "Alamat  belum dimasukan";    
        }
        
        if ($tanggal == "") 
        {
            $valid             = false;
            $isi['errtanggal'] = "Tanggal belum   dimasukan";
        }
        
        if ($valid) {
            
            $dataclient = array(
                'NAMA' => $nama_client,
                'ALAMAT' => $alamat,
                'TANGGAL_PENGAJUAN' => $tanggal
            );
            
            $this->client_model->insert_data_client($dataclient);
            $id_client    = $this->client_model->select_max_id_client()->row()->ID_CLIENT;
            
            // insert for initial aplikasi
            $dataaplikasi = array(
                'ID_CLIENT' => $id_client,
                'STEP' => 1,
				'DATE_CREATED' => DATE('d-m-Y')
            );
            
            $this->aplikasi_model->insert_data_aplikasi($dataaplikasi);
            
            // get id max aplikasi and store in the session
            $this->session->set_userdata('id_aplikasi', $this->aplikasi_model->get_max_id()->row()->ID_APLIKASI);
            $id_aplikasi = $this->session->userdata('id_aplikasi');
            
            $this->session->set_flashdata('pesan', "Data client berhasil disimpan");
            redirect('estimasi_fp/form_aplikasi/' . $id_aplikasi);
            
        } else {
            
            $isi['step'] = 0;
            
            $user['nama']      = $this->session->userdata('nama');
		    $user['id_user']   = $this->session->userdata('id_user');
            $data['header']    = $this->load->view('backend_fp/header', $user, true);
            $role['role']      = $this->session->userdata('role');
		    $data['menu_kiri'] = $this->load->view('backend_fp/menu_kiri',$role, true);
            $data['content']   = $this->load->view('frontend_fp/form_client', $isi, true);
            $this->load->view('/backend_fp/main', $data);
        }
    }
    
    public function update_client()
    {
        $nama_client = $this->input->post('nama_client');
        $id_client   = $this->input->post('id_client');
        $alamat      = $this->input->post('alamat');
        $tanggal     = $this->input->post('tanggal');
        $valid = true;
        
        if ($nama_client == "") 
        {
            $valid            = true;
            $isi['errclient'] = "Nama Client belum dimasukan";    
        }

        if ($alamat == "") 
        {
            $valid            = false;
            $isi['erralamat'] = "Alamat  belum dimasukan";    
        }
        
        if ($tanggal == "") 
        {
            $valid             = false;
            $isi['errtanggal'] = "Tanggal belum   dimasukan";
        }
        
        if ($valid) {
                
            $dataclient = array(
                'NAMA' => $nama_client,
                'ALAMAT' => $alamat,
                'TANGGAL_PENGAJUAN' => $tanggal
            );
            
            $this->client_model->update_client($dataclient, $id_client);
            
            // get id max aplikasi and store in the session
            
            $id_aplikasi = $this->session->userdata('id_aplikasi');
            
            $this->session->set_flashdata('pesan', "Data client berhasil disimpan");
            redirect('estimasi_fp/form_edit_client/' . $id_aplikasi);
            
        } else {
            
            $isi['step'] = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->STEP;
            $user['nama']      = $this->session->userdata('nama');
		    $user['id_user']   = $this->session->userdata('id_user');
            $data['header']    = $this->load->view('backend_fp/header', $user, true);
            $role['role']      = $this->session->userdata('role');
		    $data['menu_kiri'] = $this->load->view('backend_fp/menu_kiri',$role, true);
            $data['content']   = $this->load->view('frontend_fp/form_client', $isi, true);
            $this->load->view('/backend_fp/main', $data);
        }
    }
    
    public function form_aplikasi($id_aplikasi)
    {
        
        $isi['anggota']     = $this->anggota_model->get_data_anggota();
        $isi['anggota_tim'] = $this->aplikasi_model->get_anggota_tim(0);
        $isi['pesan_error'] = "";
        
        $isi['step'] = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->STEP;
        
        if ($this->session->flashdata('pesan') != "") 
        {
            $isi['kirim'] = $this->session->flashdata('pesan');
        }
        
        $user['nama']      = $this->session->userdata('nama');
		$user['id_user']   = $this->session->userdata('id_user');
        $data['header']    = $this->load->view('backend_fp/header', $user, true);
        $role['role']      = $this->session->userdata('role');
		$data['menu_kiri'] = $this->load->view('backend_fp/menu_kiri',$role, true);
        $data['content']   = $this->load->view('frontend_fp/form_aplikasi', $isi, true);
        $this->load->view('/backend_fp/main', $data);
    }
    
    public function add_aplikasi()
    {
        $nama_aplikasi  = $this->input->post('nama_aplikasi');
        $templete       = $this->input->post('templete');
        $tim_pengembang = $this->input->post('tim_pengembang');
        $id_aplikasi    = $this->session->userdata('id_aplikasi');
        $valid = true;
        
        if ($nama_aplikasi == "") 
        {
            $valid              = true;
            $isi['erraplikasi'] = "Nama aplikasi belum dimasukan";   
        }

        if ($templete == "") 
        {
            $valid              = false;
            $isi['errtemplete'] = "Metode aplikasi belum dimasukan";    
        }
        
        if ($tim_pengembang == 0) 
        {
            $valid         = false;
            $isi['errtim'] = "Tim Pengembang belum  dimasukan";
        }
        
        if ($valid) {
            
            // Menambah tim baru
            $nama_tim = "Tim " . $nama_aplikasi;
            $datatim  = array(
                
                'NAMA_TIM' => $nama_tim
            );
            $this->aplikasi_model->insert_tim($datatim);
            
            // get maksimal ID Tim
            $id_tim = $this->aplikasi_model->select_max_id_tim()->row()->ID_TIM;
            
            foreach ($tim_pengembang as $data) {
                $dataanggota = array(
                    
                    'ID_TIM' => $id_tim,
                    'ID_ANGGOTA' => $data
                );
                
                $this->aplikasi_model->insert_anggota_tim($dataanggota);
            }
            
            $dataaplikasi = array(
                'NAMA_APLIKASI' => $nama_aplikasi,
                'TEMPLATE' => $templete,
                'ID_TIM' => $id_tim,
                'STATUS' => 0,
				'STEP' => 2,
            );
                       
            $this->aplikasi_model->update_aplikasi($dataaplikasi, $id_aplikasi);
          
            // $this->aplikasi_model->insert_data_aplikasi($dataaplikasi);
            // get id max aplikasi and store in the session
            //$this->session->set_userdata('id_aplikasi', $this->aplikasi_model->get_max_id()->row()->ID_APLIKASI);
            
            $this->session->set_flashdata('pesan', "Deskripsi aplikasi berhasil disimpan");
            redirect('estimasi_fp/form_edit_aplikasi/' . $id_aplikasi);
            
        } else {
        $isi['anggota']     = $this->anggota_model->get_data_anggota();
        $isi['anggota_tim'] = $this->aplikasi_model->get_anggota_tim(0);
        $isi['pesan_error'] = "";
        
        $isi['step'] = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->STEP;
        $user['nama']      = $this->session->userdata('nama');
		$user['id_user']   = $this->session->userdata('id_user');
        $data['header']    = $this->load->view('backend_fp/header', $user, true);
        $role['role']      = $this->session->userdata('role');
		$data['menu_kiri'] = $this->load->view('backend_fp/menu_kiri',$role, true);
        $data['content']   = $this->load->view('frontend_fp/form_aplikasi', $isi, true);
        $this->load->view('/backend_fp/main', $data);
        }
    }
    
    public function form_edit_aplikasi($id)
    {
        // check deskripsi apps udah dimasukan atau belum
        $check = $this->aplikasi_model->edit_log_aplikasi($id)->num_rows;
        
        $isi['id_aplikasi']   = $id;
        $isi['nama_aplikasi'] = $this->aplikasi_model->edit_log_aplikasi($id)->row()->NAMA_APLIKASI;
        $isi['id_tim']        = $this->aplikasi_model->edit_log_aplikasi($id)->row()->ID_TIM;
        $isi['edit']          = true;
        $isi['visible']       = true;
        $isi['templete']      = $this->aplikasi_model->edit_log_aplikasi($id)->row()->TEMPLATE;
        $isi['anggota']       = $this->anggota_model->get_data_anggota();
        $isi['anggota_tim']   = $this->aplikasi_model->get_anggota_tim($id);
        $isi['fitur']         = $this->fitur_model->get_fitur($id);
        $isi['id']            = $id;
        
        if ($this->session->flashdata('pesan') != "") 
        {
            $isi['kirim'] = $this->session->flashdata('pesan');
        }
        
        if ($this->session->flashdata('pesan_error') != "") 
        {
            $isi['pesan_error'] = $this->session->flashdata('pesan_error');
        } else {
            $isi['pesan_error'] = "";
        }
        
        $isi['step']       = $this->aplikasi_model->edit_log_aplikasi($id)->row()->STEP;
        $user['nama']      = $this->session->userdata('nama');
		$user['id_user']   = $this->session->userdata('id_user');
        $data['header']    = $this->load->view('backend_fp/header', $user, true);
        $role['role']      = $this->session->userdata('role');
		$data['menu_kiri'] = $this->load->view('backend_fp/menu_kiri',$role, true);
        $data['content']   = $this->load->view('frontend_fp/form_aplikasi', $isi, true);
        $this->load->view('/backend_fp/main', $data);
    }
    
    public function add_fitur()
    {
        
        $nama_fitur  = $this->input->post('nama_fitur');
        $id_aplikasi = $this->session->userdata('id_aplikasi');
        
        $datafitur = array(
            'NAMA_FITUR' => $nama_fitur,
            'ID_APLIKASI' => $id_aplikasi
        );
        $validasi  = strtolower(str_replace(' ', '', $nama_fitur));
        
        
        if (strlen($validasi) == 0) 
        {
            $this->session->set_flashdata('pesan_error', "Nama Fitur kosong");    
        } else {
            $exsist = false;
            
            // get current fitur name
            $hasil  = $this->fitur_model->get_fitur($id_aplikasi);
			if($hasil->num_rows !=0){
				 foreach ($hasil->result() as $row) {
                
                if (strtolower(str_replace(' ', '', $row->NAMA_FITUR)) == $nama_fitur) {
                    
                    $this->session->set_flashdata('pesan_error', "Nama fitur sudah ada");
                    $exsist = true;  
                }
            }
		}
               
            if ($exsist == false) {
                $this->fitur_model->insert_data_fitur($datafitur);
                $isi['kirim'] = $this->session->set_flashdata('pesan', "Nama fitur berhasil disimpan");   
            }
        }
        
        redirect('estimasi_fp/form_edit_aplikasi/' . $id_aplikasi);
    }
       
    public function delete_fitur($id_fitur)
    {
        $this->fitur_model->delete_fitur($id_fitur);
        $id_aplikasi = $this->session->userdata('id_aplikasi');
        $this->session->set_flashdata('pesan', "Fitur berhasil dihapus");
        $isi['kirim'] = $this->session->flashdata('pesan');
        redirect('estimasi_fp/form_edit_aplikasi/' . $id_aplikasi);
    }

    public function update_aplikasi()
    {
        $id_aplikasi    = $this->session->userdata('id_aplikasi');
        $nama_aplikasi  = $this->input->post('nama_aplikasi');
        $templete       = $this->input->post('templete');
        $tim_pengembang = $this->input->post('tim_pengembang');
        $biaya_real     = $this->input->post('biaya_real');
        $id_tim         = $this->input->post('id_tim');
        
        $valid = true;
        
        if ($nama_aplikasi == "") {
            $valid              = true;
            $isi['erraplikasi'] = "Nama Aplikasi belum dimasukan";
            
        }
		
        if ($tim_pengembang == "") 
        {
            $valid         = false;
            $isi['errtim'] = "Tim Pengembang belum  dimasukan";
        }
        
        if ($valid) {
            
            //update_anggota
            $this->aplikasi_model->delete_anggota_tim($id_tim);
           
            foreach ($tim_pengembang as $data) {
                $dataanggota = array(
                    
                    'ID_TIM' => $id_tim,
                    'ID_ANGGOTA' => $data
                );
                
                $this->aplikasi_model->insert_anggota_tim($dataanggota);
            }
            //update data aplikasi
            $dataaplikasi = array(
                'NAMA_APLIKASI' => $nama_aplikasi,
                'TEMPLATE' => $templete
            );
        
            $this->aplikasi_model->update_aplikasi($dataaplikasi, $id_aplikasi);
            
            $this->session->set_flashdata('pesan', "Deskripsi aplikasi berhasil diperbaharui");
            
            redirect('estimasi_fp/form_edit_aplikasi/' . $id_aplikasi . '');
        } else {
            
            $isi['errtim']        = "Tim Pengembang belum  dimasukan";
            $isi['id_aplikasi']   = $id_aplikasi;
            $isi['nama_aplikasi'] = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->NAMA_APLIKASI;
            $isi['id_tim']        = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->ID_TIM;
            $isi['edit']          = true;
            $isi['templete']      = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->TEMPLATE;
            $isi['anggota']       = $this->anggota_model->get_data_anggota();
            $isi['anggota_tim']   = $this->aplikasi_model->get_anggota_tim($id_aplikasi);
            $isi['id']            = $id_aplikasi;
            
            if ($this->session->flashdata('pesan') != "") {
                $isi['kirim'] = $this->session->flashdata('pesan');
            }
            
            $isi['step'] = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->STEP; 
            
            $user['nama']      = $this->session->userdata('nama');
		    $user['id_user']   = $this->session->userdata('id_user');
            $data['header']    = $this->load->view('backend_fp/header', $user, true);
            $role['role']      = $this->session->userdata('role');
		
		    $data['menu_kiri'] = $this->load->view('backend_fp/menu_kiri',$role, true);
            $data['content']   = $this->load->view('frontend_fp/form_aplikasi', $isi, true);
            $this->load->view('/backend_fp/main', $data);
        }
    }

    // TODO: CFP RCAF
    public function form_cfp()
    {
        $id_aplikasi = $this->session->userdata('id_aplikasi');
        $berisi = $this->log_cfp_model->get_data_log($id_aplikasi)->num_rows();
        if ($berisi !=0) {
            redirect('estimasi_fp/form_edit_cfp/'. $id_aplikasi);
        }

        $this->load->model('cfp_model');
        $isi['isi'] = $this->cfp_model->get_data();
        $isi['edit'] = false;
        $isi['step'] = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->STEP;
        $user['nama']      = $this->session->userdata('nama');
        $user['id_user']   = $this->session->userdata('id_user');
        $data['header']    = $this->load->view('backend_fp/header', $user, true);
        $role['role']      = $this->session->userdata('role');
        $data['menu_kiri'] = $this->load->view('backend_fp/menu_kiri',$role, true);
        $data['content']   = $this->load->view('frontend_fp/form_cfp', $isi, true);
        $this->load->view('/backend_fp/main', $data);
        
    }

    public function add_cfp()
    {
        //get session id aplikasi
        $id_aplikasi = $this->session->userdata('id_aplikasi');

        //Melakukan pembaharuan log jika sudah ada sebelumnya
        $this->log_cfp_model->delete($id_aplikasi);

        $jumlah = $this->log_cfp_model->count();
        $index = 1;
        $status["variable"] = "";
        $status["errpesan"] = "";
        $status["size"]     = $jumlah;
        $data[]             = "";
        $pesan[]            = "";
        $valid              = true;
        while ($index <= $jumlah) {

            $var1 = "idcfp" . $index . '';
            $var2 = "bobot" . $index . '';
            $var3 = "surveycfp". $index. '';
            $id_cfp = $this->input->post($var1);
            $bobot  = $this->input->post($var2);
            $survey = $this->input->post($var3);


            $data[$index] = "errkategori" . $index. "";

            $datacfp = array(
                'ID_APLIKASI' => $this->session->userdata('id_aplikasi'),
                'ID_P_CFP' => $id_cfp,
                'VALUE' => $survey
                );

            if ($survey == 0) {
                $pesan[$index] = "Nilai indikator CFP belum dimasukkan";
            }

            if (is_numeric($survey) == false) {
                $pesan[$index] = "Nilai indikator CFP yang dimasukkan harus angka";
            }

            if ($survey < 0) {
                $pesan[$index] = "Nilai indikator CFP harus bilangan bulat positif";
            }

            if (is_numeric($survey) && strpos($survey, ".") !== false) {
                $pesan[$index] = "Nilai indikator CFP harus blangan bulat positif";
            }

            else {
                $pesan[$index] = "";
                $this->log_cfp_model->insert_log_weight($datacfp);
            }
            $index++;
        }

        if ($valid) {
            $cfp = $this->log_cfp_model->sumLog($id_aplikasi)->row()->VALUE;

            $nilaicfp = $cfp;

            $status["hasil"] = $nilaicfp;

            //Melakukan update log transaksi dengan memasukkan nilai negatif CFP
            $id_aplikasi = $this->session->userdata('id_aplikasi');
            $step = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->STEP;

            if ($step < 3) {
                $step = 3;
            }

            $datacfp = array(
                'CFP' => $nilaicfp,
                'STEP' => $step
                );

            $this->aplikasi_model->update_aplikasi($datacfp, $id_aplikasi);
            $status["variable"]= $data;

            $status["STATUS"] = "Data sudah tersimpan";

            echo json_encode($status);
        }

        else {
            $status["variable"] = $data;
            $status["errpesan"] = $pesan;
            echo json_encode($status);
        }
    }

    public function form_edit_cfp($id_aplikasi)
    {
        $this->session->set_userdata('ubah_fp', true);

        $berisi = $this->log_cfp_model->get_data_log($id_aplikasi)->num_rows();

        if ($berisi == 0) {
            # code...
            redirect('estimasi_fp/form_cfp');
        }

        $cfp = $this->log_cfp_model->sumLog($id_aplikasi)->row()->VALUE;
        $isi['edit'] = true;
        $nilaicfp = $cfp;
        $isi['isi'] = $this->log_cfp_model->get_data_log($id_aplikasi);
        $isi['step'] = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->STEP;
        $isi['id_aplikasi'] = $id_aplikasi;
        $isi['nilai_cfp'] = $nilaicfp;
        $isi['edit'] = true;
        $user['nama']       = $this->session->userdata('nama');
        $data['header']     = $this->load->view('backend_fp/header', $user, true);
        $role['role']      = $this->session->userdata('role');
        $data['menu_kiri'] = $this->load->view('backend_fp/menu_kiri',$role, true);
        $data['content']    = $this->load->view('frontend_fp/form_cfp', $isi, true);
        $this->load->view('/backend_fp/main', $data);
    }

    public function form_rcaf()
    {
        $id_aplikasi = $this->session->userdata('id_aplikasi');
        $berisi      = $this->log_rcaf_model->get_data_log($id_aplikasi)->num_rows();
        if ($berisi != 0) 
        {
            redirect('estimasi_fp/edit_log_rcaf/' . $id_aplikasi);
        }
        
        $this->load->model('rcaf_model');
        $isi['isi']  = $this->rcaf_model->get_data();
        $isi['edit'] = false;
        $isi['step'] = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->STEP;
        $isi['template']    = $this->aplikasi_model->get_metode($id_aplikasi)->row()->TEMPLATE;
        $user['nama']      = $this->session->userdata('nama');
        $user['id_user']   = $this->session->userdata('id_user');
        $data['header']    = $this->load->view('backend_fp/header', $user, true);
        $role['role']      = $this->session->userdata('role');        $data['menu_kiri'] = $this->load->view('backend_fp/menu_kiri',$role, true);
        $data['content']   = $this->load->view('frontend_fp/form_rcaf', $isi, true);
        $this->load->view('/backend_fp/main', $data);
    }

    public function add_rcaf()
    {
        //get session id aplikasi
        $id_aplikasi = $this->session->userdata('id_aplikasi');

        //Melakukan pembaharuan log jika sudah ada sebelumnya
        $this->log_rcaf_model->delete($id_aplikasi);

        $jumlah = $this->log_rcaf_model->count()->row()->JUMLAH;
        $template = $this->aplikasi_model->get_metode($id_aplikasi)->row()->TEMPLATE;
        if($template==1){
            $jumlah--;
        }
        $index  = 1;
        $status["variable"] = "";
        $status["errpesan"] = "";
        $status["size"]     = $jumlah;
        $data[]             = "";
        $pesan[]            = "";
        $valid              = true;
        $n = 0;

        while ($index <= $jumlah) {
            # code...
            $var1    = 'idrcaf' . $index . '';
            $var2    = 'bobot' . $index . '';
            $var3    = 'surveyrcaf' . $index . '';
            $id_rcaf = $this->input->post($var1);
            $bobot   = $this->input->post($var2);
            $survey  = $this->input->post($var3);

            $data[$index] = "errkategori" . $index . "";

            $datarcaf =  array(
                'ID_APLIKASI' => $this->session->userdata('id_aplikasi'),
                'ID_P_RCAF' => $id_rcaf,
                'VALUE' => $survey
            );
                
            if ($survey == "") {

                $pesan[$index] = "Belum diisi";
                $valid         = false;
            }
            else {
                $pesan[$index] = "";
                $this->log_rcaf_model->insert_log_weight($datarcaf);
            }

            $index++;
        }

        if ($valid) {
            $rcaf = $this->log_rcaf_model->sumLog($id_aplikasi)->row()->VALUE;
            $nilaircaf = $rcaf;

            $status["hasil"] = $nilaircaf;

            $id_aplikasi = $this->session->userdata('id_aplikasi');
            $step = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->STEP;

        if ($step < 4) {
            # code...
            $step = 4;
        }

        $datarcaf = array(
            'RCAF' => $nilaircaf,
            'STEP' => $step
            );

        $this->aplikasi_model->update_aplikasi($datarcaf, $id_aplikasi);
        $status["variable"] = $data;

        $status["STATUS"] = "Data sudah tersimpan";

        echo json_encode($status);
        }

        else{
            $status["variable"] = $data;
            $status["errpesan"] = $pesan;
            echo json_encode($status);
        }
    }

    public function edit_log_rcaf($id_aplikasi)
    {
        $this->session->set_userdata('ubah_rcaf', true);

        //checking value if exist
        $berisi = $this->log_rcaf_model->get_data_log($id_aplikasi)->num_rows();

        if ($berisi == 0) {
            redirect('estimasi_fp/form_rcaf');
        }

        $rcaf = $this->log_rcaf_model->sumLog($id_aplikasi)->row()->VALUE;
        $isi['edit']        = true;
        $nilaircaf          = $rcaf;
        $isi['isi']         = $this->log_rcaf_model->get_data_log($id_aplikasi);
        $isi['step']        = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->STEP;
        $isi['id_aplikasi'] = $id_aplikasi;
        $isi['nilai_rcaf']  = $nilaircaf;
        $isi['edit']        = true;
        $isi['template']    = $this->aplikasi_model->get_metode($id_aplikasi)->row()->TEMPLATE;
        $user['nama']       = $this->session->userdata('nama');
        $data['header']     = $this->load->view('backend_fp/header', $user, true);
        $role['role']      = $this->session->userdata('role');
        $data['menu_kiri'] = $this->load->view('backend_fp/menu_kiri',$role, true);
        $data['content']    = $this->load->view('frontend_fp/form_rcaf', $isi, true);
        $this->load->view('/backend_fp/main', $data);
    }

    // END TODO;

    public function result()
    {
        // get data log application
        // get session id aplikasi
        $id_aplikasi   = $this->session->userdata('id_aplikasi');
        $get_data      = $this->aplikasi_model->get_nilai_fp($id_aplikasi);
        $cfp           = $get_data->row()->CFP;
        $rcaf          = $get_data->row()->RCAF;
		$template      = $get_data->row()->TEMPLATE;
		// $er            = $get_data->row()->ER;
		
        // mengecek status persetujuan estimasi
        $isi['status'] = $get_data->row()->STATUS;
        
        // inserting step
        $step = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->STEP;
	   
       if($step < 7) 
        {
		  $step = 7;
		}
		
            $step = array(
                'STEP' => $step
            );
            $this->aplikasi_model->update_aplikasi($step, $id_aplikasi);
        
        
        $nilai_fp = $cfp * (0.65 + 0.01 * $rcaf);
        
        // for show into view
        $isi['cfp']       = $cfp;
        $isi['rcaf']      = $rcaf;
        $isi['nilai_fp']  = $nilai_fp;
        
        $ubah_fp = $this->session->userdata('ubah_fp');
        
        $isi['id_aplikasi'] = $id_aplikasi;
        
        // nilai hour effort
        
        $effort_rate              = 8.2;
        $isi['effort_rate']       = $effort_rate;
        $effort_estimate          = $effort_rate*$nilai_fp;
        $isi['effort_estimate']   = $effort_estimate;
		
		// updating hour effort
		
		$hour_effort = array(
                'EFFORT_ESTIMATE' => $effort_estimate
            );
			
		 $this->aplikasi_model->update_aplikasi($hour_effort, $id_aplikasi);
		 
        // nilai estimasi usaha
        $distribusi_usaha         = $this->aktivitas_model->get_data_aktivitas($template);
        
        
        //error handling agar tidak error pada saat input biaya pertama kali
		 
		// melakukan pengecekan apakah sudah dilakukan pengubahan biaya atau belum
        $check_edit = $this->log_biaya_model->check_log_biaya_edit($id_aplikasi)->num_rows;
        $edit = false;
        if ($check_edit > 1) {
			// checking apakah kolom sudah di edit atau belum, jika sudah diedit,maka pakai table isi satunya
			$isi['edit'] = true;
			$edit = true;
        }
	 
        if ($edit==false) {
            //delete previous biaya if exist
            
            $this->log_biaya_model->delete_current_log_biaya($id_aplikasi);
            foreach ($distribusi_usaha->result() as $row) {
                $nilai_usaha_aktivitas = round(($row->PRESENTASE_USAHA / 100) * $effort_estimate, 2);
                $gaji_per_jam          = round($row->GAJI_PER_BULAN / 160, 2);
                $biaya_aktivitas       = round($nilai_usaha_aktivitas * $gaji_per_jam, 2);
                
                $databiaya = array(
                    'ID_APLIKASI' => $id_aplikasi,
                    'ID_AKTIVITAS' => $row->ID_AKTIVITAS,
                    'NILAI_USAHA' => $nilai_usaha_aktivitas,
                    'GAJI_PER_JAM' => $gaji_per_jam,
                    'BIAYA_AKTIVITAS' => $biaya_aktivitas
                );
                
                $this->log_biaya_model->insert_log_biaya($databiaya);
            }
        }
        
        $isi['distribusi_usaha'] = $distribusi_usaha;
        
        $get_log_biaya = $this->log_biaya_model->get_log_biaya($id_aplikasi);
        
        $subBiayaSD      = 0;
        $subPresentaseSD = 0;
        $subUsahaSD      = 0;
        
        $subBiayaOGA      = 0;
        $subPresentaseOGA = 0;
        $subUsahaOGA      = 0;
        
        $subBiayaQT      = 0;
        $subPresentaseQT = 0;
        $subUsahaQT      = 0;
        $total_biaya     = 0;
        
        
        foreach ($get_log_biaya->result() as $row) {
            
            //1 software development (SD), 2 OnGoingActivity, 3 Quality and testing
            if ($row->KATEGORI_AKTIVITAS == 1) 
            {
                $subPresentaseSD = $subPresentaseSD + $row->PRESENTASE_USAHA;
                $subBiayaSD      = $subBiayaSD + $row->BIAYA_AKTIVITAS;
                $subUsahaSD      = $subUsahaSD + $row->NILAI_USAHA;
            }
            
            if ($row->KATEGORI_AKTIVITAS == 2) 
            {
                $subPresentaseOGA = $subPresentaseOGA + $row->PRESENTASE_USAHA;
                $subUsahaOGA      = $subUsahaOGA + $row->NILAI_USAHA;
                $subBiayaOGA      = $subBiayaOGA + $row->BIAYA_AKTIVITAS;
            }
            
            if ($row->KATEGORI_AKTIVITAS == 3) 
            {
                $subPresentaseQT = $subPresentaseQT + $row->PRESENTASE_USAHA;
                $subUsahaQT      = $subUsahaQT + $row->NILAI_USAHA;
                $subBiayaQT      = $subBiayaQT + $row->BIAYA_AKTIVITAS;
            }
        }
        
        $total_biaya = $subBiayaSD + $subBiayaOGA + $subBiayaQT;
        
        $isi['get_log_biaya'] = $get_log_biaya;
        
        $isi['subPresentaseSD'] = $subPresentaseSD;
        $isi['subUsahaSD']      = $subUsahaSD;
        $isi['subBiayaSD']      = $subBiayaSD;
        
        $isi['subPresentaseOGA'] = $subPresentaseOGA;
        $isi['subUsahaOGA']      = $subUsahaOGA;
        $isi['subBiayaOGA']      = $subBiayaOGA;
        
        $isi['subPresentaseQT'] = $subPresentaseQT;
        $isi['subUsahaQT']      = $subUsahaQT;
        $isi['subBiayaQT']      = $subBiayaQT;
     
        $isi['step']        = $step;
        $isi['role']        = $this->session->userdata('role');
        $isi['total_biaya'] = $total_biaya;
        $isi['biaya_op']    = $this->log_biaya_model->get_biaya_op($id_aplikasi);
		$total_biaya_op = $this->log_biaya_model->get_sum_biaya_op($id_aplikasi)->row()->JUMLAH_TOTAL;
		
        if ($this->session->flashdata('pesan_biaya') != "") {
            $isi['pesan_biaya'] = $this->session->flashdata('pesan_biaya');
        }
        
        $user['nama']      = $this->session->userdata('nama');
		$user['id_user']   = $this->session->userdata('id_user');
        $data['header']    = $this->load->view('backend_fp/header', $user, true);
        $role['role']      = $this->session->userdata('role');
		// melakukan pembaharuan  biaya estimasi dalam log aplikasi
		
		// update aplikasi untuk nilai usaha dan nilai biaya
		$biaya_estimasi = array(
                'BIAYA_ESTIMASI' => ($total_biaya + $total_biaya_op)
            );
			
		 $this->aplikasi_model->update_aplikasi($biaya_estimasi, $id_aplikasi);
		 
		$isi['status'] = $this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->STATUS;
		$data['menu_kiri'] = $this->load->view('backend_fp/menu_kiri',$role, true);
        $data['content']   = $this->load->view('frontend_fp/hasil', $isi, true);
        $this->load->view('/backend_fp/main', $data);
    }
    
    public function update_biaya()
    {
        
        $index = 1;
        while ($index <= 11) {
            
            $nilai_biaya  = $this->input->post('biaya_aktivitas' . $index);
            $id_log_biaya = $this->input->post('id_log_biaya' . $index);
            
            $data_biaya = array(
                'BIAYA_AKTIVITAS' => $nilai_biaya,
				'GAJI_PER_JAM' => 0,
                'EDIT_BIAYA' => 1
            );
            $this->log_biaya_model->update_log_biaya($id_log_biaya, $data_biaya);
            
            $index++;
            
        }
        $this->session->set_flashdata('pesan_biaya', "Perubahan berhasil disimpan");
        redirect('estimasi_fp/result');
    }

    public function submit()
    {
        
        $id_aplikasi = $this->session->userdata('id_aplikasi');
        $step		=$this->aplikasi_model->edit_log_aplikasi($id_aplikasi)->row()->STEP;
        
        // update untuk field biaya estimasi
		$nilai           = $this->input->post('biaya_estimasi');
        $effort_estimate = $this->input->post('effort_estimate');
        
        $data = array(
            'BIAYA_ESTIMASI' => $nilai,
            'EFFORT_ESTIMATE' => $effort_estimate,
			'STATUS' => 1,
        );
		
        $this->aplikasi_model->update_aplikasi($data, $id_aplikasi);
        
        //get data for email
        $data_email = array(
            'subject' => "request validasi penawaran aplikasi",
			'email'	  =>$this->user_model->selectonrole(2)->row()->EMAIL,
            'pesan' => 'Tim anda melakukan estimasi harga. Silahkan klik pada url dibawah ini <br> 
			</br>
			
			<a href="' . base_url() . 'log_estimasi_fp/request_validasi/'.$id_aplikasi.'" >Lihat Detail Request  </a>
			  '
        );
        
        //sending email
        $mail       = new Mailler();
        $result = $mail->send_mail($data_email);
        $tambahan = "Anda akan diarahkan ke halaman log estimasi";
	    $gabung = $result.$tambahan;
        $status["STATUS"] = $gabung;
        echo json_encode($status);
    }
    
    public function popCFP() 
    {
        $data['header']    = "";
        $data['menu_kiri'] = "";
        $isi['pesan']      = $this->session->flashdata('pesan');
        $isi['isi']        = $this->cfp_model->get_data();
        $data['content']   = $this->load->view('frontend_fp/popup/daftar_cfp', $isi, true);
        $this->load->view('/backend_fp/main', $data);
    }

    public function popRCAF() 
    {
        $data['header']    = "";
        $data['menu_kiri'] = "";
        $isi['pesan']      = $this->session->flashdata('pesan');
        $isi['isi']        = $this->rcaf_model->get_data();
        $data['content']   = $this->load->view('frontend_fp/popup/daftar_rcaf', $isi, true);
        $this->load->view('/backend_fp/main', $data);
    }

    function tambah_op()
    {
        
        $diisi = true;
		$status["errdeskripsi"] = "";
		$status["errnilai"] = "";
        $deskripsi = $this->input->post('deskripsi');
		
        if($deskripsi == "")
        {
		$status["errdeskripsi"] = 'Belum diisi';
		$diisi = false;
	    }
		
        $nilai     = $this->input->post('nilai');
		
        if($nilai==0 || $nilai=="")
        {	
		$status["errnilai"] = 'Belum diisi';
		$diisi = false;	
		}

		if(is_numeric($nilai)==false && $nilai<0)
        {
		$status["errnilai"] = 'harus angka positif';
		$diisi=false;
		}
		
		if($diisi==true)
        {
			 $databop = array(
            'ID_APLIKASI' => $this->session->userdata('id_aplikasi'),
            'NILAI' => $nilai,
            'DESKRIPSI' => $deskripsi
        );
        $this->log_biaya_model->insert_biaya_op($databop);
        
        $status["STATUS"] = 'Data biaya berhasil disimpan';
		}
		
        else {
			$status["STATUS"] = 'Data biaya Gagal disimpan disimpan';
		}
        
        echo json_encode($status);
    }
    
    function edit_op($id_op)
    {
        $status["DESKRIPSI"] = $this->log_biaya_model->get_biaya_op($id_op)->ROW()->DESKRIPSI;
        $status["NILAI"]     = $this->log_biaya_model->get_biaya_op($id_op)->ROW()->NILAI;
        $status["ID_OP"]     = $id_op;
    }
    
    public function update_bop($index)
    {
        
        $deskripsi = $this->input->post('deskripsi' . $index . '');
        $nilai     = $this->input->post('nilai' . $index . '');
        $id_bop    = $this->input->post('id_op' . $index . '');
        
        $databop = array(
            'NILAI' => $nilai,
            'DESKRIPSI' => $deskripsi
        );
        $this->log_biaya_model->update_biaya_op($id_bop, $databop);
        
        $status["STATUS"] = 'Data berhasil diperbaharui';
        echo json_encode($status);
    }
    
    function delete_bop($id_bop)
    {
        $this->log_biaya_model->delete_biaya_op($id_bop);
        redirect('estimasi_fp/result');
        $this->session->set_flashdata('pesan', "Data berhasil dihapus");
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */