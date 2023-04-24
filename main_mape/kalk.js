var weight, height, measure, bmi, error;

function calculate() {
	weight = document.getElementById("weight").value;
	height = document.getElementById("height").value;
	height /= 100;
	height *= height;
	bmi = weight/height;
	bmi = bmi.toFixed(1);

	if (bmi <= 18.4) {
		measure = "Tavs BMI ir " + bmi + " kas nozīmē " + ", ka tev ir nepietiekams svars";
	} else if (bmi >= 18.5 && bmi <= 24.9) {
		measure = "Tavs BMI ir " + bmi + " kas nozīmē " + ", ka tev ir normāls svars";
	} else if (bmi >= 25 && bmi <= 29.9) {
		measure = "Tavs BMI ir " + bmi + " kas nozīmē " + ", ka tev ir liekais svars";
	} else if (bmi >= 30) {
		measure = "Tavs BMI ir " + bmi + " kas nozīmē " + ", ka Tev ir nopietnas svara problēmas";
	}
	
	switch(weight){
		case "0": 
			document.getElementById("results").innerHTML = error;
			break;
		case weight<0:
			document.getElementById("results").innerHTML = "Negatīvas vērtības nav atļautas!";
			break;
	}

	switch(height){
		case 0:
			document.getElementById("results").innerHTML = error;
			break;
		case weight<0:
			document.getElementById("results").innerHTML = "Negatīvas vērtības nav atļautas!";
			break;
		default:
			document.getElementById("results").innerHTML = measure;
	}
}

