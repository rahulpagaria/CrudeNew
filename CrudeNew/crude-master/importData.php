<?php
// load the database configuration file
include 'config.php';
require ('dbconnect.php');

if (isset($_POST['importSubmit'])) {
    
    // validate whether uploaded file is a csv file
    $csvMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
    if (! empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            
            //print("Hello World c");
            
            // open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // skip first line
            fgetcsv($csvFile);
            
            // parse data from csv file line by line
            while (($line = fgetcsv($csvFile)) !== FALSE) {
                
                $numinserts = 0;
                
                $numupdates = 0;
                
                
                // check whether member already exists in database with same email
                $prevQuery = "SELECT id FROM employees WHERE name = '" . $line[0] . "'";
                $prevResult = $connection->query($prevQuery);
                if ($prevResult->num_rows > 0) {
                   // error_log("Hello Worldty u ");
                   // error_log("UPDATE employees SET name = '" . $line[0] . "', address = '" . $line[1] . "', salary = '" . $line[2] . "'  WHERE name = '" . $line[0] . "'");
                    // update member data
                    $updResult = $connection->query("UPDATE employees SET name = '" . $line[0] . "', address = '" . $line[1] . "', salary = '" . $line[2] . "'  WHERE name = '" . $line[0] . "'");
                    $numupdates = $updResult->num_rows;
                   /* echo $numupdates;
                    print $numupdates; */
                    
                } else {
                    // insert employee data into database
                    $insResult = $connection->query("INSERT INTO employees (name, address, salary) VALUES ('" . $line[0] . "','" . $line[1] . "','" . $line[2] .  "')");
                    $numinserts = $insResult->num_rows;
                    /* echo $numinserts;
                    print $numinserts;
 */                    
                }
            }
            
            // close opened csv file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        } else {
            $qstring = '?status=err';
        }
    } else {
        $qstring = '?status=invalid_file';
    }
}

// redirect to the listing page
print("Hello World r");

header("Location: importcsv.php" . $qstring);