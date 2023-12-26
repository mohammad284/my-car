@include('front-end.layout-pages.header')

			<!-- breadcrumb_section - start
			================================================== -->
			<section class="breadcrumb_section text-center clearfix">
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="front_end/assets/images/breadcrumb/1644302692bmw.png">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">Gallery</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.html">Home</a></li>
							<li>Pages</li>
							<li>Gallery</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- breadcrumb_section - end
			================================================== -->


			<!-- gallery_section - start
			================================================== -->
			<section class="gallery_section sec_ptb_100 clearfix">
				<div class="container">

					<div class="row justify-content-center">
						<div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
							<div class="section_title mb_60 text-center" data-aos="fade-up" data-aos-delay="100">
								<h2 class="title_text mb_15">
									<span>Featured Vehicles</span>
								</h2>
								<p class="mb-0">
								This text is an example of a text that can be replaced in the same space. This text was generated from the Arabic text generator,
								</p>
							</div>
						</div>
					</div>
					
					<ul class="button-group filters-button-group ul_li_center mb_30 clearfix" data-aos="fade-up" data-aos-delay="300">
						<li><button class="button active" data-filter="*">All</button></li>
						@foreach($types as $type)
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
													<img style="height: 210px;" src="{{ asset ($details['image']->image)  }}" alt="image_not_found">
												</button>
												<!-- <button class="text_btn text-uppercase" type="submit"><span>Kook A Car</span><img src="front_end/assets/images/icons/icon_02.png" alt="icon_not_found"></a></button> -->
											</div>
										</form>
										<span class="item_price bg_default_blue">${{$details['car']->price_for_day}}/Day</span>
									</div> 
									<ul class="info_list ul_li_center clearfix">
										<li>Sports</li>
										<li>Auto</li>
										<li>2 Passengers</li>
										<li>Gasoline</li>
									</ul>
								</div>
							</div>
						@endforeach
					</div>

					<!-- <div class="pagination_wrap clearfix">
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
			</section>
			<!-- gallery_section - end
			================================================== -->


			<!-- search_section - start
			================================================== -->
			<section class="search_section sec_ptb_100 clearfix" data-bg-color="#161829">
				<div class="container">
					<div class="section_title text-center mb_60">
						<h2 class="title_text text-white mb-0" data-aos="fade-up" data-aos-delay="100"><span>Top Rate cars</span></h2>
					</div>

				</div>

				<div class="offers_car_carousel slideshow4_slider" data-aos="fade-up" data-aos-delay="700">
					@foreach($top_car_details as $details)
					<div class="item">
						<div class="gallery_fullimage_2">
							<img src="{{asset($details['image']->image)}}" alt="image_not_found">
							<div class="item_content text-white">
								<span class="item_price bg_default_blue">${{$details['car']->price_for_day}}/Day</span>
								<h3 class="item_title text-white">{{$details['car']->name}}</h3>
								<form method="POST" enctype="multipart/form-data" action="/details">
									@csrf
									<div class="form_item">
										<input type="hidden" name="car_id" value="{{$details['car']->id}}" />
										<button class="text_btn text-uppercase" type="submit"><span>Kook A Car</span><img src="front_end/assets/images/icons/icon_02.png" alt="icon_not_found"></a></button>
									</div>
								</form>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</section>
			<!-- search_section - end  
			================================================== -->


		</main>
		<!-- main body - end
		================================================== -->

		@include('front-end.layout-pages.footer')