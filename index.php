<?php
	// This is the URL of the API (where we get the data from)
	$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";
	
	// This is the response from the API
	$response = file_get_contents($URL);
	
	// Validate the response
	if ($response === FALSE) {
		die('Error: There has been an issue in fetching the data from the API');
	}
	
	// This is the result of the response we convert it from JSON to an array in PHP
	$result = json_decode($response, true);

	// Validate the result
	if ($result === NULL) {
		die('Error: There has been an issue in decoding the JSON');
	}
?>

<!--This is the html page-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<!--We are using the pico css framework for styling-->
	<link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
</head>
<body>
	<!--This is the header of the page-->
	<header style="padding: 30px 0px 0px 0px;">
		<h1 style="display: flex; justify-content: center; align-items: center;">
			UOB Student Nationality Data
		</h1>
	</header>
	<!--This is the main content of the page-->
	<main class="container">
		<!--This is the table that will display the data-->
		<div class="overflow-auto">
			<table class="striped">
				<!--This is the table headerr-->
				<thead>
					<tr>
						<th scope="col">Year</th>
						<th scope="col">Semester</th>
						<th scope="col">The Programs</th>
						<th scope="col">Nationality</th>
						<th scope="col">Colleges</th>
						<th scope="col">Number of Students</th>
					</tr>
				</thead>
				<!--This is the table body-->
				<?php
					// Loop through the results and display them in an html table
					foreach ($result['results'] as $record) {
						echo "<tr>";
						echo "<td>".$record['year']."</td>";
						echo "<td>".$record['semester']."</td>";
						echo "<td>".$record['the_programs']."</td>";
						echo "<td>".$record['nationality']."</td>";
						echo "<td>".$record['colleges']."</td>";
						echo "<td>".$record['number_of_students']."</td>";
						echo "</tr>";
					}
				?>
			</table>
		</div>
	</main>
</body>
</html>