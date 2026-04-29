<?php

namespace App\Controllers;

use App\Models\TowedVehicleStorageModel;

class TowedVehicleStorageController extends BaseController
{
    public function index()
    {
        $model = new TowedVehicleStorageModel();

        // 검색 기능 처리
        $search = $this->request->getGet('search');
        
        // 검색된 보관소 목록 가져오기
        if ($search) {
            $data['storages'] = $model->like('towed_vehicle_storage_name', $search)
                                      ->orLike('address_road_name', $search)
                                      ->paginate(12, 'default', page: $this->request->getGet('page'));
        } else {
            $data['storages'] = $model->paginate(12, 'default', page: $this->request->getGet('page'));
        }

        // 검색어 전달
        $data['search'] = $search;
        
        // 페이지네이션 링크
        $data['pager'] = $model->pager;
        
        return view('Towed/index', $data);
    }

    public function detail($id)
    {
        $storageModel = new TowedVehicleStorageModel();

        $data['storage'] = $storageModel->find($id);

        if (empty($data['storage'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('해당 견인차 보관소 정보를 찾을 수 없습니다.');
        }

        $storage = $data['storage'];
        $lat = (float)($storage['latitude'] ?? 0);
        $lng = (float)($storage['longitude'] ?? 0);

        // 1km 이내 근처 보관소
        $data['nearby_storages'] = [];
        if ($lat && $lng) {
            $db = \Config\Database::connect();
            $data['nearby_storages'] = $db->query(
                "SELECT *, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance
                 FROM towed_vehicle_storage
                 WHERE id != ?
                 HAVING distance < 1
                 ORDER BY distance
                 LIMIT 5",
                [$lat, $lng, $lat, (int)$id]
            )->getResultArray();
        }

        // 블로그 검색
        $data['blog_posts'] = $this->naverBlogSearch($storage['towed_vehicle_storage_name'] ?? '', '견인 보관소');

        return view('Towed/detail', $data);
    }
}
