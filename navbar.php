<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
	<a class="navbar-brand" href="<?php echo $base_url; ?>"><?php echo $app_name; ?></a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
			<li class="nav-item">
				<a class="nav-link" href="<?php echo $base_url; ?>?action=events">Events</a>
			</li>
			<?php if ( is_user_logged_in() ) { ?>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo $base_url; ?>?action=logout">Logout</a>
			</li>
			<?php } else { ?>
			<li class="nav-item">
				<a class="nav-link active" aria-current="page" href="<?php echo $base_url; ?>?action=signup">Register</a>
			</li>
			<?php } ?>
		</ul>
	</div>
	</div>
</nav>