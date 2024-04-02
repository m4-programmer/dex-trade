

<section id="about" class="about-section s-pt-100 s-pb-100 section-bg">
    <div class="about-globe">
        <img src="{{ asset('asset/theme2/images/bg/globe3.png')}}" alt="image">
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 d-lg-block d-none">
                <div class="about-thumb">
                    <img src="{{ asset('asset/theme2/images/about/about.png') }}" alt="image">
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="section-title">{{translate('About Us')}}</h2>
                <p class="text-white text-justifys descripton-root">{{translate($gs->sitename.'
                     is a cryptocurrency trading company owned by'. $gs->sitename .' exchange designed for maximization of capitals of companies (Banks, industries) and individuals while they focus on their daily activities.
                    '. $gs->sitename.'.com has managed to build a few large mining farms in United State, Belize, Venezuela and England United Kingdom,
                    We have equipped them with the most powerful and modern mining hardware that around the clock provides excellent results and serves as a source for earnings.
                    Our team consists of professional financial analysts and experts, miners and traders, who are constantly monitoring situations, which may affect a value of one or another cryptocurrency.
                     They estimates the best possible trade entry points on the cryptocurrency market based on ...
                ')}}
                </p>
                <a href="#" class="cmn-btn">{{translate('Learn More')}}</a>
            </div>
        </div>
    </div>
</section>
