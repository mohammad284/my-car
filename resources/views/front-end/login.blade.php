
	@include('front-end.layout-pages.header')
            <!-- breadcrumb_section - start
			================================================== -->
			<section class="breadcrumb_section text-center clearfix">
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="front_end/assets/images/breadcrumb/1644302692bmw.png">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">Login</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.html">Home</a></li>
							<li>Login</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- breadcrumb_section - end
			================================================== -->


			<!-- register_section - start
			================================================== -->
			<section class="register_section sec_ptb_100 clearfix">
				<div class="container">

					<div class="register_card mb_60" data-bg-color="##F2F2F2" data-aos="fade-up" data-aos-delay="100">
						<div class="row align-items-center">
							<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
								<div class="reg_image" data-aos="fade-up" data-aos-delay="300">
									<img src="front_end/assets/images/logo-01.png" alt="image_not_found">
								</div>
							</div>

							<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
								<div class="reg_form" data-aos="fade-up" data-aos-delay="500">
									<h3 class="form_title">LogIn:</h3>

									<form method="POST" enctype="multipart/form-data" action="/login">
										@csrf
										<div class="form_item">
											<input type="email" name="email" placeholder="Your email">
										</div>
										<div class="form_item">
											<input type="password" name="password" placeholder="Password">
										</div>
										<button type="submit" class="custom_btn bg_default_red text-uppercase">Login <img src="front_end/assets/images/icons/icon_01.png" alt="icon_not_found"></button>
										<span class="reset_pass mb_15"><a href="#!">Reset Your Password by e-mail?</a></span>

									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="register_card mb-0" data-bg-color="##F2F2F2" data-aos="fade-up" data-aos-delay="100">
						<div class="section_title mb_30 text-center">
							<h2 class="title_text mb-0" data-aos="fade-up" data-aos-delay="300">
								<span>Register</span>
							</h2>
						</div>
						<form method="POST" enctype="multipart/form-data" action="/register">
							@csrf
							<div class="row justify-content-lg-between">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="500">
									<div class="form_item">
										<input type="text" name="name" placeholder="Your Name*">
									</div>
									<div class="form_item">
										<input type="email" name="email" placeholder="Your Email*">
									</div>

									<div class="form_item">
										<input type="text" name="mobile" placeholder="Phone Number*">
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="700">
									<div class="form_item">
										<input type="password" name="password" placeholder="Password*">
									</div>
									<div class="form_item">
										<input type="password" name="password_confirmation" placeholder="Confirm Password*">
									</div>
									<button type="submit" class="custom_btn bg_default_red text-uppercase mb-0">Register <img src="front_end/assets/images/icons/icon_01.png" alt="icon_not_found"></button>
								</div>
							</div>
						</form>
					</div>
					
				</div>
			</section>
			<!-- register_section - end
			================================================== -->


		</main>
		<!-- main body - end
		================================================== -->
        @include('front-end.layout-pages.footer')