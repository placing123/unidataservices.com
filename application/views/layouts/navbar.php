<nav class="navbar navbar-expand-lg custom-navbar">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#retailAdminNavbar" aria-controls="retailAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i></i>
						<i></i>
						<i></i>
					</span>
				</button>
				<div class="collapse navbar-collapse" id="retailAdminNavbar">
					<ul class="navbar-nav m-auto">
						<li class="nav-item">
							<a class="nav-link " href="<?php echo base_url().'home'?>">
								<i class="fa fa-tachometer nav-icon"></i>
								Dashboard
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="<?php echo base_url().'home'?>">
								<i class="fa fa-file nav-icon"></i>
								Data Entry
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="<?php echo base_url().'query'?>">
								<i class="fa fa-question-circle nav-icon"></i>
								Query Task (Helpline)
							</a>
						</li>
						<!-- <li class="nav-item">
							<a class="nav-link " href="wallet.php">
								<i class="fa fa-money nav-icon"></i>
								Wallet
							</a>
						</li> -->
						<li class="nav-item">
							<a class="nav-link " href="<?php echo base_url().'profile'?>">
								<i class="fa fa-user nav-icon"></i>
								Profile
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="<?php echo base_url().'agreement'?>">
								<i class="fa fa-check-circle nav-icon"></i>
								Agreement
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="<?php echo base_url().'instructions'?>">
								<i class="fa fa-list nav-icon"></i>
								Instruction
							</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-cog nav-icon"></i>
								303PJC21122021							</a>
							<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="loginDropdown">
								<li>
									<a class="dropdown-item" href="<?php echo base_url().'profile'?>">My Profile</a>
								</li>
								<li>
									<a class="dropdown-item" href="<?php echo base_url().'profile'?>">Change Password</a>
								</li>
								<li>
									<a class="dropdown-item" href="<?php echo base_url().'home'?>">Log Out</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>