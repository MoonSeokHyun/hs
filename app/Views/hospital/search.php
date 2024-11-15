<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>편의시설 검색 결과</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f9fc;
            color: #333;
        }

        .container {
            width: 80%;
            max-width: 900px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        .search-item {
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 8px;
            background-color: #fff;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .search-item:hover {
            background-color: #f0f8ff;
        }

        .search-item h3 {
            margin: 0;
            color: #007bff;
        }

        .search-item p {
            margin: 5px 0;
            color: #666;
        }

        .search-form {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-form input[type="text"] {
            padding: 10px;
            font-size: 1em;
            width: 80%;
            max-width: 400px;
            margin-right: 10px;
        }

        .search-form button {
            padding: 10px 20px;
            font-size: 1em;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>편의시설 검색</h1>
        <form class="search-form" method="get" action="/hospital/search">
            <input type="text" name="query" placeholder="편의시설 이름을 입력하세요" value="<?= esc($searchQuery ?? '') ?>">
            <button type="submit">검색</button>
        </form>

        <?php if (!empty($results)): ?>
            <h2>검색 결과</h2>
            <?php foreach ($results as $result): ?>
                <div class="search-item" onclick="location.href='/hospitals/detail/<?= esc($result['ID']); ?>'">
                    <h3><?= esc($result['BusinessName']); ?></h3>
                    <p>주소: <?= esc($result['FullAddress']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php elseif (isset($searchQuery)): ?>
            <p>검색 결과가 없습니다.</p>
        <?php endif; ?>
    </div>
</body>
</html>
