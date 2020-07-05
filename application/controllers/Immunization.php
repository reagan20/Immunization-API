<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Immunization extends CI_Controller
{
    public function index()
    {
        $this->load->view('header');
        $this->load->view('immunization');
        $this->load->view('footer');
    }
    public function add()
    {
        if (isset($_POST['submit_btn'])) {
            $data = array(
                'child_id' => $this->input->post('child_id'),
                'vaccine_id' => $this->input->post('vaccine_id'),
                'hospital_id' => $this->input->post('hospital_id'),
                'dated' => $this->input->post('date'),
            );
            $qry = $this->db->insert('tbl_immunization', $data);
            if ($qry) {
                $this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Immunization successfully created.</strong><button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                redirect('immunization');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>SORRY!! An error occurred while posting data. Please try again later.</strong><button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                redirect('immunization');
            }
        }
    }
    public function update()
    {
        if (isset($_POST['submit_btn'])) {
            $data = array(
                'child_id' => $this->input->post('child_id'),
                'vaccine_id' => $this->input->post('vaccine_id'),
                'hospital_id' => $this->input->post('hospital_id'),
                'dated' => $this->input->post('date'),
            );
            $qry = $this->db->where('id', $this->input->post('id'))->update('tbl_immunization', $data);
            if ($qry) {
                $this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Data successfully updated.</strong><button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                redirect('immunization');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>SORRY!! An error occurred while posting data. Please try again later.</strong><button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                redirect('immunization');
            }
        }
    }
}
