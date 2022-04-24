@extends('web/layouts/webLayoutMaster')

@section('title', 'Privacy Policies - ')

@section('meta-description','Privacy policy of the Alomran website.')

@section('meta-robots')
    <meta name="robots" content="noindex">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/web/pages/politicas.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/web/pages/home/home.css')) }}">
    <link href="{{ asset(mix('fonts/font-awesome/css/font-awesome.min.css')) }}"
          rel="stylesheet" media="print" onload="this.media='all'; this.onload=null;">
@endsection

@section('content')
    <section id="politicas">
        <header>
            <div class="d-flex flex-column align-items-center">
                <a href="/" style="margin-top: 3em">
                    <img src="/images/logos/alomran-logo.png" alt="alomran" height="90px">
                </a>
                <h2>PRIVACY POLICIES</h2>
            </div>
        </header>
        <div class="container">
            <h2>INTELLECTUAL AND INDUSTRIAL PROPERTY RIGHTS</h2>
            <p>All the contents of the web page are protected by the regulations governing Intellectual and Industrial Property, in particular by the Royal Legislative Decree 1/1996, of April 12, which approves the revised text of the Intellectual Property Law and by the Law 17/2001, of December 7, on Trademarks. The rights to the contents belong to Al Omran. or, if applicable, to third parties.</p>
            <p>In no case, the access to our web page implies the cession, transmission or any other type of resignation, neither total nor partial, of the Intellectual or Industrial Property rights. The user who accesses our website may only view and obtain a private copy of the contents as long as said copy is solely and exclusively for personal and private use; its use for commercial purposes is strictly prohibited. The user of the website must refrain from deleting, altering, evading or manipulating any protection device or security systems that may be installed in it.</p>
            <p>The unauthorized use of the materials and information contained in the web site may imply the violation of the legislation on intellectual or industrial property and other applicable regulations. Al Omran. reserves the right to prosecute any infringement of its intellectual and industrial property rights.</p>
            <h2>GENERAL CONDITIONS OF USE</h2>
            <p>The user undertakes to use the website in accordance with the law, this legal notice, regulations and instructions made known to him/her, as well as morality, generally accepted good customs and public order.</p>
            <p>It is expressly forbidden to use this web site for harmful purposes or interests of Al Omran. or third parties, which in any way overload, damage, disable or deteriorate the networks, servers, computer equipment of Al Omran. or third parties, preventing its normal use.</p>
            <h2>LIMITATION OF LIABILITY</h2>
            <p>Al Omran is not responsible for damages that may derive from the access and navigation through this web site, such as those produced in computer systems, for example, in case of virus and/or any other form of computer attack.</p>
            <p>Al Omran is not responsible for any damages that may arise from a bad or incorrect use of this website by users, nor does it assume any liability for incidents in telecommunications networks, such as, for example, crashes, absence or defects in such telecommunications, beyond the will and control of Al Omran.</p>
            <h2>SOCIAL MEDIA</h2>
            <p>Regarding the links to the profiles of social networks that appear on the website, we inform the user that Al Omran. is the provider of information society services in accordance with the LSSI.</p>
            <p>We remind you that the social networks referenced have their own terms and conditions that you must respect.</p>
            <h2>APPLICABLE LAW AND JURISDICTION</h2>
            <p>Any dispute that may arise from the use of this website is subject to Spanish law and, in general, to the courts and tribunals of Madrid. In the event that the user is a consumer, the competent courts and tribunals shall have jurisdiction in accordance with current Spanish legislation.</p>
            <h2>OTHER CONDITIONS OF USE</h2>
            <p>Al Omran reserves the right to modify the contents of this web page at any time, without prejudice to the user and respecting, where appropriate, the general contracting conditions in force at any given time.</p>

        </div>
    </section>
@endsection

@section('page-script')
    <script async defer src="{{ asset('js/scripts/extensions/all.min.js') }}"></script>
@endsection