<?php
namespace App\Controllers\Admin\Notifications;

use App\Controllers\Admin\AdminController;

class NotificationTemplate extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->NotificationModel = model('NotificationModel');
    }

    public function index()
    {
        $data = [
            'session' => $this->session,
        ];
        return view('admin/notifications/templates/temp_list', $data);
    }

    public function data_list()
    {
        $data = $this->NotificationModel->getAllTemplates();
        $list = [];
        $i = 0;
        foreach ($data as $k => $template) {
            $action = '';
            $url = base_url("admin/notifications/notificationtemplate/edit/$template->id");
            // '<a title="Edit" style="font-size: 1.2rem;" class="text-warning sup_update me-1" href="' . base_url("/admin/product/brands/edit/" . $v->id) . '" brand_id="' . $v->id . '" > <i class="fa fa-pencil-square-o"></i></a>';
            $action .= "<a href='$url' class='text-warning me-1 fs-5'><i class='fa fa-pencil-square-o'></i></a>";

            $action .= "<a href='#' class='text-danger me-1 fs-5 sup_delete' temp_id='$template->id'><i class='fa fa-trash-o'></i></a>";

            $list[] = [
                ++$i,
                $template->title,
                '<p>' . ($template->type == 2 ? $template->subject : $template->content) . '</p>',
                $action,
            ];
        }
        echo json_encode([
            'list' => $list,
        ]);
    }

    public function add()
    {
        if ($this->request->getPost('submit')) {
            if ($this->request->isAJAX()) {
                $postdata = $this->request->getPost();
                $valid_arr = [
                    "title" => 'required|min_length[4]',
                    "type" => 'required',
                ];
                if ($postdata['type'] == 2) {
                    $valid_arr['editor_content'] = 'required|min_length[30]';
                    $valid_arr['subject'] = 'required|min_length[4]';
                } else {
                    $valid_arr['text_content'] = 'required|min_length[20]';
                }
                $check = $this->validate($valid_arr, [
                    'editor_content' => [
                        'required' => 'The content field is required',
                        'min_length' => 'The content field must be at least 20 characters in length.',
                    ],
                    'text_content' => [
                        'required' => 'The content field is required',
                        'min_length' => 'The content field must be at least 20 characters in length.',
                    ],
                ]);
                if ($check) {
                    $data = [
                        'title' => format_name($postdata['title']),
                        'subject' => ucfirst($postdata['subject']),
                        'type' => $postdata['type'],
                    ];
                    if ($postdata['type'] == 2) {
                        $data['content'] = $postdata['editor_content'];
                    } else {
                        $data['content'] = ucfirst($postdata['text_content']);
                    }
                    $res = $this->NotificationModel->insertTemplate($data);
                    if ($res) {
                        json_response(1, "Succesfully inserted");
                    } else {
                        json_response(0, "Something went wrong");
                    }
                } else {
                    echo json_encode([
                        'status' => 0,
                        'msg' => 'Form is not validate',
                        'errors' => $this->validation->getErrors(),
                    ]);
                }
            } else {
                error404();
            }
        } else {
            $data = [
                'session' => $this->session,
            ];
            return view('admin/notifications/templates/add', $data);
        }
    }

    public function edit($id = 0)
    {
        if (!$id) {
            if ($this->request->isAJAX()) {
                $postdata = $this->request->getPost();
                $valid_arr = [
                    "title" => 'required|min_length[4]',
                    "type" => 'required',
                ];
                if ($postdata['type'] == 2) {
                    $valid_arr['editor_content'] = 'required|min_length[30]';
                    $valid_arr['subject'] = 'required|min_length[4]';
                } else {
                    $valid_arr['text_content'] = 'required|min_length[20]';
                }
                $check = $this->validate($valid_arr, [
                    'editor_content' => [
                        'required' => 'The content field is required',
                        'min_length' => 'The content field must be at least 20 characters in length.',
                    ],
                    'text_content' => [
                        'required' => 'The content field is required',
                        'min_length' => 'The content field must be at least 20 characters in length.',
                    ],
                ]);
                if ($check) {
                    $id = $postdata['id'];
                    $data = [
                        'title' => format_name($postdata['title']),
                        'subject' => ucfirst($postdata['subject']),
                        'type' => $postdata['type'],
                    ];
                    if ($postdata['type'] == 2) {
                        $data['content'] = $postdata['editor_content'];
                    } else {
                        $data['content'] = ucfirst($postdata['text_content']);
                    }
                    $res = $this->NotificationModel->updateTemplate($data, $id);
                    if ($res) {
                        json_response(1, "Succesfully inserted");
                    } else {
                        json_response(0, "Something went wrong");
                    }
                } else {
                    echo json_encode([
                        'status' => 0,
                        'msg' => 'Form is not validate',
                        'errors' => $this->validation->getErrors(),
                    ]);
                }
            } else {
                error404();
            }
        } else {
            $data = [
                'session' => $this->session,
                'temp_data' => $this->NotificationModel->getTemplate($id),
            ];
            return view('admin/notifications/templates/edit', $data);
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('temp_id');
        $res = $this->NotificationModel->deleteTemplate($id);
        if ($res) {
            json_response(1, "Successfully deleted");
        } else {
            json_response(0, "Something went wrong");
        }
    }
}