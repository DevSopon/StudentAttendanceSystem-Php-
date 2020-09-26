<?php
include 'inc/header.php';
include 'lib/student.php';
?>


		<div class="panel panel-default">
			<div class="panel-heading">
				<h3>
					<a class="btn btn-success" href="add.php">Add Student</a>
					<a class="btn btn-info pull-right" href="index.php">Take Attendance</a>
				</h3>
			</div>
		</div>


		<div class="panel-body">
			
			<form action="" method="post">
				<table /class="table table-striped">
					<tr>
						<th width="45%">Serial</th>
						<th width="45%">Attendance date</th>
						<th width="10%">Action</th>
						
					</tr>
					<?php
						$stu = new Student ();
						$get_date = $stu->getDatelist();
						if ($get_date) {
							$i = 0;
							while ($value = $get_date->fetch_assoc()) {
								$i++;
						
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $value['attend_time']; ?></td>
						<td>
							<a class="btn  btn-info" href="studentview.php?dt=<?php echo $value['attend_time']; ?>">  view </a>
						</td>
					</tr>

					<?php }} ?>
					<tr>
						<td colspan="4"><input type="submit" name="submit" value="Submit" class="btn btn-primary"></td>
					</tr>
				</table>
			</form>
		</div>
<?php  include 'inc/footer.php'; ?>