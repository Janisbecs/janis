<!DOCTYPE html>
<html lang="lv">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css?family=Amatic+SC|Raleway"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="styles.css" />
    <title>pieteiksanas</title>
  </head>
  <body>
    <header><h1>MW grupa</h1></header>
    <section class="hero">
      <div class="background-image"></div>
      <div class="hero-content-area">
        <div class="container">

            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
  
                $conn = new mysqli($servername, $username, $password);
  
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
  
                // Create database
                $sql = "CREATE DATABASE IF NOT EXISTS box_club";
                if ($conn->query($sql) === TRUE) {
                    //echo "Database created successfully";
                } else {
                    echo "Error creating database: " . $conn->error;
                }
                $conn->select_db("box_club");

                $sql = "DROP TABLE IF EXISTS middle";
                if ($conn->query($sql) === TRUE) {
                    $sql = "CREATE TABLE middle (
                        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(50) NOT NULL,
                        surname VARCHAR(50) NOT NULL,
                        age INT(50) NOT NULL,
                        comment VARCHAR(200),
                        gender VARCHAR(10) NOT NULL
                        ) 
                        AS
                        SELECT *
                        FROM all_guys
                        WHERE age > 12 AND age < 66";
                    if ($conn->query($sql) === TRUE) {
                        //echo "Table created successfully";
                    } else {
                        echo "Error creating table: " . $conn->error;
                    }
                } else {
                    echo "Error dropping table: " . $conn->error;
                }

                // Fetch data from juniors table
                $sql = "SELECT * FROM middle";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row in a table
                    echo "<table><tr><th>Vārds</th><th>Uzvārds</th><th>Vecums</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["surname"] . "</td><td>" . $row["age"] . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }
                $conn->close();
            ?>

            <br><br><a href="index.html" class="btn" style="color: white">Atpakaļ uz sākumlapu</a>
        </div>
      </div>
    </section>
  </body>
</html>
