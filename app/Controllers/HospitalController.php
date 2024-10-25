<?php

namespace App\Controllers;

use App\Models\HospitalModel;

class HospitalController extends BaseController
{
    public function index()
    {
        $hospitalModel = new HospitalModel();

        // 카테고리별로 병원 정보를 가져옵니다
        $categories = [
            '병원', '부속의료기관', '산후조리업', '안전상비의약품 판매업소', 
            '약국', '응급환자이송업', '의료법인', '의료유사업', '의원'
        ];

        $data['hospitalsByCategory'] = [];
        foreach ($categories as $category) {
            $data['hospitalsByCategory'][$category] = $hospitalModel->getHospitalsByCategory($category, 10);
        }

        return view('hospital/index', $data);
    }
}
