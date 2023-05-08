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
    <title>profile</title>
  </head>
  <body>
    <header><h1>Profils</h1></header>
    <section class="hero">
      <div class="background-image"></div>
      <div class="hero-content-area">
        <div class="container">
            <?php 
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "box_club";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Retrieve username from loginform table where user_id matches $_SESSION['user_id']
                session_start();
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT user FROM loginform WHERE id = '$user_id'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $username = $row['user'];

                // Retrieve all values from all_guys table where user_id matches $_SESSION['user_id']
                $sql = "SELECT * FROM all_guys WHERE user_id = '$user_id'";
                $result = $conn->query($sql);

                // Display the data in a table
                echo "<table border='1'>
                    <tr>
                        <th>Lietotājvārds</th>
                        <th>Vārds</th>
                        <th>Uzvārds</th>
                        <th>Vecums</th>
                        <th>Komentāri</th>
                        <th>Dzimums</th>
                    </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $username . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['surname'] . "</td>";
                    echo "<td>" . $row['age'] . "</td>";
                    echo "<td>" . $row['comment'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";

                $conn->close();
            ?>
            <br><br><a href="home_loged.html" class="btn" style="color: white">Atpakaļ</a>
        </div>
      </div>
    </section>
  </body>
</html>
