<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\FestivalInfoModel;
use CodeIgniter\HTTP\CURLRequest;

class UpdateFestivalInfo extends BaseCommand
{
    protected $group = 'Custom';
    protected $name = 'update:festival-info';
    protected $description = 'Updates festival information from external API and stores it in the database.';

    public function run(array $params = [])
    {
        $apiKey = 'laaaH4+nm2VrDZAve3+7kNvJitTpHwJWPA38HpR69+Neba1ZiPpPyb8mxneuCSZSeVo0nuySuUSuLjCNLSPAiw=='; // API 인증키
        $url = 'http://api.data.go.kr/openapi/tn_pubr_public_cltur_fstvl_api'; // API 엔드포인트

        $pageNo = 1; // 페이지 번호 (1 페이지 기준)
        $numOfRows = 2000; // 하루에 가져올 데이터 수 (최대 10개)

        // 요청할 파라미터 설정
        $params = [
            'serviceKey' => $apiKey,
            'pageNo' => $pageNo,           // 첫 번째 페이지
            'numOfRows' => $numOfRows,     // 한 페이지당 10개 항목
            'type' => 'json',              // 응답 형식 (JSON)
        ];

        $curl = service('curlrequest'); // CodeIgniter의 CURL 라이브러리 사용

        try {
            $response = $curl->get($url, ['query' => $params]);

            if ($response) {
                $responseBody = $response->getBody();
                CLI::write('API Response: ' . $responseBody, 'green'); // 응답 출력

                $data = json_decode($responseBody, true);
                CLI::write('Data Structure: ' . print_r($data, true), 'green'); // 응답 구조 출력

                $festivals = $data['response']['body']['items']['item'] ?? [];

                if (!empty($festivals)) {
                    $model = new FestivalInfoModel();

                    foreach ($festivals as $festival) {
                        // API에서 받은 데이터를 모델을 통해 저장
                        $festivalData = [
                            'Festival_Name' => $festival['fstvlNm'] ?? 'Unknown',
                            'Venue' => $festival['opar'] ?? 'Unknown',
                            'Start_Date' => $festival['fstvlStartDate'] ?? '2024-01-01',
                            'End_Date' => $festival['fstvlEndDate'] ?? '2024-01-01',
                            'Description' => $festival['fstvlCo'] ?? '',
                            'Organizing_Agency' => $festival['mnnstNm'] ?? '',
                            'Hosting_Agency' => $festival['auspcInsttNm'] ?? '',
                            'Supporting_Agency' => $festival['suprtInsttNm'] ?? '',
                            'Contact_Number' => $festival['phoneNumber'] ?? '',
                            'Website_URL' => $festival['homepageUrl'] ?? '',
                            'Related_Information' => $festival['relateInfo'] ?? '',
                            'Address_Road' => $festival['rdnmadr'] ?? '',
                            'Address_Land' => $festival['lnmadr'] ?? '',
                            'Latitude' => $festival['latitude'] ?? null,
                            'Longitude' => $festival['longitude'] ?? null,
                            'Data_Reference_Date' => $festival['referenceDate'] ?? '2024-01-01',
                            'Provider_Code' => $festival['instt_code'] ?? '',
                            'Provider_Name' => $festival['instt_nm'] ?? '',
                        ];

                        // 기존 데이터를 찾기
                        if ($model->exists($festival['fstvlNm'])) {
                            // 데이터가 이미 존재하면 변경된 항목만 업데이트
                            $existingFestival = $model->where('Festival_Name', $festival['fstvlNm'])->first();
                            $isUpdated = false;

                            // 기존 데이터와 비교하여 변경된 항목만 업데이트
                            foreach ($festivalData as $key => $value) {
                                if ($existingFestival[$key] != $value) {
                                    $existingFestival[$key] = $value;
                                    $isUpdated = true;
                                }
                            }

                            if ($isUpdated) {
                                $model->update($existingFestival['id'], $existingFestival);
                                CLI::write('Updated: ' . $festival['fstvlNm'], 'green');
                            } else {
                                CLI::write('No changes: ' . $festival['fstvlNm'], 'yellow');
                            }
                        } else {
                            // 데이터가 없으면 새로 추가
                            $model->save($festivalData);
                            CLI::write('Added: ' . $festival['fstvlNm'], 'green');
                        }
                    }
                } else {
                    CLI::write('No festival data found in the response.', 'yellow');
                }
            }
        } catch (\Exception $e) {
            CLI::error('Error fetching data from API: ' . $e->getMessage());
        }
    }
}
