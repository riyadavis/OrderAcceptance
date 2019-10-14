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
			// let cartid = new Array();
			// cartid.name = "cartid";
			// i = 0;
			
			response.map(r=>{
				let para = document.createElement('p');
				let textnode = r.id;
				// cartid[i] = r.id;
				// i++;
				  cartId = document.createElement('input');
					cartId.value = r.id;
					cartId.type = "hidden";
					cartId.name = "cartId";
					cartId.id = "cartId";
					div.appendChild(cartId);
				 cartItems = document.createElement('input');
				cartItems.value = r.items_added;
				cartItems.type = "hidden";
				cartItems.id = "cartItems";
				cartItems.name = "cartItems";
				let text = document.createTextNode('cart Id :'+textnode);
				para.appendChild(text);
				div.appendChild(para);
				div.appendChild(cartItems);
				div.appendChild(cartId);
				
			});
			let button = document.createElement('input');
			button.type = "button";
			button.value = "Place Order";
			// let arr = document.createElement('input');
			// arr.value = JSON.stringify(cartid);
			// arr.type = "hidden";
			// arr.name = "arr";
			// arr.id = "arr";
			// div.appendChild(arr);
			
			div.appendChild(button); console.log(cartId.value);
			button.onclick = async function(){
					let url = "<?php echo site_url('OrderAcceptanceApi/InsertOrder'); ?>?q=1";
					let form = new FormData();
					form.append('cartItems',JSON.stringify(cartItems.value));
					form.append('cartId',cartId.value);
					// form.append('')
					console.log(form);
				// console.log(JSON.stringify(cartItems.value));
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
					push();
					 async function push()
					{
						let url = "<?php echo site_url('OrderAcceptanceApi/confirmMessage'); ?>";
						let request = await fetch (url);
						
					}
			}
			
		}

	});
</script>
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('e6256b34427ca9b29815', {
      cluster: 'ap2',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
</html>