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
    <header><h1>Sign up</h1></header>
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
              $uname = $_POST['username'];
              $password = $_POST['password'];
              $password_confirm = $_POST['password_confirm'];
              if($password !== $password_confirm) {
                  // passwords don't match, handle error
              } else {
                  // prepare the statement
                  $stmt = $conn->prepare("INSERT INTO loginform (user, Pass) VALUES (?, ?)");
                  $stmt->bind_param("ss", $uname, $password);

                  // execute the statement
                  if ($stmt->execute() === TRUE) {
                      // data inserted successfully
                      echo "Data inserted successfully";
                  } else {
                      // handle error
                      echo "Error inserting data: " . $stmt->error;
                  }

                  // close the statement and connection
                  $stmt->close();
                  $conn->close();
              }
            }
            ?>
            <form method="POST" action="">
                <div class="form-input">
                    <input type="text" name="username" placeholder="Enter the User Name"/>	
                </div>
                <div class="form-input">
                    <input type="password" name="password" placeholder="password"/><br/>
                    <input type="password" name="password_confirm" placeholder="password again"/>
                </div>
                <input type="submit" value="LOGIN" class="btn-login"/>
            </form>
            
            <br><br><a href="index.html" class="btn" style="color: white">Atpakaļ uz sākumlapu</a>
        </div>
      </div>
    </section>
  </body>
</html>
