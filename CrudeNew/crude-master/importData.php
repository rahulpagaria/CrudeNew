<?php
// load the database configuration file
include 'config.php';
require ('dbconnect.php');

if (isset($_POST['importSubmit'])) {
    
    // validate whether uploaded file is a csv file and possible file types
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
            
          
            
            // Horrible - newline as carriage return on a MAC
            ini_set('auto_detect_line_endings', TRUE);
          
            
            // open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // skip first line - do nothing with it
            fgetcsv($csvFile);
            
            // parse data from csv file line by line
            while (($line = fgetcsv($csvFile)) !== FALSE) {
                
                
              //  $numinserts = 0;
                
              //  $numupdates = 0;
                
                
                // check whether member already exists in database with same name
                $prevQuery = "SELECT id FROM employees WHERE name = '" . $line[0] . "'";
                
                $prevResult = $connection->query($prevQuery);
                if ($prevResult->num_rows > 0) {
                   // error_log("UPDATE employees SET name = '" . $line[0] . "', address = '" . $line[1] . "', salary = '" . $line[2] . "'  WHERE name = '" . $line[0] . "'");
                    // update member data
                     $connection->query("UPDATE employees SET name = '" . $line[0] . "', address = '" . $line[1] . "', salary = '" . $line[2] . "'  WHERE name = '" . $line[0] . "'");
                   // $numupdates = $updResult->num_rows;
                    
                } else {
                    // insert employee data into database
                    $connection->query("INSERT INTO employees (name, address, salary) VALUES ('" . $line[0] . "','" . $line[1] . "','" . $line[2] .  "')");
                 //   $numinserts = $insResult->num_rows;             
                    
                }
            }
            
            // close opened csv file
            fclose($csvFile);
            ini_set('auto_detect_line_endings', FALSE);
            $qstring = '?status=succ';
        } else {
            $qstring = '?status=err';
        }
    } else {
        $qstring = '?status=invalid_file';
    }
}

// redirect to the listing page

header("Location: importcsv.php" . $qstring);  // pass the message on reload