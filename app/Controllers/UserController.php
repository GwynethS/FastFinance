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

    public function show_user_list()
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

    public function show_user_create()
    {
        $session = \Config\Services::session();
        $role = $session->get('role');
        if (!is_array($role)) {
            return redirect()->to('/public/auth-login');
        }
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Crear nuevo usuario']),
            'page_title' => view('partials/page-title', ['title' => 'Crear nuevo usuario', 'pagetitle' => 'Usuarios'])
        ];

        $roleModel = new RoleModel;
        $userModel = new UserModel;


        // si el usuario es de tipo superadmin, se muestran todos los roles

        if ($session->get('role')['alias'] == 'superadmin') {
            $data['roles'] = $roleModel->findAll();
        } else {
            $data['roles'] = $roleModel->where('alias !=', 'superadmin')->findAll();
        }

        //$data['bosses'] = $userModel->where('job', 'Jefe')->orWhere('job', 'Gerente')->findAll();
        $data['bosses'] = $userModel->findAll();

        if ($this->request->getMethod() == 'post') {
            $name = $this->request->getVar('name');
            $lastname = $this->request->getVar('lastname');
            $document = $this->request->getVar('document');
            $birthday = $this->request->getVar('birthday');
            $phone = $this->request->getVar('phone');
            $email = $this->request->getVar('email');
            $role_id = $this->request->getVar('role');
            $password = $this->request->getVar('password');
            $company = $this->request->getVar('company');
            $department = $this->request->getVar('department');
            $job = $this->request->getVar('job');
            $user_boss_id = $this->request->getVar('user_boss_id');

            $name = mb_strtoupper($name);
            $lastname = mb_strtoupper($lastname);

            $datainsertuser = [
                'role_id' => $role_id,
                'user_boss_id' => $user_boss_id,
                'name' => $name,
                'lastname' => $lastname,
                'document' => $document,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'birthday' => $birthday,
                'company' => $company,
                'department' => $department,
                'job' => $job
            ];
            if (
                $name != '' and !is_null($name)
                and $lastname != '' and !is_null($lastname)
                and $document != '' and !is_null($document)
                and $birthday != '' and !is_null($birthday)
                and $role_id != '' and !is_null($role_id)
                and $email != '' and !is_null($email)
                and $password != '' and !is_null($password)
                and $company != '' and !is_null($company)
                and $department != '' and !is_null($department)
                and $job != '' and !is_null($job)
            ) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $userregistred = $userModel->where('email', $email)->first();
                    if (isset($userregistred['email'])) {
                        $data['error'] = 'Ya existe un usuario con este email.';
                    } else {
                        $userModel->insert($datainsertuser);
                        return redirect()->to('/public/user-list');
                    }
                } else {
                    $data['error'] = 'El correo electrónico es incorrecto.';
                }
            } else {
                $data['error'] = 'Debe ingresar todos los datos.';
            }
            $data['dataform'] = $datainsertuser;
//            $data['dataform']['role_id'] = $role_id;
//            $data['dataform']['password'] = $password;
        }
        return view('user/user-create', $data);
    }

    public function show_user_edit($id)
    {
        $session = \Config\Services::session();
        $role = $session->get('role');
        if (!is_array($role)) {
            return redirect()->to('/auth-login');
        }

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Editar usuario']),
            'page_title' => view('partials/page-title', ['title' => 'Editar usuario', 'pagetitle' => 'Usuarios'])
        ];

        $roleModel = new RoleModel;
        $userModel = new UserModel;
        $data['roles'] = $roleModel->where('state', 1)->findAll();
        //$data['bosses'] = $userModel->where('job', 'Jefe')->orWhere('job', 'Gerente')->findAll();
        $data['bosses'] = $userModel->findAll();
        $data['user'] = $userModel->where('id', $id)->first();

        if ($this->request->getMethod() == 'post') {
            $name = $this->request->getVar('name');
            $lastname = $this->request->getVar('lastname');
            $document = $this->request->getVar('document');
            $birthday = $this->request->getVar('birthday');
            $phone = $this->request->getVar('phone');
            $email = $this->request->getVar('email');
            $role_id = $this->request->getVar('role');
            $password = $this->request->getVar('password');
            $company = $this->request->getVar('company');
            $department = $this->request->getVar('department');
            $job = $this->request->getVar('job');
            $user_boss_id = $this->request->getVar('user_boss_id');

            $name = mb_strtoupper($name);
            $lastname = mb_strtoupper($lastname);

            $dataupdateuser = [
                'role_id' => $role_id,
                'user_boss_id' => $user_boss_id,
                'name' => $name,
                'lastname' => $lastname,
                'document' => $document,
                'email' => $email,
                'phone' => $phone,
                'birthday' => $birthday,
                'company' => $company,
                'department' => $department,
                'job' => $job
            ];
            if ($password != '') {
                $dataupdateuser['password'] = $password;
            }
            if (
                $name != '' and !is_null($name)
                and $lastname != '' and !is_null($lastname)
                and $document != '' and !is_null($document)
                and $birthday != '' and !is_null($birthday)
                and $role_id != '' and !is_null($role_id)
                and $email != '' and !is_null($email)
                and $company != '' and !is_null($company)
                and $department != '' and !is_null($department)
                and $job != '' and !is_null($job)
            ) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $userModel->update($data['user']['id'], $dataupdateuser);
                    return redirect()->to('/public/user-list');
                } else {
                    $data['error'] = 'El correo electrónico ingresado no es válido. Por favor, ingrese un correo electrónico válido.';
                }
            } else {
                $data['error'] = 'Debe ingresar todos los datos.';
            }
        }
        return view('user/user-edit', $data);
    }

    public function show_user_delete($id)
    {
        $session = \Config\Services::session();
        $role = $session->get('role');
        if (!is_array($role)) {
            return redirect()->to('/public/auth-login');
        }

        $userModel = new UserModel;
        $user = $userModel->where('id', $id)->first();
        $userModel->update($user['id'], ['state' => 0]);
        return redirect()->to('/public/user-list');
    }

    public function show_user_enable($id)
    {
        $session = \Config\Services::session();
        $role = $session->get('role');
        if (!is_array($role)) {
            return redirect()->to('/public/auth-login');
        }
        $userModel = new UserModel;
        $user = $userModel->where('id', $id)->first();
        $userModel->update($user['id'], ['state' => 1]);
        return redirect()->to('/public/user-list');
    }

    public function show_user_change_password()
    {
        $session = \Config\Services::session();
        $role = $session->get('role');

        if (!is_array($role)) {
            return redirect()->to('/public/auth-login');
        }

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Cambiar contraseña']),
            'page_title' => view('partials/page-title', ['title' => 'Cambiar contraseña', 'pagetitle' => 'Perfil'])
        ];

        $userModel = new UserModel;
        $user = $userModel->where('id', $session->get('id'))->first();

        if ($this->request->getMethod() == 'post') {
            $new_password = $this->request->getVar('new_password');

            if ($new_password != '' and !is_null($new_password)) {
                $userModel->update($user['id'], ['password' => $new_password]);

                return redirect()->to('/');
            }

            $data['dataform']['new_password'] = $new_password;
        }

        return view('user/user-change-password', $data);
    }

    public function show_user_update_document_password()
    {
        $userModel = new UserModel;
        $users = $userModel->findAll();

        foreach ($users as $user) {
            $userModel->update($user['id'], ['password' => $user['document']]);
        }
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

        if ($this->request->getMethod() == 'post') {

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
