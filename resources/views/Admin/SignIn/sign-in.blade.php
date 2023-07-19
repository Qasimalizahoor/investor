<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Sign In | AdminKit Demo</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome back, <span id="roleNameDisplay"> </span></h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									{{-- @error('error')
										<span class="text-danger  text-center" id="errorMessage">{{$message}}</span>
									@enderror --}}
									{{-- <div class="text-center">
										<img src="img/avatars/avatar.jpg" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132" />
									</div> --}}
									<form action="{{ route('login') }}" method="POST">
										@csrf
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" id="email" type="email" name="email" placeholder="Enter your email" />
										</div>
										<div class="mb-3">
											<label class="form-label">Your Role</label>
											<select class="form-control form-control-lg" name="role" id="role">
												<option selected disabled>Select Role</option>
												<option value="admin">Admin</option>
												<option value="user">User</option>
												<option value="support">Support</option>
											</select>
										</div>

										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" id="password" type="password" name="password" placeholder="Enter your password" />
											{{-- <small><a href="index.html">Forgot password?</a> </small> --}}
										</div>
										{{-- <div>
											<label class="form-check">
            <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
            <span class="form-check-label">
              Remember me next time
            </span>
          </label>
										</div> --}}
										<div class="text-center mt-3">
											 <button type="submit" class="btn btn-lg btn-primary">Sign in</button> 
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
	{{-- <script>
		$(document ).ready(function(){
			$('#password , #email').keypress(function(){
				$('#errorMessage').hide();
			})
		})
	</script> --}}

	<script>
		$(document).ready(function() {
            // Trigger the initial selection
            displaySelectedRole();

            // Handle role selection change event
            $('#role').on('change', function() {
                displaySelectedRole();
            });

            function displaySelectedRole() {
				
                var selectedRole = $('#role option:selected').text();
				if (selectedRole === "Select Role") {
       				 $('#roleNameDisplay').empty();
						return;
					}
                var characters = selectedRole.split('');
				
                $('#roleNameDisplay').empty();

                $.each(characters, function(index, character) {
                    var delay = index * 80; // Delay in milliseconds for each character

                    setTimeout(function() {
                        $('#roleNameDisplay').append(character);
                    }, delay);
                });
            }
        });



	</script>

</body>

</html>