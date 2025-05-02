<?php namespace App\Controllers;

use App\Models\StoreInfoModel;
use CodeIgniter\Controller;

class StoreInfoController extends Controller
{
    public function index()
    {
        $model = new StoreInfoModel();
        // 최대 12개만 가져오기
        $data['stores'] = $model->findAll(12);
        echo view('store/index', $data);
    }

    public function detail($id = null)
    {
        $model = new StoreInfoModel();
        $data['store'] = $model->find($id);

        if (empty($data['store'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Store not found: ' . $id);
        }

        echo view('store/detail', $data);
    }
}
