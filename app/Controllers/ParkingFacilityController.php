<?php namespace App\Controllers;

use App\Models\ParkingFacilityModel;

class ParkingFacilityController extends BaseController
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
        $f = $data['facility'];
        $data['blog_posts'] = $this->naverBlogSearch((string) ($f['FCLTY_NM'] ?? ''), '공영주차장');
        $addrParts = array_filter([
            $f['CTPRVN_NM'] ?? '',
            $f['SIGNGU_NM'] ?? '',
            $f['RDNMADR_NM'] ?? '',
        ]);
        $data['map_link_query'] = trim(implode(' ', $addrParts)) !== ''
            ? trim(implode(' ', $addrParts))
            : (string) ($f['FCLTY_NM'] ?? '');

        echo view('parking_facility/detail', $data);
    }
}
