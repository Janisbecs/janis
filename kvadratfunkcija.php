<!Doctype html> 
<html>
<body>
	<?php
		// Define variables for A, B, and C
		$a = isset($_POST['a']) ? $_POST['a'] : '';
		$b = isset($_POST['b']) ? $_POST['b'] : '';
		$c = isset($_POST['c']) ? $_POST['c'] : '';

		// Define the quadratic formula function
		function quadraticFormula($a, $b, $c) {
			// Calculate the discriminant
			$discriminant = ($b * $b) - (4 * $a * $c);

			// Check for complex roots
			if ($discriminant < 0) {
				return "Sakņu nav!";
			}

			// Calculate the roots
			$root1 = (-$b + sqrt($discriminant)) / (2 * $a);
			$root2 = (-$b - sqrt($discriminant)) / (2 * $a);

			// Return the roots
			return "Saknes ir {$root1} un {$root2}.";
		}

		// Check if the form has been submitted
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Validate user input
			$errors = array();

			if (!is_numeric($a)) {
				$errors[] = "A vajag būt skaitlim.";
			}

			if (!is_numeric($b)) {
				$errors[] = "B vajag būt skaitlim.";
			}

			if (!is_numeric($c)) {
				$errors[] = "C vajag būt skaitlim.";
			}

			// If there are no errors, calculate the roots
			if (count($errors) == 0) {
				$result = quadraticFormula($a, $b, $c);
			} else {
				$result = implode("<br>", $errors);
			}
		}
	?>

	<h1>Kvadrātfunkcijas kalkulātors</h1>

	<form method="post">
		<label for="a">A:</label>
		<input type="text" name="a" id="a" value="<?php echo $a; ?>"><br>

		<label for="b">B:</label>
		<input type="text" name="b" id="b" value="<?php echo $b; ?>"><br>

		<label for="c">C:</label>
		<input type="text" name="c" id="c" value="<?php echo $c; ?>"><br>

		<input type="submit" value="Aprēķināt">
	</form>

	<?php
	// Display the result
	if (isset($result)) {
		echo "<p>{$result}</p>";
	}
	?>
</body>
</html>
