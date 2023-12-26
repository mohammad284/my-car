
	@include('front-end.layout-pages.header')
            <!-- breadcrumb_section - start
			================================================== -->
			<section class="breadcrumb_section text-center clearfix">
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="front_end/assets/images/breadcrumb/1644302692bmw.png">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">update profile</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.html">Home</a></li>
							<li>update profile</li>
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

                <div class="register_card mb-0" data-bg-color="##F2F2F2" data-aos="fade-up" data-aos-delay="100">
						<div class="section_title mb_30 text-center">
							<h2 class="title_text mb-0" data-aos="fade-up" data-aos-delay="300">
								<span>update profile:</span>
							</h2>
						</div>
						<form method="POST" enctype="multipart/form-data" action="/updateAccount">
							@csrf
							<div class="row justify-content-lg-between">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="500">
									<div class="form_item">
										<input type="text" name="name" value="{{$user->name}}" >
									</div>
									<div class="form_item">
										<input type="email" name="email" value="{{$user->email}}"  >
									</div>

									<div class="form_item">
										<input type="text" name="mobile" value="{{$user->mobile}}" >
									</div>
                                    <div class="form_item">
										<input type="text" name="provider_address" value="{{$user->provider_address}}" >
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="700">
									<div class="form_item">
										<input type="password" name="password" placeholder="Password*">
									</div>
									<div class="form_item">
										<input type="password" name="password_confirmation" placeholder="Confirm Password*">
									</div>
									<button type="submit" class="custom_btn bg_default_red text-uppercase mb-0">update <img src="front_end/assets/images/icons/icon_01.png" alt="icon_not_found"></button>
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