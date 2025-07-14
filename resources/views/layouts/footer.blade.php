

<div class="g-py-40">
    <div class="container">

        <div class="row justify-content-center">

            <!-- Footer Description -->
            <div class="col-md-8 col-sm-10 col-lg-3">
                <div class="footer-description text-center text-lg-left">

                    <div class="logoFooter">
                        <img src="/logo/logo_instat.png" alt="Image Description" class="logoInstat">
                        <img src="/logo/WB_F-WBG-Horizontal-CMYK.jpg" alt="image Description" class="logoWB">
                    </div>

                    <p class="g-mb-20 g-px-20 g-px-md-0 text-center mt-1">la statistique, un outil de gouvernance au service du développement</p>
                    <div class="social-icons list-unstyled d-flex justify-content-center justify-content-lg-start">
                        <a href="https://www.facebook.com/INSTATMadagascar" target="_blank" class="g-font-size-25 g-mr-10"><i class="fa-brands fa-facebook"></i></a>
                        <!--<a href="" class="g-font-size-25"><i class="fa fa-twitter-square"></i></a> -->
                    </div>
                </div>
            </div>
            <!-- END Footer Description -->

            <!-- Footer Contact -->
            <div class="col-md-8 col-sm-10 col-lg-3">
                <div class="footer-contact g-py-15 g-py-lg-0">
                    <h6 class="footer-title g-py-10 g-mb-10 text-uppercase">Contact info</h6>
                    <ul class="list-unstyled">
                        <li class="g-flex-middle justify-content-center justify-content-lg-start g-mb-10">
                            <i class="fa-solid fa-location-dot g-font-size-16 g-mr-10"></i>
                            <span class="align-middle">INSTAT - Rue Jules RANAIVO - ANOSY, BP 485 Antananarivo 101</span>
                        </li>
                        <li class="g-flex-middle justify-content-center justify-content-lg-start g-mb-10">
                            <i class="fa-solid fa-mobile-screen-button g-font-size-16 g-mr-10"></i>
                            <span class="align-middle">+261 32 11 086 66 </span>
                        </li>
                        <li class="g-flex-middle justify-content-center justify-content-lg-start g-mb-10">
                            <i class="fa-solid fa-user g-font-size-16 g-mr-10"></i>
                            <span class="align-middle">infos@instat.mg</span>
                        </li>
                        <li class="g-flex-middle justify-content-center justify-content-lg-start g-mb-10">
                            <i class="fa-solid fa-globe g-font-size-16 g-mr-10"></i>
                            <span class="align-middle"> <a href=" https://www.instat.mg/" target="_blank">www.instat.mg</a> </span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END Footer Contact -->

            <!-- Footer Info -->

            <div class="col-sm-10 col-md-8 col-lg-2">
                <div class="footer-info g-px-20 g-py-15 g-py-lg-0">
                    <h6 class="footer-title g-py-10 g-mb-10 text-uppercase">Menus</h6>

                    <ul class="list-unstyled">
                        <li class="g-mb-10">
                            <a href="{{ route('front-office') }}">
                                <i class="fa fa-angle-right g-mr-5"></i>
                                <span class="align-middle">{{__('Home')}}</span>
                            </a>
                        </li>

                        <li class="g-mb-10">
                            <a href="{{ route('front-office') }}">
                                <i class="fa fa-angle-right g-mr-5"></i>
                                <span class="align-middle">{{__('Thèmes')}}</span>
                            </a>
                        </li>

                        <li class="g-mb-10">
                            <a href="{{ route('showEnquetes') }}">
                                <i class="fa fa-angle-right g-mr-5"></i>
                                <span class="align-middle">{{__('Recensements et enquêtes')}}</span>
                            </a>
                        </li>
                    
                </div>
            </div>
            {{-- <div class="col-sm-10 col-md-8 col-lg-2">
                <div class="footer-info g-px-20 g-py-15 g-py-lg-0">
                    <h6 class="footer-title g-py-10 g-mb-10 text-uppercase">Menus</h6>
                    <ul class="list-unstyled">
                        <li class="g-mb-10">
                            <a href="{{route('actus')}}">
                                <i class="fa fa-angle-right g-mr-5"></i>
                                <span class="align-middle">Actualité</span>
                            </a>
                        </li>
                        <li class="g-mb-10">
                            <a href=" ">
                                <i class="fa fa-angle-right g-mr-5"></i>
                                <span class="align-middle">FAQ</span>
                            </a>--}}
                        {{-- </li> 
                        <li class="g-mb-10">
                            <a href="{{route('recrutement')}}">
                                <i class="fa fa-angle-right g-mr-5"></i>
                                <span class="align-middle">Recrutements et appels d'Offres</span>
                            </a>
                        </li>
                        <li class="g-mb-10">
                            <a href="{{route('menu.links','liens-utiles')}}">
                                <i class="fa fa-angle-right g-mr-5"></i>
                                <span class="align-middle">Liens utiles</span>
                            </a>
                        </li>
                        
                        <li class="g-mb-10">
                            <a href="{{route('contact')}}">
                                <i class="fa fa-angle-right g-mr-5"></i>
                                <span class="align-middle">Contact</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div> --}}
            <!-- END Footer Info -->

            <!-- Footer Newsletter -->
            <div class="col-sm-10 col-md-8 col-lg-4">
                <div class="footer-subscribe g-px-25 g-px-lg-0">
                    <h6 class="footer-title g-py-10 g-mb-10 text-uppercase">Abonnez-vous</h6>
                    <p class="g-px-20 g-px-md-0">{{__('Subscribe to our newsletter and stay up to date with the latest news.')}}</p>
                    <p class="g-mb-20 g-px-20 g-px-md-0"></p>
                    <form class="footer-subscribe-form">
                        <div class="form-group form-group-v1 focus-effect g-rounded-30 g-p-5">
                            <input type="mail" name="subscribe_email" placeholder="{{__('Your Email')}}" class="form-control g-rounded-30 g-p-5">
                            <button type="submit" class="g-rounded-30 g-px-20 g-py-10 border-0">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Footer Newsletter -->

        </div>

    </div>
</div>

<!-- Copyright -->
<div class="copyright-wrap g-py-25">
    <div class="container g-px-20 g-px-lg-0">
        <ul class="list-unstyled g-flex-lg-middle">
            <li>
                <p class="text-center">Copyright <span><i class="fa fa-copyright"></i></span> INSTAT {{ date("Y")}}. {{__('All rights reserved')}}</p>
            </li>
            <li class="ml-auto">
                <!-- <a href="index-2.html#" class="g-px-10">Terms & Use</a> -->
                <!-- <a href="index-2.html#" class="g-px-10">Privacy Policy</a> -->
            </li>
        </ul>
    </div>
</div>
<!-- END Copyright -->

