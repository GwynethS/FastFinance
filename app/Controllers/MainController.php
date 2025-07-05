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
        $face_value = $this->request->getPost('face_value');
        $market_value = $this->request->getPost('market_value');
        $interest_rate_type = $this->request->getPost('interest_rate_type');
        $capitalization_period = $this->request->getPost('capitalization_period');
        $interest_rate = $this->request->getPost('interest_rate');
        $cok = $this->request->getPost('cok');
        $term_years = $this->request->getPost('term_years');
        $payment_frequency = $this->request->getPost('payment_frequency');
        $total_grace = $this->request->getPost('total_grace');
        $partial_grace = $this->request->getPost('partial_grace');
        $issue_date = $this->request->getPost('issue_date');

        $premium = $this->request->getPost('premium');
        $structuring_fee = $this->request->getPost('structuring_fee');
        $placement_fee = $this->request->getPost('placement_fee');
        $floatation_fee = $this->request->getPost('floatation_fee');
        $cavali_fee = $this->request->getPost('cavali_fee');

        $dataInsert = [
            'user_id' => $session->get('id'),
            'name' => $name,
            'coin' => $coin,
            'face_value' => $face_value,
            'market_value' => $market_value,
            'interest_rate_type' => $interest_rate_type,
            'capitalization_period' => $capitalization_period ?: null,
            'interest_rate' => $interest_rate,
            'cok' => $cok,
            'term_years' => $term_years,
            'payment_frequency' => $payment_frequency,
            'total_grace' => $total_grace,
            'partial_grace' => $partial_grace,
            'issue_date' => $issue_date,
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

        $bondModel = new BondModel();

        $bond = $bondModel->where('user_id', $session->get('id'))
            ->where('state', 1);

        $code = $this->request->getGet('code');
        $name = $this->request->getGet('name');

        if ($code) {
            $bond->like('code', $code);
        }

        if ($name) {
            $bond->like('name', $name);
        }

        $bond = $bond->first();

        if (isset($bond) and ($code or $name)) {

            $periodsByYear = round($bond['year_days'] / $bond['payment_frequency'], 0);
            $interestRate = $bond['interest_rate'] / 100;

            $tep = 0;

            switch ($bond['interest_rate_type']) {
                case 'EFECTIVA':
                    if ($bond['payment_frequency'] != 360) {
                        $tep = pow(1 + $interestRate, $bond['payment_frequency'] / $bond['year_days']) - 1;
                    } else {
                        $tep = $interestRate;
                    }
                    break;
                case 'NOMINAL':
                    $tea = pow(1 + ($interestRate / ($bond['year_days'] / $bond['capitalization_period'])), ($bond['year_days'] / $bond['capitalization_period'])) - 1;

                    $tep = pow(1 + $tea, $bond['payment_frequency'] / $bond['year_days']) - 1;
                    break;
            }

            $totalPeriods = $bond['term_years'] * $periodsByYear;

            $cok = $bond['cok'] / 100;
            $cokPeriod = 0;

            if ($bond['payment_frequency'] != 360) {
                $cokPeriod = pow(1 + $cok, $bond['payment_frequency'] / $bond['year_days']) - 1;
            } else {
                $cokPeriod = $cok;
            }

            $issuerCosts = ($bond['structuring_fee'] + $bond['placement_fee'] + $bond['floatation_fee'] + $bond['cavali_fee']) / 100 * $bond['market_value'];
            $investorCosts = ($bond['floatation_fee'] + $bond['cavali_fee']) / 100 * $bond['market_value'];

            $startDate = (new \DateTime($bond['issue_date']));

            $faceValue = $bond['face_value'];
            $totalGracePeriods = $bond['total_grace'];
            $partialGracePeriods = $bond['partial_grace'];
            $initialBalance = $bond['face_value'];

            $initialIssuerFlow = $bond['market_value'] - $issuerCosts;
            $initialInvestorFlow = ($bond['market_value'] + $investorCosts) * -1;

            $totalPresentValue = $totalWeightedPresentValue = $totalConvexityFactor = 0;

            $cashFlow = [];

            $cashFlow[] = [
                'period' => 0,
                'date' => '',
                'grace' => '',
                'initial_balance' => '',
                'interest' => '',
                'quote' => '',
                'amortization' => '',
                'final_balance' => '',
                'premium' => '',
                'issuer_flow' => round($initialIssuerFlow, 2),
                'investor_flow' => round($initialInvestorFlow, 2),
                'present_value' => '',
                'weighted_present_value' => '',
                'convexity_factor' => ''
            ];

            for ($i = 1; $i <= $totalPeriods; $i++) {

                $paymentDate = $startDate->modify('+' . $bond['payment_frequency'] . ' days')->format('d/m/Y');

                $quote = 0;

                $interest = $initialBalance * $tep;
                $amortization = 0;
                $premium = 0;

                if ($totalGracePeriods > 0) {
                    $graceType = 'T';

                    $faceValue = $initialBalance + $interest;
                    $finalBalance = $initialBalance + $interest;

                    $totalGracePeriods--;
                } else {
                    if ($partialGracePeriods > 0) {
                        $graceType = 'P';

                        $quote = $interest;

                        $finalBalance = $initialBalance - $amortization;

                        $partialGracePeriods--;
                    } else {
                        $graceType = 'S';

                        $quote = $faceValue * ($tep / (1 - pow(1 + $tep, $totalPeriods * -1)));

                        $amortization = $quote - $interest;

                        $finalBalance = round($initialBalance - $amortization, 2);
                    }
                }

                if ($i == $totalPeriods) {
                    $premium = $initialBalance * $bond['premium'] / 100;
                }

                $issuerFlow = ($quote + $premium) * -1;
                $investorFlow = ($issuerFlow) * -1;

                $discountFactor = pow(1 + $cokPeriod, $i);
                $presentValue = $investorFlow / $discountFactor;

                $periodInYears = ($i * $bond['payment_frequency']) / $bond['year_days'];
                $weightedPresentValue = $presentValue * $periodInYears;

                $convexityFactor = $presentValue * $i * ($i + 1);

                $totalPresentValue += $presentValue;
                $totalWeightedPresentValue += $weightedPresentValue;
                $totalConvexityFactor += $convexityFactor;

                $cashFlow[] = [
                    'period' => $i,
                    'date' => $paymentDate,
                    'grace' => $graceType,
                    'initial_balance' => round($initialBalance, 2),
                    'interest' => round($interest, 2),
                    'quote' => round($quote, 2),
                    'amortization' => round($amortization, 2),
                    'final_balance' => round(abs($finalBalance) <= 0.01 ? 0 : $finalBalance, 2),
                    'premium' => round($premium, 2),
                    'issuer_flow' => round($issuerFlow, 2),
                    'investor_flow' => round($investorFlow, 2),
                    'present_value' => round($presentValue, 2),
                    'weighted_present_value' => round($weightedPresentValue, 2),
                    'convexity_factor' => round($convexityFactor, 2),
                ];

                $initialBalance = $finalBalance;
            }

            $data['bond'] = $bond;
            $data['cashFlow'] = $cashFlow;

            $duration = $totalPresentValue != 0 ? $totalWeightedPresentValue / $totalPresentValue : 0;
            $modifiedDuration = $duration / (1 + $cokPeriod);
            $convexity = $totalPresentValue != 0 ? $totalConvexityFactor / ($totalPresentValue * pow(1 + $cokPeriod, 2) * pow($bond['year_days'] / $bond['payment_frequency'], 2)) : 0;

            $issuerFlowTIR = $this->calculateTIR($cashFlow, 'issuer_flow');
            $investorFlowTIR = $this->calculateTIR($cashFlow, 'investor_flow');

            $issuerTCEA = pow(1 + $issuerFlowTIR, $bond['year_days'] / $bond['payment_frequency']) - 1;
            $investorTREA = pow(1 + $investorFlowTIR, $bond['year_days'] / $bond['payment_frequency']) - 1;


            $results = [
                'duration' => round($duration, 4),
                'modified_duration' => round($modifiedDuration, 4),
                'convexity' => round($convexity, 4),
                'bond_price' => $totalPresentValue,
                'issuer_tcea' => round($issuerTCEA * 100, 4),
                'investor_trea' => round($investorTREA * 100, 4),
            ];

            $data['results'] = $results;
        }

        return view('cash-flow/cash-flow-list', $data);
    }

    public function calculateTIR(array $cashFlow, $key)
    {
        $flows = [];
        foreach ($cashFlow as $row) {
            if (isset($row[$key])) {
                $flows[] = (float)$row[$key];
            }
        }

        return Periodic::rate($flows);
    }

}
