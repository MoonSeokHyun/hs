<?php
namespace App\Controllers;

use App\Models\GasStationModel;
use App\Models\GasStationReviewModel;

class GasStationController extends BaseController
{
    protected $gasStationModel;
    protected $reviewModel;

    public function __construct()
    {
        $this->gasStationModel = new GasStationModel();
        $this->reviewModel = new GasStationReviewModel();
    }

    public function index()
    {
        // 기본 주유소 리스트 및 페이징 처리
        $data['gasStations'] = $this->gasStationModel->paginate(5, 'gasStationsGroup');
        $data['pager'] = $this->gasStationModel->pager;
    
        // 최근 주유소와 리뷰 5개씩 가져오기
        $data['recentGasStations'] = $this->gasStationModel->getRecentGasStations();
        $data['recentReviews'] = $this->reviewModel->getRecentReviewsWithStationName();
        
        // 인기 주유소 가져오기 (조인 사용)
        $data['popularGasStations'] = $this->gasStationModel->getPopularGasStations();
    
        return view('gas_station/index', $data);
    }


    public function search()
    {
        $searchQuery = $this->request->getGet('search');

        // 검색어가 없을 때 빈 결과 반환
        if (!$searchQuery) {
            return redirect()->to('/gas_stations');
        }

        // 검색어를 통해 주유소 목록 검색
        $data['gasStations'] = $this->gasStationModel->getGasStations(10, 1, $searchQuery);

        // 검색 결과가 없으면 메시지 설정
        if (empty($data['gasStations'])) {
            $data['noResultsMessage'] = '검색 결과가 없습니다.';
        }

        // Pagination 링크 설정
        $data['pager'] = $this->gasStationModel->pager;

        return view('gas_station/index', $data);
    }

    // 주유소 상세 페이지
// 주유소 상세 페이지
public function detail($stationId)
{
    // 주유소 정보 가져오기
    $station = $this->gasStationModel->getGasStation($stationId);

    // 주유소 좌표를 기준으로 3km 내의 다른 주유소 정보 가져오기
    $nearbyGasStations = $this->gasStationModel->getNearbyGasStations($station['latitude'], $station['longitude']);

    // 해당 주유소의 모든 리뷰 가져오기
    $reviews = $this->reviewModel->getReviewsByStationId($stationId);

    // 리뷰 평균 평점 가져오기
    $averageRating = $this->gasStationModel->getAverageRating($stationId);

    // 유가 정보 생성
    $gasolinePrice = rand(1500, 1700);
    $dieselPrice = rand(1300, 1399);
    $premiumGasolinePrice = rand(1800, 1900);
    $kerosenePrice = rand(900, 1100);

    // 지도에 마커 표시 및 유가 정보 출력
    return view('gas_station/detail', [
        'station' => $station,
        'nearbyGasStations' => $nearbyGasStations,
        'reviews' => $reviews,
        'averageRating' => $averageRating,
        'gasolinePrice' => $gasolinePrice,
        'dieselPrice' => $dieselPrice,
        'premiumGasolinePrice' => $premiumGasolinePrice,
        'kerosenePrice' => $kerosenePrice,
    ]);
}

    // 리뷰 저장 처리
    public function saveComment()
    {
        $stationId = $this->request->getPost('station_id');
        $rating = $this->request->getPost('rating');
        $commentText = $this->request->getPost('comment_text');

        // 리뷰 및 평점 저장
        $this->reviewModel->save([
            'station_id' => $stationId,
            'rating' => $rating,
            'comment_text' => $commentText
        ]);

        return redirect()->back()->with('message', '리뷰가 성공적으로 저장되었습니다.');
    }
}