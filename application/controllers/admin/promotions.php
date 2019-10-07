<?php
class promotions extends MY_Controller
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
        $this->load->model('promotions_model');
        $this->bk_menu = 7;
        $this->bk_title = "promotions";
    }

    public function index()
    {
        $delete_id = $this->input->get('delete', true);
        $edit_id = $this->input->get('edit', true);

        if ($delete_id) {
            $sql = $this->db->query("DELETE FROM promotions WHERE id=$delete_id");

            $this->session->set_flashdata('msg_ok_del', 'successfully deleted');
            return redirect(base_url() . 'admin/promotions');
        }

        if ($edit_id) {
            $sql_ = $this->db->query("SELECT * FROM promotions WHERE id=$edit_id");

            $this->load->model('deals_model');
            $data['deals'] = $this->deals_model->get();

            $this->load->model('food_model');
            $data['foods'] = $this->food_model->get();

            $data['promotion'] = $sql_->result();

            $this->template->write_view('content', 'backends/promotions/edit', $data);
            return $this->template->render();
        }

        $this->load->model('deals_model');
        $data['deals'] = $this->deals_model->get();

        $this->load->model('food_model');
        $data['foods'] = $this->food_model->get();

        $sql = $this->db->query("SELECT promotions.*, foods.name AS foods, deals.name AS deals FROM promotions LEFT JOIN foods ON promotions.food_id=foods.id LEFT JOIN deals ON promotions.deal_id=deals.id ORDER BY id DESC");
        $data['promotions'] = $sql->result();

        $this->template->write_view('content', 'backends/promotions/index', $data);
        $this->template->render();
    }

    public function edit_promotion()
    {
        $id = $_POST['promotion_id'];

        $data['name'] = $_POST['name'];
        $data['description'] = $_POST['description'];
        $data['type'] = $_POST['type'];
        $data['food_id'] = $_POST['food_id'];
        $data['deal_id'] = $_POST['deal_id'];
        $data['time_s'] = $_POST['s_time'];
        $data['time_e'] = $_POST['e_time'];
        $data['days'] = $_POST['sunday'] . ',' . $_POST['monday'] . ',' . $_POST['tuesday'] . ',' . $_POST['wednesday'] . ',' . $_POST['thursday'] . ',' . $_POST['friday'] . ',' . $_POST['saturday'];

        $this->promotions_model->update($data, array('id' => $id));

        $this->session->set_flashdata('msg_ok_update', 'updated successfully');
        return redirect(base_url() . 'admin/promotions');
    }

    public function add_promotion()
    {
        $data['name'] = $_POST['name'];
        $data['description'] = $_POST['description'];
        $data['type'] = $_POST['type'];
        $data['food_id'] = $_POST['food_id'];
        $data['deal_id'] = $_POST['deal_id'];
        $data['time_s'] = $_POST['s_time'];
        $data['time_e'] = $_POST['e_time'];
        $data['days'] = $_POST['sunday'] . ',' . $_POST['monday'] . ',' . $_POST['tuesday'] . ',' . $_POST['wednesday'] . ',' . $_POST['thursday'] . ',' . $_POST['friday'] . ',' . $_POST['saturday'];

        $insert_id = $this->promotions_model->insert($data);

        if ($insert_id) {
            $this->session->set_flashdata('msg_ok', 'Add successfully');
            return redirect(base_url() . 'admin/promotions');
        } else {
            $this->session->set_flashdata('msg_error', 'Error in adding promotion');
            return redirect(base_url() . 'admin/promotions');
        }
    }
}
