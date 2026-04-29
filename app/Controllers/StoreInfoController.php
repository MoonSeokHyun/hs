<?php namespace App\Controllers;

use App\Models\StoreInfoModel;

class StoreInfoController extends BaseController
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

        $st = $data['store'];
        $data['blog_posts'] = $this->naverBlogSearch((string) ($st['store_name'] ?? ''), '타이어');
        $data['map_link_query'] = (string) ($st['road_address'] ?? $st['address'] ?? $st['store_name'] ?? '');

        echo view('store/detail', $data);
    }
}
