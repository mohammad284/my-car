@include('front-end.layout-pages.header')
			<!-- breadcrumb_section - start
			================================================== -->
			<section class="breadcrumb_section text-center clearfix">
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="assets/images/breadcrumb/bg_08.jpg">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">Frequently Asked Questions</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.html">Home</a></li>
							<li>Privacy</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- breadcrumb_section - end
			================================================== -->


			<!-- faq_section - start
			================================================== -->
			<section class="faq_section sec_ptb_100 clearfix">
				<div class="container">
					<div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">

                    <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 order-last">
							<div class="faq_content">
								<h2 class="title_text mb_15" data-aos="fade-up" data-aos-delay="100">Privacy Policy</h2>

								<p class="mb_30" data-aos="fade-up" data-aos-delay="200">
									{{$privacy->privacy_policy}}
								</p>

							</div>
						</div>
                        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 order-last">
							<div class="faq_content">
								<h2 class="title_text mb_15" data-aos="fade-up" data-aos-delay="100">Terms and Conditions</h2>


								<p class="mb_30" data-aos="fade-up" data-aos-delay="200">
									{{$privacy->Terms}}
								</p>
							</div>
						</div>

						
					</div>
				</div>
			</section>
			<!-- faq_section - end
			================================================== -->



		</main>
		<!-- main body - end
		================================================== -->
    @include('front-end.layout-pages.footer')