
<footer class="footer">
	<div class="menu1">
		<ul>
			<li><a href="<?= ROOT ?>">home</a></li>
			<li><a href="<?= ROOT ?>/about.php">about us</a> </li>
			<li><a href="<?= ROOT ?>/auctions.php">auctions</a></li>
			
		</ul>		
	</div>

	<div class="menu2">
		<ul>
			<li><a href="<?= ROOT ?>/contact.php">contact Us</a></li>
			<li><a href="<?= ROOT ?>/faq.php">FAQs</a></li>
		</ul>		
	</div>

	<div class="container">
		<div class="row">
			<div class="col-12">
				<p class="text-center">&copy; <span id="footerCopyrightDate"></span> ONLINE AUCTION</p>
			</div>
		</div>
	</div>

</footer>

<script>
	document.querySelector("#footerCopyrightDate").innerHTML = new Date().getFullYear();
</script>

</body>
</html>