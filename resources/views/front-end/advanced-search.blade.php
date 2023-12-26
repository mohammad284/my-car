@include('front-end.layout-pages.header')

			<!-- breadcrumb_section - start
			================================================== -->
			<section class="breadcrumb_section text-center clearfix">
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="front_end/assets/images/breadcrumb/1644302692bmw.png">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">Our cars</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.html">Home</a></li>
							<li>Our Cars</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- breadcrumb_section - end
			================================================== -->


			<!-- car_section - start
			================================================== -->
			<div class="car_section sec_ptb_100 clearfix">
				<div class="container">
					<div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">

						<div class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
							<aside class="filter_sidebar sidebar_section" data-bg-color="#F2F2F2">
								<div class="sidebar_header" data-bg-gradient="linear-gradient(90deg, #0C0C0F, #292D45)">
									<h3 class="text-white mb-0">Filters</h3>
								</div>
								<div class="sb_widget">
									<form action="/searchFiltter" method="POST" enctype="multipart/form-data">
                                        @csrf
										<div class="sb_widget price-range-area clearfix" data-aos="fade-up" data-aos-delay="100">
											<h4 class="input_title">Price</h4>
											<div id="slider-range" class="slider-range clearfix"></div>
											<input class="price-text" name="price" type="text" id="amount" readonly>
										</div>

										<div class="sb_widget car_picking" data-aos="fade-up" data-aos-delay="100">


										<div class="sb_widget" data-aos="fade-up" data-aos-delay="100">
											<h4 class="input_title">Number of passengers:</h4>
											<div class="row">
												<div class="col-lg-6">
													<div class="checkbox_input">
														<label for="passengers_radio1"><input type="radio" id="passengers_radio1" value="2" name="passengers" checked> 2</label>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="checkbox_input">
														<label for="passengers_radio2"><input type="radio" id="passengers_radio2" value="4" name="passengers"> 4</label>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="checkbox_input">
														<label for="passengers_radio3"><input type="radio" id="passengers_radio3" value="5" name="passengers"> 5</label>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="checkbox_input">
														<label for="passengers_radio4"><input type="radio" id="passengers_radio4" value="7" name="passengers"> 7 or more</label>
													</div>
												</div>
											</div>
                                            <h4 class="input_title">Number of door:</h4>
											<div class="row">
												<div class="col-lg-6">
													<div class="checkbox_input">
														<label for="passengers_radio1"><input type="radio" id="passengers_radio1" value="2" name="door" checked> 2</label>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="checkbox_input">
														<label for="passengers_radio2"><input type="radio" id="passengers_radio2" value="4" name="door"> 4</label>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="checkbox_input">
														<label for="passengers_radio4"><input type="radio" id="passengers_radio4" value="5" name="door"> more</label>
													</div>
												</div>
											</div>

                                            <h4 class="input_title">automatic:</h4>
											<div class="row">
												<div class="col-lg-6">
													<div class="checkbox_input">
														<label for="passengers_radio1"><input type="radio" id="passengers_radio1" value="1" name="automatic" checked> yes</label>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="checkbox_input">
														<label for="passengers_radio2"><input type="radio" id="passengers_radio2" value="0" name="automatic"> no</label>
													</div>
												</div>
											</div>
										</div>
										<div class="sb_widget" data-aos="fade-up" data-aos-delay="100">

                                            <div class="form_item">
												<select name="fuel_policy">
                                                <option data-display="fuel policy" selected disabled>Select A Option</option>
                                                    @foreach($cars_details as $details)
													<option value="{{$details['car']->fuel_policy}}">{{$details['car']->fuel_policy}}</option>
                                                    @endforeach
												</select>
											</div>

										</div>


										<hr data-aos="fade-up" data-aos-delay="100">

										<div data-aos="fade-up" data-aos-delay="100">
											<button type="submit" class="custom_btn bg_default_red text-uppercase">Apply Filters <img src="front_end/assets/images/icons/icon_01.png" alt="icon_not_found"></button>
										</div>
									</form>
								</div>
							</aside>
						</div>

						<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
							<div class="item_shorting clearfix" data-aos="fade-up" data-aos-delay="100">
								<div class="row align-items-center justify-content-lg-between">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<span class="item_available">research results {{$search_count}}</span>
									</div>
								</div>
							</div>

							<div class="row">
                                @foreach($cars_details as $details)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="100">
                                            <h3 class="item_title mb-0">
                                                <a href="#!">
                                                    {{$details['car']->name}}
                                                </a>
                                            </h3>
                                            <div class="item_image position-relative">
                                                <a class="image_wrap" href="#!">
                                                    <img src="{{ asset($details['image']->image) }}" alt="image_not_found">
                                                </a>
                                                <span class="item_price bg_default_blue">${{$details['car']->price_for_day}}/Day</span>
                                            </div>
                                            <ul class="info_list ul_li_center clearfix">
                                                <li>Auto</li>
                                                <li>2 Passengers</li>
                                                <li>Gasoline</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
							</div>
                            
							<div class="pagination_wrap clearfix" data-aos="fade-up" data-aos-delay="100">
								<div class="row align-items-center justify-content-lg-between">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<ul class="pagination_nav ul_li_right clearfix">
										</ul>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- car_section - end
			================================================== -->



		</main>
		<!-- main body - end
		================================================== -->

@include('front-end.layout-pages.footer')