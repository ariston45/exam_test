<?php
if (isset($_POST['cmd'])) {
  switch ($_POST['cmd']) {
    case 'Search':
      if ($_POST['valin'] == true) {
        if ($_POST['valin'] == 'Student not yet an exam') {
          $_SESSION['valin'] = 'Student not yet an exam';
        } else {
          $_SESSION['valin'] = $_POST['valin'];
        }
      } else {
        $_SESSION['valin'] = "All students";
      }
      echo "<script>window.location.href = window.location.href;</script>";
      break;
    case 'Clear':
      $_SESSION['valin'] = "";
      unset($_SESSION['idstu']);
      echo "<script>window.location.href = window.location.href;</script>";
      break;
    case 'Upload';
      $filename = fileSetup();
      if ($filename != "") {
        $inst = "import";
        echo $$filename;
      }
      // echo $$filename;
      if ($inst == "import") {
        $_SESSION["import_id"] = $filename;
        $ext = strtolower(array_pop(explode(".", $filename)));
        if ($ext == "xls") {
          require_once "../" . $GLOBALS["xls-reader-dir"] . "PHPExcel.php";
          import_excel_students($filename);
          saveStudents($filename);
          unset($filename);
        } else {
          $js = "<script language=\"javascript\"> \r\n
          alert(\"Sorry, the file format is unsupported.\"); \r\n
          </script> \r\n
          ";
          echo $js;
        }
      }
      header("location:dashboard.php?pg=pic_student");
      break;
    case 'Reset':
      resetImport();
      break;
    case 'Register':
      $id = $_SESSION['idstu'] = $_POST['id'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $n = savePointStudent($id, $name, $email);
      if ($n == true) {
        echo '<script>alert("Data well inputed on database.");</script>';
        echo "<script>window.location.href = window.location.href;</script>";
      } else {
        echo '<script>alert("Data can not input on database ' . $_POST['cmd'] . '.");</script>';
        echo "<script>window.location.href = window.location.href;</script>";
      }
      break;
    case 'Clear':
      session_unset($_SESSION['idstu']);
      break;
    default:
      # code...
      break;
  }
}
// $view_1 = resStudent();
// $view_2 = resStudentRej();
// $view_3 = resStudentDup();
// $ck_up = resViewStudent();
// if($row = mysqli_num_rows($ck_up) != 0){$ck = 1;}
// $ck_re = resViewStudentReject();
// if($row = mysqli_num_rows($ck_re) != 0){$ck = 1;}
// $ck_du = resViewStudentDupli();
// if($row = mysqli_num_rows($ck_du) != 0){$ck = 1;}
?>
<style>
  table {
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #ddd;
  }
  th {
    background-color: #1769aa;
    color: #fff;
    padding: 4px;
    text-align: center;
    font-size: 14px;
  }
  td {
    border: 1px solid #ddd;
    text-align: center;
    font-size: 12px;
    padding: 2px;
    word-break: break-word; 
    max-width: 200px;
  }
  table.dataTable{
    border-collapse: collapse;
  }
  table.dataTable tr{
    border: #1769aa 1px solid;
  }
  table.dataTable tr th{
    padding: 4px;
  }
  #tbStudents_filter {
    margin-bottom: 10px;
  }
  #tbStudents_filter input{
    width: 200px;
    margin-left: 10px;
  }
  .dataTables_wrapper .dataTables_length {
    float: left;
  }
</style>

<div class="row">
  <div class="col-lg-12">
    <h4></h4>
  </div>
  <div class="col-md-12">
    <div class="panel panel-info">
      <div class="panel-heading">Students Details</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-5">
            <form action="" method="POST">
              <div class="input-group">
                <input type="text" name="valin" class="form-control input-sm" placeholder="Student ID or Name">
                <span class="input-group-btn">
                  <input type="submit" name="cmd" class="btn btn-primary btn-sm" value="Search">
                </span>
              </div><!-- /input-group -->
            </form>
          </div>
          <div class="col-md-3">
            <form action="" method="POST">
              <input type="hidden" name="valin" class="form-control input-sm" value="Student not yet an exam">
              <button type="submit" name="cmd" class="btn btn-primary" value="Search">Student not yet an exam</button>
            </form>
          </div>
          <!-- /.col-lg-5 -->
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            
            <table id="tbStudents" class="" cellspacing="0" width="100%">
              <thead>
                <th> No </th>
                <th> Student ID</th>
                <th> Name </th>
                <th> Email </th>
                <th> Option </th>
              </thead>
              <tbody>
              <?php
              $no = 1;
              $id_g = $_SESSION['admin_group'];
              $valin = $_SESSION['valin'];
              if ($_SESSION['valin'] == "All students") {
                $data_student = showAllStudents($id_g);
                foreach ($data_student as $key => $value) {
                  $ids_student[$key] = (string) $value['idstudents'];
                }
                $data_student_online = studentOnlineCek_arr($ids_student);
                foreach ($data_student as $r) {
                  $id = $r[0];
                  $release = null;
                  if (in_array($id, $data_student_online)) {
                    $release = '<button class="btn btn-xs btn-warning" onclick="release(\'' . $id . '\')"><i class="fa fa-sign-out" aria-hidden="true" ></i> Release</button>';
                  } else {
                    $release = '<button class="btn btn-xs btn-default" disabled><i class="fa fa-sign-out" aria-hidden="true" ></i> Release</button>';
                  } ?>
                  <tr>
                    <td><?=$no?></td>
                    <td><?=$id?></td>
                    <td><?=$r[1]?></td>
                    <td><?=$r[2]?></td>
                    <td>
                      <a href="?pg=pic_student_det&ids=<?=$r[0]?>">
                        <button type="button" class="btn btn-xs btn-info"><i class="fa fa-search-plus"></i> View</button>
                      </a>
                      <a href="?pg=pic_student_edit&ids=' . $r[0] . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
                      <?=$release?>
                    </td>
                  </tr>
                  <?php $no++;
                }
              } elseif ($_SESSION['valin'] == 'Student not yet an exam') {
                $data_student = showStudentUnexap_up($id_g);
                foreach ($data_student as $r) {
                  $id = $r[0];
                  //$n = viewEquExm($id);
                  $table .= '<tr><td>' . $no . '</td><td>' . $id . '</td><td>' . $r[1] . '</td><td>' . $r[2] . '</td> <td>
                  <a href="?pg=pic_student_det&ids=' . $r[0] . '">
                  <button type="button" class="btn btn-xs btn-info"><i class="fa fa-search-plus"></i> View</button>
                  </a>
                  <a href="?pg=pic_student_edit&ids=' . $r[0] . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
                  ' . $release . '
                  </td>
                  </tr>';
                  $no++;
                }
              } elseif ($_SESSION['valin'] != "") {
                $release = null;
                $data_student = showStudents($id_g, $valin);
                foreach ($data_student as $key => $value) {
                  $ids_student[$key] = (string) $value['idstudents'];
                }
                $data_student_online = studentOnlineCek_arr($ids_student);
                foreach ($data_student as $r) {
                  $id = $r[0];
                  $release = null;
                  if (in_array($id, $data_student_online)) {
                    $release = '<button class="btn btn-xs btn-warning" onclick="release(\'' . $id . '\')"><i class="fa fa-sign-out" aria-hidden="true" ></i> Release</button>';
                  } else {
                    $release = '<button class="btn btn-xs btn-default" disabled><i class="fa fa-sign-out" aria-hidden="true" ></i> Release</button>';
                  }
                  $table .= '<tr><td>' . $no . '</td><td>' . $id . '</td><td>' . $r[1] . '</td><td>' . $r[2] . '</td>
                  <td>
                  <a href="?pg=pic_student_det&ids=' . $r[0] . '">
                  <button type="button" class="btn btn-xs btn-info"><i class="fa fa-search-plus"></i> View</button>
                  </a>
                  <a href="?pg=pic_student_edit&ids=' . $r[0] . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
                  ' . $release . '
                  </td>
                  </tr>';
                  $no++;
                }
              } else {
                // 
              }
              echo $table;
              ?>
              </tbody>
            </table>
            <?php
            if ($valin != null) {
              echo ('<p class=" text-left"><i>You have searched for data with the keyword "' . $valin . '". 
                To reset keywords, please click reset button.
                <form action="" method="post">
                <input type="submit" name="cmd" class="btn btn-warning btn-xs" value="Clear"></i>
                </form></p><br>');
            } else {
              echo ('<p class=" text-left"><i>*You can input id or name.</i></p>');
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<!--======================-->
<script src='../assets/js/jquery-1.12.0.min.js'></script>
<script>
  $(document).ready(function () {
    $('#tbStudents').DataTable({
      "paging": true,
      "columnDefs": [{
        "width": "5%",
        "targets": 0
      },
      {
        "width": "27%",
        "targets": 1
      },
      {
        "width": "27%",
        "targets": 2
      },
      {
        "width": "17%",
        "targets": 3
      },
      {
        "width": "21%",
        "targets": 4
      }
      ]
    });
  });
  function release($id) {
    var r = confirm('Apakah anda akan menghapus login NIM : ' + $id);
    if (r == true) {
      $.ajax({
        type: 'GET',
        url: 'view_pic/help-student-action.php', //Here you will fetch records 
        data: { cmd: 'release', id: $id },   //Pass $id
        success: function (data) {
          alert('Berhasil merelease user ' + $id + '\nUser bisa login ulang untuk melanjutkan ujian');
        }
      });
    }
  }
</script>

<!--/.row-->