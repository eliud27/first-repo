<?php 
	
	include 'include/conn.php'; 
	include'include/session.php';
	include'include/systemCheck.php';
	include'include/userCheck.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./assets/css/index.css">
	<link rel="shortcut icon" type="text/css" href="./assets/img/logo.jpeg">
	<link rel="stylesheet" type="text/css" href="./assets/bootstrap/bootstrap-icons.css">
	<title><?php echo $_GET['pagename']?></title>
</head>
<body>
	<div class="optionLink" id="optionLink"><?php include 'include/link.php';?></div>
<div class="firstHeader">
	<table width="100%">
		<tr>
			<td><center><strong class="nameCompany"><label class="companyTable">Welcome</label> E-CART Shop Online</strong></center></td>
			<td class="companyTable"><center>Mwanza-Nyasaka center, Magessa Mall | <a href="tel:+255743084795">+255 743 084 795</a>/<a href="tel:+255625368361">+255 625 368 361</a></center></td>
			<td class="companyTable">
				<a href="?page=profile&pagename=Profile"><label><i class="bi bi-person"></i> <?php echo $username; ?></label></a>
				&nbsp;<a href="pages/logout.php"><i class="bi bi-power"></i></a>
			</td>
		</tr>
	</table>
</div>
<div class="secondHeader">
	<center>
		<table class="x-table">
			<tr>
				<td>
					<form method="POST">
						<input type="text" name="search" placeholder="Search Here.." required>
						<input type="submit" name="submitSearch">
					</form>
				</td>
				<td>
					<table class="companyTable">
						<tr>
							<td><img src="./assets/img/logo.jpeg"></td>
							<td><label>E-CART Shop Online, Order Fast With Free Delivery</label></td>
						</tr>
					</table>
				</td>
				<td class="cart-Count">
					<a href="?page=cart&pagename=<?php  echo $username;?> | Cart">
						<span><i class="bi bi-cart"></i><label id="countCart"><center> <?php echo $cart;?> </center></label></span>
					</a>
				</td>
			</tr>
		</table>
	</center>
</div>
<div class="containerDiv">
	<div class="normalLink">
		<div class="categoryDiv">
			<div class="categoryTitle">CATEGORIES<label class="listIcon"><i class="bi bi-list-task"></i></label></div>
			<?php

				$selectCategory = "select * from types_tbl order by typename asc";
				$queryCategory = mysqli_query($con,$selectCategory);
				if(mysqli_num_rows($queryCategory)> 0){
					while($category = mysqli_fetch_assoc($queryCategory)){
						?>
						<a href="?page=categories&pagename=<?php echo $category['typename']; ?>"><div class="categoryList"><?php echo ucfirst($category['typename']); ?></div></a>
						<?php
					}
				}else{
					echo"<center>No category</center>";
				}
			?>
		</div>
		<br><br>
		<div class="menuLinkList">
			<a href="?page=index&pagename=Lyuba Shop | Home"><div class="listLink"><i class="bi bi-house"></i> Home</div></a>
		<?php

			if(isset($_SESSION['userID'])){

				?>
				<a href="?page=profile&pagename=Profile"><div class="listLink"><i class="bi bi-person"></i> Profile</div></a>
				<a href="?page=notification&pagename=Notification"><div class="listLink"><i class="bi bi-bell"></i> Notification <?php if($notiTotal >0){echo"<label class='label-not'><center>".$notiTotal."</center></label>";}?></div></a>
				<?php
			}
		?>
		</div>
	</div>
	<div class="divBody">
		<?php include 'pages/'.$_GET['page'].'.php'; ?>
	</div>
</div><br><br><br><br><br>
<div class="footerDivLink">
	<center>
		<table width="100%">
			<tr>
				<td class="linkFooter">
					<center><a href="?page=index&pagename=Lyuba Shop | Home"><div><i class="bi bi-house"></i></div></a></center>
				</td>
				<td class="linkFooter">
					<center><a href="?page=profile&pagename=Profile"><label><i class="bi bi-person"></i></label></a></center>
				</td>
				<td class="linkFooter">
					<center><a href="?page=notification&pagename=Notification"><label><i class="bi bi-bell"></i><?php if($notiTotal >0){echo"<span class='labelnot'></span>";}?></label></a></center>
				</td>
				<input type="hidden" id="optionBtn" value="no">
				<td>
					<center><label class="buttonList" onclick="viewOption()"><i class="bi bi-list"></i></label></center>
				</td>
			</tr>
		</table>
	</center>
</div>
</body>
</html>

<script type="text/javascript">
	function viewOption(){
		
		var btn = document.getElementById('optionBtn').value;

		if(btn == "no"){

			document.getElementById('optionLink').style.width = "70%";
			document.getElementById('optionBtn').value = "yes";

		}else if(btn == "yes"){

			document.getElementById('optionLink').style.width = "0px";
			document.getElementById('optionBtn').value = "no";
		}
	}
</script>

<?php
		
		if(isset($_POST['submitSearch'])){

			$searchBox = $_POST['search'];

			echo "<script>location.href='?page=search&pagename=Result For ".$searchBox." &q=".$searchBox."';</script>";

		}

?>