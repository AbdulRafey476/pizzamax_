<?php
class banner extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user'])) {
            redirect('admin/dashboard');
        } else {
            $user = $_SESSION['user'][0];
            if ($user->perm == USER) {
                redirect('admin/denied');
            }
        }
        $this->load->model('banner_model');
        $this->bk_menu = 7;
        $this->bk_title = "banner";
    }

    public function index()
    {
        $delete_id = $this->input->get('delete', true);
        $edit_id = $this->input->get('edit', true);

        if ($delete_id) {
            $sql = $this->db->query("DELETE FROM banners WHERE id=$delete_id");

            $this->session->set_flashdata('msg_ok_del', 'successfully deleted');
            return redirect(base_url() . 'admin/banner');
        }

        if ($edit_id) {
            $sql_ = $this->db->query("SELECT * FROM banners WHERE id=$edit_id");

            $data['banner'] = $sql_->result();

            $this->template->write_view('content', 'backends/banner/edit', $data);
            return $this->template->render();
        }

        $sql = $this->db->query("SELECT * FROM banners ORDER BY id DESC");
        $data['banners'] = $sql->result();

        $this->template->write_view('content', 'backends/banner/index', $data);
        $this->template->render();
    }

    public function edit_banner()
    {
        $data['type'] = $_POST['type'];
        $id = $_POST['banner_id'];

        $dir = create_sub_dir_upload('uploads/banner/');
        $filename = $_FILES['image']['name'];

        if ($filename) {
            $_FILES['image']['name'] = rename_upload_file($filename);
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|GIF|PNG';
            $config['max_size'] = '5000';
            $config['upload_path'] = $dir;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data['path'] = base_url() . $dir . '/' . $_FILES['image']['name'];
                $this->banner_model->update($data, array('id' => $id));

                $this->session->set_flashdata('msg_ok_update', 'updated successfully');
                return redirect(base_url() . 'admin/banner');

            } else {
                $this->session->set_flashdata('updated_msg_error', $this->upload->display_errors());
                return redirect(base_url() . 'admin/banner?edit=' . $id);
            }
        } else {
            $this->banner_model->update($data, array('id' => $id));
            $this->session->set_flashdata('msg_ok_update', 'updated successfully');
            return redirect(base_url() . 'admin/banner');
        }
    }

    public function add_banner()
    {
        $data['type'] = $_POST['type'];

        $dir = create_sub_dir_upload('uploads/banner/');
        $filename = $_FILES['image']['name'];
        $_FILES['image']['name'] = rename_upload_file($filename);
        $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|GIF|PNG';
        $config['max_size'] = '200000000';
        $config['upload_path'] = $dir;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $data['path'] = base_url() . $dir . '/' . $_FILES['image']['name'];
            $insert_id = $this->banner_model->insert($data);
            // echo "yes";
            if ($insert_id) {
                $this->session->set_flashdata('msg_ok', $this->lang->line('add_successfully'));
                return redirect(base_url() . 'admin/banner');
            } else {
                $this->session->set_flashdata('msg_error', $this->upload->display_errors());
                return redirect(base_url() . 'admin/banner');
            }
        } else {
            // echo "false";
            $this->session->set_flashdata('msg_error', $this->upload->display_errors());
            return redirect(base_url() . 'admin/banner');
        }
    }
}
