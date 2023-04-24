<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>   

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
    $website = "";
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
  if (!empty($name) && !empty($email) && !empty($gender)) {
    // Create connection
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connectison
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Use the database
    $dbname = "01_db";
    $conn->select_db($dbname);

    // Insert user input values into database
    $sql = "INSERT INTO user (name, email, website, comment, gender)
    VALUES ('$name', '$email', '$website', '$comment', '$gender')";

    if ($conn->query($sql) === TRUE) {
      echo "<br>";
      echo "Jūs tikāt pievienots!";
    } else {
      //echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    header("Location: index.php");
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

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Website: <input type="text" name="website">
  <span class="error"></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>
<a href="index.php"><button style="margin-top: 20px;">Atpakaļ</button></a>

</body>
</html>