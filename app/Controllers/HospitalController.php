<?php

namespace App\Controllers;

use App\Models\HospitalModel;
use App\Models\ReviewModel;
use proj4php\Proj4php;
use proj4php\Proj;
use proj4php\Point;

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

        // TM 좌표를 WGS84 좌표로 변환
        $latitude = null;
        $longitude = null;

        if (isset($hospital['Coordinate_X'], $hospital['Coordinate_Y'])) {
            $proj4 = new Proj4php();
            $tmProj = new Proj('EPSG:5186', $proj4); // 한국 TM 좌표계
            $wgs84Proj = new Proj('EPSG:4326', $proj4); // WGS84 좌표계

            $pointSrc = new Point($hospital['Coordinate_X'], $hospital['Coordinate_Y'], $tmProj);
            $pointDest = $proj4->transform($wgs84Proj, $pointSrc);

            $latitude = $pointDest->y; // 변환된 위도
            $longitude = $pointDest->x; // 변환된 경도
        }

        // 편의시설 정보를 추가
        $nearbyFacilities = $hospitalModel->getNearbyFacilities($hospital['Coordinate_X'], $hospital['Coordinate_Y']);

        return view('hospital/detail', [
            'hospital' => $hospital,
            'reviews' => $reviews,
            'nearbyFacilities' => $nearbyFacilities,
            'latitude' => $latitude,
            'longitude' => $longitude
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
