<?php

namespace App\Controllers;

use App\Models\FestivalInfoModel;
use App\Models\EventDataModel;

class FestivalInfoController extends BaseController
{
    public function index()
    {
        $festivalModel = new FestivalInfoModel();
        $eventModel = new EventDataModel();

        $currentDate = date('Y-m-d');

        // 축제 데이터
        $festivals = $festivalModel->where('Start_Date <=', $currentDate)
                                   ->where('End_Date >=', $currentDate)
                                   ->findAll();

        // 공연 데이터
        $events = $eventModel->where('Event_Start_Date <=', $currentDate)
                             ->where('Event_End_Date >=', $currentDate)
                             ->findAll();

        // 축제 및 공연 데이터 결합
        $combinedData = [];
        foreach ($festivals as $festival) {
            if (isset($festival['id'])) {
                $festival['type'] = 'festival';
                $combinedData[] = $festival;
            }
        }
        foreach ($events as $event) {
            if (isset($event['ID'])) {
                $event['type'] = 'event';
                $combinedData[] = $event;
            }
        }

        // 페이지네이션 처리
        $currentPage = (int)($this->request->getGet('page') ?? 1);
        $itemsPerPage = 9;
        $totalItems = count($combinedData);
        $pagedData = array_slice($combinedData, ($currentPage - 1) * $itemsPerPage, $itemsPerPage);

        $pager = \Config\Services::pager();
        $pager->makeLinks($currentPage, $itemsPerPage, $totalItems);

        // 뷰로 데이터 전달
        $data = [
            'combinedData' => $pagedData,
            'pager' => $pager,
        ];

        return view('festival/index', $data);
    }

    public function detail($id)
    {
        $festivalModel = new FestivalInfoModel();
        $festival = $festivalModel->find($id);

        if (!$festival) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $relatedFestivals = $festivalModel->where('id !=', $id)
                                          ->where('End_Date >', date('Y-m-d'))
                                          ->findAll(3);

        return view('festival/detail', [
            'festival' => $festival,
            'relatedFestivals' => $relatedFestivals,
            'blog_posts' => $this->naverBlogSearch((string) ($festival['Festival_Name'] ?? ''), '축제'),
            'map_link_query' => (string) ($festival['Address_Road'] ?? $festival['Venue'] ?? $festival['Festival_Name'] ?? ''),
        ]);
    }

    public function eventDetail($id)
    {
        $eventModel = new EventDataModel();
        $event = $eventModel->find($id);

        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $relatedEvents = $eventModel->where('ID !=', $id)
                                    ->where('Event_End_Date >', date('Y-m-d'))
                                    ->findAll(3);

        return view('festival/eventdetail', [
            'event' => $event,
            'relatedEvents' => $relatedEvents,
            'blog_posts' => $this->naverBlogSearch((string) ($event['Event_Name'] ?? ''), '공연'),
            'map_link_query' => (string) ($event['Road_Address'] ?? $event['Location'] ?? $event['Event_Name'] ?? ''),
        ]);
    }
}
