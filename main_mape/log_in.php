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
    <title>ienaksana</title>
  </head>
  <body>
    <header><h1>Log IN</h1></header>
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

            if ($conn->query($sql) === TRUE) {
                $sql = "CREATE TABLE IF NOT EXISTS loginform (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    user VARCHAR(50) NOT NULL UNIQUE,
                    Pass VARCHAR(50) NOT NULL UNIQUE
                )";
                if ($conn->query($sql) === TRUE) {
                    //echo "Table created successfully";
                } else {
                    echo "Error creating table: " . $conn->error;
                }
            } else {
                echo "Error dropping table: " . $conn->error;
            }

            if(isset($_POST['username'])){
                $uname=$_POST['username'];
                $password=$_POST['password'];
                $stmt = $conn->prepare("SELECT * FROM loginform WHERE user = ? AND Pass = ? LIMIT 1");
                $stmt->bind_param("ss", $uname, $password);
                $stmt->execute();
                $result = $stmt->get_result();
                if($result->num_rows == 1){
                    //echo "You have successfully logged in";
                    session_start();
                    $row = $result->fetch_assoc();
                    $_SESSION['user_id'] = $row['id'];
                    $user_id = $_SESSION['user_id'];
                    //echo $user_id;
                    header("Location: home_loged.html");
                    exit();
                } else {
                    //echo "You have entered an incorrect password";
                    exit();
                }      
            }
            ?>
            <form method="POST">
                <div class="form-input">
                    <input type="text" name="username" placeholder="Lietotājvārds"/>	
                </div>
                <div class="form-input">
                    <input type="password" name="password" placeholder="Parole"/>
                </div>
                <input type="submit" value="Ienākt" class="btn-login"/>
            </form>
            
            <br><br><a href="index.html" class="btn" style="color: white">Atpakaļ uz sākumlapu</a>
        </div>
      </div>
    </section>
  </body>
</html>
