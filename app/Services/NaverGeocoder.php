<?php

namespace App\Services;

/**
 * 네이버 지도 API를 사용한 지오코딩 서비스
 * 주소를 좌표로 변환하며, 주소 정리 후 최대 3회 시도
 */
class NaverGeocoder
{
    private $apiKeyId;
    private $apiKey;
    private $baseUrl = 'https://naveropenapi.apigw.ntruss.com/map-geocode/v2/geocode';

    public function __construct()
    {
        // .env에서 API 키 읽기
        $this->apiKeyId = getenv('NAVER_MAPS_API_KEY_ID') ?: 'c3hsihbnx3';
        $this->apiKey = getenv('NAVER_MAPS_API_KEY') ?: 'iyBYir1BVYhy4bW5XWB1wHGfUNyOit2Pz4g413ce';
    }

    /**
     * 주소를 정리하는 메서드
     * 
     * @param string $address 원본 주소
     * @return string 정리된 주소
     */
    private function normalizeAddress(string $address): string
    {
        // 공백 제거 및 정리
        $address = trim($address);
        
        // 불필요한 문자 제거
        $address = preg_replace('/\s+/', ' ', $address);
        
        // 괄호 안의 내용 제거 (상세 주소 등)
        $address = preg_replace('/\([^)]*\)/', '', $address);
        
        // 특수 문자 정리
        $address = preg_replace('/[^\w\s가-힣\-\.]/u', '', $address);
        
        return trim($address);
    }

    /**
     * 주소를 여러 형태로 변환하여 시도할 주소 배열 반환
     * 
     * @param string $address 원본 주소
     * @return array 시도할 주소 배열
     */
    private function getAddressVariations(string $address): array
    {
        $variations = [];
        
        // 1차: 원본 주소
        $variations[] = $address;
        
        // 2차: 정리된 주소
        $normalized = $this->normalizeAddress($address);
        if ($normalized !== $address) {
            $variations[] = $normalized;
        }
        
        // 3차: 시/도, 시/군/구만 추출
        if (preg_match('/([가-힣]+(?:시|도)\s+[가-힣]+(?:시|군|구))/u', $address, $matches)) {
            $variations[] = $matches[1];
        }
        
        // 중복 제거
        return array_unique($variations);
    }

    /**
     * 네이버 지오코딩 API 호출
     * 
     * @param string $address 주소
     * @return array|null 좌표 정보 (latitude, longitude) 또는 null
     */
    private function callGeocodingApi(string $address): ?array
    {
        $url = $this->baseUrl . '?query=' . urlencode($address);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-NCP-APIGW-API-KEY-ID: ' . $this->apiKeyId,
            'X-NCP-APIGW-API-KEY: ' . $this->apiKey,
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode !== 200) {
            return null;
        }
        
        $data = json_decode($response, true);
        
        if (isset($data['status']) && $data['status'] === 'OK' && !empty($data['addresses'])) {
            $firstResult = $data['addresses'][0];
            return [
                'latitude' => (float) $firstResult['y'],
                'longitude' => (float) $firstResult['x'],
                'roadAddress' => $firstResult['roadAddress'] ?? '',
                'jibunAddress' => $firstResult['jibunAddress'] ?? '',
            ];
        }
        
        return null;
    }

    /**
     * 주소를 좌표로 변환 (최대 3회 시도)
     * 
     * @param string $address 주소
     * @param int $maxRetries 최대 시도 횟수 (기본값: 3)
     * @return array|null 좌표 정보 또는 null
     */
    public function geocode(string $address, int $maxRetries = 3): ?array
    {
        if (empty($address)) {
            return null;
        }
        
        $variations = $this->getAddressVariations($address);
        $attempts = 0;
        
        foreach ($variations as $variation) {
            if ($attempts >= $maxRetries) {
                break;
            }
            
            $result = $this->callGeocodingApi($variation);
            
            if ($result !== null) {
                return $result;
            }
            
            $attempts++;
            
            // API 호출 간 짧은 대기 (너무 빠른 요청 방지)
            if ($attempts < $maxRetries) {
                usleep(100000); // 0.1초 대기
            }
        }
        
        return null;
    }

    /**
     * 좌표가 있는지 확인
     * 
     * @param array|null $coords 좌표 배열
     * @return bool
     */
    public static function hasCoordinates(?array $coords): bool
    {
        return $coords !== null 
            && isset($coords['latitude']) 
            && isset($coords['longitude'])
            && is_numeric($coords['latitude'])
            && is_numeric($coords['longitude']);
    }
}
