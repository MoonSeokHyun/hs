<?php namespace App\Controllers;

use App\Models\ParkingFacilityModel;
use CodeIgniter\Controller;

class ParkingFacilityController extends Controller
{
    public function index()
    {
        $model = new ParkingFacilityModel();
        // ID 오름차순으로 정렬한 뒤, 상위 12개만 가져오기
        $data['facilities'] = $model
            ->orderBy('ID', 'ASC')
            ->findAll(12);
    
        echo view('parking_facility/index', $data);
    }

    public function detail($id = null)
    {
        $model = new ParkingFacilityModel();
        $data['facility'] = $model->find($id);
        if (!$data['facility']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("ID {$id} 시설을 찾을 수 없습니다.");
        }
        echo view('parking_facility/detail', $data);
    }
}
