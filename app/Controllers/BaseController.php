<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    /**
     * 네이버 블로그 검색 API (상세 페이지용).
     *
     * @param string $mainQuery 장소·상품명 등
     * @param string $suffix    검색 맥락 (예: '주차장', '주유소')
     * @return list<array<string, mixed>>
     */
    protected function naverBlogSearch(string $mainQuery, string $suffix = ''): array
    {
        $mainQuery = trim($mainQuery);
        if ($mainQuery === '') {
            return [];
        }

        $suffix = trim($suffix);
        $fullQuery = $suffix !== '' ? "{$mainQuery} {$suffix}" : $mainQuery;

        $clientId     = env('NAVER_SEARCH_CLIENT_ID', 'NlYld_Eq4rodExbK5pmQ');
        $clientSecret = env('NAVER_SEARCH_CLIENT_SECRET', 'KpyY5brELu');

        $url = 'https://openapi.naver.com/v1/search/blog.json?' . http_build_query([
            'query'   => $fullQuery,
            'display' => 5,
            'sort'    => 'sim',
        ]);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 5,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER     => [
                'X-Naver-Client-Id: '     . $clientId,
                'X-Naver-Client-Secret: ' . $clientSecret,
            ],
        ]);

        $raw  = curl_exec($ch);
        $http = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http !== 200 || ! $raw) {
            return [];
        }

        $json = json_decode($raw, true);

        return $json['items'] ?? [];
    }
}
