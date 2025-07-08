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

    public function support_request()
    {
        $session = \Config\Services::session();
        $email = \Config\Services::email();

        $username = $session->get('username');

        if (!isset($username)) {
            return redirect()->to('/public/auth-login');
        }

        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = 'smtp.gmail.com';
        $config['SMTPUser'] = env('email.smtpUser');
        $config['SMTPPass'] = env('email.smtpPass');
        $config['SMTPPort'] = 587;
        $config['SMTPTimeout'] = 7;
        $config['mailType'] = 'html';
        $config['charset'] = 'utf-8';

        $email->initialize($config);

        $emailService = \Config\Services::email();

        $subject = $this->request->getPost('subject');
        $message = $this->request->getPost('message');

        $emailService->setTo(env('email.smtpTo'));
        $emailService->setFrom($session->get('email'), $session->get('username'));
        $emailService->setSubject($subject);;
        $emailService->setMessage($message);

        $email->send();

        /*if ($email->send()) {
            echo "Correo enviado correctamente a: ";
        } else {
            echo "Error al enviar el correo: " . $email->printDebugger(['headers']);
        }*/

        return redirect()->to('/public/faq');
    }
}
