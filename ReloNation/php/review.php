<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link rel="stylesheet" href="../css/rateus.css">
    <style>
        .rate-button {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            background-color: #00A19D;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
        }
        .rate-button:hover {
            background-color: #00A19D;
        }
        .review {
            background-color: #fff;
            color: #000;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            width: 300px;
        }
        .links{
            display:flex;
            width: 20%;
            justify-content :space-between;
        }
    </style>
</head>
<body>
    <h2>Reviews</h2>
    <div class="reviews-container">
    <?php
        include 'connection.php';

        $sql = "SELECT name, rating, title, description, timestamp FROM review ORDER BY timestamp DESC";
        $result = $db->query($sql);

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='review'>";
                echo "<h3>" . htmlspecialchars($row['title']) . " - " . htmlspecialchars($row['rating']) . " stars</h3>";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "<small>Reviewed by " . htmlspecialchars($row['name']) . " on " . htmlspecialchars($row['timestamp']) . "</small>";
                echo "</div>";
            }
        } else {
            echo "<p>No reviews yet.</p>";
        }

        $db = null; 
    ?>

    </div>

    <div class="links">
        <a href="../html/rateus.html" class="rate-button">Rate Us</a>
        <a href="../home.html" class="rate-button">Back</a>
    </div>

    
</body>
</html>






