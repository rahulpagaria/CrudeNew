<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>

<!-- Custom Inbuilt css code -->
<style type="text/css">
.wrapper {
	width: 650px;
	margin: 0 auto;
}

.page-header h2 {
	margin-top: 0;
}

<!--
align right -->table tr td:last-child a {
	margin-right: 15px;
}
</style>
<script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();    // Tool tip shows on full page load
        });
    </script>
</head>
<?php
// load the database configuration file
// require 'config.php';

/*
 * session_start();
 * if (!$_SESSION['login']){
 * header("location:login.php");
 * die;
 * }
 */
require ('dbconnect.php');

if (! empty($_GET['status'])) {
    switch ($_GET['status']) {
        case 'succ':
            $statusMsgClass = 'alert-success';
            $statusMsg = 'Employees data has been inserted successfully.'; // success message
            break;
        case 'err':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.'; // any other error
            break;
        case 'invalid_file':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.'; // file format error displayed on the same form for user to try again
            break;
        default:
            $statusMsgClass = ''; // keep message bar empty
            $statusMsg = '';
    }
}
?>
<div class="container">

	<div class="col-md-12">
		<div class="page-header clearfix">
			<h5 class="pull-left" align="right"></h5>
			<a href="./logout.php" class="btn btn-danger pull-right">Logout</a> <a
				href="./index.php" class="btn btn-info pull-right">Index Page</a>

		</div>
	</div>
    
       
    <?php
    
    if (! empty($statusMsg)) {
        echo '<div class="alert ' . $statusMsgClass . '">' . $statusMsg . '</div>'; // dynamic allocation of style
    }
    ?>
    <div class="panel panel-default">
		<div class="panel-heading">
			Employees list <a href="javascript:void(0);"
				onclick="$('#importFrm').slideToggle();">Import Employees</a>
			<!-- Animation effect of message on click in jquery -->
		</div>
		<div class="panel-body">
			<form action="importData.php" method="post"
				enctype="multipart/form-data" id="importFrm">
				<input type="file" name="file" /> <input type="submit"
					class="btn btn-primary" name="importSubmit" value="IMPORT">
			</form>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Address</th>
						<th>Salary</th>
					</tr>
				</thead>
				<tbody>
                <?php
                // get records from database
                
                $query = $connection->query("SELECT * FROM employees ORDER BY id DESC");
                if ($query->num_rows > 0) {
                    while ($row = $query->fetch_assoc()) {
                        ?>
                    <tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['address']; ?></td>
						<td><?php echo $row['salary']; ?></td>
					</tr>
                    <?php } }else{ ?>
                    <tr>
						<td colspan="5">No employee(s) found.....</td>
					</tr>
                    <?php } ?>
                </tbody>
			</table>
		</div>
	</div>
</div>
</html>