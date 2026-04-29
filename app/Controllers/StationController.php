<?php

namespace App\Controllers;

use App\Models\StationModel;

class StationController extends BaseController
{
    public function index()
    {
        $model = new StationModel();
        
        // Get current page from the URL, default to 1 if not set
        $page = $this->request->getVar('page') ?: 1;

        // Get stations for current page
        $data['stations'] = $model->getStations($page);
        
        // Get pagination links
        $data['pager'] = $model->pager;

        return view('charging_station/index', $data);
    }

    public function detail($id)
    {
        $model = new StationModel();
        
        // Fetch station details by ID
        $data['station'] = $model->find($id);

        if (!$data['station']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Station not found');
        }

        $s = $data['station'];
        $label = (string) ($s['Service'] ?? $s['Company'] ?? $s['FullAddress'] ?? '');

        $data['blog_posts'] = $this->naverBlogSearch($label, '충전소');
        $data['map_link_query'] = (string) ($s['FullAddress'] ?? $label);

        return view('charging_station/detail', $data);
    }
}
