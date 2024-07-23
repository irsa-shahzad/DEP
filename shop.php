<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'perfume_shop_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['add'])) {
    $product_id = intval($_GET['add']);
    $result = $conn->query("SELECT * FROM products WHERE id = $product_id");
    $product = $result->fetch_assoc();
    $_SESSION['cart'][] = $product;
}

if (isset($_POST['checkout'])) {
    // Handle checkout
    // For simplicity, we'll just clear the cart
    $_SESSION['cart'] = [];
    echo "Order placed successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
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
        <h1>Shopping Cart</h1>
        <form method="post">
            <?php if (!empty($_SESSION['cart'])): ?>
                <ul>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <li>
                            <?php echo $item['name']; ?> - $<?php echo $item['price']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <button type="submit" name="checkout">Checkout</button>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Perfume Shop</p>
    </footer>
</body>
</html>
