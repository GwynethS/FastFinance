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

class MainController extends BaseController
{
    public function index()
    {
        //index method
    }

    public function show_bond_list()
    {
        $session = \Config\Services::session();

        $username = $session->get('username');

        if (!isset($username)) {
            return redirect()->to('/public/auth-login');
        }

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Lista de bonos']),
            'page_title' => view('partials/page-title', ['title' => 'Lista de bonos', 'pagetitle' => 'Lista de bonos']),
        ];

        $bondModel = new BondModel();
        $userSettingModel = new UserSettingModel();

        $userSettings = $userSettingModel->where('user_id', $session->get('id'))->first();

        $data['userSettings'] = $userSettings;

        $bonds = $bondModel->where('user_id', $session->get('id'))
            ->where('state', 1);

        $code = $this->request->getGet('code');
        $name = $this->request->getGet('name');

        if ($code) {
            $bonds->like('code', $code);
        }

        if ($name) {
            $bonds->like('name', $name);
        }

        $bonds = $bonds->findAll();

        $data['bonds'] = $bonds;

        return view('bond/bond-list', $data);
    }

    public function bond_create()
    {
        $session = \Config\Services::session();

        $username = $session->get('username');

        if (!isset($username)) {
            return redirect()->to('/public/auth-login');
        }

        $bondModel = new BondModel();

        $name = $this->request->getPost('name');
        $coin = $this->request->getPost('coin');
        $interest_rate_type = $this->request->getPost('interest_rate_type');
        $capitalization_period = $this->request->getPost('capitalization_period');
        $interest_rate = $this->request->getPost('interest_rate');
        $cok = $this->request->getPost('cok');
        $term_years = $this->request->getPost('term_years');
        $payment_frequency = $this->request->getPost('payment_frequency');
        $total_grace = $this->request->getPost('total_grace');
        $partial_grace = $this->request->getPost('partial_grace');
        $premium = $this->request->getPost('premium');
        $structuring_fee = $this->request->getPost('structuring_fee');
        $placement_fee = $this->request->getPost('placement_fee');
        $floatation_fee = $this->request->getPost('floatation_fee');
        $cavali_fee = $this->request->getPost('cavali_fee');

        $dataInsert = [
            'user_id' => $session->get('id'),
            'name' => $name,
            'coin' => $coin,
            'interest_rate_type' => $interest_rate_type,
            'capitalization_period' => $capitalization_period ?: null,
            'interest_rate' => $interest_rate,
            'cok' => $cok,
            'term_years' => $term_years,
            'payment_frequency' => $payment_frequency,
            'total_grace' => $total_grace,
            'partial_grace' => $partial_grace,
            'premium' => $premium,
            'structuring_fee' => $structuring_fee,
            'placement_fee' => $placement_fee,
            'floatation_fee' => $floatation_fee,
            'cavali_fee' => $cavali_fee,
            'created_by' => $session->get('email'),
        ];

        $randomCode = 'BND-' . substr(md5(uniqid(rand(), true)), 0, 6);
        $dataInsert['code'] = strtoupper($randomCode);

        $bondModel->insert($dataInsert);

        return redirect()->to('/public/bond-list');
    }

    public function show_cash_flow_list()
    {
        $session = \Config\Services::session();
        $username = $session->get('username');
        if (!isset($username)) {
            return redirect()->to('/public/auth-login');
        }

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Flujo de caja']),
            'page_title' => view('partials/page-title', ['title' => 'Flujo de caja', 'pagetitle' => 'Flujo de caja']),
        ];

        return view('cash-flow/cash-flow-list', $data);
    }

}
