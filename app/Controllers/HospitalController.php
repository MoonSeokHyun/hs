<?php

namespace App\Controllers;

use App\Models\HospitalModel;

class HospitalController extends BaseController
{
    public function index()
    {
        $hospitalModel = new HospitalModel();

        // 데이터베이스에서 병원 정보를 가져옵니다 (10개 제한)
        $data['hospitals'] = $hospitalModel->getHospitals(10);

        return view('hospital/index', $data);
    }
}
