<?php

namespace App\Cells;

use App\Models\EventModel;

class EventSampleCell
{
    /**
     * 이벤트 데이터를 가져와 뷰를 렌더링합니다.
     *
     * @return string 렌더링된 HTML
     */
    public function render()
    {
        // EventModel 인스턴스 생성
        $eventModel = new EventModel();
        
        // 전체 이벤트 중 최대 3개 데이터 조회
        $events = $eventModel->findAll(3);

        // "includes/event_sample_view" 뷰 파일에 events 데이터를 전달하여 렌더링합니다.
        return view('includes/event_sample_view', ['events' => $events]);
    }
}
