<?php namespace App\Models;

use CodeIgniter\Model;

class StoreInfoModel extends Model
{
    protected $table            = 'store_info';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'longitude',
        'latitude',
        'address',
        'road_address',
        'business_registration_number',
        'branch_id',
        'region',
        'store_name',
        'phone_number',
        'notes',
        'services_offered',
    ];

    /**
     * Retrieves URLs for all stores formatted for sitemap generation.
     *
     * @param string $baseUrl Base URL of the site (e.g., https://example.com)
     * @return array List of sitemap entries with 'loc' and optional 'lastmod'.
     */
    public function getSitemapUrls(string $baseUrl): array
    {
        // Fetch all store records
        $stores = $this->findAll();
        $urls   = [];

        foreach ($stores as $store) {
            $urls[] = [
                'loc' => rtrim($baseUrl, '/') . '/stores/' . $store['id'],
                // Uncomment below if you have an 'updated_at' field
                // 'lastmod' => date('c', strtotime($store['updated_at'] ?? 'now'))
            ];
        }

        return $urls;
    }
}
