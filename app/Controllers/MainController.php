<?php

namespace Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
use App\Models\RoleModel;
use App\Models\UserModel;
use PHPMailer;
use PHPExcel_IOFactory;
use PHPExcel_Shared_Date;

class MainController extends BaseController
{
    public function index()
    {
        //index method
    }

    public function show_bond_list()
    {
        $session = \Config\Services::session();
        $role = $session->get('role');
        if (!is_array($role)) {
            return redirect()->to('/public/auth-login');
        }
        $userModel = new UserModel;
        $roleModel = new RoleModel;
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';

        $users = $userModel;
        if ($type != '') {
            $roles = explode(',', $type);
            $users = $users->whereIn('role_id', $roles);
        }
        $users = $users->findAll();
        foreach ($users as $k => $user) {
            $users[$k]['role'] = $roleModel->where('id', $user['role_id'])->first();
        }

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Usuarios']),
            'page_title' => view('partials/page-title', ['title' => 'Usuarios', 'pagetitle' => 'Usuarios']),
            'users' => $users,
            'type' => $type
        ];
        return view('user/user-list', $data);
    }

    public function show_cashflow_list()
    {
        $session = \Config\Services::session();
        $role = $session->get('role');
        if (!is_array($role)) {
            return redirect()->to('/public/auth-login');
        }
        $userModel = new UserModel;
        $roleModel = new RoleModel;
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';

        $users = $userModel;
        if ($type != '') {
            $roles = explode(',', $type);
            $users = $users->whereIn('role_id', $roles);
        }
        $users = $users->findAll();
        foreach ($users as $k => $user) {
            $users[$k]['role'] = $roleModel->where('id', $user['role_id'])->first();
        }

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Usuarios']),
            'page_title' => view('partials/page-title', ['title' => 'Usuarios', 'pagetitle' => 'Usuarios']),
            'users' => $users,
            'type' => $type
        ];
        return view('user/user-list', $data);
    }

}
