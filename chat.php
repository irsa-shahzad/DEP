<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'realtime');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Insert new message into the database
    $username = $conn->real_escape_string($_POST['username']);
    $message = $conn->real_escape_string($_POST['message']);
    $sql = "INSERT INTO chat (username, message) VALUES ('$username', '$message')";
    $conn->query($sql);
}

// Fetch chat messages
$sql = "SELECT * FROM chat ORDER BY timestamp DESC";
$result = $conn->query($sql);
$messages = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="chat.php">Chat</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Chat</h1>
        <div id="chat-box">
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $msg): ?>
                    <div class="message">
                        <strong><?php echo htmlspecialchars($msg['username']); ?>:</strong>
                        <p><?php echo htmlspecialchars($msg['message']); ?></p>
                        <small><?php echo $msg['timestamp']; ?></small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No messages yet.</p>
            <?php endif; ?>
        </div>
        <form method="post" action="chat.php">
            <input type="text" name="username" placeholder="Your name" required>
            <textarea name="message" placeholder="Type your message here..." required></textarea>
            <button type="submit">Send</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Perfume Shop</p>
    </footer>

    <!-- JavaScript for real-time updates -->
    <script>
        function fetchMessages() {
            fetch('chat.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('chat-box').innerHTML = data;
                });
        }

        // Fetch messages every 5 seconds
        setInterval(fetchMessages, 5000);
    </script>
</body>
</html>
