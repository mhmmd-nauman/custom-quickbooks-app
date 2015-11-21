<html>
<head>
<title>IPP Test App</title>

<!-- Every page of your app should have this snippet of Javascript in it, so that it can show the Blue Dot menu -->
<script type="text/javascript" src="https://appcenter.intuit.com/Content/IA/intuit.ipp.anywhere.js"></script>
<script type="text/javascript">
		intuit.ipp.anywhere.setup({
			menuProxy: '<?php print($quickbooks_menu_url); ?>',
			grantUrl: '<?php print($quickbooks_oauth_url); ?>'
		});
		</script>
<style>
table {
	margin-left: 20px;
	margin-right: 20px;
}
 tr:nth-child(even) {
background: #CCC
}
 tr:nth-child(odd) {
background: #EEE
}
td {
	padding: 4px;
}
</style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="views/bootstrap-3.3.5-dist/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="views/bootstrap-3.3.5-dist/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="views/bootstrap-3.3.5-dist/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="css/popup.css" />
<script src="js/popup.js"></script>

<script src="js/tinymce/tinymce.min.js"></script>

</head>
<body>
<div class="container">
<div class="row">
  <div class="col-md-12 pullright">
    <?php if ($quickbooks_is_connected): ?>
    <ipp:blueDot></ipp:blueDot>
    <?php endif; ?>
  </div>
</div>
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
