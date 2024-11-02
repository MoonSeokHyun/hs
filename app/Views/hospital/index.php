<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ease Hub</title>
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
            font-size: 2.2em;
            font-weight: 500;
        }
        .category {
            margin-bottom: 40px;
            width: 100%;
            max-width: 800px;
        }
        .category h2 {
            text-align: left;
            font-size: 1.5em;
            color: #333;
            margin-bottom: 15px;
            font-weight: 400;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .carousel {
            overflow: hidden;
            position: relative;
            border-radius: 8px;
        }
        .card-container {
            display: flex;
            transition: transform 0.3s ease-in-out;
        }
        .card {
            min-width: 100%;
            box-sizing: border-box;
            padding: 20px;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            text-align: left;
            height: 180px;
            border: 1px solid #eee;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .card:hover {
            background-color: #f1f1f1;
        }
        .card h2 {
            margin: 0 0 10px;
            font-size: 1.2em;
            color: #333;
            font-weight: 400;
        }
        .card p {
            margin: 4px 0;
            color: #666;
            font-size: 0.9em;
            line-height: 1.4em;
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
            background-color: transparent;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            color: #007bff;
            opacity: 0.6;
            transition: opacity 0.3s;
        }
        .nav-button:hover {
            opacity: 1;
        }
    </style>
</head>
<body>
    <h1>Ease Hub </h1>
    <?php foreach ($hospitalsByCategory as $category => $hospitals): ?>
        <div class="category">
            <h2><?= esc($category); ?></h2>
            <div class="carousel">
                <div class="card-container" id="container-<?= esc($category); ?>">
                    <?php if (!empty($hospitals) && is_array($hospitals)): ?>
                        <?php foreach ($hospitals as $hospital): ?>
                            <a href="/hospitals/detail/<?= esc($hospital['ID']); ?>" class="card">
                                <h2><?= esc($hospital['BusinessName']); ?></h2>
                                <p><strong>Address:</strong> <?= esc($hospital['FullAddress']); ?></p>
                                <p><strong>Phone:</strong> <?= esc($hospital['PhoneNumber']); ?></p>
                                <p><strong>Permit Date:</strong> <?= esc($hospital['PermitDate']); ?></p>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="card">
                            <h2>No Hospitals Found</h2>
                            <p>There are no hospital records available for this category at the moment.</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="navigation">
                    <button class="nav-button" onclick="prevSlide('<?= esc($category); ?>')">&#10094;</button>
                    <button class="nav-button" onclick="nextSlide('<?= esc($category); ?>')">&#10095;</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <script>
        function updateSlide(category, index) {
            const container = document.getElementById(`container-${category}`);
            const cardWidth = container.querySelector('.card').offsetWidth;
            container.style.transform = `translateX(-${index * cardWidth}px)`;
        }

        const slideIndices = {};

        <?php foreach ($hospitalsByCategory as $category => $hospitals): ?>
            slideIndices['<?= esc($category); ?>'] = 0;
        <?php endforeach; ?>

        function nextSlide(category) {
            const container = document.getElementById(`container-${category}`);
            const cards = container.querySelectorAll('.card');
            if (slideIndices[category] < cards.length - 1) {
                slideIndices[category]++;
            } else {
                slideIndices[category] = 0;
            }
            updateSlide(category, slideIndices[category]);
        }

        function prevSlide(category) {
            const container = document.getElementById(`container-${category}`);
            const cards = container.querySelectorAll('.card');
            if (slideIndices[category] > 0) {
                slideIndices[category]--;
            } else {
                slideIndices[category] = cards.length - 1;
            }
            updateSlide(category, slideIndices[category]);
        }
    </script>
</body>
</html>
