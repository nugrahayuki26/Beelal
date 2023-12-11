<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Menu_model');
	}

	public function index()
	{
		$this->form_validation->set_rules('name', 'Name Of New Menu', 'trim|required');
		$name = htmlspecialchars($this->input->post('name'));
		$name = trim($name, ' ');
		$menu = $this->db->get_where('user_menu', ['menu' => $name])->row_array();
		$data['menu'] = $this->db->get_where('user_menu')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title_page'] = "Menu Management";
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/sitemain/header', $data);
			$this->load->view('templates/sitemain/sidebar', $data);
			$this->load->view('templates/sitemain/topbar', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('templates/sitemain/footer');
		}else{
			// cek apakah menu sudah ada atau tidak
			if (is_null($menu)) {
				$this->db->insert('user_menu', ['menu' => $name]);
				$this->Flasher_model->flashdata('New menu added', 'Succes', 'success');
				redirect('menu');
			}else{
				$this->Flasher_model->flashdata('Name menu already exist', 'Failed', 'danger');
				redirect('menu');
			}
		}
	}

	public function delete($id = -1)
	{
		// id diperiksa apakah data ada atau tidak
		if (is_null($this->db->get_where('user_menu', ['id' => $id])->row_array())) {
			$this->Flasher_model->flashdata('Menu not exist','Failed','danger');
			redirect('menu');
		}else{
			$this->db->where('id', $id);
			$this->db->delete('user_menu');
			$this->Flasher_model->flashdata('Menu deleted','Succes','warning');
			redirect('menu');
		}
	}

	public function detail()
	{
		echo json_encode($this->db->get_where('user_menu', ['id' => $this->input->post('id')])->row_array());
	}

	public function edit()
	{
		// cek apakah ada data yang dikirimkan atau tidak
		if (is_null($this->input->post('id'))) {
			redirect('menu');
		}
		$id = htmlspecialchars($this->input->post('id'));
		$name = htmlspecialchars($this->input->post('name'));
		$menu = $this->db->get_where('user_menu', ['menu' => $name])->row_array();
		// di cek apakah nama sudah digunakan atau belum
		if (is_null($menu)) {
			$this->db->set('menu', $name);
			$this->db->where('id', $id);
			$this->db->update('user_menu');
			$this->Flasher_model->flashdata('Menu Renamed','Succes','success');
			redirect('menu');
		}else{
			$this->Flasher_model->flashdata('Name already exist','Failed','danger');
			redirect('menu');
		}
	}

	public function subMenu()
	{
		$this->form_validation->set_rules('title', 'Title sub menu ', 'required');
		$this->form_validation->set_rules('menu', 'Sub Main menu ', 'required');
		$this->form_validation->set_rules('url', 'Url sub menu ', 'required');
		$this->form_validation->set_rules('icon', 'Icon sub menu ', 'required');
		$title = $this->input->post('title');
		$is_active = $this->input->post('is_active');
		if (is_null($is_active)) {
			$is_active = 0;
		}
		$query = [
			'menu_id' => $this->input->post('menu'),
			'title' => $this->input->post('title'),
			'url' => $this->input->post('url'),
			'icon' => $this->input->post('icon'),
			'is_active' => $is_active
		];

		$menu = $this->db->get_where('user_sub_menu', ['title' => $this->input->post('title')])->row_array();
		$data['subMenu'] = $this->Menu_model->getSubMenu();
		$data['menu'] = $this->db->get_where('user_menu')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title_page'] = "Submenu Management";

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/sitemain/header', $data);
			$this->load->view('templates/sitemain/sidebar', $data);
			$this->load->view('templates/sitemain/topbar', $data);
			$this->load->view('menu/submenu', $data);
			$this->load->view('templates/sitemain/footer');
		}else{

			// cek apakah menu sudah ada atau tidak
			if (is_null($menu)) {
				$this->db->insert('user_sub_menu', $query);
				$this->Flasher_model->flashdata('New sub menu added ','Succes','success');
				redirect('menu/submenu');
			}else{
				$this->Flasher_model->flashdata('Name already exist','Failed','danger');
				redirect('menu/submenu');
			}
		}
	}

	public function subMenuDelete($id = -1)
	{
		// id diperiksa apakah data ada atau tidak
		if (is_null($this->db->get_where('user_sub_menu', ['id' => $id])->row_array())) {
			$this->db->where('id', $id);
			$this->db->delete('user_sub_menu');
			$this->Flasher_model->flashdata('Menu not exist','Failed','danger');
			redirect('menu/submenu');
		}else{
			$this->db->where('id', $id);
			$this->db->delete('user_sub_menu');
			$this->Flasher_model->flashdata('Menu deleted','Succes','warning');
			redirect('menu/submenu');
		}
	}

	public function subMenuEdit()
	{
		// cek apakah ada data yang dikirimkan atau tidak
		if (is_null($this->input->post('id'))) {
			redirect('menu/submenu');
		}
		$id = $this->input->post('id');

		$is_active = $this->input->post('is_active');
		if (is_null($is_active)) {
			$is_active = 0;
		}
		$query = [
			'menu_id' => $this->input->post('menu'),
			'title' => $this->input->post('title'),
			'url' => $this->input->post('url'),
			'icon' => $this->input->post('icon'),
			'is_active' => $is_active
		];
		$this->db->set($query);
		$this->db->where('id', $id);
		$this->db->update('user_sub_menu');
		$this->Flasher_model->flashdata('Sub Menu edited','Succes','success');
		redirect('menu/submenu');
	}

	public function subMenuDetail()
	{
		echo json_encode($this->db->get_where('user_sub_menu', ['id' => $this->input->post('id')])->row_array());
		// 
		// 
	}

	public function usermanagement()
	{
        $data['menu'] = $this->db->get_where('user')->result_array();
		$data['role'] = $this->db->get_where('user_role')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title_page'] = "User Management";
		
		$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[user.email]');
		
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/sitemain/header', $data);
			$this->load->view('templates/sitemain/sidebar');
			$this->load->view('templates/sitemain/topbar');
			$this->load->view('menu/usermanagement');
			$this->load->view('templates/sitemain/footer');
		} else {
		    $email  = $this->input->post('email');
		    
		    $is_active1 = $this->input->post('is_active');
    		if (is_null($is_active1)) {
    			$is_active1 = 0;
    		}
    		
    		$config['upload_path']          = './assets/img/profile/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['max_size']             = '2000';
    		$config['encrypt_name']         = TRUE;
    		
    		$this->load->library('upload', $config);
    
            $this->upload->do_upload('image');
            $image = $this->upload->data('file_name');
            
            $query = [
    			'name' 			=> htmlspecialchars($this->input->post('name', true)),
    			'email' 		=> $email,
        	    'password' 		=> password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
        	    'image' 		=> $image,
        	    'role_id'       => $this->input->post('role_id'),
        	    'date_create'   => time(),
    			'is_active'     => $is_active1
    		];
    		
		    $this->db->insert('user', $query);
			$this->Flasher_model->flashdata('Data User telah ditambahkan', 'Succes', 'success');
			redirect('menu/usermanagement');
		}
	}
	
	public function userdelete($id = -1)
	{
		// id diperiksa apakah data ada atau tidak
		if (is_null($this->db->get_where('user', ['id' => $id])->row_array())) {
			$this->Flasher_model->flashdata('Data tidak bisa dihapus','Failed','danger');
			redirect('menu/usermanagement');
		}else{
			$this->db->where('id', $id);
			$this->db->delete('user');
			$this->Flasher_model->flashdata('Data dihapus','Succes','warning');
			redirect('menu/usermanagement');
		}
	}

	public function userdetail()
	{
		echo json_encode($this->db->get_where('user', ['id' => $this->input->post('id')])->row_array());
	}

	public function useredit()
	{
	    $id = $this->input->post('id');
	    $email  = $this->input->post('email');
	    $data['user'] = $this->db->get_where('user', ['id' => $id])->row_array();
		// cek apakah ada data yang dikirimkan atau tidak
		
		
		
		if (is_null($this->input->post('id'))) {
			redirect('menu/submenu');
		}

        if ($this->input->post('password')) {
			$this->db->set('password', password_hash($this->input->post('password', true), PASSWORD_DEFAULT));
		}
		
		$is_active1 = $this->input->post('is_active');
		if (is_null($is_active1)) {
			$is_active1 = 0;
		}
		
		$file_upload = $_FILES['image'];
		if ($file_upload['name'] != '') {
			$config['upload_path'] = './assets/img/profile/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '2000';
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('image')) {
				$old_image = $data['user']['image'];
				if ($old_image != 'default.png') {
					unlink(FCPATH . 'assets/img/profile/' . $old_image);
				}
				$new_image = $this->upload->data('file_name');
				$this->db->set('image', $new_image);
			} else {
				$this->Flasher_model->flashdata($this->upload->display_errors(), 'Failed', 'danger');
				redirect('user/edit');
			}
		}
		
		$query = [
    			'name' 			=> htmlspecialchars($this->input->post('name', true)),
    			'email' 		=> $email,
        	    'role_id'       => $this->input->post('role_id'),
        	    'date_create'   => time(),
    			'is_active'     => $is_active1
    		];
		$this->db->set($query);
		$this->db->where('id', $id);
		$this->db->update('user');
		$this->Flasher_model->flashdata('Data telah diubah','Succes','success');
		redirect('menu/usermanagement');
	}
}
