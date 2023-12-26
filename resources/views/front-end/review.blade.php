@include('front-end.layout-pages.header')
		<!-- breadcrumb_section - start
			================================================== -->
			<section class="breadcrumb_section text-center clearfix">
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="front_end/assets/images/breadcrumb/1644302692bmw.png">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">Reviews</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.html">Home</a></li>
							<li>Reviews</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- breadcrumb_section - end
			================================================== -->


			<!-- testimonial_section - start
			================================================== -->
			<section class="testimonial_section sec_ptb_150 clearfix">
				<div class="container">

					<div class="section_title mb_60 text-center" data-aos="fade-up" data-aos-delay="100">
						<h2 class="title_text mb-0">
							<span>What Clients Say about Us</span>
						</h2>
					</div>

					<div class="testimonial_carousel_wrap position-relative" data-aos="fade-up" data-aos-delay="300">
						<div class="testimonial_carousel" data-slick='{"dots": false}'>
							@foreach($all_review as $review)
								<div class="item">
									<div class="testimonial_item2 text-center">
										<p class="mb_30">
											“{{$review['review']->comment}}”
										</p>
										<div class="admin_info">
											<div class="admin_image">
												<img src="{{asset($review['user']->image)}}" alt="image_not_found">
											</div>
											<h4 class="admin_name">{{$review['user']->name}}</h4>
											<ul class="rating_star ul_li_center clearfix">
												<?php $i = 0 ?>
												@for($i=0;$i<$review['review']->rate;$i++)
												<li class="active"><i class="fas fa-star"></i></li>
												@endfor
											</ul>
										</div>
									</div>
								</div>
							@endforeach
						</div>

						<div class="carousel_nav position_ycenter">
							<button type="button" class="ts_left_arrow"><i class="fal fa-angle-left"></i></button>
							<button type="button" class="ts_right_arrow"><i class="fal fa-angle-right"></i></button>
						</div>
					</div>
					
				</div>
			</section>
			<!-- testimonial_section - end
			================================================== -->


			<!-- comment_form_section - start
			================================================== -->
			<!-- <section class="comment_form_section sec_ptb_150 parallaxie has_overlay clearfix" data-bg-image="front_end/assets/images/backgrounds/bg_03.jpg">
				<div class="overlay"></div>

				<div class="container">
					<div class="section_title mb_60 text-center" data-aos="fade-up" data-aos-delay="100">
						<h2 class="title_text text-white mb-0">
							<span>Leave Your Feedback</span>
						</h2>
					</div>

					<form action="#">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form_item" data-aos="fade-up" data-aos-delay="300">
									<input type="text" name="firstname" placeholder="First Name">
								</div>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form_item" data-aos="fade-up" data-aos-delay="400">
									<input type="text" name="lastname" placeholder="Last Name">
								</div>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form_item" data-aos="fade-up" data-aos-delay="500">
									<input type="email" name="email" placeholder="E-mail">
								</div>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form_item" data-aos="fade-up" data-aos-delay="600">
									<select>
										<option data-display="Please Rate Us">Select A Option</option>
										<option value="1">Option 1</option>
										<option value="2">Option 2</option>
										<option value="3" disabled>Option 3</option>
										<option value="4">Option 4</option>
									</select>
								</div>
							</div>
						</div>

						<div class="form_item" data-aos="fade-up" data-aos-delay="700">
							<textarea name="commtent" placeholder="Leave Your Review"></textarea>
						</div>

						<div class="abtn_wrap text-center clearfix" data-aos="fade-up" data-aos-delay="800">
							<button type="submit" class="custom_btn bg_default_red btn_width text-uppercase">Leave Testimonial <img src="front_end/assets/images/icons/icon_01.png" alt="icon_not_found"></button>
						</div>
					</form>
				</div>
			</section> -->
			<!-- comment_form_section - end
			================================================== -->


			<!-- testimonial_section - start
			================================================== -->
			<section class="testimonial_section sec_ptb_150 clearfix">
				<div class="container">
					<div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">

						<div style="max-width: 85%;flex: 0 0 85%;-ms-flex: 0 0 85%;" class="col-lg-8 col-md-8 col-sm-10 col-xs-12 order-last">
							<div class="testimonial_contants_wrap">
								@foreach($all_review as $review)
									<div class="testimonial_item clearfix">
										<div class="admin_info_wrap clearfix" data-aos="fade-up" data-aos-delay="100">
											<div class="admin_image">
												<img src="{{asset($review['user']->image)}}" alt="image_not_found">
											</div>
											<div class="admin_content">
												<h4 class="admin_name">{{$review['user']->name}}</h4>
												<ul class="rating_star ul_li clearfix">
												<?php $i = 0 ?>
												@for($i=0;$i<$review['review']->rate;$i++)
												<li class="active"><i class="fas fa-star"></i></li>
												@endfor
												</ul>
											</div>
										</div>
										<p class="mb-0" data-aos="fade-up" data-aos-delay="200">
										“{{$review['review']->comment}}”
										</p>
										<div class="row">
											@foreach($review['images'] as $image)
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="review_image" data-aos="fade-up" data-aos-delay="400">
														<img src="{{asset($image->image)}}" alt="image_not_found">
													</div>
												</div>
											@endforeach
										</div>
									</div>
								@endforeach

								<!-- <div class="pagination_wrap border-0 pt-0 mt-0 clearfix">
									<div class="row align-items-center justify-content-lg-between">
										<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
											<span class="page_number" data-aos="fade-up" data-aos-delay="100">Page 1 of 3</span>
										</div>

										<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
											<ul class="pagination_nav ul_li_right clearfix" data-aos="fade-up" data-aos-delay="300">
												<li><a href="#!"><i class="fal fa-angle-double-left"></i></a></li>
												<li class="active"><a href="#!">1</a></li>
												<li><a href="#!">2</a></li>
												<li><a href="#!">3</a></li>
												<li><a href="#!"><i class="fal fa-angle-double-right"></i></a></li>
											</ul>
										</div>
									</div>
								</div> -->
							</div>
						</div>

						<!-- <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
							<aside class="sidebar_section clearfix" data-bg-color="#F2F2F2">
								<div class="sb_widget sb_subscrib_form" data-aos="fade-up" data-aos-delay="100">
									<h3 class="sb_widget_title">Subscribe:</h3>
									<form action="#">
										<div class="form_item">
											<input type="email" name="email" placeholder="E-mail">
										</div>
										<button type="submit" class="custom_btn bg_default_red text-uppercase">Subscribe <img src="front_end/assets/images/icons/icon_01.png" alt="icon_not_found"></button>
									</form>
								</div>

								<div class="sb_widget sb_latest_newses" data-aos="fade-up" data-aos-delay="300">
									<h3 class="sb_widget_title">Latest News:</h3>

									<div class="blog_small_grid">
										<a class="item_image" href="#!">
											<img src="front_end/assets/images/blog/img_05.jpg" alt="image_not_found">
										</a>
										<div class="item_content">
											<h3 class="item_title">
												<a href="#!">
													Porta nec nibh ut sodales. Phasellus nunc nunc, auctor…
												</a>
											</h3>
											<span class="post_date">Aug. 10, 2020 / by Merkulove/ No Comments</span>
										</div>
									</div>

									<div class="blog_small_grid">
										<a class="item_image" href="#!">
											<img src="front_end/assets/images/blog/img_06.jpg" alt="image_not_found">
										</a>
										<div class="item_content">
											<h3 class="item_title">
												<a href="#!">
													Phasellus mollis tus ligula to a quam dolor...
												</a>
											</h3>
											<span class="post_date">Aug. 10, 2020 / by Merkulove/ No Comments</span>
										</div>
									</div>
								</div>

								<div class="sb_widget sb_category_list" data-aos="fade-up" data-aos-delay="400">
									<h3 class="sb_widget_title">Categories:</h3>
									<ul class="ul_li_block clearfix">
										<li><a href="#!"><i class="fas fa-caret-right"></i> Vehicle guide</a></li>
										<li><a href="#!"><i class="fas fa-caret-right"></i> Best offers</a></li>
										<li><a href="#!"><i class="fas fa-caret-right"></i> Travel Guides</a></li>
										<li><a href="#!"><i class="fas fa-caret-right"></i> On The Road</a></li>
									</ul>
								</div>
							</aside>
						</div> -->

					</div>
				</div>
			</section>
			<!-- testimonial_section - end
			================================================== -->


		</main>
		<!-- main body - end
		================================================== -->


@include('front-end.layout-pages.footer')