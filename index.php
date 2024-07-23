<?php
$conn = new mysqli('localhost', 'root', '', 'perfume_shop_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfume Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="shop.php">Shop</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Welcome to Our Perfume Shop</h1>
        <div class="product-list">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="product">
                    <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    <h2><?php echo $row['name']; ?></h2>
                    <p><?php echo $row['description']; ?></p>
                    <p>$<?php echo $row['price']; ?></p>
                    <a href="shop.php?add=<?php echo $row['id']; ?>">Add to Cart</a>
                </div>
            <?php endwhile; ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Perfume Shop</p>
    </footer>
</body>
</html>
