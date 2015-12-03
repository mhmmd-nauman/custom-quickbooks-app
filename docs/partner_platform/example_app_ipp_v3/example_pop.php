<?php

require_once dirname(__FILE__) . '/config.php';

require_once dirname(__FILE__) . '/views/header.tpl.php';
?>

<a href="http://www.wikipedia.org" class="default_popup2">Default External Site</a>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script src="js/jquery.popup.js"></script>
	<script>
		$(function(){
$('.default_popup2').popup({
					width				: 420,
				height				: 315
			});
			});
</script>


<?php

require_once dirname(__FILE__) . '/views/footer.tpl.php';

?>
