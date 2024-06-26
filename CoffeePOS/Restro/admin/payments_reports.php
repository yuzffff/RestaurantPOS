<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
require_once('partials/_head.php');
?>

<body>
    <!-- Sidenav -->
    <?php
    require_once('partials/_sidebar.php');
    ?>
    <!-- Main content -->
    <div class="main-content">
        <!-- Top navbar -->
        <?php
        require_once('partials/_topnav.php');
        ?>
        <!-- Header -->
        <div style="background-image: url(assets/img/theme/restro01.jpg); background-size: cover;" class="header  pb-8 pt-5 pt-md-8">
        <span class="mask bg-gradient-dark opacity-4"></span>
            <div class="container-fluid">
                <div class="header-body">
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--8">
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            Payment Reports
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-success" scope="col">Payment Code</th>
                                        <th scope="col">Payment Method</th>
                                        <th class="text-success" scope="col">Order Code</th>
                                        <th scope="col">Amount Paid</th>
                                        <th class="text-success" scope="col">Date Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM  rpos_payments ORDER BY `created_at` DESC ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($payment = $res->fetch_object()) {
                                    ?>
                                        <tr>
                                            <th class="text-success" scope="row">
                                                <?php echo $payment->pay_code; ?>
                                            </th>
                                            <th scope="row">
                                                <?php echo $payment->pay_method; ?>
                                            </th>
                                            <td class="text-success">
                                                <?php echo $payment->order_code; ?>
                                            </td>
                                            <td>
                                                ฿ <?php echo $payment->pay_amt; ?>
                                            </td>
                                            <td class="text-success">
                                                <?php echo date('d/M/Y g:i', strtotime($payment->created_at)) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <!--ใช้ในการแสดงข้อมูลการชำระเงินในระบบและทำให้Userสามารถดูข้อมูลการชำระเงินล่าสุดได้ในรูปแบบที่เข้าใจง่าย-->
                                    <!--ใช้คำสั่ง SQL SELECT เพื่อดึงข้อมูลการชำระเงินทั้งหมดจากตาราง rpos_payments โดยเรียงลำดับตามเวลาที่สร้างล่าสุด (จากวันที่ล่าสุดไปยังวันที่เก่าที่สุด)-->
                                    <!--วนลูปผ่านผลลัพธ์ที่ได้รับจากการดึงข้อมูล และแสดงข้อมูลการชำระเงินแต่ละรายการในรูปแบบของแถวในตาราง-->
                                    <!--สำหรับแต่ละแถว โค้ดจะแสดงรหัสการชำระเงิน (pay_code), วิธีการชำระเงิน (pay_method), รหัสคำสั่งซื้อ (order_code), จำนวนเงินที่ชำระ (pay_amt), และวันที่และเวลาที่ทำการชำระเงิน (created_at) โดยใช้ฟังก์ชัน date() เพื่อแปลงรูปแบบของวันที่และเวลา-->
                                    <!--ใช้ลูป while เพื่อวนลูปผ่านผลลัพธ์ที่ได้รับจากการดึงข้อมูล และสร้างแถวตาราง HTML สำหรับแสดงข้อมูลการชำระเงินแต่ละรายการที่ได้รับ-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <?php
            require_once('partials/_footer.php');
            ?>
        </div>
    </div>
    <!-- Argon Scripts -->
    <?php
    require_once('partials/_scripts.php');
    ?>
</body>

</html>