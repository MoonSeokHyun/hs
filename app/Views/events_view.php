<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Event List</h1>
        <div class="row">
            <?php foreach ($events as $event): ?>
                <div class="col-md-6 mb-4">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <small class="float-left font-weight-bold"><?= $event['brand'] ?></small>
                            <small class="float-right"><?= $event['event_type'] ?></small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img src="<?= $event['image_url'] ?>" class="img-fluid" alt="Product Image">
                                </div>
                                <div class="col-8">
                                    <h5 class="card-title"><?= $event['product_name'] ?></h5>
                                    <p>
                                        <strong>Price:</strong> <?= number_format($event['price'], 2) ?> 원<br>
                                        <?php if ($event['original_price']): ?>
                                            <small class="text-muted">Original: <?= number_format($event['original_price'], 2) ?> 원</small><br>
                                        <?php endif; ?>
                                        <?php if ($event['discount_rate']): ?>
                                            <small class="text-danger">Discount: <?= $event['discount_rate'] ?>%</small>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="d-flex justify-content-center">
            <?= $pager ?>
        </div>
    </div>
</body>
</html>
