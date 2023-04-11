<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klases darbs ar PHP</title>
</head>
<body>
    <?php
        $date = date('d-m-y');
        $time = date('H:i:s');
        $hour = date('H');

        if ($hour < 12) {
            $greeting = "Labrīt!";
        } elseif ($hour < 18) {
            $greeting = "Labdien!";
        } else {
            $greeting = "Labvakar!";
        }

        echo "$greeting<br>";
        echo "Datums: $date<br>";
        echo "Laiks: $time";
        echo"<br><br>";


        for( $i = 1; $i<=10; $i++ ) { 
        echo "Skaitlis:", $i; 
        echo"<br>"; 
        } 

        $age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
        echo "<br>Peter is " . $age['Peter'] . " years old.";
    ?>
</body>
</html>