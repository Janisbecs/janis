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
    <header><h1>Pieteikšanās</h1></header>
    <section class="hero">
      <div class="background-image"></div>
      <div class="hero-content-area">
        <div class="container">
            


            <?php
            // define variables and set to empty values
            $nameErr = $emailErr = $genderErr = "";
            $name = empty($name) ? "" : $name;
            $email = empty($email) ? "" : $email;
            $gender = empty($gender) ? "" : $gender;
            $comment = empty($comment) ? "" : $comment;
            $website = empty($website) ? "" : $website;

            // // define variables and set to empty values
            // $nameErr = $emailErr = $genderErr = "";
            // $name = $email = $gender = $comment = $website = "";

            // Connect to MySQL server
              $servername = "localhost";
              $username = "root";
              $password = "";

              $conn = new mysqli($servername, $username, $password);

              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }

              // Create database
              $sql = "CREATE DATABASE IF NOT EXISTS box_club";
              mysqli_query($conn, "ALTER DATABASE box__club CHARACTER SET utf8 COLLATE utf8_latvian_ci;");

              if ($conn->query($sql) === TRUE) {
                  //echo "Database created successfully";
              } else {
                  echo "Error creating database: " . $conn->error;
              }

              // Select the database
              $conn->select_db("box_club");

              // Create table
              $sql = "CREATE TABLE IF NOT EXISTS all_guys (
                      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                      name VARCHAR(50) NOT NULL,
                      surname VARCHAR(50) NOT NULL,
                      age INT(50) NOT NULL,
                      comment VARCHAR(200),
                      gender VARCHAR(10) NOT NULL
                  )";

              if ($conn->query($sql) === TRUE) {
                  //echo "Table created successfully";
              } else {
                  echo "Error creating table: " . $conn->error;
              }

              //$conn->close();


            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              if (empty($_POST["name"])) {
                  $nameErr = "Name is required";
              } else {
                  $name = test_input($_POST["name"]);
              }
              
              if (empty($_POST["email"])) {
                  $emailErr = "Email is required";
              } else {
                  $email = test_input($_POST["email"]);
              }
                  
              if (empty($_POST["website"])) {
                  $website = "Age is required";
              } else {
                  $website = test_input($_POST["website"]);
              }

              if (empty($_POST["comment"])) {
                  $comment = "";
              } else {
                  $comment = test_input($_POST["comment"]);
              }

              if (empty($_POST["gender"])) {
                  $genderErr = "Gender is required";
              } else {
                  $gender = test_input($_POST["gender"]);
              }

              // Check if all fields are filled and form has been submitted
              if (!empty($name) && !empty($email) && !empty($gender)&& !empty($website)) {
                  // Create connection
                  //$servername = "localhost";
                  //$username = "root";
                  //$password = "";

                  // Create connectison
                  //$conn = new mysqli($servername, $username, $password);

                  // Check connection
                  if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                  }

                  // Use the database
                  $dbname = "box_club";
                  $conn->select_db($dbname);

                  // Insert user input values into database
                  $sql = "INSERT INTO all_guys (name, surname, age, comment, gender)
                  VALUES ('$name', '$email', '$website', '$comment', '$gender')";

                  if ($conn->query($sql) === TRUE) {
                  echo "<br>";
                  echo "Jūs tikāt pievienots!";
                  } else {
                  //echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                  $conn->close();
                  header("Location: index.html");
                  exit();
              }
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>

            <h2>Pieteikšanās boksa klubam</h2>
            <p><span class="error">* obligātie lauciņi</span></p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
                Vārds: <input type="text" name="name">
                <span class="error">* <?php echo $nameErr;?></span>
                <br><br>
                Uzvārds: <input type="text" name="email">
                <span class="error">* <?php echo $emailErr;?></span>
                <br><br>
                Vecums: <input type="number" name="website">
                <span class="error">*</span>
                <br><br>
                Vieta piezīmēm: <textarea name="comment" rows="2" cols="40"></textarea>
                <br><br>
                Dzimums:
                <input type="radio" name="gender" value="female">Sieviete
                <input type="radio" name="gender" value="male">Vīrietis
                <input type="radio" name="gender" value="other">Cits
                <span class="error">* <?php echo $genderErr;?></span>
                <br><br>
                <button type="submit" class="button" name="submit" value="Pieteikties">Pieteikties</button>
            </form>
          
          <p class="text-center" style="color: white">Sekmīgas pieteikšanās gadījumā tiksiet novirzīts uz sākumlapu.</p>
          <p class="text-center" style="color: white">Ja spiežot pogu PIETEIKTIES jūs nenovirza uz sākumlapu, pārbaudiet aizpildītos lauciņus!</p>
          <a href="index.html" class="btn" style="color: white">Atpakaļ uz sākumlapu</a>
        </div>
      </div>
    </section>
  </body>
</html>
