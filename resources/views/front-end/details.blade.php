@include('front-end.layout-pages.header')
			<!-- breadcrumb_section - start
			================================================== -->
			<section class="breadcrumb_section text-center clearfix">
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="{{asset($bg_image->image)}}">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">Car Details</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="/">Home</a></li>
							<li><a href="/gallery">Our Cars</a></li>
							<li>Car Details</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- breadcrumb_section - end
			================================================== -->


			<!-- details_section - start
			================================================== -->
			<div class="details_section sec_ptb_100 pb-0 clearfix">
				<div class="container">
					<div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">

						<div style="max-width: 85%;flex: 0 0 85%;-ms-flex: 0 0 85%;" class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
							<div class="car_choose_carousel mb_30 clearfix">
								<div class="thumbnail_carousel" data-aos="fade-up" data-aos-delay="100">

								@foreach($images as $image)
									<div class="item">
											<div class="item_head">
												<h4 class="item_title mb-0">{{$car->name}}</h4>
												<ul class="review_text ul_li_right clearfix">
													<li class="text-right">
														<strong>Super</strong>
														<small>{{$review_count}} Reviews</small>
													</li>
													<li><span class="bg_default_blue">{{$car->rating}}/5</span></li>
												</ul>
											</div>
											
											<img style="height: 430px;" src="{{asset ($image->image)}}" alt="image_not_found">
											
											<ul class="btns_group ul_li_center clearfix">
												<li>
													<span class="custom_btn btn_width bg_default_blue"> ${{$car->price_for_day}}/Day</span>
												</li>
												<li>
													<form method="POST" enctype="multipart/form-data" action="/reservation">
														@csrf
														<div>
															<input type="hidden" name="car_id" value="{{$car->id}}" />
															<button class="custom_btn btn_width bg_default_red text-uppercase" type="submit"><span>Book A Car</span><img src="front_end/assets/images/icons/icon_01.png" alt="icon_not_found"></a></button>
														</div>
													</form>
												</li>

											</ul>
										</div>
									@endforeach
								</div>


								<div class="thumbnail_carousel_nav" data-aos="fade-up" data-aos-delay="100">
								@foreach($images as $image)
									<div class="item">
										<img  src="{{asset ($image->image)}}" alt="image_not_found">
									</div>
									@endforeach

								</div>
							</div>

							<div class="car_choose_content">
								<ul class="info_list ul_li_block mb_15 clearfix" data-aos="fade-up" data-aos-delay="100">
									<li><strong>Passengers:</strong> {{$car->site}}</li>
									<li><strong>plat number:</strong> {{$car->number_of_car}}</li>
									<li><strong>Doors:</strong> {{$car->door}}</li>
									<li><strong>mileage:</strong> {{$car->mileage}}</li>
									<li><strong>fuel policy:</strong>{{$car->fuel_policy}}</li>
									<li><strong>location:</strong> {{$car->car_location}}</li>
								</ul>
								<!-- <div data-aos="fade-up" data-aos-delay="200">
									<a class="terms_condition" href="#!"><i class="fas fa-info-circle mr-1"></i> Terms and conditions</a>
								</div> -->

								<hr data-aos="fade-up" data-aos-delay="300">

								<div class="rent_details_info">
									<h4 class="list_title" data-aos="fade-up" data-aos-delay="100">Rent Details:</h4>
									<ul class="info_list ul_li_block mb_15 clearfix" data-aos="fade-up" data-aos-delay="100">
									<li><strong>specification:</strong> {{$car->specification}}</li>
									<li><strong>price:</strong> {{$car->price_for_day}}</li>
									<li><strong>security deposit:</strong> {{$car->security_deposit}}</li>
									<li><strong>damage excess:</strong> {{$car->damage_excess}}</li>
									<li><strong>extra information:</strong>{{$car->extra_information}}</li>
									<li><strong>important information:</strong> {{$car->important_information}}</li>
								</ul>
								</div>

								<hr data-aos="fade-up" data-aos-delay="100">

								<div class="testimonial_contants_wrap">
									<h3 class="item_title mb_30" data-aos="fade-up" data-aos-delay="100">Recent Reviews:</h3>
									@foreach($review_details as $details)
										<div class="testimonial_item clearfix">
											<div class="admin_info_wrap clearfix" data-aos="fade-up" data-aos-delay="200">
												<div class="admin_image">
													<img src="front_end/assets/images/meta/img_01.png" alt="image_not_found">
												</div>
												<div class="admin_content">
													<h4 class="admin_name">{{$details['user']->name}}</h4>
													<ul class="rating_star ul_li clearfix">
														@for($i=0;$i<$details['review']->rate;$i++)
															<li class="active"><i class="fas fa-star"></i></li>
														@endfor
													</ul>
												</div>
											</div>
											<p class="mb-0" data-aos="fade-up" data-aos-delay="300">
												“{{$details['review']->comment}}”
											</p>
										</div>
									@endforeach

								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- details_section - end
			================================================== -->


			<!-- cars_section - start
			================================================== -->
			<section class="cars_section sec_ptb_100 clearfix">
			<h3 class="item_title mb_30" data-aos="fade-up" data-aos-delay="100">same cars:</h3>
				<div class="offers_car_carousel slideshow4_slider" data-aos="fade-up" data-aos-delay="100">
					@foreach($car_type_details as $details)
					<div class="item">
						<div class="gallery_fullimage_2">
							<img style="height: 320px;" src="{{asset($details['image']->image)}}" alt="image_not_found">
							<div class="item_content text-white">
								<span class="item_price bg_default_blue">${{$details['car_type']->price_for_day}}/Day</span>
								<h3 class="item_title text-white">Phasellus porta pulvinar metus</h3>
								<!-- <a class="text_btn text-uppercase" href="/"><span>Kook A Car</span> <img src="front_end/assets/images/icons/icon_02.png" alt="icon_not_found"></a> -->
								<form method="POST" enctype="multipart/form-data" action="/details">
										@csrf
										<div class="form_item">
											<input type="hidden" name="car_id" value="{{$details['car_type']->id}}" />
											<button class="text_btn text-uppercase" type="submit"><span>Kook A Car</span><img src="front_end/assets/images/icons/icon_02.png" alt="icon_not_found"></a></button>
										</div>
									</form>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</section>
			<!-- cars_section - end
			================================================== -->


		</main>
		<!-- main body - end
		================================================== -->



@include('front-end.layout-pages.footer')