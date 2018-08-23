<?php session_start(); ?>
<?php if (isset($_SESSION['student'])):
  include 'head.php';
  include 'db.php';

  $id = $_SESSION['student'];
  $q = $db->prepare('select name, phone from student where matric_no = ?');
  $q->bind_param('s', $id);
  $q->execute();
  $q->bind_result($name, $phone);
  $q->fetch();
  $q->free_result();
  $q->close();

  $q = $db->prepare('select course, session, date, start_time, finish_time from exam_dt where status = ?');
  $status = '0';
  $q->bind_param('s', $status);
  $q->execute();
  $q->store_result();
  $n = $q->num_rows;
?>
    <body>
      <div class="container">
        <div class="col-md-7">
          <div class="row clight" >
            ffff
          </div>
        </div>
        <div class="col-md-5">
          <div class="row">
            <h4>EXAMS</h4>
            <div class="col-md-12">
              <?php if ($n < 1): $q->free_result(); $q->close();?>
                <p>There are no exams yet</p>
              <?php else:
                $q->bind_result($course, $session, $edate, $st, $ft);
                $hour = date('h');
                if (date('a') == "pm") {
                  $hour +=12;
                }
                $time = $hour.date(':i:s');
                $tdate = date('Y-m-d');
              ?>
                <?php while ($q->fetch()): ?>
                    <tr>
                      <td><?php echo $course; ?></td>
                      <td><?php echo $session; ?></td>
                      <td><?php echo $edate; ?></td>
                      <?php if ($tdate == $edate): ?>
                        <?php if ( ($time >= $st) && ($time < $ft) ): ?>
                          <td><a href="exam.php">write</a></td>
                        <?php endif; ?>
                      <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
                <?php $q->free_result(); $q->close(); ?>
              <?php endif; ?>
            </div>
            <h4>RESULTS</h4>
            <?php
              $q = $db->prepare('select course, session, score from scores where matric_no = ?');
              $q->bind_param('s', $id);
              $q->execute();
              $q->store_result();
              $n = $q->num_rows;
            ?>
            <?php if ($n < 1): ?>
              <p>You have no result at the moment</p>
            <?php else:
              $q->bind_result($c, $s, $sc);
            ?>
              <?php while ($q->fetch()): ?>
                  <tr>
                    <td><?php echo $c; ?></td>
                    <td><?php echo $s; ?></td>
                    <td><?php echo $sc; ?></td>
                  </tr>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </body>
    <?php include 'footer.php'; ?>
  </html>
<?php else:
  header('Location:logout.php');
  exit;
?>

<?php endif; ?>
