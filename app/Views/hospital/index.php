<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital List</title>
</head>
<body>
    <h1>Hospital List</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Business Name</th>
                <th>Full Address</th>
                <th>Phone Number</th>
                <th>Permit Date</th>
                <th>Test</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hospitals as $hospital): ?>
                <tr>
                    <td><?= $hospital['ID']; ?></td>
                    <td><?= esc($hospital['BusinessName']); ?></td>
                    <td><?= esc($hospital['FullAddress']); ?></td>
                    <td><?= esc($hospital['PhoneNumber']); ?></td>
                    <td><?= esc($hospital['PermitDate']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
