<?php
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$id_v = $_POST['id_voucher'];
$topup = $_POST['top-up'];
$inv_num = $_POST['invoice_num'];
$inv_date = $_POST['invoice_date'];
topUpVoucher($id_v, $topup, $inv_num, $inv_date);
echo "Processing.....";
echo "<script>window.history.back()</script>";
