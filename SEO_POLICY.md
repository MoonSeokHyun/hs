# SEO 정책 문서

## 1. Canonical URL 정책

### 기본 원칙
- 각 페이지는 고유한 canonical URL을 가집니다.
- 검색 파라미터가 있는 경우에도 기본 URL을 canonical로 설정합니다.

### 적용 규칙
- **인덱스 페이지**: `/category` (검색 파라미터 무시)
- **디테일 페이지**: `/category/detail/{id}` (고유 ID 기반)
- **검색 페이지**: 검색 파라미터가 있어도 기본 인덱스 URL을 canonical로 설정

### 예외
- 페이지네이션: 각 페이지는 고유한 canonical URL 유지
- 필터링: 필터가 적용된 경우에도 기본 URL을 canonical로 설정

## 2. Robots 메타 태그 정책

### 기본값
```
robots: index, follow
```

### 적용 규칙
- **인덱스 페이지**: `index, follow`
- **디테일 페이지**: `index, follow`
- **검색 결과 페이지**: `index, follow` (검색어가 있는 경우)
- **에러 페이지**: `noindex, nofollow`

### 특수 케이스
- 검색 파라미터만 다른 중복 URL: `noindex, follow` (canonical로 정리)
- 관리자 페이지: `noindex, nofollow`

## 3. 구조화 데이터 (JSON-LD)

### 디테일 페이지
- **의료기관**: `MedicalBusiness` 타입
- **주차장**: `ParkingFacility` 타입
- **주유소**: `GasStation` 타입
- **세차장**: `CarWash` 타입
- **정비소**: `AutoRepair` 타입
- **숙박시설**: `LodgingBusiness` 타입

### 공통 필드
```json
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "시설명",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "주소"
  },
  "telephone": "전화번호",
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 위도,
    "longitude": 경도
  }
}
```

### 인덱스 페이지
- **타입**: `ItemList`
- **구조**: 각 항목을 `ListItem`으로 포함

## 4. 브레드크럼 네비게이션

### 구조
```json
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "홈",
      "item": "https://example.com/"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "카테고리",
      "item": "https://example.com/category"
    }
  ]
}
```

### 적용 페이지
- 모든 인덱스 페이지
- 모든 디테일 페이지
- 검색 결과 페이지

## 5. 네이버 검색엔진 최적화

### 메타 태그
- `naver-site-verification`: 사이트 소유 확인
- 모바일 친화적 메타 태그 포함

### 구조화 데이터
- Schema.org JSON-LD 형식 사용
- 네이버가 인식 가능한 구조 유지

### URL 구조
- 깔끔한 URL 구조 유지
- 검색 파라미터 최소화

## 6. Open Graph & Twitter Card

### 기본 필드
- `og:title`: 페이지 제목
- `og:description`: 페이지 설명
- `og:url`: 페이지 URL
- `og:type`: `website` (기본값)
- `og:image`: 대표 이미지

### Twitter Card
- `twitter:card`: `summary_large_image`
- `twitter:title`, `twitter:description`, `twitter:image` 포함

## 7. 페이지별 SEO 전략

### 홈페이지
- **타입**: `WebSite`
- **SearchAction** 포함 (검색 기능)
- 주요 카테고리 링크 제공

### 인덱스 페이지
- **타입**: `ItemList`
- 카테고리별 구조화 데이터
- 페이지네이션 정보 포함

### 디테일 페이지
- **타입**: 해당 시설 타입 (LocalBusiness 등)
- Geo 좌표 포함 (있는 경우)
- 리뷰 정보 포함 (있는 경우)

## 8. 성능 최적화

### 이미지
- `loading="lazy"` 속성 사용
- 적절한 alt 텍스트 제공

### 폰트
- Pretendard 폰트 사용 (한글 최적화)
- 폰트 preload 고려

### CSS/JS
- 공통 CSS 파일 분리
- 인라인 스타일 최소화

## 9. 모바일 최적화

### 반응형 디자인
- 모든 페이지 모바일 친화적
- 터치 친화적 버튼 크기
- 가독성 최적화

### 메타 태그
- `viewport` 설정
- `mobile-web-app-capable` 설정

## 10. 접근성 (A11y)

### ARIA 레이블
- 네비게이션에 `aria-label` 추가
- 버튼에 적절한 `aria-label` 제공

### 시맨틱 HTML
- 적절한 HTML5 시맨틱 태그 사용
- 헤딩 계층 구조 준수
