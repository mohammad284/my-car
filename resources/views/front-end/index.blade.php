@include('front-end.layout-index.header')
@push('plugin-styles')
  <?php
  $lang = Session('locale');
  if ($lang != "en") {
      $lang = "ar";
  }
?>
  @if($lang == 'en')
  <link href="{{ asset('assets/massageltr.css') }}" rel="stylesheet" />
  @else
  <link href="{{ asset('assets/massage.css') }}" rel="stylesheet" />
  @endif
@endpush
@if(session()->has('message'))
<p class="message-box" >
    {{ session()->get('message') }}
</p>
@endif
			<!-- banner_section - start
			================================================== -->
			<section class="banner_section parallaxie has_overlay text-white d-flex align-items-center clearfix" data-bg-image="front_end/assets/images/breadcrumb/1920x1080_nissan-sentra-cup-2021-4k-5k-cars.jpg">
				<div class="overlay"></div>
				<div class="container">
					<div class="row align-items-center justify-content-lg-between">
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							<div class="banner_content">
								<h1 class="text-white text-uppercase" data-aos="fade-up" data-aos-delay="100">Find that car</h1>
								<p data-aos="fade-up" data-aos-delay="300">
								This text is an example of a text that can be replaced in the same space.
								</p>
								<div data-aos="fade-up" data-aos-delay="500">
									<a class="custom_btn bg_default_red btn_width text-uppercase" href="/gallery">Find A Car <img src="front_end/assets/images/icons/icon_01.png" alt="icon_not_found"></a>
								</div>
							</div>
						</div>

						<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
							<div id="banner_accordion" class="banner_accordion">
								@foreach($last_advetising_details as $details)
								<div class="card" data-aos="fade-up" data-aos-delay="100">
									<div class="card-header" id="heading_one">
										<button data-toggle="collapse" data-target="#collapse_one" aria-expanded="true" aria-controls="collapse_one">
											{{$details['car']->name}}
										</button>
									</div>

									<div id="collapse_one" class="collapse show" aria-labelledby="heading_one" data-parent="#banner_accordion">
										<div class="card-body">
											<strong>${{$details['car']->price_for_day}}/day</strong>
											<p>
												{{$details['advertising']->text}}
											</p>
										</div>
									</div>
								</div>
  								@endforeach
							</div>
						</div>
					</div>

					<div class="advance_search_form">
						<div class="section_title text-center mb_30">
							<h2 class="title_text mb-0 text-white" data-aos="fade-up" data-aos-delay="100">
								<span>Find the right car for every occasion</span>
							</h2>
						</div>
						<form method="POST" enctype="multipart/form-data" action="/advancedSearch">
							@csrf
							<div class="row">
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
									<div class="form_item" data-aos="fade-up" data-aos-delay="100">
										<h4 class="input_title text-white">Pick Up Location</h4>
										<div class="position-relative">
											<input id="location_two" type="text" name="location" placeholder="City, State or Airport Code">
											<label for="location_two" class="input_icon"><i class="fas fa-map-marker-alt"></i></label>
										</div>
									</div>
								</div>

								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
									<div class="form_item" data-aos="fade-up" data-aos-delay="300">
										<h4 class="input_title text-white">Pick A Start Date</h4>
										<input type="date" name="start_date">
									</div>
								</div>

								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
									<div class="form_item" data-aos="fade-up" data-aos-delay="300">
										<h4 class="input_title text-white">Pick A End Date</h4>
										<input type="date" name="end_date">
									</div>
								</div>
							</div>
							<hr class="mt-0">

							<div class="row">
								<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
									<div class="form_item mb-0" data-aos="fade-up" data-aos-delay="100">
										<select name="type">
											<option value="0" data-display="All Cars Type">Nothing</option>
												@foreach($car_types as $type)
													<option value="{{$type->id}}">{{$type->type}}</option>
												@endforeach
										</select>
									</div>
								</div>
  								<br>
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div data-aos="fade-up" data-aos-delay="300">
										<button type="submit" class="custom_btn bg_default_red btn_width text-uppercase">Find A Car <img src="front_end/assets/images/icons/icon_01.png" alt="icon_not_found"></button>
									</div>
								</div>
							</div>
							
						</form>
					</div>
				</div>
			</section>
			<!-- banner_section - end
			================================================== -->





			<!-- offer_section - start
			================================================== -->
			<section class="offer_section sec_ptb_150 clearfix">
				<div class="container">
					<div class="has_serial_number">
						<div class="row justify-content-lg-between">
							<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
								<div class="serial_number text-right" data-aos="fade-up" data-aos-delay="100">
									<span>01</span>
									<h4 class="mb-0">My Advertising</h4>
								</div>
							</div>

							<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
								<div class="offer_content">
									<h2 class="item_title" data-aos="fade-up" data-aos-delay="100">
									In this section we put the latest ads
									</h2>
									<div data-aos="fade-up" data-aos-delay="500">
										<a class="text_btn text-uppercase" href="/allAdvertising"><span>View All Advertising</span> <img src="front_end/assets/images/icons/icon_02.png" alt="icon_not_found"></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- offer_section - end
			================================================== -->


			<!-- cars_section - start
			================================================== -->
			<section class="cars_section clearfix">
				<div class="offers_car_carousel slideshow4_slider" data-slick='{"dots": false}' data-aos="fade-up" data-aos-delay="100">
					@foreach($advertising_details as $advertising)
						<div class="item">
							<div class="gallery_fullimage_2">
								<img src="{{asset($advertising['image']->image)}}" alt="image_not_found">
								<div class="item_content text-white">
									<span class="item_price bg_default_blue">${{$advertising['car']->price_for_day}}/Day</span>
									<h3 class="item_title text-white">{{$advertising['car']->name}}</h3>
									<form method="POST" enctype="multipart/form-data" action="/details">
										@csrf
										<div class="form_item">
											<input type="hidden" name="car_id" value="{{$advertising['car']->id}}" />
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



			<!-- feature_section - start
			================================================== -->
			<section class="feature_section sec_ptb_150 clearfix" data-bg-color="#F2F2F2">
				<div class="container">

					<div class="row justify-content-center">
						<div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
							<div class="section_title mb_60 text-center" data-aos="fade-up" data-aos-delay="100">
								<h2 class="title_text mb_15">
									<span>Featured Vehicles</span>
								</h2>
								<p class="mb-0">
								This text is an example of a text that can be replaced in the same space.
								</p>
							</div>
						</div>
					</div>

					<ul class="button-group filters-button-group ul_li_center mb_30 clearfix" data-aos="fade-up" data-aos-delay="300">
						<li><button class="button active" data-filter="*">All</button></li>
						@foreach($car_types as $type)
							<li><button class="button" data-filter=".{{$type->type}}">{{$type->type}}</button></li>
						@endforeach
					</ul>
					<div class="feature_vehicle_filter mb-0 element-grid clearfix">
						@foreach($car_details as $details)
							<div class="element-item {{$details['type']->type}} " data-category="{{$details['type']->type}}">
								<div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="100">
									<h3 class="item_title mb-0">
										<a href="#!">
										{{$details['car']->name}}
										</a>
									</h3>
									<div class="item_image position-relative"> 
										<form method="POST" enctype="multipart/form-data" action="/details">
											@csrf
											<div class="form_item">
												<input type="hidden" name="car_id" value="{{$details['car']->id}}" />
												<button  type="submit" class="image_wrap" >
													<img  style="height: 210px;" src="{{ asset ($details['image']->image)  }}" alt="image_not_found">
												</button>
												<!-- <button class="text_btn text-uppercase" type="submit"><span>Kook A Car</span><img src="front_end/assets/images/icons/icon_02.png" alt="icon_not_found"></a></button> -->
											</div>
										</form>


										<span class="item_price bg_default_blue">${{$details['car']->price_for_day}}/Day</span>
										
									</div> 
									<ul class="info_list ul_li_center clearfix">
										<li>Sports</li>
										<li>Auto</li>
										<li>{{$details['car']->site}} Passengers</li>
										<li>Gasoline</li>
									</ul>
								</div>
							</div>
						@endforeach
					</div>



				</div>
			</section>
			<!-- feature_section - end
			================================================== -->



			<!-- testimonial_section - start
			================================================== -->
			<section class="testimonial_section sec_ptb_150 clearfix">
				<div class="container">

					<div class="has_serial_number">
						<div class="row justify-content-lg-between">
							<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
								<div class="serial_number text-right" data-aos="fade-up" data-aos-delay="100">
									<span>02</span>
									<h4 class="mb-0">Reviews</h4>
								</div>
							</div>

							<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
								<div class="testimonial_contants_wrap">
									<h2 class="item_title mb_30" data-aos="fade-up" data-aos-delay="100">
										Reviews from our clients:
									</h2>

									@foreach($all_review as $review)
										<div class="testimonial_item clearfix">
											<div class="admin_info_wrap clearfix" data-aos="fade-up" data-aos-delay="100">
												<div class="admin_image">
													<img src="front_end/assets/images/meta/img_01.png" alt="image_not_found">
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
												{{$review['review']->comment}}
											</p>
											<div class="row">
												@foreach($review['images'] as $image)
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
														<div class="review_image" data-aos="fade-up" data-aos-delay="300">
															<img src="{{asset($image->image)}}" alt="image_not_found">
														</div>
													</div>
												@endforeach
											</div>
										</div>
									@endforeach

									<div class="links_erap clearfix">
										<div class="row align-items-center justify-content-lg-between">
											<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
												<div class="abtn_wrap clearfix" data-aos="fade-up" data-aos-delay="100">
													<a class="text_btn text-uppercase" href="/allReview"><span>View All Reviews</span> <img src="front_end/assets/images/icons/icon_02.png" alt="icon_not_found"></a>
												</div>
											</div>
											<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
												<ul class="primary_social_links ul_li_right clearfix" data-aos="fade-up" data-aos-delay="200">
													<li><span class="social_list_title">Follow Us:</span></li>
													<li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
													<li><a href="#!"><i class="fab fa-youtube"></i></a></li>
													<li><a href="#!"><i class="fab fa-instagram"></i></a></li>
													<li><a href="#!"><i class="fab fa-twitter"></i></a></li>
													<li><a href="#!"><i class="fas fa-envelope"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<!-- testimonial_section - end
			================================================== -->


			<!-- blog_section - start
			================================================== -
			<section class="blog_section clearfix">
				<div class="updown_style_wrap">

					<div class="updown_style">
						<div class="blog_fullimage" data-aos="fade-up" data-aos-delay="100">
							<img src="front_end/assets/images/blog/img_01.jpg" alt="image_not_found">
							<div class="item_content text-white">
								<h3 class="item_title text-white">Cras eu ante bibendum, lacinia velit sit amet, scelerisque enim</h3>
								<p>
									Phasellus porta pulvinar metus, sit amet bibendum lectus hendrerit vel. Duis ullamcorper, justo quis hendrerit venenatis, purus mi volutpat dui, vel commodo urna eros eget sapien
								</p>
								<a class="text_btn text-uppercase" href="#!"><span>Read in our blog</span> <img src="front_end/assets/images/icons/icon_02.png" alt="icon_not_found"></a>
							</div>
						</div>

						<div class="blog_fullimage" data-aos="fade-up" data-aos-delay="300">
							<img src="front_end/assets/images/blog/img_02.jpg" alt="image_not_found">
							<div class="item_content text-white">
								<h3 class="item_title text-white">Phasellus porta pulvinar metus</h3>
								<p>
									Phasellus porta pulvinar metus, sit amet bibendum lectus hendrerit vel. Duis ullamcorper, justo quis hendrerit venenatis, purus mi volutpat dui, vel commodo urna eros eget sapien
								</p>
								<a class="text_btn text-uppercase" href="#!"><span>Read in our blog</span> <img src="front_end/assets/images/icons/icon_02.png" alt="icon_not_found"></a>
							</div>
						</div>
					</div>

					<div class="updown_style">
						<div class="blog_fullimage" data-aos="fade-up" data-aos-delay="100">
							<img src="front_end/assets/images/blog/img_03.jpg" alt="image_not_found">
							<div class="item_content text-white">
								<h3 class="item_title text-white">Fed finibus mi et purus finibus, ut condimentum mauris fringilla</h3>
								<p>
									Phasellus porta pulvinar metus, sit amet bibendum lectus hendrerit vel. Duis ullamcorper, justo quis hendrerit venenatis, purus mi volutpat dui, vel commodo urna eros eget sapien
								</p>
								<a class="text_btn text-uppercase" href="#!"><span>Read in our blog</span> <img src="front_end/assets/images/icons/icon_02.png" alt="icon_not_found"></a>
							</div>
						</div>

						<div class="blog_fullimage" data-aos="fade-up" data-aos-delay="300">
							<img src="front_end/assets/images/blog/img_04.jpg" alt="image_not_found">
							<div class="item_content text-white">
								<h3 class="item_title text-white">Maecenas sagittis turpis non pharetra pulvinar. Nullam mollis tortor eget</h3>
								<p>
									Phasellus porta pulvinar metus, sit amet bibendum lectus hendrerit vel. Duis ullamcorper, justo quis hendrerit venenatis, purus mi volutpat dui, vel commodo urna eros eget sapien
								</p>
								<a class="text_btn text-uppercase" href="#!"><span>Read in our blog</span> <img src="front_end/assets/images/icons/icon_02.png" alt="icon_not_found"></a>
							</div>
						</div>
					</div>

				</div>
			</section>
			 blog_section - end
			================================================== -->


		</main>
		<!-- main body - end
		================================================== -->
@include('front-end.layout-index.footer')

