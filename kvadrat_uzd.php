<!DOCTYPE html>
<html>
<head>
    <title>Kvadrātfunkcijas uzdevums</title>
</head>
<body>
    <h1>Kvadrātfunkcijas uzdevums</h1>
    <p>Ievadiet kvadrātfunkcijas saknes: </p>

    <?php
        // generē  a b c koef. tikai ja jau nav uzgenereti 
        $a = isset($_POST['a']) ? $_POST['a'] : 1;
        while(true){
            $b = isset($_POST['b']) ? $_POST['b'] : rand(-100, 100);
            $c = isset($_POST['c']) ? $_POST['c'] : rand(-100, 100);
            $discriminant = $b * $b - 4 * $a * $c;
            if ($discriminant >= 0) {
                $root1 = (-1 * $b + sqrt($discriminant)) / (2 * $a);
                $root2 = (-1 * $b - sqrt($discriminant)) / (2 * $a);
                if( $root1==(round($root1)) && $root2==(round($root2))){
                    break;
                }
            }
        }
        // parada vienadojumu
        echo "<p>$a x^2 + $b x + $c = 0</p>";

        function check_roots(){
            // atgriez formas datus
            $root1 = $_POST['root1'];
            $root2 = $_POST['root2'];
            $a = $_POST['a'];
            $b = $_POST['b'];
            $c = $_POST['c'];
            // aprekina diskriminantu
            $discriminant = $b * $b - 4 * $a * $c;
            // pārbauda vai saknes ir pareizas
            if ($discriminant < 0 || $root1 * $root2 != $c / $a || $root1 + $root2 != -$b / $a) {
                echo "<p>Nepareizi! Lūdzu mēģiniet vēlreiz!</p>";
            } else {
                echo "<p>Apsveicu! Ievadījāt pareizās saknes!</p>";
            }
        }

        // Handle form submissions
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            check_roots();
        }
    ?>

    <form method="post">
        <label for="root1">1. sakne:</label>
        <input type="number" id="root1" name="root1" required>
        <br>
        <label for="root2">2. sakne:</label>
        <input type="number" id="root2" name="root2" required>
        <br>
        <input type="hidden" name="a" value="<?php echo $a; ?>">
        <input type="hidden" name="b" value="<?php echo $b; ?>">
        <input type="hidden" name="c" value="<?php echo $c; ?>">
        <input type="submit" value="Pārbaudīt">
    </form>
    <input type="button" value="Jauns" onclick="location.href='kvadrat_uzd.php'">
    <input type="button" value="Rādīt saknes" onclick="showRoots()">
    <a href="index.php"><button style="margin-top: 20px;">Atpakaļ</button></a>

    <script>
        function showRoots() {
            // Retrieve the form data
            var root1 = document.getElementById('root1');
            var root2 = document.getElementById('root2');
            var a = "<?php echo $a; ?>";
            var b = "<?php echo $b; ?>";
            var c = "<?php echo $c; ?>";
            // Calculate the discriminant
            var discriminant = b * b - 4 * a * c;
            // Check if discriminant is positive, negative, or zero
            if (discriminant > 0) {
                // Two distinct real roots
                var sqrtDiscriminant = Math.sqrt(discriminant);
                var x1 = (-b + sqrtDiscriminant) / (2 * a);
                var x2 = (-b - sqrtDiscriminant) / (2 * a);
                // Display the roots
                root1.value = x1;
                root2.value = x2;
            } else if (discriminant === 0) {
                // One real root (repeated)
                var x = -b / (2 * a);
                // Display the root
                root1.value = x;
                root2.value = x;
            } else {
                // Complex roots (not supported)
                root1.value = 69;
                root2.value = 69;
            }
        }

        var buttons = document.getElementsByClassName("button");
    </script>
</body>
</html>