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
            session_start();
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "box_club";
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $user_id = $_SESSION['user_id'];

            // If the form has been submitted, update the user's profile
            if (isset($_POST['submit'])) {
                $name = isset($_POST['name']) ? $_POST['name'] : '';
                $surname = isset($_POST['surname']) ? $_POST['surname'] : '';
                $age = isset($_POST['age']) ? $_POST['age'] : '';
                $comment = isset($_POST['comment']) ? $_POST['comment'] : '';
                $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
            
                // Validate input fields
                if (!empty($name) && !empty($surname) && !empty($age) && !empty($comment) && !empty($gender)) {
                    $sql = "UPDATE all_guys SET name='$name', surname='$surname', age='$age', comment='$comment', gender='$gender' WHERE user_id='$user_id'";
                    if ($conn->query($sql) === TRUE) {
                        echo "Profils sekmīgi rediģēts";
                        echo "<br>";
                        echo "<br>";
                        header("Location: profile.php");
                        exit();
                    } else {
                        echo "Kļūda rediģējot profilu" . $conn->error;
                        echo "<br>";
                    }
                }
            }
            
            // Retrieve username from loginform table where user_id matches $_SESSION['user_id']
            $sql = "SELECT user FROM loginform WHERE id = '$user_id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $username = $row['user'];
            
            // Retrieve all values from all_guys table where user_id matches $_SESSION['user_id']
            $sql = "SELECT * FROM all_guys WHERE user_id = '$user_id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            
            // Display the data in a form for editing
            echo "<form method='post'>";
            echo "<label for='username'>Lietotājvārds:</label>";
            echo "<input type='text' name='username' value='$username' disabled><br><br>";
            echo "<label for='name'>Vārds:</label>";
            echo "<input type='text' name='name' value='" . $row['name'] . "'><br><br>";
            echo "<label for='surname'>Uzvārds:</label>";
            echo "<input type='text' name='surname' value='" . $row['surname'] . "'><br><br>";
            echo "<label for='age'>Vecums:</label>";
            echo "<input type='text' name='age' value='" . $row['age'] . "'><br><br>";
            echo "<label for='comment'>Komentāri:</label>";
            echo "<input type='text' name='comment' value='" . $row['comment'] . "'><br><br>";
            echo "<label for='gender'>Dzimums:</label>";
            echo "<input type='text' name='gender' value='" . $row['gender'] . "'><br><br>";
            echo "<input type='submit' name='submit' value='Saglabāt izmaiņas'>";
            echo "</form>";
            
            if (isset($_POST['delete'])) {
              $sql = "DELETE FROM all_guys WHERE user_id='$user_id'";
              if ($conn->query($sql) === TRUE) {
                  echo "Profils sekmīgi dzēsts";
                  echo "<br>";
                  echo "<br>";
                  $sql = "UPDATE all_guys SET name='$name', surname='$surname', age='$age', comment='$comment', gender='$gender' WHERE user_id='$user_id'";
                  header("Location: profile.php");
                } else {
                  echo "Kļūda dzēšot profilu" . $conn->error;
                  echo "<br>";
              }
            }
            $conn->close();
            ?>

            <form method='post'>
              <input type='hidden' name='delete' value='1'>
              <input type='submit' name='delete_profile' value='Dzēst profilu'>
            </form>

            <br><br><a href="home_loged.html" class="btn" style="color: white">Atpakaļ</a>
        </div>
      </div>
    </section>
  </body>
</html>
