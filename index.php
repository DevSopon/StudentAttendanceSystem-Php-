<?php
include 'inc/header.php';
include 'lib/student.php';
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("form").submit(function(){
			var roll = true;
			$(':radio').each(function(){
				name = $(this).attr('name');
				if (roll && !$(':radio[name="'+name+'"]:checked').length) {
					//alert (name + "Roll missing!");
					$(alert).show();
					roll = false;
				}
			});
			return roll;
		});
	});
</script>
<?php
 $stu = new Student ();
 $cur_date= date('Y-m-d');
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$present = $_POST['present'];
		
		$insertpresent = $stu->insertPresentData($cur_date, $present);
	}
 
?>
<?php
 	if (isset($insertpresent)) {
 		echo $insertpresent;
 	}
?>
<div style="hidden" class='alert alert-danger'> <strong>Error! </strong>Student roll missing.</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3>
					<a class="btn btn-success" href="add.php">Add Student</a>
					<a class="btn btn-info pull-right" href="view.php">View All</a>
				</h3>
			</div>
		</div>


		<div class="panel-body">
			<div class="well text-center" style="font-size: 20px;">
				<strong>Date:</strong> <?php echo $cur_date; ?>
			</div>
			<form action="" method="post">
				<table /class="table table-striped">
					<tr>
						<th width="20%">Serial</th>
						<th width="30%">Student Name</th>
						<th width="30%">Student Roll</th>
						<th width="10%">Attendance</th>
					</tr>
					<?php
						$get_student = $stu->getStudents();
						if ($get_student) {
							$i = 0;
							while ($value = $get_student->fetch_assoc()) {
								$i++;
						
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $value['name']; ?></td>
						<td><?php echo $value['roll']; ?></td>
						<td>
							<input type="radio" name="present[<?php echo $value['roll']; ?>]" value="present">P
							<input type="radio" name="present[<?php echo $value['roll']; ?>]" value="absent">A
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