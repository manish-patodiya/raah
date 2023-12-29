<?php
namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminController;
use Ifsnop\Mysqldump as IMysqldump;

class Backup extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        check_access('backup');
        $this->BackupModel = model('BackupModel');
    }

    public function index()
    {
        $data = [
            'session' => $this->session,
        ];
        return view('admin/backup', $data);
    }

    public function get_history()
    {
        check_method_access('backup', 'view');
        $backup_history = $this->BackupModel->getAll();
        $data = [];
        foreach ($backup_history as $k => $v) {
            $action = '';
            if (check_method_access('backup', 'download', true)) {
                $action .= '<a title="Download" download="' . $v->filename . '" class="text-warning me-1" href="' . $v->path . '" style="font-size: 1.2rem;"> <i class="fa-solid fa-download"></i></a>';
            }
            if (check_method_access('backup', 'delete', true)) {
                $action .= '<a title="Delete" class="text-danger sup_delete me-1"  bckp_id="' . $v->id . '" href="#" title="Delete" style="font-size: 1.2rem;" > <i class="fa fa-trash-o"></i></a>';
            }
            $data[] = [
                date('d/m/Y H:i:s', strtotime($v->created_at)),
                $v->filename,
                $action,
            ];
        }
        echo json_encode([
            "status" => 1,
            "data" => $data,
        ]);
    }

    public function backup()
    {
        $db = db_connect();
        $hostname = $db->hostname;
        $username = $db->username;
        $password = $db->password;
        $database = $db->database;
        $filename = 'dbbackup' . time() . '-' . date('d-m-Y') . '.sql';
        $dir = 'public/database/backup/' . $filename;
        $custom = [
            // 'add-drop-database' => true,
            // 'databases' => true,
        ];

        $data = [
            'filename' => $filename,
            'path' => base_url($dir),
        ];
        $this->BackupModel->insertRow($data);

        try {
            $dump = new IMysqldump\Mysqldump("mysql:host=$hostname;dbname=$database", "$username", "$password", $custom);
            $dump->start("$dir");
            json_response(1, "Backup successfull", ['filename' => $filename, 'url' => base_url($dir)]);
        } catch (\Exception $e) {
            json_response(0, 'Something Went Wrong', ["error" => $e->getMessage()]);
        }
    }

    public function delete()
    {
        $bid = $this->request->getPost('bid');
        $res = $this->BackupModel->deleteRow($bid);
        if ($res) {
            json_response(1, 'Deleted');
        } else {
            json_response(0, 'Something went wrong');
        }
    }

    public function importFile()
    {
        $check = $this->validate([
            'sql' => 'uploaded[sql]|ext_in[sql,sql]',
        ], [
            'sql' => [
                'uploaded' => 'SQL file is required',
                'ext_in' => 'File\'s extenstion should be .sql',
            ],
        ]);
        if ($check) {
            if ($this->request->isAJAX()) {
                $file = $this->request->getFile('sql');
                $file_path = '';
                if ($file->isValid() && !$file->hasMoved()) {
                    $upload_path = 'public/database/import/';
                    $file_name = $file->getRandomName();
                    $moved = $file->move($upload_path, $file_name);
                    if ($moved) {
                        $file_path = base_url($upload_path . $file_name);
                    }
                }
                $db = db_connect();
                $tables = $this->db->listTables();
                foreach ($tables as $table) {
                    $this->db->truncate($table);
                }
            } else {
                die('Invalid Request');
            }
        } else {
            echo json_encode([
                "status" => 0,
                "msg" => 'Form not validate',
                'errors' => $this->validation->getErrors(),
            ]);
        }
    }
}