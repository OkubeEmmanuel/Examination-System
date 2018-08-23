<?php session_start(); ?>
<?php if (isset($_SESSION['admin'])):
  include 'db.php';
  include 'head.php';
  $q = $db->prepare('select name, matric_no, phone from student');
  $q->execute();
  $q->store_result();
  $n = $q->num_rows;
?>
  <body class="bgwhite">
    <script type="text/javascript" src="./js/confirm-delete.js"></script>
  <!-- Navigation -->
  <div ID="navoffset" class="secpage shadow-off bgwhite">
    <div class="navigation dark">
      <div class="container">
        <div class="logo"><a href="./admin-home.php">AMES</a></div>
        <?php include 'admin-nav.php';?>
      </div>
    </div>
  </div>

  <div class="bgwhite space20 relative z20"></div>
  <div class="bgxlight bordertopbottom relative z20">
    <div class="container ptb40 cdark">

      <div class="container">
        <?php if (isset($_SESSION['ssr'])): ?>
          <div class="alert alert-success bold text-center">
            Student was successfully removed.
          </div>
        <?php endif; unset($_SESSION['ssr']); ?>
  <?php if ($n > 0):
    $q->bind_result($name, $matric_no, $phone);
    $x = 1;
  ?>
  <table class="table table-hover table-bordered">
    <thead>
      <th>Sn</th>
      <th>Matriculation number</th>
      <th>Name</th>
      <th>Phone number</th>
      <th></th>
      <th></th>
    </thead>
    <tbody>
    <?php while ($q->fetch()): ?>
      <tr>
        <td><?php echo $x; ?></td>
        <td><?php echo $matric_no; ?></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $phone; ?></td>
        <td><a href="edit-student.php?id=<?php echo $matric_no; ?>">edit</a></td>
        <td><a href="#" onclick="condel('<?php echo $matric_no; ?>')">delete</a></td>
      </tr>
      <?php $x++; ?>
    <?php endwhile; ?>
    </tbody>
  </table>
  <?php else: ?>
      <h2 class="mid tc">There are no registered students at this time</h2>
  <?php endif; ?>
  <?php $q->free_result(); $q->close(); $db->close(); ?>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  </body>
</html>
<?php else:
  header('Location:logout.php');
  exit;
?>

<?php endif; ?>
