@extends('web/layouts/webLayoutMaster')

@section('title', 'Cookies Policies - ')

@section('meta-description','Cookies policy of the Ordery website.')

@section('meta-robots')
    <meta name="robots" content="noindex">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/web/pages/politicas.css')) . '?v=' . $APP_VERSION }}">
    <link rel="stylesheet" href="{{ asset(mix('css/web/pages/home/home.css')) }}">
    <link href="{{ asset(mix('fonts/font-awesome/css/font-awesome.min.css')) }}"
          rel="stylesheet" media="print" onload="this.media='all'; this.onload=null;">
@endsection

@section('content')
    <section id="politicas">
        <header>
            <div class="d-flex flex-column align-items-center">
                <a href="/" style="margin-top: 3em" aria-label="Link to web">
                    <img src="/images/logos/logo.png" alt="Ordery" height="90px">
                </a>
                <h2>COOKIE POLICIES</h2>
            </div>
        </header>
        <div class="container">
            <h2>What is a cookie?</h2>
            <p>
                An HTTP cookie is a small piece of data stored on the user's computer by the web browser while browsing a website. Cookies were designed to be a reliable mechanism for websites to remember stateful information (such as items added in the shopping cart in an online store) or to record the user's browsing activity (including clicking particular buttons, logging in, or recording which pages were visited in the past). They can also be used to remember pieces of information that the user previously entered into form fields, such as names, addresses, passwords, and payment card numbers.
            </p>
            <h2>What types of cookies does ordery.com use?</h2>
            <p>Depending on how long they remain active, cookies can be:</p>
            <p>  <b>Session cookies:</b> designed to collect and store data while the user accesses a website. They are usually used to store information that is only relevant to the provision of the service requested by the user on one occasion (for example, a list of products purchased).</p>
            <p><b>Persistent cookies:</b> They are a type of cookies by which the data is still stored in the terminal and can be accessed and processed during a defined period. They have a deletion date. They are used for example in the process of purchase or registration to avoid having to enter our data constantly.</p>
            <p>According to who is the entity that manages the equipment or domain from where the cookies are sent and treats the data obtained, we can distinguish:</p>
            <p><b>Own Cookies:</b> Are those that are sent to the user's device managed exclusively by us for the best operation of the site.</p>
            <p><b>Third-party cookies:</b> are those that are sent to the user's device from a computer or domain that is not managed by us but by another entity, which will treat the data obtained.</p>
            <p>When you navigate through ordery.com the following cookies may be installed on your device:</p>
            <p><b>Registration cookies:</b> When the user enters our website and logs in, a temporary cookie is installed so that you can navigate through your user area without having to enter your data continuously. This cookie will disappear when you log out.</p>
            <p><b>Analysis cookies:</b> They are used to study user behaviour anonymously when browsing our website. This way we can know the most viewed contents, the number of visitors, etc. This information will be used to improve the browsing experience and optimize our services. They can be our own but also from third parties. Among the latter are Google Analytics and Iadvice cookies.</p>
            <p><b>Third-party advertising cookies:</b> The aim is to optimize the exposure of advertising. To manage these services we use the Doubleclick platform of Google that stores information about the ads that have been shown to a user, those that interest him and if he visits the website of the advertiser.</p>
            <p><b>Third-party personalization cookies:</b> The objective is to personalize the web content and make recommendations based on your interests. To do this, we may use third party cookies and the customization platform provided by our telecommunications operator partners, who will have access to the IP address from which you are browsing and which, if you are a customer of that operator, would help us to personalize the recommendations on products of your interest. In addition, they will store information about the products that have been shown and those that interest each user in order to constantly improve the recommendations.</p>
            <p>Configuration, consultation and deactivation of cookies</p>
            <p>You can allow, block or delete cookies installed on your computer by setting the options of the browser installed on your computer:</p>
            <p><b>Chrome</b> from <a href="https://support.google.com/chrome/answer/95647?hl=en" target="_blank" rel=noreferrer>https://support.google.com/chrome/answer/95647?hl=en</a></p>
            <p><b>Safari</b> from <a href="https://support.apple.com/en-gb/guide/safari/sfri11471/mac" target="_blank" rel=noreferrer>https://support.apple.com/en-gb/guide/safari/sfri11471/mac</a></p>
            <p><b>Explorer</b> from <a href="http://windows.microsoft.com/es-es/windows7/how-to-manage-cookies-in-internet-explorer-9" target="_blank" rel=noreferrer>http://windows.microsoft.com/es-es/windows7/how-to-manage-cookies-in-internet-explorer-9</a></p>
            <p><b>Firefox</b> from <a href="http://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-que-los-sitios-we" target="_blank" rel=noreferrer>http://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-que-los-sitios-we</a></p>
            <p>Everything about Google's cookies, both analytical and advertising, as well as their administration and configuration can be found at
                <a href="http://www.google.es/intl/es/policies/technologies/types/" target="_blank" rel=noreferrer>http://www.google.es/intl/es/policies/technologies/types/</a></p>
            <p><a href="http://www.google.es/policies/technologies/ads/" target="_blank" rel=noreferrer>http://www.google.es/policies/technologies/ads/</a> </p>
            <p><a href="https://developers.google.com/analytics/devguides/collection/analyticsjs/cookie-usage" target="_blank" rel=noreferrer>https://developers.google.com/analytics/devguides/collection/analyticsjs/cookie-usage</a></p>
            <p>If you choose to disable Cookies we will not be able to offer you some of our services such as remaining logged in or keeping your shopping in your cart.</p>
        </div>
    </section>

@endsection

@section('page-script')
    <script async defer src="{{ asset('js/scripts/extensions/all.min.js') }}"></script>
@endsection
