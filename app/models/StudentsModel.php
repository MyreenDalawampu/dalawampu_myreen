<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentsModel extends Model {

    protected $table = 'students';
    protected $primary_key = 'id';
    protected $allowed_fields = ['first_name', 'last_name', 'email'];
    
    protected $validation_rules = [
        'first_name' => 'required|min_length[2]|max_length[100]',
        'last_name'  => 'required|min_length[2]|max_length[100]',
        'email'      => 'required|valid_email|max_length[255]'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Paginate students with optional search query.
     * 
     * @param string $q Search query string (optional)
     * @param int|null $records_per_page Number of records per page (optional)
     * @param int|null $page Current page number (optional)
     * @return array ['total_rows' => int, 'records' => array]
     */
    public function page($q = '', $records_per_page = null, $page = null)
    {
        if (is_null($page)) {
            return [
                'total_rows' => $this->db->table($this->table)->count_all(),
                'records' => $this->db->table($this->table)->get_all()
            ];
        } else {
            $query = $this->db->table($this->table);

            if (!empty($q)) {
                // Search in first_name, last_name or email
                $query->like('first_name', '%'.$q.'%')
                      ->or_like('last_name', '%'.$q.'%')
                      ->or_like('email', '%'.$q.'%');
            }

            // Clone the query to count total rows without limit/offset
            $countQuery = clone $query;
            $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];

            // Fetch paginated records
            $data['records'] = $query->pagination($records_per_page, $page)->get_all();

            return $data;
        }
    }
}
?>
