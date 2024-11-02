<?php

namespace App\Controllers;

use App\Models\HospitalModel;
use App\Models\ReviewModel;

class HospitalController extends BaseController
{
    public function index()
    {
        $hospitalModel = new HospitalModel();

        $categories = [
            '부속의료기관', '안전상비의약품 판매업소', 
            '응급환자이송업', '의료유사업'
        ];

        $data['hospitalsByCategory'] = [];
        foreach ($categories as $category) {
            $data['hospitalsByCategory'][$category] = $hospitalModel->getHospitalsByCategory($category, 10);
        }

        return view('hospital/index', $data);
    }

    public function detail($id)
    {
        $hospitalModel = new HospitalModel();
        $reviewModel = new ReviewModel();

        $hospital = $hospitalModel->find($id);
        $reviews = $reviewModel->getReviewsByHospital($id);

        if (!$hospital) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Hospital with ID {$id} not found");
        }

        // 편의시설 정보를 추가
        $nearbyFacilities = $hospitalModel->getNearbyFacilities($hospital['Coordinate_X'], $hospital['Coordinate_Y']);

        return view('hospital/detail', [
            'hospital' => $hospital,
            'reviews' => $reviews,
            'nearbyFacilities' => $nearbyFacilities
        ]);
    }

    public function addReview()
    {
        $reviewModel = new ReviewModel();
        $data = [
            'hospital_id' => $this->request->getPost('hospital_id'),
            'user_name'   => $this->request->getPost('user_name'),
            'rating'      => $this->request->getPost('rating'),
            'comment'     => $this->request->getPost('comment'),
        ];
        
        $reviewModel->save($data);
        return redirect()->to('/hospital/detail/' . $data['hospital_id']);
    }
}
