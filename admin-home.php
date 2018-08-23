<?php session_start(); ?>
<?php if (isset($_SESSION['admin'])):
  include 'head.php';
?>
<body class="bglight">
  <div class="navigation dark">

		<div class="container">

			<?php include 'admin-nav.php';?>

		</div>
	</div>

<!-- End of Navigation -->

<div id="parallax-off" class="tp-banner-container relative">
		<div class="tp-banner" >
			<ul>
				<!-- SLIDE 1  -->
				<li  data-transition="fade" data-slotamount="1" data-masterspeed="2000" data-thumb="images/cmi/3.jpg" data-delay="12000"  data-saveperformance="on"  data-title="Ken Burns Slide" data-color="white">
					<!-- MAIN IMAGE -->
					<img src="images/dummy.png" alt="" data-lazyload="images/bg/heroheader.jpg" data-bgposition="center center" data-kenburns="on" data-duration="12000" data-ease="Power0.easeInOut" data-bgfit="100" data-bgfitend="100" data-bgpositionend="center center">
        <div class="container rev-ct1">
					<div class="prlx-on tp-caption georgia size50 ls-1 cwhite bold customout tp-resizeme uppercase text-center mt50"
						data-x="center" data-voffset="-120"
						data-y="center" data-hoffset="0"
						data-captionhidden="on"
						data-splitin="line"
						data-elementdelay="0.25"
						data-start="500"
						data-speed="500"
						data-easing="Back.easeOut"
						data-customin="x:0;y:-20;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
						data-endelementdelay="0.1"
						data-customout="x:0;y:0;z:0;rotationX:40;rotationY:70;rotationZ:0;scaleX:0.85;scaleY:0.85;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
						data-endspeed="500"
						data-endeasing="Power4.easeIn"
						style="z-index: 10"
						>
						Welcome to AM examination system
            <br> <span class="size30 ml200">you are logged in as admin.</span>
					</div>
        </div>
					<div class="prlx-off tp-caption caption-white-bold-caps  customin customout"
						data-x="center"   data-voffset="20"
						data-y="center"   data-hoffset="0"

						data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
						data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
						data-speed="500"
						data-start="1000"
						data-easing="Back.easeOut"
						data-endspeed="300"
						data-endeasing="Back.easeIn"
						style="z-index: 10;"
						>
						<div class="container rev-ct1 mt20">
              <div class="col-md-6 col-md-offset-3">
                <div class="col-md-4">
  								<a href="view-students.php" class="btn btnwhiteline bold">Students</a>
  							</div>
  							<div class="col-md-4">
  								<a href="view-exam.php" class="btn btnwhiteline bold ">Exams</a>
  							</div>
                <div class="col-md-4">
  								<a href="view-results.php" class="btn btnwhiteline bold pull-left">Results</a>
  							</div>
              </div>
						</div>
					</div>

					<!-- Filter dark -->
					<div class="tp-caption customin customout"
						 data-x="center"
						 data-y="center"

						 data-customin="opacity:0;"
			 			 data-customout="opacity:1;"
						 data-speed="600"
						 data-start="0"
						 data-easing="easeOut"
						 style="z-index: 4; display:block; background:rgba(0,0,0,0.3); width:100%; height:100%;"
						 ></div>
				</li>



			</ul>
			<div class="tp-bannertimer none"></div>
		</div>
	</div>
</body>
</html>

  <?php include 'footer.php'; ?>
<?php else:
  header('Location:logout.php');
  exit;
?>

<?php endif; ?>
