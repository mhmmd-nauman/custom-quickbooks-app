
<html>
<head>
      <meta charset = "utf-8">
      <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
      <meta name = "viewport" content = "width = device-width, 
         initial-scale = 1">
      
      <title>Bootstrap 101 Template</title>
      
      <!-- Bootstrap -->
      <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" 
         rel = "stylesheet">
      
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 
         elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the 
         page via file:// -->
      
      <!--[if lt IE 9]>
      <script src = "https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src = "https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style type="text/css">
          .big-drop-down{ width: 120px;}
          .small-drop-down{ width: 80px;}
          .small-date-box{ width: 60px;}
      </style>
   </head>
<body>
<div class="container-fluid">

<div class="row">
  <ul class = "nav navbar-nav">
    <li class = "active"><a href = "index.php">Home</a></li>
    <li><a href = "example_customer_query.php">Customers</a></li>
    <li><a href = "example_invoice_query.php">Invoices</a></li>
    <li><a href = "example_invoice_w_lines_query.php">Invoices with Lines</a></li>
    <li><a href = "example_payment_query.php">Payments</a></li>
    <li><a href = "example_items_query.php">Items</a></li>
  </ul>
</div>

<div class="row">
  <div class="col-md-12">
    <h1>Invoices from QB Live Application</h1>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <hr>
  </div>
</div>


<div class="row">
  <div class="col-md-12">
      <table class="table table-striped table-bordered table-responsive" style=" font-size: 10px;">
  <tr>
      <td style=" width: 10%;"> Client Name/Email </td>
    <td> Invoice# /<br>Amount Owing /<br>Ship Date </td>
    
    <td> Print Supplier </td>
    <td> Blank Garment Supplier </td>
    <td> Shipping Address </td>
    <td style=" width: 7%;"> Phone # </td>
    <td> Shipping Method </td>
    <td> Tracking Number/Date </td>
    <td> Follow up ? </td>
    <td> BG Email </td>
    <td> Send Print Instruction </td>
    <td> View Files </td>
  </tr>
      
  <tr>
    <td>Weiskopf Consulting / Consulting@intuit.com </td>    
    <td>1010</td>
    
    <td>          
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option>
            <option value=Hall Properties>Hall Properties</option>
            <option value=Robertson & Associates>Robertson & Associates</option>
            <option value=PG&E>PG&E</option><option value=PG&E>PG&E</option>
            <option value=Cal Telephone>Cal Telephone</option>
            <option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            
            </select>
        <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option>
                <option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option>
                <option value='True Screen'>True Screen</option>               
                </select>
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>45612 Main St.Bayshore94326    </td>
    <td> 
    (650) 555-1423        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1010/<input class="small-date-box" type="text" name="tract_num" value="2015-12-02"></td>
    <td> <a class="btn btn-success btn-sm" href=?follow="1010">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" href=?bg="1010">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" href=?print="1010">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" href=?files="1010">View Files</a> </td>
  </tr>
   
  </table>  
  </div>
</div><div class="row">
  <div class="col-md-12">
    <hr>
  </div>
</div>

</div>
	</body>
</html>

<!-- Hosting24 Analytics Code -->
<script type="text/javascript" src="http://stats.hosting24.com/count.php"></script>
<!-- End Of Analytics Code -->
