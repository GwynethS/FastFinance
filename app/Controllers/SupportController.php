<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BondModel;
use App\Models\PostModel;
use App\Models\RoleModel;
use App\Models\UserModel;
use App\Models\UserSettingModel;
use PHPMailer;
use PHPExcel_IOFactory;
use PHPExcel_Shared_Date;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\CashFlow\Variable\Periodic;

class SupportController extends BaseController
{
    public function index()
    {
        //index method
    }

    public function show_faq()
    {
        $session = \Config\Services::session();

        $username = $session->get('username');

        if (!isset($username)) {
            return redirect()->to('/public/auth-login');
        }

        $role = $session->get('role')['alias'];

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Preguntas frecuentes (FAQ)']),
            'page_title' => view('partials/page-title', ['title' => 'Preguntas frecuentes (FAQ)', 'pagetitle' => 'Preguntas frecuentes (FAQ)']),
        ];

        return view('support/faq', $data);
    }

}
