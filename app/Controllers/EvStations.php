<?php namespace App\Controllers;

use App\Models\EvStationsModel;

class EvStations extends BaseController
{
    public function index()
    {
        $model = new EvStationsModel();
        $data['stations'] = $model->findAll(12); // 최대 12개
        echo view('ev_stations/index', $data);
    }

    public function detail($id = null)
    {
        $model = new EvStationsModel();
        $station = $model->find($id);

        if (!$station) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Station #{$id} not found");
        }

        echo view('ev_stations/detail', [
            'station' => $station,
            'blog_posts' => $this->naverBlogSearch((string) ($station['facility_name'] ?? ''), '전기차 충전'),
            'map_link_query' => (string) ($station['full_address'] ?? $station['road_address'] ?? $station['facility_name'] ?? ''),
        ]);
    }
}
