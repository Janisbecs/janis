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

            $conn = new mysqli($servername, $username, $password);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            
            ?>

            <br><br><a href="home_loged.html" class="btn" style="color: white">Atpakaļ</a>
        </div>
      </div>
    </section>
  </body>
</html>
