<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script> -->
<style type="text/css">
.wrapper {
	width: 650px;
	margin: 0 auto;
}

.page-header h2 {
	margin-top: 0;
}

table tr td:last-child a {
	margin-right: 15px;
}
</style>
<script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
	<div class="wrapper">
		<div class="col-md-12">
			<div class="page-header clearfix">
				<h5 class="pull-left" align="right"></h5>
				<a href="./logout.php" class="btn btn-danger pull-right">Logout</a>
			</div>
		</div>
		<div class="col-md-12">
			<div class="page-header clearfix">
				<h2 class="pull-left">Import Employees in Batch</h2>
				<a href="./importcsv.php" class="btn btn-success pull-right">Batch
					Import CSV</a>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header clearfix">
						<h2 class="pull-left">Employees Details</h2>
						<a href="create.php" class="btn btn-success pull-right">Add New
							Employee</a>
					</div>
                    <?php
                    /*
                     * if (! $_SESSION['login']) {
                     * header("location:login.php");
                     * die();
                     * }
                     */
                    // Include config file
                    require_once 'config.php';
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM employees";
                    if ($result = $pdo->query($sql)) {
                        if ($result->rowCount() > 0) {
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Name</th>";
                            echo "<th>Address</th>";
                            echo "<th>Salary</th>";
                            echo "<th>Action</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = $result->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "<td>" . $row['salary'] . "</td>";
                                echo "<td>";
                                // Passing ID variable explicitly
                                // Add the variable name and variable value to the end of the URL in the href attribute of an anchor tag
                                echo "<a href='read.php?id=" . $row['id'] . "' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                echo "<a href='update.php?id=" . $row['id'] . "' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                echo "<a href='delete.php?id=" . $row['id'] . "' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else {
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else {
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                    unset($pdo);
                    ?>
                </div>
			</div>
		</div>
		<!-- 	echo "
		 <div id='userbox'>
			Welcome $u
			<ul>
				<li><a href='./importcsv.php'>Import Batch Files</a></li>

				<li><a href='./logout.php'>Logout</a></li>
			</ul>
		</div>*/
		"; -->
	</div>
</body>
</html>