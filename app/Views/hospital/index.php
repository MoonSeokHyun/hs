<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HospitalHub</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
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
            color: #007bff;
            margin-bottom: 30px;
        }
        .carousel {
            width: 90%;
            max-width: 800px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .card-container {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .card {
            min-width: 100%;
            box-sizing: border-box;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
        }
        .card h2 {
            margin: 0 0 10px;
            font-size: 1.5em;
            color: #333;
        }
        .card p {
            margin: 5px 0;
            color: #555;
        }
        .navigation {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }
        .nav-button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 50%;
            opacity: 0.8;
        }
        .nav-button:hover {
            opacity: 1;
        }
    </style>
</head>
<body>
    <h1>HospitalHub</h1>
    <div class="carousel">
        <div class="card-container">
            <?php if (!empty($hospitals) && is_array($hospitals)): ?>
                <?php foreach ($hospitals as $hospital): ?>
                    <div class="card">
                        <h2><?= esc($hospital['BusinessName']); ?></h2>
                        <p><strong>Address:</strong> <?= esc($hospital['FullAddress']); ?></p>
                        <p><strong>Phone:</strong> <?= esc($hospital['PhoneNumber']); ?></p>
                        <p><strong>Permit Date:</strong> <?= esc($hospital['PermitDate']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="card">
                    <h2>No Hospitals Found</h2>
                    <p>There are no hospital records available at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="navigation">
            <button class="nav-button" onclick="prevSlide()">&#10094;</button>
            <button class="nav-button" onclick="nextSlide()">&#10095;</button>
        </div>
    </div>

    <script>
        const cardContainer = document.querySelector('.card-container');
        const cards = document.querySelectorAll('.card');
        let currentIndex = 0;

        function updateSlide() {
            cardContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        function nextSlide() {
            if (currentIndex < cards.length - 1) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateSlide();
        }

        function prevSlide() {
            if (currentIndex > 0) {
                currentIndex--;
            } else {
                currentIndex = cards.length - 1;
            }
            updateSlide();
        }
    </script>
</body>
</html>
