<?php
// Connection parameters (replace with your database credentials)
$host = 'db';
$username = 'root';
$password = 'qwerty';
$dbname = 'web02';

// Establishing connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Process form submission
if (isset($_POST['submit'])) {
    $name = '%' . $_POST['search'] . '%';
    $category = '%' . $_POST['category'] . '%';

    $sql = "SELECT name, category, price FROM products WHERE name LIKE '$name' AND category LIKE '$category'";

    try {
        $result = $conn->query($sql);
        echo "<div class='container'>";
        echo "<h2>Search Results:</h2>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>Name: " . htmlspecialchars($row["name"]) . ", Category: " . htmlspecialchars($row["category"]) . ", Price: $" . htmlspecialchars($row["price"]) . "</p>";
            }
        } else {
            echo "<p>No results found.</p>";
        }
        echo "</div>";
    } catch (Exception $e) {
        echo "<div class='container'>";
        echo "<h2>Search Results:</h2>";
        echo "<p>$e</p>";
    }



    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Product Search</title>
    <style>
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
        }

        form {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        input[type="text"],
        select,
        input[type="submit"] {
            margin: 5px;
            padding: 10px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            margin: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Product Search</h1>
        <form method="post" action="">
            <input type="text" name="search" placeholder="Enter product name">
            <select name="category">

                <option value="shirt">shirt</option>
                <option value="pant">pant</option>
                <option value="accessory">accessory</option>
                <option value="shoes">shoes</option>
            </select>
            <input type="submit" name="submit" value="Search"></input>
        </form>
    </div>
</body>

</html>