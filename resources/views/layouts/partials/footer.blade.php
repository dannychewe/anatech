<!-- footer-area -->
<footer>
   <div class="footer-area pt-105" data-background="{{ asset('assets/img/shape/shape-bg-05.png') }}">
      <div class="tp-footer-top pb-25">
         <div class="container">
            <div class="row">

               {{-- Contact Column --}}
               <div class="col-lg-4 col-md-6">
                  <div class="tp-footer-widget footer-2-col-1 mb-40 wow fadeInUp" data-wow-delay=".2s">

                     <div class="tp-footer-widget__content mb-95">
                        <i>FEEL FREE TO CONTACT US</i>
                        <h4 class="tp-footer-widget__contact mb-20">
                           <a href="tel:{{ $globalFooter->phone ?? '+260 000 000 000' }}">
                              {{ $globalFooter->phone ?? '+260 000 000 000' }}
                           </a>
                        </h4>

                        <a href="mailto:{{ $globalFooter->email ?? 'info@example.com' }}">
                           {{ $globalFooter->email ?? 'info@example.com' }}
                        </a>
                     </div>

                     <div class="tp-footer-widget__sub-sec">
                        <span class="tp-footer-widget__sub-title mb-5">About Us</span>
                        <p>
                           {{ $globalFooter->about ??
                              'Anatech supplies laboratory equipment, scientific instruments, chemicals and consumables — supporting accurate testing, research and industrial quality assurance across Zambia.' }}
                        </p>
                     </div>

                  </div>
               </div>

               {{-- Useful Links --}}
               <div class="col-lg-3 col-md-6">
                  <div class="tp-footer-widget footer-2-col-2 mb-40 wow fadeInUp" data-wow-delay=".4s">

                     <span class="tp-footer-widget__title mb-15">Useful Links</span>

                     <div class="tp-footer-widget__links mb-35">
                        <ul>
                           <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                           <li><a href="{{ url('/about-us') }}">About Us</a></li>
                           <li><a href="{{ url('/services') }}">Our Services</a></li>
                           <li><a href="{{ url('/products') }}">Products</a></li>
                           <li><a href="{{ url('/blogs') }}">Blog</a></li>
                        </ul>
                     </div>

                     <div class="tp-footer-widget__sub-sec">
                        <span class="tp-footer-widget__sub-title mb-10">Opening Hours</span>
                        <div class="tp-footer-widget__list">
                           <ul>
                              <li>Mon - Fri: 8:00 AM - 5:00 PM</li>
                              <li>Sat: 9:00 AM - 1:00 PM</li>
                              <li>Sunday: Closed</li>
                           </ul>
                        </div>
                     </div>

                  </div>
               </div>

               {{-- Quick Access --}}
               <div class="col-lg-2 col-md-6">
                  <div class="tp-footer-widget footer-2-col-3 mb-40 wow fadeInUp" data-wow-delay=".6s">

                     <span class="tp-footer-widget__title mb-15">Quick Access</span>

                     <div class="tp-footer-widget__links">
                        <ul>
                           <li><a href="{{ url('/') }}">Home</a></li>
                           <li><a href="{{ url('/about-us') }}">About</a></li>
                           <li><a href="{{ url('/services') }}">Services</a></li>
                           <li><a href="{{ url('/products') }}">Products</a></li>
                           <li><a href="{{ url('/contact-us') }}">Contact</a></li>
                        </ul>
                     </div>

                  </div>
               </div>

               {{-- Contact Info + Social --}}
               <div class="col-lg-3 col-md-6">
                  <div class="tp-footer-widget footer-2-col-4 mb-40 wow fadeInUp" data-wow-delay=".8s">

                     <span class="tp-footer-widget__title mb-15">Contact Info</span>

                     <div class="tp-footer-widget__links mb-120">
                        <ul>
                           <li>{{ $globalFooter->address ?? 'Plot 123, Lusaka, Zambia' }}</li>

                           <li>
                              <a href="tel:{{ $globalFooter->phone ?? '+260 000 000 000' }}">
                                 {{ $globalFooter->phone ?? '+260 000 000 000' }}
                              </a>
                           </li>

                           <li>
                              <a href="mailto:{{ $globalFooter->email ?? 'info@example.com' }}">
                                 {{ $globalFooter->email ?? 'info@example.com' }}
                              </a>
                           </li>

                           <li>Office Hours: 8AM - 5PM</li>
                           <li>Sunday: Closed</li>
                        </ul>
                     </div>

                     {{-- Social Icons --}}
                     <div class="tp-footer-widget__social fw-social">

                        @if(!empty($globalFooter->facebook))
                           <a href="{{ $globalFooter->facebook }}" target="_blank">
                              <i class="fa-brands fa-facebook-f"></i>
                           </a>
                        @endif

                        @if(!empty($globalFooter->twitter))
                           <a href="{{ $globalFooter->twitter }}" target="_blank">
                              <i class="fa-brands fa-twitter"></i>
                           </a>
                        @endif

                        @if(!empty($globalFooter->instagram))
                           <a href="{{ $globalFooter->instagram }}" target="_blank">
                              <i class="fa-brands fa-instagram"></i>
                           </a>
                        @endif

                        @if(!empty($globalFooter->linkedin))
                           <a href="{{ $globalFooter->linkedin }}" target="_blank">
                              <i class="fa-brands fa-linkedin-in"></i>
                           </a>
                        @endif

                        @if(!empty($globalFooter->youtube))
                           <a href="{{ $globalFooter->youtube }}" target="_blank">
                              <i class="fa-brands fa-youtube"></i>
                           </a>
                        @endif

                     </div>

                  </div>
               </div>

            </div>
         </div>
      </div>

      {{-- Footer Bottom --}}
      <div class="footer-area-bottom fw-border">
         <div class="container">
            <div class="row">

               <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                  <div class="footer-widget__copyright copyright-white">
                     <span>
                        © {{ date('Y') }} <a href="{{ url('/') }}">Anatech Zambia</a>.
                        All Rights Reserved. Powered by
                        <a href="https://yamfumu.co/" target="_blank">Yamfumu Technologies</a>.
                     </span>
                  </div>
               </div>

               <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                  <div class="footer-widget__copyright-info info-direction">
                     <ul class="d-flex align-items-center justify-content-lg-end flex-wrap">
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Support</a></li>
                     </ul>
                  </div>
               </div>

            </div>
         </div>
      </div>

   </div>
</footer>
<!-- footer-area-end -->
