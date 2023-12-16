<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wine Wishlist</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            margin: 20px;
            background-image: url('473240.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            color: #5a1814; /* Dark red for better readability on the background */
        }

        h2 {
            text-align: center;
            color: #f1eee6; /* Light beige for better contrast */
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            background-color: rgba(229, 189, 166, 0.9); /* Light wine color for the form */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #302a1d; /* Dark brown for label text */
        }

        input {
            width: 100%;
            padding: 10px; /* Slightly smaller padding for a more compact form */
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #9b291f; /* Wine red for the submit button */
            color: #f1eee6;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #5a1814; /* Darker red on hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: rgba(241, 238, 230, 0.9); /* Light beige for the table */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #afb0ab;
            padding: 12px;
            text-align: left;
            color: #302a1d; /* Dark brown for table text */
        }

        th {
            background-color: #9b291f; /* Wine red for table header */
            color: #f1eee6;
        }
    </style>
</head>
<body>
    <h2>Wine Wishlist</h2>
    
    <form action="wish1.php" method="post">
        <label for="name">Wine Name:</label>
        <input type="text" name="name" required>
        <label for="price">Price per Bottle:</label>
        <input type="number" step="0.001" name="price" required>
        <label for="quantity">Quantity:</label>
        <input type="number" step="1" name="quantity" required>

       

        <input type="submit" value="Add Wine to Wishlist">
    </form>

   

    <table>
        
        <?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wishlist";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    // Insert data into the database
    $sql = "INSERT INTO items (name,price,quantity) VALUES ('$name',$price,$quantity)";

    if ($conn->query($sql) === TRUE) {
        echo "New wine added to wishlist successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Display the entered wine details from the database
echo "<h2>Your Wishlist:</h2>";
echo "<table>";
echo "<tr><th>Name</th><th>Price</th><th>Quantity</th></tr>";

// Retrieve data from the database
$result = $conn->query("SELECT * FROM items");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['name']}</td><td>{$row['price']}</td><td>{$row['quantity']}</td></tr>";
    }
} else {
    echo "<tr><td colspan='5'>No wines found</td></tr>";
}

echo "</table>";

// Close the database connection
$conn->close();
?>
        <!-- Your PHP code to display the wine details goes here -->
    </table>
</body>
</html>
