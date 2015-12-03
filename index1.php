
<html>
<head>
      <meta charset = "utf-8">
      <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
      <meta name = "viewport" content = "width = device-width, 
         initial-scale = 1">
      
      <title>Quickbooks Custom Application</title>
      
      <!-- Bootstrap -->
      <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" 
         rel = "stylesheet">
<!--<link rel="stylesheet" href="css/popup.css" />-->
      
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        $(function() {
          $( ".tract_date" ).datepicker();
        });
        function modalbox(linkt,setTitle,SetHeight,SetWidth){
                    $('<iframe id="some-dialog" class="window-Frame" src='+linkt+' />').dialog({
                    autoOpen: true,
                    width: SetWidth,
                    height: SetHeight,
                    modal: true,
                    resizable: true ,
                    title:setTitle,
                    position: { my: "top", at: "top", of: window  }
            }).width(SetWidth-20).height(SetHeight-20);
    }
    </script>
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
    <h1>Invoice Details</h1>
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
    
    <td style=" width: 10%;"> Print Supplier </td>
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
    <td>Weiskopf Consulting/Consulting@intuit.com</td>    
    <td>    
        1010 /
        $0 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        45612 Main St.Bayshore94326    </td>
    <td> 
        (650) 555-1423        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1010/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-12-02"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1010">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1010">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1010">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1010">View Files</a> </td>
  </tr>

<tr>
    <td>Jane Doe/jane.doe@gmail.com</td>    
    <td>    
        1038 /
        $100.00 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
                        </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
            </td>
    <td> 
        415-123-5555        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1038/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-11-18"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1038">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1038">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1038">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1038">View Files</a> </td>
  </tr>

<tr>
    <td>Sonnenschein Family Store/Familiystore@intuit.com</td>    
    <td>    
        1037 /
        $362.07 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        5647 Cypress Hill Ave.Middlefield94303    </td>
    <td> 
        (650) 557-8463        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1037/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-10-23"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1037">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1037">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1037">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1037">View Files</a> </td>
  </tr>

<tr>
    <td>0969 Ocean View Road/Sporting_goods@intuit.com</td>    
    <td>    
        1036 /
        $477.50 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        370 Easy St.Middlefield94482    </td>
    <td> 
        (415) 555-9933        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1036/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-10-23"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1036">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1036">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1036">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1036">View Files</a> </td>
  </tr>

<tr>
    <td>0969 Ocean View Road/Sporting_goods@intuit.com</td>    
    <td>    
        1031 /
        $387.00 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        370 Easy St.Middlefield94482    </td>
    <td> 
        (415) 555-9933        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1031/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-08-08"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1031">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1031">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1031">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1031">View Files</a> </td>
  </tr>

<tr>
    <td>Cool Cars/Cool_Cars@intuit.com</td>    
    <td>    
        1004 /
        $2369.52 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        65 Ocean Dr. , CA , 94213    </td>
    <td> 
        (415) 555-9933        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1004/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-10-11"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1004">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1004">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1004">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1004">View Files</a> </td>
  </tr>

<tr>
    <td>Mark Cho/Mark@Cho.com</td>    
    <td>    
        1035 /
        $314.28 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        36 Willow RdMenlo Park94304    </td>
    <td> 
        (650) 554-1479        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1035/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-10-23"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1035">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1035">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1035">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1035">View Files</a> </td>
  </tr>

<tr>
    <td>Sushi by Katsuyuki/Sushi@intuit.com</td>    
    <td>    
        1017 /
        $80.00 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        898 Elm St.Maplewood07040    </td>
    <td> 
        (505) 570-0147        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1017/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-10-07"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1017">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1017">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1017">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1017">View Files</a> </td>
  </tr>

<tr>
    <td>Rondonuwu Fruit and Vegi/Tony@Rondonuwu.com</td>    
    <td>    
        1034 /
        $78.60 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        847 California Ave.San Jose95021    </td>
    <td> 
        (650) 555-2645        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1034/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-10-22"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1034">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1034">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1034">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1034">View Files</a> </td>
  </tr>

<tr>
    <td>Geeta Kalapatapu/Geeta@Kalapatapu.com</td>    
    <td>    
        1033 /
        $629.10 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        1987 Main St.Middlefield94303    </td>
    <td> 
        (650) 555-0022        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1033/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-10-22"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1033">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1033">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1033">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1033">View Files</a> </td>
  </tr>

<tr>
    <td>Amy's Bird Sanctuary/Birds@Intuit.com</td>    
    <td>    
        1021 /
        $459.00 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        4581 Finch St.Bayshore94326    </td>
    <td> 
        (650) 555-3311        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1021/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-10-01"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1021">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1021">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1021">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1021">View Files</a> </td>
  </tr>

<tr>
    <td>Travis Waldron/Travis@Waldron.com</td>    
    <td>    
        1032 /
        $414.72 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        78 First St.Monlo Park94304    </td>
    <td> 
        (650) 557-9977        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1032/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-10-20"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1032">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1032">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1032">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1032">View Files</a> </td>
  </tr>

<tr>
    <td>Travis Waldron/Travis@Waldron.com</td>    
    <td>    
        1013 /
        $81.00 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        78 First St.Monlo Park94304    </td>
    <td> 
        (650) 557-9977        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1013/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-10-11"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1013">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1013">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1013">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1013">View Files</a> </td>
  </tr>

<tr>
    <td>0969 Ocean View Road/Sporting_goods@intuit.com</td>    
    <td>    
        1030 /
        $226.75 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        370 Easy St.Middlefield94482    </td>
    <td> 
        (415) 555-9933        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1030/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-07-08"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1030">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1030">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1030">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1030">View Files</a> </td>
  </tr>

<tr>
    <td>Dukes Basketball Camp/Dukes_bball@intuit.com</td>    
    <td>    
        1029 /
        $460.40 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        25 Court St.Tucson85719    </td>
    <td> 
        (520) 420-5638        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1029/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-09-05"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1029">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1029">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1029">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1029">View Files</a> </td>
  </tr>

<tr>
    <td>Jeff's Jalopies/Jalopies@intuit.com</td>    
    <td>    
        1022 /
        $81.00 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        12 Willow Rd.Menlo Park94305    </td>
    <td> 
        (650) 555-8989        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1022/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-10-01"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1022">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1022">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1022">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1022">View Files</a> </td>
  </tr>

<tr>
    <td>Amy's Bird Sanctuary/Birds@Intuit.com</td>    
    <td>    
        1001 /
        $108.00 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        4581 Finch St.Bayshore94326    </td>
    <td> 
        (650) 555-3311        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1001/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-10-20"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1001">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1001">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1001">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1001">View Files</a> </td>
  </tr>

<tr>
    <td>55 Twin Lane/Sporting_goods@intuit.com</td>    
    <td>    
        1005 /
        $54.00 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        370 Easy St.Middlefield94482    </td>
    <td> 
        (650) 555-0987        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1005/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-10-14"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1005">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1005">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1005">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1005">View Files</a> </td>
  </tr>

<tr>
    <td>55 Twin Lane/Sporting_goods@intuit.com</td>    
    <td>    
        1006 /
        $86.40 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        370 Easy St.Middlefield94482    </td>
    <td> 
        (650) 555-0987        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1006/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-09-14"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1006">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1006">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1006">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1006">View Files</a> </td>
  </tr>

<tr>
    <td>55 Twin Lane/Sporting_goods@intuit.com</td>    
    <td>    
        1028 /
        $81.00 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        370 Easy St.Middlefield94482    </td>
    <td> 
        (650) 555-0987        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1028/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-09-05"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1028">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1028">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1028">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1028">View Files</a> </td>
  </tr>

<tr>
    <td>Bill's Windsurf Shop/Surf@Intuit.com</td>    
    <td>    
        1002 /
        $175.00 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        12 Ocean Dr. , CA , 94213    </td>
    <td> 
        (415) 444-6538        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1002/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-07-08"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1002">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1002">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1002">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1002">View Files</a> </td>
  </tr>

<tr>
    <td>Bill's Windsurf Shop/Surf@Intuit.com</td>    
    <td>    
        1027 /
        $85.00 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        12 Ocean Dr. , CA , 94213    </td>
    <td> 
        (415) 444-6538        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1027/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-09-05"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1027">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1027">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1027">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1027">View Files</a> </td>
  </tr>

<tr>
    <td>Amy's Bird Sanctuary/Birds@Intuit.com</td>    
    <td>    
        1025 /
        $205.00 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        4581 Finch St.Bayshore94326    </td>
    <td> 
        (650) 555-3311        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1025/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-09-05"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1025">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1025">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1025">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1025">View Files</a> </td>
  </tr>

<tr>
    <td>Red Rock Diner/qbwebsamplecompany@yahoo.com</td>    
    <td>    
        1024 /
        $156.00 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        500 Red Rock Rd.Bayshore94326    </td>
    <td> 
        (650) 555-4973        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1024/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-08-15"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1024">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1024">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1024">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1024">View Files</a> </td>
  </tr>

<tr>
    <td>Red Rock Diner/qbwebsamplecompany@yahoo.com</td>    
    <td>    
        1023 /
        $70.00 /
            </td>
    
    <td>    
              
            <select name="print_supplier" class="big-drop-down">
            <option value=Norton Lumber and Building Materials>Norton Lumber and Building Materials</option><option value=Hall Properties>Hall Properties</option><option value=Robertson & Associates>Robertson & Associates</option><option value=PG&E>PG&E</option><option value=PG&E>PG&E</option><option value=Cal Telephone>Cal Telephone</option><option value=Diego's Road Warrior Bodyshop>Diego's Road Warrior Bodyshop</option>            </select>
                <select name="print_supplier2" class="small-drop-down">
                <option value='SuperGraphics'>SuperGraphics</option><option value='Double L'>Double L</option><option value='Top Notch'>Top Notch</option><option value='True Screen'>True Screen</option>                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        500 Red Rock Rd.Bayshore94326    </td>
    <td> 
        (650) 555-4973        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> 1023/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="2015-10-21"></td>
    <td> <a class="btn btn-success btn-sm" id="DomainAdd" href="example_invoice_email.php?follow=1023">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=1023">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=1023">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=1023">View Files</a> </td>
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
<script>
$("#DomainAdd").click(function(e){
    e.preventDefault();	
    modalbox(this.href,this.title,550,800);
});

</script>
