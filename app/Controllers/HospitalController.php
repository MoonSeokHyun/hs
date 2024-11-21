<?php

namespace App\Controllers;

use App\Models\HospitalModel;
use App\Models\ReviewModel;
use proj4php\Proj4php;
use proj4php\Proj;
use proj4php\Point;
use App\Models\EventCrawlingModel;

class HospitalController extends BaseController
{
    public function index()
{
    $hospitalModel = new HospitalModel();
    $reviewModel = new ReviewModel();
    $eventModel = new EventCrawlingModel();

    // 진행 중인 이벤트 데이터 가져오기
    $events = cache()->remember('ongoing_events', 600, function () use ($eventModel) {
        return $eventModel->where('status', '진행중')
            ->orderBy('updated_at', 'DESC')
            ->findAll(10);
    });

    // 병원 카테고리 정의
    $categories = [
        '부속의료기관', '안전상비의약품 판매업소',
        '응급환자이송업', '의료유사업'
    ];

    $data = [
        'events' => $events,
    ];

    // 카테고리별 병원 조회 및 캐시 처리
    $data['hospitalsByCategory'] = $this->fetchHospitalsByCategory($hospitalModel, $reviewModel, $categories);

    // 인기 있는 시설과 최근 추가된 시설 캐싱된 데이터 가져오기
    $data['popularFacilities'] = cache()->remember('popularFacilities', 3600, function () use ($hospitalModel) {
        return $hospitalModel->getPopularFacilitiesByRating(10);
    });

    $data['recentlyAddedFacilities'] = cache()->remember('recentlyAddedFacilities', 3600, function () use ($hospitalModel) {
        return $hospitalModel->getRecentlyAddedFacilities(10);
    });

    // 최근 리뷰 캐시 설정
    $data['latestReviews'] = cache()->remember('latestReviews', 600, function () use ($reviewModel) {
        return $reviewModel->getLatestReviews(5);
    });

    return view('hospital/index', $data);
}

    // 카테고리별 병원을 캐시하고 리뷰 모델과 함께 가져오는 메서드
    private function fetchHospitalsByCategory($hospitalModel, $reviewModel, $categories)
    {
        $categoryData = [];
        foreach ($categories as $category) {
            $cacheKey = "hospitalsByCategory_{$category}";
            $hospitals = cache()->get($cacheKey);

            if (!$hospitals) {
                $hospitals = $hospitalModel->getHospitalsByCategory($category, 10);
                foreach ($hospitals as &$hospital) {
                    $ratingData = $reviewModel->getAverageRatingByHospital($hospital['ID']);
                    $hospital['average_rating'] = $ratingData['average_rating'] ?? 0;
                    $hospital['review_count'] = $ratingData['review_count'] ?? 0;
                }
                cache()->save($cacheKey, $hospitals, 3600);
            }
            $categoryData[$category] = $hospitals;
        }

        return $categoryData;
    }

    public function detail($id)
    {
        try {
            $hospitalModel = new HospitalModel();
            $reviewModel = new ReviewModel();
    
            // 병원 상세 정보를 캐시 처리
            $hospitalCacheKey = "hospital_detail_{$id}";
            $hospital = cache()->get($hospitalCacheKey);
            
            if (!$hospital) {
                $hospital = $hospitalModel->find($id);
                cache()->save($hospitalCacheKey, $hospital, 3600);
            }
    
            if (!$hospital) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Hospital with ID {$id} not found");
            }
    
            // 병원 리뷰와 평점 요약 정보 가져오기
            $reviews = $reviewModel->getReviewsByHospital($id);
            $ratingSummary = $hospitalModel->getHospitalRatingSummary($id);
    
            // 좌표 변환 캐시
            $coordsCacheKey = "hospital_coords_{$id}";
            $coords = cache()->get($coordsCacheKey);
            
            if (!$coords && isset($hospital['Coordinate_X'], $hospital['Coordinate_Y'])) {
                $proj4 = new Proj4php();
                $tmProj = new Proj('EPSG:5186', $proj4); 
                $wgs84Proj = new Proj('EPSG:4326', $proj4); 
    
                $pointSrc = new Point($hospital['Coordinate_X'], $hospital['Coordinate_Y'], $tmProj);
                $pointDest = $proj4->transform($wgs84Proj, $pointSrc);
    
                $coords = ['latitude' => $pointDest->y, 'longitude' => $pointDest->x];
                cache()->save($coordsCacheKey, $coords, 3600);
            }
    
            // 주변 시설 정보 캐시 및 가져오기
            $nearbyCacheKey = "nearby_facilities_{$id}";
            $nearbyFacilities = cache()->get($nearbyCacheKey);
            
            if (!$nearbyFacilities) {
                $nearbyFacilities = $hospitalModel->getNearbyFacilities($coords['latitude'], $coords['longitude']);
                cache()->save($nearbyCacheKey, $nearbyFacilities, 3600);
            }
    
            return view('hospital/detail', [
                'hospital' => $hospital,
                'reviews' => $reviews,
                'ratingSummary' => $ratingSummary,
                'nearbyFacilities' => $nearbyFacilities,
                'latitude' => $coords['latitude'],
                'longitude' => $coords['longitude']
            ]);
    
        } catch (\Exception $e) {
            // 에러 발생 시 HTML 형식으로 에러 메시지 출력
            return view('error_template', [
                'errorMessage' => $e->getMessage()
            ]);
        }
    }
    

    public function addReview()
    {
        $reviewModel = new ReviewModel();

        $data = [
            'hospital_id' => $this->request->getPost('hospital_id'),
            'user_name'   => $this->request->getPost('user_name'),
            'rating'      => $this->request->getPost('rating'),
            'comment'     => $this->request->getPost('comment'),
        ];

        $reviewModel->save($data);

        // 리뷰 저장 후 캐시 삭제
        cache()->delete("hospital_detail_{$data['hospital_id']}_reviews");

        return redirect()->to('/hospital/detail/' . $data['hospital_id']);
    }
    public function search()
    {
        $hospitalModel = new HospitalModel();
        $query = $this->request->getGet('query');
    
        $results = [];
        if (!empty($query)) {
            $results = $hospitalModel->searchHospitalsByName($query, 20);
        }
    
        return view('hospital/search', [
            'results' => $results,
            'searchQuery' => $query
        ]);
    }
    
}
