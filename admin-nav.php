<?php include'head.php'; ?>
<div class="navbar navbar-default" role="navigation">
	<div class="container-fluid relative">

		<button type="button" class="btn left hide-show-button none">
		    <span class="burgerbar"></span>
		    <span class="burgerbar"></span>
		    <span class="burgerbar"></span>
		</button>
		<a href="#" class="closemenu"></a>

		<!-- mobile version drop menu -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle hamburger" data-toggle="collapse" data-target=".navbar-collapse">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button>
		</div>

		<!-- menu -->
		<div class="mainmenu mobanim dark-menu navbar-collapse white collapse offset-0 ">
			<ul class="nav navbar-nav mobpad size30" id="navigation">
				<li>
				  <a href="admin-home.php">Home </a>
				</li>
				<li class="dropdown">
		      <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="student">Students
		      <span class="caret"></span></a>
		      <ul class="dropdown-menu">
		        <li><a href="view-students.php">View Students</a></li>
		        <li><a href="register-student.php">Register Student</a></li>
		      </ul>
		    </li>
				<li class="dropdown">
		      <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="exam">Exam
		      <span class="caret"></span></a>
		      <ul class="dropdown-menu">
		        <li><a href="set-exam.php">Set Exam</a></li>
		        <li><a href="view-exam.php">View Exam</a></li>
		      </ul>
		    </li>
				<li><a href="view-results.php">Results</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>

	</div>
</div>
