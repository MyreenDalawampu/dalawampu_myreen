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
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = (int) $this->io->get('page');
        }

        $q = '';
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 5;

        // Assuming your model has a similar pagination method like UserModel->page()
        $all = $this->StudentsModel->page($q, $records_per_page, $page);
        $data['students'] = $all['records'];
        $total_rows = $all['total_rows'];

        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap');
        $this->pagination->initialize(
            $total_rows,
            $records_per_page,
            $page,
            site_url('students/index') . '?q=' . urlencode($q)
        );
        $data['page'] = $this->pagination->paginate();

        $this->call->view('students/index', $data);
    }

    public function create()
    {
        if ($this->io->method() === 'post') {
            $first_name = $this->io->post('first_name');
            $last_name = $this->io->post('last_name');
            $email = $this->io->post('email');

            $data = [
                'first_name' => $first_name,
                'last_name'  => $last_name,
                'email'      => $email
            ];

            try {
                $this->StudentsModel->insert($data);
                redirect();
            } catch (Exception $e) {
                echo 'Something went wrong while creating student: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            $this->call->view('students/create');
        }
    }

    public function update($id)
    {
        $student = $this->StudentsModel->find($id);
        if (!$student) {
            echo 'Student not found.';
            return;
        }

        if ($this->io->method() === 'post') {
            $first_name = $this->io->post('first_name');
            $last_name = $this->io->post('last_name');
            $email = $this->io->post('email');

            $data = [
                'first_name' => $first_name,
                'last_name'  => $last_name,
                'email'      => $email
            ];

            try {
                $this->StudentsModel->update($id, $data);
                redirect();
            } catch (Exception $e) {
                echo 'Something went wrong while updating student: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            $data['student'] = $student;
            $this->call->view('students/update', $data);
        }
    }

    function delete($id){
        if($this->StudentsModel->delete($id)){
        redirect(uri: site_url());
    }else{
        echo 'Error deleting student.';
    }
    }
}
?>


