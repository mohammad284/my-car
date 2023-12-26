@include('front-end.layout-pages.header')

			<!-- breadcrumb_section - start
			================================================== -->
			<section class="breadcrumb_section text-center clearfix">
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="front_end/assets/images/breadcrumb/1644302692bmw.png">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">My Account</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.html">Home</a></li>
							<li>Account</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- breadcrumb_section - end
			================================================== -->


			<!-- account_section - start
			================================================== -->
			<section class="account_section sec_ptb_100 clearfix">
				<div class="container">
					<div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">

						<div class="col-lg-4 col-md-8 col-sm-10 col-xs-12">
							<div class="account_tabs_menu clearfix" data-bg-color="#F2F2F2" data-aos="fade-up" data-aos-delay="100">
								<h3 class="list_title mb_15">Account Details:</h3>
								<ul class="ul_li_block nav" role="tablist">
									<li>
										<a class="active" data-toggle="tab" href="#admin_tab"><i class="fas fa-user"></i> {{$user->name}}</a>
									</li>
									<li>
										<a href="/logout"><i class="fas fa-sign-out-alt"></i> Log Out <img class="arrow" src="front_end/assets/images/icons/icon_02.png" alt="icon_not_found"></a>
									</li>

								</ul>
							</div>
						</div>

						<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
							<div class="account_tab_content tab-content">
								<div id="admin_tab" class="tab-pane active">
									<div class="account_info_list" data-aos="fade-up" data-aos-delay="100">
										<h3 class="list_title mb_30">Account:</h3>
										<ul class="ul_li_block clearfix">
											<li><span>Name:</span> {{$user->name}}</li>
											<li><span>E-mail:</span> {{$user->email}}</li>
											<li><span>Phone Number:</span>{{$user->mobile}}</li>
											<li><span>Address:</span> {{$user->provider_address}}</li>
										</ul>
										<a class="text_btn text-uppercase" href="/editAccount"><span>Change Account Information</span> <img src="front_end/assets/images/icons/icon_02.png" alt="icon_not_found"></a>
									</div>

								</div>

							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- account_section - end
			================================================== -->


		</main>
		<!-- main body - end
		================================================== -->

@include('front-end.layout-pages.footer')