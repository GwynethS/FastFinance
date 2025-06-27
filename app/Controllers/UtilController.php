<?php

namespace App\Controllers;

use App\Models\UserModel;

class UtilController extends BaseController
{
    public function show_users_by_supervisor()
    {

        $session = \Config\Services::session();
        $role = $session->get('role');

        if (!is_array($role)) {
            return redirect()->to('/public/auth-login');
        }

        $userModel = new UserModel();

        $supervisorId = $this->request->getPost('supervisor_id');

        if ($supervisorId) {

            $users = $userModel->where('user_id', $supervisorId)->where('state', 1)->findAll();

        } else {

            if ($session->get('role')['alias'] === 'jefeventas') {

                $supervisors = $userModel->where('user_id', $session->get('id'))->where('state', 1)->findAll();

                if (!empty($supervisors)) {

                    $supervisorIds = array_column($supervisors, 'id');

                    $users = $userModel->whereIn('user_id', $supervisorIds)->where('state', 1)->findAll();
                }

            } else {

                if ($session->get('role')['alias'] === 'gerencia' and $session->get('brand') != '') {

                    if ($session->get('id') == 138) {

                        $users = $userModel->select('user.*')
                            ->join('role', 'role.id = user.role_id')
                            ->where('role.alias', 'gestor')
                            ->where('user.brand !=', 'NIUBIZ')
                            ->where('user.state', 1)
                            ->findAll();

                    } else {

                        $users = $userModel->select('user.*')
                            ->join('role', 'role.id = user.role_id')
                            ->where('role.alias', 'gestor')
                            ->where('user.brand', $session->get('brand'))
                            ->where('user.state', 1)
                            ->findAll();
                    }

                } else {

                    if (($session->get('role')['alias'] === 'gerencia' and $session->get('brand') == '') or $session->get('role')['alias'] === 'superadmin') {

                        $users = $userModel->select('user.*')
                            ->join('role', 'role.id = user.role_id')
                            ->where('role.alias', 'gestor')
                            ->where('user.state', 1)
                            ->findAll();

                    }
                }
            }

        }

        if (isset($users)) {

            foreach ($users as &$user) {
                $photoPath = '/home2/wmlobzmc/public_html/grupolozamora/chambeo' . $user['photo'];

                if (!file_exists($photoPath)) {
                    $user['photo'] = null;
                }
            }

            $dataResponse = [
                'success' => true,
                'users' => $users,
            ];

            return json_encode($dataResponse);

        } else {

            $dataResponse = [
                'success' => false
            ];

            return json_encode($dataResponse);
        }

    }

    public function show_users_by_sales_manager()
    {

        $session = \Config\Services::session();
        $role = $session->get('role');

        if (!is_array($role)) {
            return redirect()->to('/public/auth-login');
        }

        $userModel = new UserModel();

        $salesManagerId = $this->request->getPost('sales_manager_id');

        if ($salesManagerId) {

            $supervisors = $userModel->where('user_id', $salesManagerId)->where('state', 1)->findAll();

            if (!empty($supervisors)) {

                $supervisorIds = array_column($supervisors, 'id');

                $users = $userModel->whereIn('user_id', $supervisorIds)->where('state', 1)->findAll();
            }

        } else {

            if ($session->get('role')['alias'] === 'gerencia' and $session->get('brand') != '') {

                if ($session->get('id') == 138) {

                    $supervisors = $userModel->select('user.*')
                        ->join('role', 'role.id = user.role_id')
                        ->where('role.alias', 'supervisor')
                        ->where('user.brand !=', 'NIUBIZ')
                        ->where('user.state', 1)
                        ->findAll();

                    $users = $userModel->select('user.*')
                        ->join('role', 'role.id = user.role_id')
                        ->where('role.alias', 'gestor')
                        ->where('user.brand !=', 'NIUBIZ')
                        ->where('user.state', 1)
                        ->findAll();
                } else {

                    $supervisors = $userModel->select('user.*')
                        ->join('role', 'role.id = user.role_id')
                        ->where('role.alias', 'supervisor')
                        ->where('user.brand', $session->get('brand'))
                        ->where('user.state', 1)
                        ->findAll();

                    $users = $userModel->select('user.*')
                        ->join('role', 'role.id = user.role_id')
                        ->where('role.alias', 'gestor')
                        ->where('user.brand', $session->get('brand'))
                        ->where('user.state', 1)
                        ->findAll();
                }
            } else {
                if (($session->get('role')['alias'] === 'gerencia' and $session->get('brand') == '') or $session->get('role')['alias'] === 'superadmin') {

                    $supervisors = $userModel->select('user.*')
                        ->join('role', 'role.id = user.role_id')
                        ->where('role.alias', 'supervisor')
                        ->where('user.state', 1)
                        ->findAll();

                    $users = $userModel->select('user.*')
                        ->join('role', 'role.id = user.role_id')
                        ->where('role.alias', 'gestor')
                        ->where('user.state', 1)
                        ->findAll();
                }
            }

        }


        if (isset($users) and isset($supervisors)) {

            foreach ($supervisors as &$supervisor) {
                $photoPath = '/home2/wmlobzmc/public_html/grupolozamora/chambeo' . $supervisor['photo'];

                if (!file_exists($photoPath)) {
                    $supervisor['photo'] = null;
                }
            }

            foreach ($users as &$user) {
                $photoPath = '/home2/wmlobzmc/public_html/grupolozamora/chambeo' . $user['photo'];

                if (!file_exists($photoPath)) {
                    $user['photo'] = null;
                }
            }

            $dataResponse = [
                'success' => true,
                'users' => $users,
                'supervisors' => $supervisors
            ];

            return json_encode($dataResponse);

        } else {

            $dataResponse = [
                'success' => false
            ];

            return json_encode($dataResponse);
        }

    }

    public function sendEmail($emailBody)
    {
        $email = \Config\Services::email();

        $message = '<HEAD><META content="text/html; charset=windows-1252" http-equiv=Content-Type><META name=GENERATOR content="MSHTML 10.00.9200.16686"><meta charset="utf-8" /></HEAD>';
        $message .= '<div style="width: 630px; text-align: center">';
        $message .= '<img src="data:image/png;base64,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" style="width: 100px" />';
        $message = strtr($message, [
            'Ñ' => '&Ntilde;',
            'ñ' => '&ntilde;',
            'Á' => '&Aacute;',
            'á' => '&aacute;',
            'É' => '&Eacute;',
            'é' => '&eacute;',
            'Í' => '&Iacute;',
            'í' => '&iacute;',
            'Ó' => '&Oacute;',
            'ó' => '&oacute;',
            'Ú' => '&Uacute;',
            'ú' => '&uacute;',
            'Ü' => '&Uuml;',
            'ü' => '&uuml;',
            '¡' => '&iexcl;',
            '¿' => '&iquest;',
            'Ç' => '&Ccedil;',
            'ç' => '&ccedil;',
            'º' => '&ordm;',
            'ª' => '&ordf;',
            '«' => '&laquo;',
            '»' => '&raquo;',
            '©' => '&copy;',
            '®' => '&reg;',
            '€' => '&euro;',
        ]);
        $message .= $emailBody['message'];

        $email->setFrom('administracion.ti@grupolozamora.com.pe', 'NOTIFICACIONES ERP GRUPO LOZAMORA');
        $email->setTo($emailBody['to']);
        $email->setSubject($emailBody['subject']);


        $email->setMessage($message);

        $email->send();

        /*        if ($email->send()) {
                    echo "Correo enviado correctamente a: " . $emailBody['to'];
                } else {
                    echo "Error al enviar el correo: " . $email->printDebugger(['headers']);
                }*/
    }


    public function show_users_by_brand()
    {

        $session = \Config\Services::session();
        $role = $session->get('role');

        if (!is_array($role)) {
            return redirect()->to('/public/auth-login');
        }

        $userModel = new UserModel();

        $brand = $this->request->getPost('brand');

        if ($brand) {

            $salesManagers = $userModel->select('user.*')->join('role', 'role.id = user.role_id')->where('role.alias', 'jefeventas')->where('user.brand', $brand)->where('user.state', 1)->findAll();

            $supervisors = $userModel->select('user.*')->join('role', 'role.id = user.role_id')->where('role.alias', 'supervisor')->where('user.brand', $brand)->where('user.state', 1)->findAll();

            $users = $userModel->select('user.*')->join('role', 'role.id = user.role_id')->where('role.alias', 'gestor')->where('user.brand', $brand)->where('user.state', 1)->findAll();

        } else {

            if ($session->get('id') == 138) {

                $salesManagers = $userModel->select('user.*')
                    ->join('role', 'role.id = user.role_id')
                    ->where('role.alias', 'jefeventas')
                    ->where('user.brand !=', 'NIUBIZ')
                    ->where('user.state', 1)
                    ->findAll();

                $supervisors = $userModel->select('user.*')
                    ->join('role', 'role.id = user.role_id')
                    ->where('role.alias', 'supervisor')
                    ->where('user.brand !=', 'NIUBIZ')
                    ->where('user.state', 1)
                    ->findAll();

                $users = $userModel->select('user.*')
                    ->join('role', 'role.id = user.role_id')
                    ->where('role.alias', 'gestor')
                    ->where('user.brand !=', 'NIUBIZ')
                    ->where('user.state', 1)
                    ->findAll();

            } else {

                if (($session->get('role')['alias'] === 'gerencia' and $session->get('brand') == '') or $session->get('role')['alias'] === 'superadmin') {

                    $salesManagers = $userModel->select('user.*')
                        ->join('role', 'role.id = user.role_id')
                        ->where('role.alias', 'jefeventas')
                        ->where('user.state', 1)
                        ->findAll();

                    $supervisors = $userModel->select('user.*')
                        ->join('role', 'role.id = user.role_id')
                        ->where('role.alias', 'supervisor')
                        ->where('user.state', 1)
                        ->findAll();

                    $users = $userModel->select('user.*')
                        ->join('role', 'role.id = user.role_id')
                        ->where('role.alias', 'gestor')
                        ->where('user.state', 1)
                        ->findAll();
                }
            }

        }


        if (isset($users) and isset($supervisors) and isset($salesManagers)) {

            foreach ($salesManagers as &$salesManager) {
                $photoPath = '/home2/wmlobzmc/public_html/grupolozamora/chambeo' . $salesManager['photo'];

                if (!file_exists($photoPath)) {
                    $salesManager['photo'] = null;
                }
            }

            foreach ($supervisors as &$supervisor) {
                $photoPath = '/home2/wmlobzmc/public_html/grupolozamora/chambeo' . $supervisor['photo'];

                if (!file_exists($photoPath)) {
                    $supervisor['photo'] = null;
                }
            }

            foreach ($users as &$user) {
                $photoPath = '/home2/wmlobzmc/public_html/grupolozamora/chambeo' . $user['photo'];

                if (!file_exists($photoPath)) {
                    $user['photo'] = null;
                }
            }

            $dataResponse = [
                'success' => true,
                'users' => $users,
                'supervisors' => $supervisors,
                'sales_managers' => $salesManagers
            ];

            return json_encode($dataResponse);

        } else {

            $dataResponse = [
                'success' => false
            ];

            return json_encode($dataResponse);

        }

    }

    public function show_all_supervisors()
    {
        $session = \Config\Services::session();
        $role = $session->get('role');
        if (!is_array($role)) {
            return redirect()->to('/public/auth-login');
        }

        $userModel = new UserModel();

        if ($session->get('role')['alias'] === 'gerencia' and $session->get('brand') != '') {

            if ($session->get('id') == 138) {

                $supervisors = $userModel->select('user.*')
                    ->join('role', 'role.id = user.role_id')
                    ->where('role.alias', 'supervisor')
                    ->where('user.brand !=', 'NIUBIZ')
                    ->where('user.state', 1)
                    ->findAll();

            } else {

                $supervisors = $userModel->select('user.*')
                    ->join('role', 'role.id = user.role_id')
                    ->where('role.alias', 'supervisor')
                    ->where('user.brand', $session->get('brand'))
                    ->where('user.state', 1)
                    ->findAll();

            }
        } else {
            if (($session->get('role')['alias'] === 'gerencia' and $session->get('brand') == '') or $session->get('role')['alias'] === 'superadmin') {

                $supervisors = $userModel->select('user.*')
                    ->join('role', 'role.id = user.role_id')
                    ->where('role.alias', 'supervisor')
                    ->where('user.state', 1)
                    ->findAll();
            }
        }

        if (isset($supervisors)) {

            foreach ($supervisors as &$supervisor) {
                $photoPath = '/home2/wmlobzmc/public_html/grupolozamora/chambeo' . $supervisor['photo'];

                if (!file_exists($photoPath)) {
                    $supervisor['photo'] = null;
                }
            }

            $dataResponse = [
                'success' => true,
                'supervisors' => $supervisors,
            ];

            return json_encode($dataResponse);

        } else {
            $dataResponse = [
                'success' => false
            ];

            return json_encode($dataResponse);
        }
    }

    public function show_all_sales_managers()
    {
        $session = \Config\Services::session();
        $role = $session->get('role');

        if (!is_array($role)) {
            return redirect()->to('/public/auth-login');
        }

        $userModel = new UserModel();

        if ($session->get('id') == 138) {

            $salesManagers = $userModel->select('user.*')
                ->join('role', 'role.id = user.role_id')
                ->where('role.alias', 'jefeventas')
                ->where('user.brand !=', 'NIUBIZ')
                ->where('user.state', 1)
                ->findAll();


        } else {

            if (($session->get('role')['alias'] === 'gerencia' and $session->get('brand') == '') or $session->get('role')['alias'] === 'superadmin') {

                $salesManagers = $userModel->select('user.*')
                    ->join('role', 'role.id = user.role_id')
                    ->where('role.alias', 'jefeventas')
                    ->where('user.state', 1)
                    ->findAll();

            }
        }

        if (isset($salesManagers)) {

            foreach ($salesManagers as &$salesManager) {
                $photoPath = '/home2/wmlobzmc/public_html/grupolozamora/chambeo' . $salesManager['photo'];

                if (!file_exists($photoPath)) {
                    $salesManager['photo'] = null;
                }
            }

            $dataResponse = [
                'success' => true,
                'sales_managers' => $salesManagers,
            ];

            return json_encode($dataResponse);

        } else {
            $dataResponse = [
                'success' => false
            ];

            return json_encode($dataResponse);
        }
    }

    public function upload_file($fileInputName, $fileNamePrefix, $dir_subida)
    {
        if (isset($_FILES[$fileInputName]['name']) and $_FILES[$fileInputName]['name'] != '' and $_FILES[$fileInputName]['name'] != ' ') {

            $name = explode('.', basename($_FILES[$fileInputName]['name']));
            $fileName = $fileNamePrefix . '_' . date('YmdHis') . '.' . end($name);
            $dir = $dir_subida . $fileName;

            if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $dir)) {
                return $dir;
            }
        }
        return null;
    }

}