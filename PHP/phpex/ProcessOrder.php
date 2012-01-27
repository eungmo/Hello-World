<html>
<head>
	<title>Joe's fruit store - Order Result</title>
</head>
<body>
	<h1>Joe's fruit store</h1>
	<h2>Order Results</h2>
	<?php
		echo "<p>Order Processed at ".date('H:i, jS F Y')."</p>";
		echo '<P>Your order is as follows: </p>';
		
		$apple = $_POST['apple'];
		$orange = $_POST['orange'];
		$banana = $_POST['banana'];
		
		$totalqty = $apple + $orange + $banana;
		echo "Item ordered: ".$totalqty."<br />";		//주문 갯수 출력
		$totalamount = 0.00;

		define('APPLEPRICE', 1100);
		define('ORANGEPRICE', 700);
		define('BANANAPRICE', 3000);

		$totalamount = $apple*APPLEPRICE + $orange*ORANGEPRICE + $banana*BANANAPRICE;
		
		echo "Subtotal : ".number_format($totalamount,0)." Won<br />";		//주문 가격 출력

		$taxrate = 0.10;	//세금
		$totalamount = $totalamount*(1 + $taxrate);
		echo "Total including tax: ".number_format($totalamount,0)." Won<br />";	//세금을 포함한 주문 가격 출력

		switch($_POST['find']) {
			case "a" :
				echo "<p>Regular customer.</p>";
				break;
			case "b" :
				echo "<p>Customer referred by TV advert.</p>";
				break;
			case "c" :
				echo "<p>Customer referred by Phone directory.</p>";
				break;
			case "d" :
				echo "<p>Customer referred by word of mouth</p>";
				break;
			default :
				echo "<p>We do not know this customer found us.</p>";
				break;
		}
	?>
</body>
</html>