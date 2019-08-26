<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta hrttp-equiv="X-UA-Compatible" content="ie=edge">
	<title>Order Acceptance</title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>    
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="StyleSheet" type="text/css" href="<?php echo base_url()."assets/css/bootstrap.min.css"; ?>">
    <link rel="StyleSheet" type="text/css" href="<?php echo base_url()."assets/css/main.css"; ?>">
</head>
<body>
	<form action="">
		<div id="cart"></div>
	</form>
	
</body>
<script src="<?php echo base_url().'assets/js/bootstrap.min.js';?>"></script>
<script>
	$(document).ready(function (){

		var div = document.getElementById('cart');
		var url = "<?php echo site_url('OrderAcceptanceApi/ViewCart');?>";
		viewCart();
		async function viewCart()
		{
			let request = await fetch(url);
			let response = await request.json();
			// var count = Object.keys(response).length;
			console.log(response);
			let cartid = new Array();
			cartid.name = "cartid";
			i = 0;
			
			response.map(r=>{
				let para = document.createElement('p');
				let textnode = r.id;
				cartid[i] = r.id;
				i++;
				let text = document.createTextNode('cart Id :'+textnode);
				para.appendChild(text);
				div.appendChild(para);
				
			});
			let button = document.createElement('input');
			button.type = "button";
			button.value = "Place Order";
			let arr = document.createElement('input');
			arr.value = JSON.stringify(cartid);
			arr.type = "hidden";
			arr.name = "arr";
			arr.id = "arr";
			div.appendChild(arr);
			div.appendChild(button);
			button.onclick = async function(){
					let url = "<?php echo site_url('OrderAcceptanceApi/InsertOrder'); ?>";
					let form = new FormData();
					form.append('arr',arr.value);
					// console.log(form);

					// for (var key of form.entries()) {
					// 	console.log(key[0] + ', ' + key[1]);
					// }
					let request = await fetch(url,{
						method : "post",
						body : form
					});
					// console.log(request);
					
					let response = await request.json();
					console.log(response);
					
			}
			
		}

	});
</script>
</html>