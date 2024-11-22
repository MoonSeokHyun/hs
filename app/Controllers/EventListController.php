<?php

namespace App\Controllers;

use App\Models\EventCrawlingModel;

class EventListController extends BaseController
{
    public function index()
    {
        $eventModel = new EventCrawlingModel();

        // 모든 이벤트 가져오기 (페이징 포함)
        $allEvents = $eventModel->orderBy('updated_at', 'DESC')->paginate(4);

        // 페이징 객체 가져오기
        $pager = $eventModel->pager;

        return view('event/index', [
            'allEvents' => $allEvents,
            'pager' => $pager,
        ]);
    }
    public function detail($id)
    {
        $eventModel = new EventCrawlingModel();
        $event = $eventModel->find($id);

        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Event with ID $id not found.");
        }

        return view('event/detail', ['event' => $event]);
    }
}
