<?php
	include 'inc/header.php';
	include 'lib/student.php';
?>
<?php
	$stu = new Student();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name = $_POST['name'];
		$roll = $_POST['roll'];
		$insertdata = $stu->insertStudentData($name, $roll);
	}
?>

<?php
 	if (isset($insertdata)) {
 		echo $insertdata;
 	}
?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3>
					<a class="btn btn-success" href="add.php">Add Student</a>
					<a class="btn btn-info pull-right" href="index.php">Back</a>
				</h3>
			</div>
		</div>


		<div class="panel-body" style="max-width: 700px; margin: 0 auto;">
			
			<form action="" method="post">
				<div class="form-group">
					<label for="name">Student Name</label>
					<input type="text" class="form-control" name="name"  id="name">
				</div>
				<div class="form-group">
					<label for="roll">Student Roll</label>
					<input type="text" class="form-control" name="roll" id="roll">
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" name="submit" value="Add Student">
				</div>
				
			</form>
		</div>
<?php  include 'inc/footer.php'; ?>