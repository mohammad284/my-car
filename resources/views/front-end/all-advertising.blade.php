
@include('front-end.layout-pages.header')
			<!-- breadcrumb_section - start
			================================================== -->
			<section class="breadcrumb_section text-center clearfix">
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="front_end/assets/images/breadcrumb/1644302692bmw.png">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">all Advertising</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.html">Home</a></li>
							<li>all Advertising</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- breadcrumb_section - end
			================================================== -->


			<!-- main_office_section - start
			================================================== -->
            @foreach($advertising_details as $details)

			<section class="main_office_section sec_ptb_100 clearfix">
                <div class="container">
                    <div class="row align-items-center justify-content-lg-between justify-content-sm-center">
                        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                            <div class="office_image" data-aos="fade-up" data-aos-delay="100">
                                <img src="{{asset($details['advertising']->image)}}" alt="image_not_found">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                            <div class="office_info" data-aos="fade-up" data-aos-delay="300">
                                <h3 class="item_title">Advertising:</h3>
                                <ul class="ul_li_block clearfix">
                                    <li>
									<strong><span>adertising : </span></strong>
                                        {{$details['advertising']->text}}
                                    </li>
                                    <li><strong><span>price : </span></strong> {{$details['car']->price_for_day}}</li>
                                    <li><strong><span>car name :</span></strong> {{$details['car']->name}}</li>
                                    <li><strong><span>provider name :</span></strong> {{$details['user']->name}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
			</section>
            @endforeach

			<!-- main_office_section - end
			================================================== -->






		</main>
		<!-- main body - end
		================================================== -->

        @include('front-end.layout-pages.footer')