<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentsController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('StudentsModel');
        $this->call->library('pagination');
    }

    public function index()
    {
        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = (int) $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        // bawat page 5 records lang
        $records_per_page = 5;

        // kuha data gamit model
        $all = $this->StudentsModel->page($q, $records_per_page, $page);
        $data['all'] = $all['records'];
        $total_rows = $all['total_rows'];

        // setup pagination
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); 
        $this->pagination->initialize($total_rows, $records_per_page, $page, site_url('students/index').'?q='.$q);
        $data['page'] = $this->pagination->paginate();

        // tawagin view
        $this->call->view('students/index', $data);
    }

    public function create()
    {
        if ($this->io->method() == 'post') {
            $firstname = $this->io->post('first_name');
            $lastname  = $this->io->post('last_name');
            $email     = $this->io->post('email');

            $data = [
                'first_name' => $firstname,
                'last_name'  => $lastname,
                'email'      => $email
            ];

            if ($this->StudentsModel->insert($data)) {
                redirect(site_url('students/index'));
            } else {
                echo 'Error creating student.';
            }
        } else {
            $this->call->view('students/create');
        }
    }

    public function update($id)
    {
        $students = $this->StudentsModel->find($id);
        if(!$students) {
            echo "Student not found.";
            return;
        }

        if ($this->io->method() == 'post') {
            $firstname = $this->io->post('first_name');
            $lastname  = $this->io->post('last_name');
            $email     = $this->io->post('email');

            $data = [
                'first_name' => $firstname,
                'last_name'  => $lastname,
                'email'      => $email
            ];

            if ($this->StudentsModel->update($id, $data)) {
                redirect(site_url('students/index'));
            } else {
                echo 'Error updating student.';
            }
        } else {
            $data['student'] = $students;
            $this->call->view('students/update', $data);
        }
    }

    public function delete($id)
    {
        if($this->StudentsModel->delete($id)) {
            redirect(site_url('students/index'));
        } else {
            echo 'Error deleting student.';
        }
    }
}
?>
