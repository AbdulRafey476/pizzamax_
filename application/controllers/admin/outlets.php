<?php
class outlets extends MY_Controller
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
        $this->load->model('outlets_model');
        $this->bk_menu = 7;
        $this->bk_title = "outlets";
    }

    public function index()
    {
        $delete_id = $this->input->get('delete', true);
        $edit_id = $this->input->get('edit', true);

        if ($delete_id) {
            $sql = $this->db->query("DELETE FROM outlets WHERE id=$delete_id");

            $this->session->set_flashdata('msg_ok_del', 'successfully deleted');
            return redirect(base_url() . 'admin/outlets');
        }

        if ($edit_id) {
            $sql_ = $this->db->query("SELECT * FROM outlets WHERE id=$edit_id");

            $data['outlet'] = $sql_->result();

            $this->template->write_view('content', 'backends/outlets/edit', $data);
            return $this->template->render();
        }

        $sql = $this->db->query("SELECT * FROM outlets ORDER BY id DESC");
        $data['outlets'] = $sql->result();

        $this->template->write_view('content', 'backends/outlets/index', $data);
        $this->template->render();
    }

    public function edit_outlet()
    {
        $id = $_POST['outlet_id'];

        $data['title'] = $_POST['title'];
        $data['address'] = $_POST['address'];
        $data['city'] = $_POST['city'];
        $data['contact'] = $_POST['contact'];
        $data['lat'] = $_POST['lat'];
        $data['lon'] = $_POST['lon'];

        $this->outlets_model->update($data, array('id' => $id));

        $this->session->set_flashdata('msg_ok_update', 'updated successfully');
        return redirect(base_url() . 'admin/outlets');
    }

    public function add_outlets()
    {
        $data['title'] = $_POST['title'];
        $data['address'] = $_POST['address'];
        $data['city'] = $_POST['city'];
        $data['contact'] = $_POST['contact'];
        $data['lat'] = $_POST['lat'];
        $data['lon'] = $_POST['lon'];

        $insert_id = $this->outlets_model->insert($data);

        if ($insert_id) {
            $this->session->set_flashdata('msg_ok', 'Add successfully');
            return redirect(base_url() . 'admin/outlets');
        } else {
            $this->session->set_flashdata('msg_error', 'Error in adding outlet');
            return redirect(base_url() . 'admin/outlets');
        }
    }
}
