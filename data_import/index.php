<!DOCTYPE html>
<html lang="en">

<html>
	<body>

		<?php 
			include 'db_connection.php';

			define('ZERO_RESULTS', '0 results');
			
			$file_name = 'csv_input/Car Data.csv';

			$conn = OpenCon();

			static $has_table = false;

			//Check if cars table has already been made. If not, then create table.
			if(!$has_table) {
				$table_sql = "CREATE TABLE cars (
							    Registration varchar(30) PRIMARY KEY,
							    Make varchar(30),
							    Model varchar(30),
							    Colour varchar(30),
							    Fuel varchar(30)
							)";

				$conn->query($table_sql);
				$has_table = true;
			}

			//Import CSV and store data in database.
			$row = 1;
			if (($handle = fopen($file_name, "r")) !== FALSE) {
				fgetcsv($handle);
			    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
			    	$conn->query('INSERT INTO `cars`(`Registration`, `Make`, `Model`, `Colour`, `Fuel`) VALUES ("'.$row[0].'","'.$row[1].'","'.$row[2].'","'.$row[3].'","'.$row[4].'")');
			    }
			    
			    fclose($handle);
			}

			$petrol_sql = "SELECT * FROM cars Where Fuel='petrol'";
			$electric_sql = "SELECT * FROM cars Where Fuel='electric'";
			$diesel_sql = "SELECT * FROM cars Where Fuel='diesel'";
			$hybrid_sql = "SELECT * FROM cars Where Fuel='hybrid'";
			$registration_sql = "SELECT * FROM cars";
			$petrol_result = $conn->query($petrol_sql);
			$electric_result = $conn->query($electric_sql);
			$diesel_result = $conn->query($diesel_sql);
			$hybrid_result = $conn->query($hybrid_sql);
			$registration_result = $conn->query($registration_sql);

			// Filter cars on fuel type, and load into seperate arrays to create CSV files for each type.
			if ($petrol_result->num_rows > 0) {
			  while($row = $petrol_result->fetch_assoc()) {
			    $petrol_cars[] = $row;
			  }
			} else {
			  echo ZERO_RESULTS;
			}

			if ($electric_result->num_rows > 0) {
			  while($row = $electric_result->fetch_assoc()) {
			    $electric_cars[] = $row;
			  }
			} else {
			  echo ZERO_RESULTS;
			}

			if ($diesel_result->num_rows > 0) {
			  while($row = $diesel_result->fetch_assoc()) {
			    $diesel_cars[] = $row;
			  }
			} else {
			  echo ZERO_RESULTS;
			}

			if ($hybrid_result->num_rows > 0) {
			  while($row = $hybrid_result->fetch_assoc()) {
			    $hybrid_cars[] = $row;
			  }
			} else {
			  echo ZERO_RESULTS;
			}

			// Checks each registration against a pattern to determine whether whether it is a valid registration. Creates arrays for valid and invalid registrations to print lists of each.
			if ($registration_result->num_rows > 0) {
			  while($row = $registration_result->fetch_assoc()) {
			  	if (preg_match("/^[a-z][a-z][0-9][0-9] [a-z][a-z][a-z]/i", $row["Registration"])) {
			  		$is_registrations[] = $row;
			  	} else {
			  		$not_registrations[] = $row;
			  	}
			    
			  }
			} else {
			  echo ZERO_RESULTS;
			}

			// Print each valid registrations. Print a count of how many registrations are invalid.
			foreach ($is_registrations as $registration) {
				echo nl2br("$registration[Registration], $registration[Make], $registration[Model], $registration[Colour], $registration[Fuel]\n");
			}

			echo "<p>\n</p>";
			echo "There are ".count($not_registrations)." cars that do not have valid registration numbers.";

		    $petrol_fp = fopen('csv_output/petrol_cars.csv', 'w');
		    fputcsv($petrol_fp, array('Car Registration','Make','Model','Colour','Fuel'));

		    $electric_fp = fopen('csv_output/electric_cars.csv', 'w');
		    fputcsv($electric_fp, array('Car Registration','Make','Model','Colour','Fuel'));

		    $diesel_fp = fopen('csv_output/diesel_cars.csv', 'w');
		    fputcsv($diesel_fp, array('Car Registration','Make','Model','Colour','Fuel'));

		    $hybrid_fp = fopen('csv_output/hybrid_cars.csv', 'w');
		    fputcsv($hybrid_fp, array('Car Registration','Make','Model','Colour','Fuel'));

		    // Create seperate CSV's containing cars filtered by fuel type.
		    foreach ($petrol_cars as $petrol_car) {
		    	fputcsv($petrol_fp, $petrol_car);
		    }

		    foreach ($electric_cars as $electric_car) {
		    	fputcsv($electric_fp, $electric_car);
		    }

		    foreach ($diesel_cars as $diesel_car) {
		    	fputcsv($diesel_fp, $diesel_car);
		    }

		    foreach ($hybrid_cars as $hybrid_car) {
		    	fputcsv($hybrid_fp, $hybrid_car);
		    }
		    
		    fclose($petrol_fp);
		    fclose($electric_fp);
		    fclose($diesel_fp);
		    fclose($hybrid_fp);

			CloseCon($conn); 
		?> 

	</body>
</html> 