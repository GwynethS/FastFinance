<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\RoleModel;
use App\Models\UserModel;
use App\Models\UserSettingModel;
use PHPMailer;
use PHPExcel_IOFactory;
use PHPExcel_Shared_Date;

class UserController extends BaseController
{
    public function index()
    {
        //index method
    }

    public function show_user_settings()
    {
        $session = \Config\Services::session();

        $username = $session->get('username');
        if (!isset($username)) {
            return redirect()->to('/public/auth-login');
        }

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Configuración']),
            'page_title' => view('partials/page-title', ['title' => 'Configuración', 'pagetitle' => 'Configuración']),
        ];

        $userModel = new UserModel();
        $userSettingModel = new UserSettingModel();

        $user = $userModel->where('username', $username)->first();

        $userSettings = $userSettingModel->where('user_id', $user['id'])->first();

        if (!isset($userSettings)) {
            $dataInsert = [
                'user_id' => $user['id'],
                'created_by' => $user['email'],
            ];

            $userSettingModel->insert($dataInsert);

            $userSettings = $userSettingModel->where('user_id', $user['id'])->first();
        }

        $data += [
            'user' => $user,
            'userSettings' => $userSettings,
        ];

        if ($this->request->getMethod() == 'POST') {

            $coin = $this->request->getPost('coin');
            $interest_rate_type = $this->request->getPost('interest_rate_type');

            $dataUpdate = [
                'coin' => $coin,
                'interest_rate_type' => $interest_rate_type,
                'edited_by' => $user['email'],
                'edited_at' => (new \DateTime())->format('Y-m-d H:i:s')
            ];

            $userSettingModel->update($userSettings['id'], $dataUpdate);

            return redirect()->to('/public/user-settings');
        }

        return view('user/user-settings', $data);
    }
}
