<?php
session_start();
if(!isset($_SESSION['user_session'])){  //User_session
  header("location:index.php");
 }  
include("dbcon.php"); 
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>POS-PHARMA | Purchase</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  	<script type="text/javascript">
       jQuery(document).ready(function($) {
		$("a[id*=popup]").facebox({
		  loadingImage : 'src/img/loading.gif',
		  closeImage   : 'src/img/closelabel.png'
		})
	  })
    </script>
	<script type="text/javascript">
	//GET Medicine Name And Expire Date
	$(document).ready(function(){
       $("#qty").focus(
            function(){
              var medicine_name = $("#product_hidden").val();
              var expire_date   = $("#date_hidden").val();
            $.ajax({
              type:'POST',
              url :'auto.php',
              dataType:"json",
              data:{medicine_name:medicine_name,expire_date:expire_date},
              success:function(data){
                $("#avai_qty").val(data);
              },
            });
    });
	//GET Medicine Name And Expire Date

         //Disabled Button If Quantity Not Available

	$("#qty").blur(function()
		{
			var avai_qty = $("#avai_qty").val();
			var in_qty = parseInt($("#qty").val());
			var avai_qty_int = parseInt($("#avai_qty").val());
			if(avai_qty == "" ||  in_qty > avai_qty_int || in_qty <= 0)
				{
					$("#btn_submit").attr('disabled','disabled');
					alert("Something went wrong!!");
				}
			else
				{
					$("#btn_submit").removeAttr('disabled');
				}

		});
    //Disabled Button If Quantity Not Available
	});
    </script>
    <script language="javascript" type="text/javascript">
		//Clock
		var timerID = null;
		var timerRunning = false;
		function stopclock ()
			{
				if(timerRunning)
				clearTimeout(timerID);
				timerRunning = false;
			}
		function showtime () 
			{
				var now = new Date();
				var hours = now.getHours();
				var minutes = now.getMinutes();
				var seconds = now.getSeconds()
				var timeValue = "" + ((hours >12) ? hours -12 :hours)
				if (timeValue == "0") timeValue = 12;
				timeValue += ((minutes < 10) ? ":0" : ":") + minutes
				timeValue += ((seconds < 10) ? ":0" : ":") + seconds
				timeValue += (hours >= 12) ? " P.M." : " A.M."
				document.clock.face.value = timeValue;
				timerID = setTimeout("showtime()",1000);
				timerRunning = true;
			}
		function startclock() 
			{
				stopclock();
				showtime();
			}
		window.onload=startclock;
		//Clock
    </script>
</head>
<body class="hold-transition sidebar-collapse layout-top-nav layout-navbar-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="index3.html" class="navbar-brand">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">POS PHARMA</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
		  <li class="nav-item">
            <a href="home.php" class="nav-link"><i class="icon-calendar icon-large"></i>
                <?php
                $Today = date('y:m:d',mktime());
                $new = date('l, F d, Y', strtotime($Today));
                echo $new;
                ?>
			</a>
          </li>
          <li class="nav-item">
            <a href="home.php" class="nav-link">
				<form name="clock" method="POST" action="#">
					<!--*****Clock******-->
					<input style="width:150px;background: #000;color: #fff;border-radius: 5px;height: 30px;" readonly type="submit" class="trans" name="face" value="">
				</form><!--*****Clock******-->
			</a>
          </li>
        </ul>
      </div>
	  
	     
		 
  
      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="purchase.php?invoice_number=<?php echo $_GET['invoice_number']?>" role="button">
            <i class="fas fa-shopping-bag"></i> Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="purchase.php?invoice_number=<?php echo $_GET['invoice_number']?>" role="button">
            <i class="fas fa-cart-arrow-down"></i> Purchase
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sale.php?invoice_number=<?php echo $_GET['invoice_number']?>" role="button">
            <i class="fas fa-cart-plus"></i> Sale
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('left_menu.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Items Purchase <small> Entry</small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Items Purchase Entry</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
				<div class="card-body">
					<form method="POST" action="insert_purchase.php?invoice_number=<?php echo $_GET['invoice_number']?> " >
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Supplier</label>
									<select class="form-control select2" style="width: 100%;">
										<option value="No Supplier">No Supplier</option>
										<option value="Supplier 1">Supplier 1</option>
									</select>
								</div>
								<!-- /.form-group -->
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Warehouse</label>
									<select class="form-control select2" style="width: 100%;">
										<option value="No Warehouse">No Warehouse</option>
										<option value="Warehouse 1">Warehouse 1</option>
									</select>
								</div>
								<!-- /.form-group -->
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Date</label>
									<input class="form-control select2" />
								</div>
								<!-- /.form-group -->
							</div>
						</div>
						<div class="row">
							<div class="col-3">
								<input class="form-control" type="text" id="product" required  autocomplete="off" placeholder="Medicine" autofocus>
								<input type="hidden" name="product" id="product_hidden" required autocomplete="off" placeholder="Medicine" >
							</div>
							<div class="col-3">
								<input class="form-control" type="number" name="avai_qty" id="avai_qty"  readonly placeholder="Available qty" >
							</div>
							<div class="col-3">
								<input class="form-control" type="number" name="qty" id="qty"  placeholder="Add Qty" autocomplete="off" required>
								<input type="hidden" name="expire_date" id="date_hidden" required class="form-control" autocomplete="off" placeholder="Medicine" style="">
							</div>
							<div class="col-3">
								<Button type="submit"  name="submit" class="btn btn-success" id="btn_submit" style=""><i class="icon icon-plus-sign"></i> Add Item</button>
							</div>
						</div>
					</form>
				</div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
	  <!----------------->
	  <!----------------->
	  <div class="container">
    <div class="row pre-scrollable">	
		<table class="table table-bordered table-striped table-hover" id="resultTable" data-responsive="table">
				<thead>
					<tr style="background-color: #383838; color: #FFFFFF;" >
						<th> Medicine </th>
						<th> Category</th>
						<th> Price </th>
						<th> Qty </th>
						<th> Amount </th>
						<th> Action </th>
					</tr>
				</thead>
				<tbody>
                <?php
					$invoice_number= $_GET['invoice_number'];
					$medicine_name = "";
					$category= "";
					$quantity= "";
      
					include("dbcon.php");
      
					$select_sql = "SELECT * from purchase_details where invoice_number = '$invoice_number' ";
      
					$select_query = mysqli_query($con ,$select_sql);
      
					$i = 0;
                    
					while($row = mysqli_fetch_array($select_query)):
      
						$i++;
                ?>
      
                <tr class="record">
                     <td><?php
      
      
                       $med_id = $row['id'];
                       $medicine_name=$row['medicine_name'];
                       echo $medicine_name;
                       echo "<input type='hidden' value=$med_id id='med_id$i' name='med_id'>";
                       echo "<input type='hidden' value=$medicine_name id='med_name$i' name='med_name'>"
                      ?></td>
                     <td><?php $category = $row['category'];
                     echo $category;
                      ?>
                         <input type="hidden" value='<?php echo $category?>' id='med_cat<?php echo $i?>' name='med_cat'>
                        
                      </td>
                        <?php 
                        $ex_date=$row['expire_date'];
                        $ex_date;
                         ?>
                         <input type="hidden" id="ex_date<?php echo $i?>" value='<?php echo $ex_date?>'' name='ex_date'>
      
                     
                     <td><?php echo  $row['cost']; ?></td>
                     <td>
                     <?php
      
                        $quantity =  $row['qty'];
                        $type     =  $row['type'];
                        echo "<input type='hidden' id='hid_quantity$i' value='$quantity' name='hid_quantity'>";
                        echo "<input type='number' id='quantity$i' name='quantity' value='$quantity' min='1' max='10' style='width:50px'>"."&nbsp;(".$type.")&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo "<a href='#' class='qty_upd$i'><span class='icon-refresh'></span></a>";
                        echo "<div class='ajax-loader$i' style='visibility:hidden'>
      
                             <img src='src/img/loading.gif'>
      
                             </div>
                           ";
                                     ?>
                     </td>
                     
                     <td><?php echo $row['amount']; ?></td>
						<td><a href="delete_purchase.php?invoice_number=<?php echo $_GET['invoice_number']?>&id=<?php echo $row['id'];?>&name=<?php echo $row['medicine_name']?>&expire_date=<?php echo $row['expire_date']?>&quantity=<?php echo $row['qty'];?>" class="btn btn-danger">Remove</a></td>
      
                  <?php endwhile; ?>  
                </tr>
                <tr>
              <th colspan="5" ><font size=6><strong> Total:</strong></font></th>
              <td  colspan="2"><strong>
      
                <?php
      
                $select_sql = "SELECT sum(amount) , sum(profit_amount) from purchase_details where invoice_number = '$invoice_number'";
      
                $select_query= mysqli_query($con,$select_sql);
      
                while($row = mysqli_fetch_array($select_query)){
      
                  $grand_total = $row['sum(amount)'];
                  $grand_profit =$row['sum(profit_amount)'];
                  echo '$'.$grand_total;
                }
                ?>
              </td>
            </tr>
        </tbody>
      </table>
	  <br>
      
          <?php
           if($medicine_name && $category && $quantity !=null){
            ?>
      
            <a id="popup" href="checkout.php?invoice_number=<?php echo $_GET['invoice_number']?>&medicine_name=<?php echo $medicine_name?>&category=<?php echo $category?>&ex_date=<?php echo $ex_date?>&quantity=<?php echo $quantity?>&total=<?php echo $grand_total?>&profit=<?php echo $grand_profit?>" style="width:400px;" class="btn btn-info btn-large">Proceed <i class="icon icon-share-alt"></i></a>
      
          <?php
           }else{
      
      
            ?>
      
      <div class="alert alert-danger">
        <h3><center>No Sales Available!!</center> </h3>
    </div>
      
          <?php
       
                }
      
          ?>
    </div>
      </div>
	  <!----------------->
	  <!----------------->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>

<script type="text/javascript">


  $(document).ready(function(){

     /* $("#product").focus(

            function(){

              var bar_code = $("#bar_code").val();

            $.ajax({
              type:'POST',
              url :'bar_code.php',
              dataType:"json",
              data:{bar_code:bar_code},
              success:function(data){

                $("#product").val(data);
              },

            });
    }); */

      //****AUTO COMPLETE*****
    $("#product").typeahead({

               source: function(drug_result, result){

            $.ajax({

          url : 'autocomplete.php',
          method :'POST',
          data :{drug_result:drug_result},
          dataType:"json",

          success:function(data){

            result($.map(data,function(item){



              return item;

            }));
          },

        });
      },

    });

      //****AUTO COMPLETE*****



     //****Medicine name and Date*****
     $("#product").focusout(function(){
         
               var value = $("#product").val();

               var res= value.split(",");

               var name = res[0];

               var date = res[1];

            $("#product_hidden").val(name);
          $("#date_hidden").val(date);

    });
    //****Medicine name and Date*****

    //*******Qty Update*******
  for(var i=1;i<=100;i++){

  $("a.qty_upd"+i).click(function(){

        for(var i1=1;i1<=100;i1++){

                var med_id=$("#med_id"+i1).val();
                var med_name=$("#med_name"+i1).val();
                var med_cat=$("#med_cat"+i1).val();
                var ex_date=$("#ex_date"+i1).val();
                var hid_qty = $("#hid_quantity"+i1).val();
                var qty=$("#quantity"+i1).val();

                if(qty <= 0){

                  alert("Sorry Error");

                }else{

             $.ajax({
              type:'POST',
               beforeSend:function(){
                 $('.ajax-loader'+i1).css("visibility", "visible");
              },
              url :'quantity_upd.php',
              data:{med_id:med_id,med_name:med_name,med_cat:med_cat,ex_date:ex_date,hid_qty:hid_qty,qty:qty},

              success:function(){

                location.reload();

              },

            });

           }

         }
  });

}
     //*******Qty Update*******

  });
</script>
 
