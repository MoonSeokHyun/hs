<!-- app/Views/store/index.php -->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>전국 타이어 판매소 </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* 전체 본문 초기화 */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .page-title {
            font-size: 2em;
            color: #62D491;
            text-align: center;
            margin-bottom: 30px;
        }
        .search-box {
            text-align: center;
            margin-bottom: 30px;
        }
        .search-box input {
            padding: 10px;
            width: 70%;
            max-width: 400px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1em;
        }
        .search-box button {
            padding: 10px 20px;
            margin-left: 5px;
            border: none;
            background-color: #3eaf7c;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        .search-box button:hover {
            background-color: #62d491;
        }
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .card {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
        .card h3 {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .card p {
            font-size: 0.95em;
            margin-bottom: 8px;
            color: #555;
        }
        .details-link {
            display: inline-block;
            margin-top: 10px;
            background-color: #62D491;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 0.95em;
        }
        .details-link:hover {
            background-color: #4db67d;
        }
        .pagination {
            text-align: center;
            margin-top: 40px;
        }
        .pagination a {
            display: inline-block;
            margin: 0 5px;
            padding: 8px 16px;
            background-color: #62D491;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 0.95em;
            transition: background-color 0.2s ease;
        }
        .pagination a:hover {
            background-color: #4db67d;
        }
        .pagination .active a {
            background-color: #3eaf7c;
        }
    </style>
</head>
<body>
    <?php include APPPATH . 'Views/includes/header.php'; ?>
    <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
    <div class="container">
        <h1 class="page-title">전국 타이어 판매업소</h1>

        <!-- 카드 뷰 -->
        <div class="card-container">
            <?php if (! empty($stores) && is_array($stores)): ?>
                <?php foreach ($stores as $store): ?>
                    <div class="card">
                        <h3><?= esc($store['store_name']) ?></h3>
                        <p>Region: <?= esc($store['region']) ?></p>
                        <p>Phone: <?= esc($store['phone_number']) ?></p>
                        <a href="<?= site_url('stores/' . $store['id']) ?>" class="details-link">Details</a>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <p>No stores found.</p>
            <?php endif ?>
        </div>

    <?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
