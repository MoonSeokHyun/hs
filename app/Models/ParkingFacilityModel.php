<?php namespace App\Models;

use CodeIgniter\Model;

class ParkingFacilityModel extends Model
{
    protected $table      = 'parking_facility';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'LCLAS_NM','MLSFC_NM','FCLTY_NM','CTPRVN_NM','SIGNGU_NM','LEGALDONG_CD','LEGALDONG_NM',
        'ADSTRD_CD','ADSTRD_NM','RDNMADR_CD','RDNMADR_NM','ZIP_NO','GID_CD','FCLTY_LO','FCLTY_LA',
        'MANAGE_NO','FLAG_NM','TY_NM','PARKNG_SPCE_CO','MANAGE_FLAG_NM','UTILIIZA_LMTT_FLAG_NM',
        'WKDAY_NM','WORKDAY_OPN_BSNS_TIME','WORKDAY_CLOS_TIME','SAT_OPN_BSNS_TIME','SAT_CLOS_TIME',
        'SUN_OPN_BSNS_TIME','SUN_CLOS_TIME','UTILIIZA_CHRGE_CN','BASS_TIME','BASS_PRICE',
        'ADIT_UNIT_TIME','ADIT_UNIT_PRICE','ONE_DAY_PARKNG_VLM_TIME','ONE_DAY_PARKNG_VLM_PRICE',
        'MT_FDRM_PRICE','SETLE_MTH_CN','ADIT_DC','MANAGE_INSTT_NM','TEL_NO','데이터기준일자',
        'PROVD_INSTT_CD','PROVD_INSTT_NM','LAST_CHG_DE','ORIGIN_NM','FILE_NM','BASE_DE'
    ];

    /**
     * 사이트맵용 URL 리스트를 생성합니다.
     *
     * @return array 각 아이템은 ['loc'=>URL, 'lastmod'=>ISO8601, 'changefreq'=>, 'priority'=>]
     */
    public function getSitemapEntries(): array
    {
        $rows = $this->select('id, FCLTY_NM, LAST_CHG_DE')
                     ->orderBy('id', 'ASC')
                     ->findAll();

        $entries = [];
        foreach ($rows as $r) {
            $entries[] = [
                'loc'        => site_url("parking-facilities/{$r['id']}"),
                'lastmod'    => isset($r['LAST_CHG_DE']) 
                                ? date('c', strtotime($r['LAST_CHG_DE'])) 
                                : date('c'),
                'changefreq' => 'monthly',
                'priority'   => '0.8',
            ];
        }

        return $entries;
    }
}
