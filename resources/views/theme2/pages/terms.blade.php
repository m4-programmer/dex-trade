
<?php

use App\Models\GeneralSettings as GS;
$gs = GS::get()->first();
?>

@extends(template().'layout.master')

@section('content')
    <section class="breadcrumbs" style="background-image: url({{ asset('asset/theme2/images/breadcrumbs/breadcrumbs.png') }});">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center text-capitalize">
                <h2>{{ translate("Rules & Agreements") }}</h2>
                <ol>
                    <li><a href="{{ route('home') }}">{{ translate('Home') }}</a></li>
                    <li>{{ translate('Rules & Agreements.') }}</li>
                </ol>
            </div>

        </div>
    </section>

    <!-- ======= About Section ======= -->
   <section id="about" class="about-section s-pt-100 s-pb-100 section-bg">
    <div class="about-globe">
        <img src="{{ asset('asset/theme2/images/bg/globe3.png')}}" alt="image">
    </div>
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-12">
                <h2 class="section-title">{{translate('Rules & Agreements.')}}</h2>
                <p>{{translate('Please read the following rules carefully before signing in.')}}</p>
                <p>{{translate('You agree to be of legal age in your country to partake in this program, and in all the cases your minimal age must be 18 years.')}}
                </p>
                <p class="text-white text-justifys descripton-root">
                   {{translate("$gs->sitename is not available to the general public and is opened only to the qualified members of $gs->sitename, the use of this site is restricted to our members and to individuals personally invited by them. Every deposit is considered to be a private transaction between the $gs->sitename and its Member.")}}
                </p>
                <p>
                    {{translate("As a private transaction, this program is exempt from the US Securities Act of 1933, the US Securities Exchange Act of 1934 and the US Investment Company Act of 1940 and all other rules, regulations and amendments thereof. We are not FDIC insured. We are not a licensed bank or a security firm.")}}
                </p>
                <p>
                    {{translate("You agree thaall information, communications, materials coming from $gs->sitename are unsolicited and must be kept private, confidential and protected from any disclosure. Moreover, the information, communications and materials contained herein are not to be regarded as an offer, nor a solicitation for investments in any jurisdiction which deems non-public offers or solicitations unlawful, nor to any person to whom it will be unlawful to make such offer or solicitation.")}}
                </p>
                <p>
                    {{translate("All the data ving by a member to $gs->sitename will be only privately used and not disclosed to any third parties. $gs->sitename is not responsible or liable for any loss of data.")}}
                </p>
                <p>
                    {{translate("You agree to hold all principals and members harmless of any liability. You are investing at your own risk and you agree that a past performance is not an explicit guarantee for the same future performance. You agree that all information, communications and materials you will find on this site are intended to be regarded as an informational and educational matter and not an investment advice.")}}
                </p>
                <p>
                    {{translate("We reserve the right to change the rules, commissions and rates of the program at any time and at our sole discretion without notice, especially in order to respect the integrity and security of the members' interests. You agree that it is your sole responsibility to review the current terms.")}}
                </p>
                <p>
                    {{translate("$gs->sitename is not responsible or liable for any damages, losses and costs resulting from any violation of the conditions and terms and/or use of our website by a member. You guarantee to $gs->sitename that you will not use this site in any illegal way and you agree to respect your local, national and international laws.")}}
                </p>
                <p>
                    {{translate("We will not tolerate SPAM or any type of UCE in this program. SPAM violators will be immediately and permanently removed from the program.")}}
                </p>
                <p>
                    {{translate("$gs->sitename reserves the right to accept or decline any member for membership without explanation.")}}
                </p>
                <p>
                    {{translate("If you do not agree with the above disclaimer, please do not go any further.")}}
                </p>

            </div>
        </div>
    </div>
</section>
@endsection
