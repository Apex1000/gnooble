<?php

include '../../includes/Authenticate.php';
include '../../classes/student.php';

//check whether the user is logged in or not,
Authenticate::preventUnauthorisedLogin();

$scoreboardType = $_GET['type'];
	if ($scoreboardType=== 'cgf')
		$queryResult = Student::viewScoreboardBySourceCodeLength($_GET['qid']);
	elseif (($scoreboardType=== 'prc'))
		$queryResult = Student::viewScoreboard($_GET['qid']);

$index = 0;
?>

<?php
include '../../views/template_header.php';
?>

			<h1 class="page-header">Scoreboard</h1>
			<p class="text-primary pull-right">Your StudentId : <?php echo $_SESSION['userid'];?></p>
			<p class="lead">Here are the latest standings.</p>
			<?php if ($queryResult != false): ?>

			<?php if(($_GET['type'])=== 'cgf'): ?>
				<div class="table-responsive">
					<table class="table">
						<thead>
						<tr>
							<th>Rank</th>
							<th>StudentId</th>
							<th>Name</th>
							<th>Status</th>
							<th>Chars</th>
							<th>Time(secs)</th>
							<th>Memory</th>

						</tr>
						</thead>
						<?php foreach($queryResult as $result): ?>
							<tr>
								<td><?php echo ++$index; ?></td>
								<td><?php echo $result['UserId'];?></td>
								<td><?php echo $result["Name"]; ?></td>
								<td  style="color:<?php if ($result["Status"] == 'Solved') echo "#398439";
								if ($result["Status"] == 'Failed') echo "#c12e2a";
								if ($result["Status"] == 'Attempted')echo "#eb9316";?>">
									<?php echo $result["Status"]; ?>
								</td>
								<td><?php echo $result["lengthSourceCode"]  ?></td>
								<td><?php echo $result["Time"]  ?></td>
								<td><?php echo $result["Memory"]  ?></td>

							</tr>
						<?php endforeach; ?>

						</tbody>
					</table>
				</div>
				<?php endif;?>
			<?php if(($_GET['type'])=== 'prc'): ?>
			<div class="table-responsive">
				<table class="table">
					<thead>
					<tr>
						<th>Rank</th>
						<th>StudentID</th>
						<th>Name</th>
						<th>Status</th>
						<th>Solved In(secs)</th>
						<th>Time</th>
						<th>Memory</th>

					</tr>
					</thead>
					<?php foreach($queryResult as $result): ?>
						<tr>
							<td><?php echo ++$index; ?></td>
							<td><?php echo $result['UserId'];?></td>
							<td><?php echo $result["Name"]; ?></td>
							<td  style="color:<?php if ($result["Status"] == 'Solved') echo "#398439";
													if ($result["Status"] == 'Failed') echo "#c12e2a";
													if ($result["Status"] == 'Attempted')echo "#eb9316";?>">
								<?php echo $result["Status"]; ?>
							</td>
							<td><?php echo $result["solvedIn"]  ?></td>
							<td><?php echo $result["Time"]  ?></td>
							<td><?php echo $result["Memory"]  ?></td>

						</tr>
					<?php endforeach; ?>

					</tbody>
				</table>
			</div>
				<?php endif;?>
<?php endif; ?>


<?php
include '../../views/template_footer.php';
?>
