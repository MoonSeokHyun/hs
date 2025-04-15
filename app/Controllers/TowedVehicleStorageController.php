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

        // 보관소 정보 가져오기
        $data['storage'] = $storageModel->find($id);

        return view('Towed/detail', $data);
    }
}
