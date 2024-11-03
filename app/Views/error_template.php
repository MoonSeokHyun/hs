<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>오류 발생</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8d7da;
            color: #721c24;
            margin: 0;
        }
        .error-container {
            text-align: center;
            background-color: #f8d7da;
            padding: 20px;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>에러가 발생했습니다</h1>
        <p>오류 메시지: <?= esc($errorMessage) ?></p>
        <p>잠시 후 다시 시도해 주세요.</p>
    </div>
</body>
</html>
