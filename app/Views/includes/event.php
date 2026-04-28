<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>스크래치 복권</title>
    <style>
        /* 이 페이지에서만 적용되는 스타일 */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
            background-color: #f7f8fa;
        }
        .message {
            font-size: 1.5rem;
            color: #333;
        }
        .message.success {
            color: green;
        }
        .message.error {
            color: red;
        }
        .container {
            width: 320px;
            height: 250px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .scratch-card {
            width: 100%;
            height: 150px;
            background-color: #ddd;
            margin: 20px 0;
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .scratch-layer {
            width: 100%;
            height: 100%;
            background-color: #333;
            position: absolute;
            top: 0;
            left: 0;
            cursor: pointer;
            opacity: 0.8;
            pointer-events: auto;
        }
        .scratch-layer.revealed {
            opacity: 0;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #E8653A;
            color: white;
            font-size: 1.2rem;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #4cb57a;
        }
        .hidden {
            visibility: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>스크래치 복권</h1>
        <p class="message" id="result-message">결과를 확인하려면 복권을 긁어주세요!</p>
        <p>당첨 확률: 70%</p>
        <p>오늘 0번 시도하셨습니다. 내일 다시 시도해 주세요!</p>

        <a href="?refresh=true" class="button">다시 시도</a>

        <div class="scratch-card">
            <div class="scratch-layer" id="scratch-layer"></div>
        </div>
    </div>

    <script>
        const scratchLayer = document.getElementById('scratch-layer');
        const ctx = scratchLayer.getContext('2d');
        const resultMessage = document.getElementById('result-message');
        const scratchSize = 20; // 긁는 크기
        ctx.fillStyle = '#333';
        ctx.fillRect(0, 0, scratchLayer.width, scratchLayer.height);

        let isScratched = false;

        // 마우스 및 터치 이벤트로 긁기
        const startScratching = (e) => {
            const rect = scratchLayer.getBoundingClientRect();
            const x = (e.clientX || e.touches[0].clientX) - rect.left;
            const y = (e.clientY || e.touches[0].clientY) - rect.top;
            ctx.globalCompositeOperation = 'destination-out';
            ctx.beginPath();
            ctx.arc(x, y, scratchSize, 0, Math.PI * 2, false);
            ctx.fill();
        };

        scratchLayer.addEventListener('mousemove', (e) => {
            if (e.buttons === 1) { // 마우스 왼쪽 버튼이 눌려 있을 때만 긁음
                startScratching(e);
            }
        });

        scratchLayer.addEventListener('touchmove', (e) => {
            e.preventDefault();
            startScratching(e);
        });

        scratchLayer.addEventListener('mouseup', () => {
            checkScratch();
        });

        scratchLayer.addEventListener('touchend', () => {
            checkScratch();
        });

        // 스크래치 영역 체크
        const checkScratch = () => {
            if (isScratched) return;
            const imageData = ctx.getImageData(0, 0, scratchLayer.width, scratchLayer.height);
            const totalPixels = imageData.width * imageData.height;
            let scratchedPixels = 0;

            for (let i = 0; i < totalPixels; i++) {
                if (imageData.data[i * 4 + 3] === 0) scratchedPixels++;
            }

            const scratchPercentage = scratchedPixels / totalPixels;

            // 70% 이상 긁으면 결과 보여주기
            if (scratchPercentage > 0.7) {
                isScratched = true;
                setTimeout(() => {
                    resultMessage.textContent = "꽝입니다. 다시 시도해 보세요!";
                    setTimeout(() => {
                        resultMessage.textContent = "당첨! 🎉";
                    }, 5000); // 5초 후에 메시지
                }, 2000); // 2초 후 결과 보이기
            }
        };
    </script>
</body>
</html>
