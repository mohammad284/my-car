@include('front-end.layout-pages.header')

			<!-- breadcrumb_section - start
			================================================== -->
			<section class="breadcrumb_section text-center clearfix">
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="front_end/assets/images/breadcrumb/1644302692bmw.png">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">Contact Us</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.html">Home</a></li>
							<li>Contact</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- breadcrumb_section - end
			================================================== -->
            <!-- google_map_section - start
			================================================== -->
			<div class="google_map_section clearfix" data-aos="fade-up" data-aos-delay="100">
				<div id="mapBox" data-lat="23.61694" data-lon="58.28930" data-zoom="12" data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia." data-mlat="40.701083" data-mlon="-74.1522848">
				</div>
			</div>
			<!-- google_map_section - end
			================================================== -->


			<!-- contact_section - start
			================================================== -->
			<section class="contact_section clearfix">
				<div class="container">
					<div class="contact_details_wrap text-white" data-bg-color="#1F2B3E" data-aos="fade-up" data-aos-delay="100">
						<div class="row justify-content-lg-between">
							<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
								<div class="image_area">
									<div class="brand_logo mb_15">
										<a href="index.html">
											<img src="front_end/assets/images/white_logo_1c.png" srcset="front_end/assets/images/white_logo_1c.png 2x" alt="logo_not_found">
										</a>
									</div>
									<p class="mb_30">
										Mauris dignissim condimentum viverra. Curabitur blandit eu justo id porta
									</p>
									<div class="image_wrap">
										<img src="front_end/assets/images/white_logo_1.png" alt="image_not_found">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
								<div class="content_area">
									<h3 class="item_title text-white mb_30">Contact Details:</h3>
									<ul class="ul_li_block mb_30 clearfix">
										<li>
											<i class="fas fa-map-marker-alt"></i>
											Muscat
										</li>
										<li><i class="fas fa-clock"></i> WH: 8:00am - 9:30pm</li>
										<li><i class="fas fa-phone"></i> 01967 411232</li>
										<li><i class="fas fa-envelope"></i> carcome@eml.fr</li>
									</ul>

								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- contact_section - end
			================================================== -->





		</main>
		<!-- main body - end
		================================================== -->
        @include('front-end.layout-pages.footer')