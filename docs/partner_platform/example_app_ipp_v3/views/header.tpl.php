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

		table
		{
			margin-left: 20px;
			margin-right: 20px;
		}

		tr:nth-child(even) {background: #CCC}
		tr:nth-child(odd) {background: #EEE}

		td
		{
			padding: 4px;
		}

		</style>
                <!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="views/bootstrap-3.3.5-dist/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

                <!-- Optional theme -->
                <link rel="stylesheet" href="views/bootstrap-3.3.5-dist/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

                <!-- Latest compiled and minified JavaScript -->
                <script src="views/bootstrap-3.3.5-dist/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
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
