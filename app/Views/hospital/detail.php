<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>병원 상세 정보</title>
    <style>
        body {
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 2em;
        }
        .hospital-details {
            max-width: 800px;
            width: 100%;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
            color: #333;
        }
    </style>
</head>
<body>
    <h1><?= esc($hospital['BusinessName']); ?></h1>
    <div class="hospital-details">
        <table>
            <tr>
                <th>항목</th>
                <th>내용</th>
            </tr>
            <tr>
                <td>서비스명</td>
                <td><?= esc($hospital['OpenServiceName']); ?></td>
            </tr>
            <tr>
                <td>서비스 ID</td>
                <td><?= esc($hospital['OpenServiceID']); ?></td>
            </tr>
            <tr>
                <td>행정구역 코드</td>
                <td><?= esc($hospital['MunicipalityCode']); ?></td>
            </tr>
            <tr>
                <td>관리번호</td>
                <td><?= esc($hospital['ManagementNumber']); ?></td>
            </tr>
            <tr>
                <td>허가일자</td>
                <td><?= esc($hospital['PermitDate']); ?></td>
            </tr>
            <tr>
                <td>허가취소일자</td>
                <td><?= esc($hospital['PermitCancellationDate']); ?></td>
            </tr>
            <tr>
                <td>영업상태 코드</td>
                <td><?= esc($hospital['BusinessStatusCode']); ?></td>
            </tr>
            <tr>
                <td>영업상태명</td>
                <td><?= esc($hospital['BusinessStatusName']); ?></td>
            </tr>
            <tr>
                <td>세부 영업상태 코드</td>
                <td><?= esc($hospital['DetailedBusinessStatusCode']); ?></td>
            </tr>
            <tr>
                <td>세부 영업상태명</td>
                <td><?= esc($hospital['DetailedBusinessStatusName']); ?></td>
            </tr>
            <tr>
                <td>폐업일자</td>
                <td><?= esc($hospital['ClosureDate']); ?></td>
            </tr>
            <tr>
                <td>정지 시작일자</td>
                <td><?= esc($hospital['SuspensionStartDate']); ?></td>
            </tr>
            <tr>
                <td>정지 종료일자</td>
                <td><?= esc($hospital['SuspensionEndDate']); ?></td>
            </tr>
            <tr>
                <td>재개일자</td>
                <td><?= esc($hospital['ReopeningDate']); ?></td>
            </tr>
            <tr>
                <td>전화번호</td>
                <td><?= esc($hospital['PhoneNumber']); ?></td>
            </tr>
            <tr>
                <td>면적</td>
                <td><?= esc($hospital['Area']); ?>㎡</td>
            </tr>
            <tr>
                <td>우편번호</td>
                <td><?= esc($hospital['PostalCode']); ?></td>
            </tr>
            <tr>
                <td>주소</td>
                <td><?= esc($hospital['FullAddress']); ?></td>
            </tr>
            <tr>
                <td>도로명 주소</td>
                <td><?= esc($hospital['RoadNameFullAddress']); ?></td>
            </tr>
            <tr>
                <td>도로명 우편번호</td>
                <td><?= esc($hospital['RoadNamePostalCode']); ?></td>
            </tr>
            <tr>
                <td>사업장명</td>
                <td><?= esc($hospital['BusinessName']); ?></td>
            </tr>
            <tr>
                <td>마지막 업데이트 시간</td>
                <td><?= esc($hospital['LastUpdateTime']); ?></td>
            </tr>
            <tr>
                <td>데이터 갱신 유형</td>
                <td><?= esc($hospital['DataUpdateType']); ?></td>
            </tr>
            <tr>
                <td>데이터 갱신일자</td>
                <td><?= esc($hospital['DataUpdateDate']); ?></td>
            </tr>
            <tr>
                <td>사업 유형</td>
                <td><?= esc($hospital['BusinessType']); ?></td>
            </tr>
            <tr>
                <td>의료기관 유형</td>
                <td><?= esc($hospital['MedicalInstitutionType']); ?></td>
            </tr>
            <tr>
                <td>의료 인력 수</td>
                <td><?= esc($hospital['MedicalStaffCount']); ?>명</td>
            </tr>
            <tr>
                <td>입원실 수</td>
                <td><?= esc($hospital['InpatientRoomCount']); ?>개</td>
            </tr>
            <tr>
                <td>병상 수</td>
                <td><?= esc($hospital['BedCount']); ?>개</td>
            </tr>
            <tr>
                <td>총 면적</td>
                <td><?= esc($hospital['TotalArea']); ?>㎡</td>
            </tr>
            <tr>
                <td>의료부서 내용</td>
                <td><?= esc($hospital['MedicalDepartmentContent']); ?></td>
            </tr>
            <tr>
                <td>의료부서명</td>
                <td><?= esc($hospital['MedicalDepartmentName']); ?></td>
            </tr>
            <tr>
                <td>지정 취소 일자</td>
                <td><?= esc($hospital['DesignationCancellationDate']); ?></td>
            </tr>
            <tr>
                <td>호스피스 유형</td>
                <td><?= esc($hospital['PalliativeCareType']); ?></td>
            </tr>
            <tr>
                <td>호스피스 부서</td>
                <td><?= esc($hospital['PalliativeCareDepartment']); ?></td>
            </tr>
            <tr>
                <td>특수 구급차 수</td>
                <td><?= esc($hospital['SpecialAmbulanceCount']); ?>대</td>
            </tr>
            <tr>
                <td>일반 구급차 수</td>
                <td><?= esc($hospital['GeneralAmbulanceCount']); ?>대</td>
            </tr>
            <tr>
                <td>총 직원 수</td>
                <td><?= esc($hospital['TotalStaffCount']); ?>명</td>
            </tr>
            <tr>
                <td>구급 인력 수</td>
                <td><?= esc($hospital['RescueStaffCount']); ?>명</td>
            </tr>
            <tr>
                <td>허가 병상 수</td>
                <td><?= esc($hospital['LicensedBedCount']); ?>개</td>
            </tr>
            <tr>
                <td>초기 지정일자</td>
                <td><?= esc($hospital['InitialDesignationDate']); ?></td>
            </tr>
            <tr>
                <td>관리 기관</td>
                <td><?= esc($hospital['ManagementEntity']); ?></td>
            </tr>
        </table>
    </div>
</body>
</html>
