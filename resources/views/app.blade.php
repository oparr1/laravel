<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@section('title')</title>

	<!-- CSS -->
	<link href="{{ asset('/css/styles.css') }}" rel="stylesheet">

	<!-- Fonts 
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> -->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	        <style>
        .col1, .col2, .col3, .col4, .col4.last, .col5, .col6, .col7, .col8, .col9, .col10, .col11, .col12 {
            padding: 0 0 20px;
        }

        header .col12, header .col4, #cookie_container .col9, #cookie_container .col3.last, footer .col4, footer .col4.last, footer .col5, footer .col7.last, footer .col12, #searchhighlight.col6 {
            padding: 0;
        }

        body {
           background-color:#efeded;
        }

        section {
            padding: 30px;
            text-align: left;
            border-radius: 6px;
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
            border: 1px solid #c2bcbc;
            background-color: #fff;
        }
        </style>

    <!-- Google Analytics -->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date(); a = s.createElement(o),
            m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-54546266-1', 'auto'); // Key - Works on LocalHost
        ga('send', 'pageview');
    </script>

</head>
<body>
   <div id="cookie_container">
        <div class="onepcssgrid-1200">
            <div class="onerow">
                <div class="col9">
                    <div id="cookie_text">
                        <span>O.P Website uses cookies and by continuing to browse you agree to our use of cookies. For more details, please see our <a href="/cookie-policy">Cookie Policy</a></span>
                    </div>
                </div>
                <div class="col3 last">
                    <div id="cookie_button_box">
                        <button id="button" class="button" type="submit">Continue</button>
                    </div>
                </div>
            </div> <!-- Row Closing -->
        </div> <!-- 1200 Closing -->
    </div>
    <header>
        <div class="onepcssgrid-1200">
            <div class="onerow">
                <div class="col12">
                    <div class="search_loginbox">
                    	<!-- Login / Register -->
                        <div class="login_register">
                    @if (Auth::guest())
						<a href="{{ url('/auth/login') }}">Login</a>
						<a href="{{ url('/auth/register') }}">Register</a>
					@else
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <a href="{{ url('/auth/logout') }}">Logout</a>
					@endif
                        </div>
                        <div class="search">
                            <form action="/search" method="GET">
                                <input type="text" class="siteSearch" placeholder="Search the website" name="q" />
                                <button type="submit" title="Search the website" value="Search"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="onepcssgrid-600">
            <div class="onerow">
                <div class="col4" id="col4query">
                    <div class="query">For Further Enqueries</div>
                </div>
                <div class="col4" id="col4logo">
                    <!-- Node ID for Logo - Usable for all pages -->                    
                    <div id="logo"><a href="/home"><img src="/img/logo.png" /></a></div> <!-- Easy Image without Custom model/controller -->
                </div>
                <div class="col4 last">
                    <!-- Node ID for phone number and proptery value -->          
                    <div class="pnumber">012345 67 89</div> <!-- Property Alias for multiple pages -->
                </div>
            </div> <!-- Row Closing -->
        </div> <!-- 1200 Closing -->
    </header>
    <div id="navwrapper">
        <nav>
            <ul>
                <li><a href="/home">Home</a></li>
                <li><a href="/static"><span>/</span>Static Site</a></li>
                <li>
                    <a href="/blog"><span>/</span>Blog<img src="/img/navarrow.png" class="navarrow" alt="navarrow" /></a>
                    <ul>
                        <li><a href="">Test A</a></li>
                        <li><a href="">Test B</a></li>
                        <li><a href="">Test C</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/auth/register"><span>/</span>Registration<img src="/img/navarrow.png" class="navarrow" alt="navarrow" /></a>
                    <ul>
                        <li><a href="">Test D</a></li>
                        <li><a href="">Test E</a></li>
                        <li><a href="">Test F</a></li>
                        <li><a href="">Test G</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/about-us"><span>/</span>About Us<img src="/img/navarrow.png" class="navarrow" alt="navarrow" /></a>
                    <ul>
                        <li><a href="/sql-query">Sql Query</a></li>
                        <li><a href="/search">Search</a></li>
                        <li><a href="/cookie-policy">Cookie Policy</a></li>
                    </ul>
                </li>
                <li><a href="/contact"><span>/</span>Contact</a></li>
            </ul>
            <a href="" id="pull"></a>
        </nav>
    </div>

	@yield('content')

	<div id="backtotop_subscribe">
        <div class="onepcssgrid-1200">
            <div class="onerow">
                
                <div class="subscribetonews">
                    <!-- partial/_subscribe -->
                    @include('partials._subscribe')
                </div>
                <div class="backtotop">
                    <span>Back to Top</span>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>
    <footer>
        <div class="onepcssgrid-1200">
            <div class="onerow">
                <div class="col4">
                    <ul>
                        <li><a href="/home">Home</a></li>
                        <li><a href="/static">Static Site</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="/auth/register">Registration</a></li>
                    </ul>
                </div>
                <div class="col4">
                    <ul>
                        <li><a href="/testa">Test A</a></li>
                        <li><a href="/sql-query">Sql Query</a></li>
                        <li><a href="/search">Search</a></li>
                        <li><a href="/cookie-policy">Cookie Policy</a></li>
                    </ul>
                </div>
                <div class="col4 last">
                    <ul>
                        <li><a href="/about-us">About Us</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                </div>
            </div> <!-- Row Closing -->
            <div class="onerow" id="border">
                <div class="col5">
                    <div id="social">
                        <a href="http://www.facebook.com"><img src="/img/facebook.png" alt="Facebook" /></a>
                        <a href="http://www.twitter.com"><img src="/img/twitter.png" alt="Twitter" /></a>
                        <a href="http://www.youtube.com"><img src="/img/youtube.png" alt="YouTube" /></a>
                    </div>
                </div>
                <div class="col7 last">
                    <div id="browser">
                        <img src="/img/firefox.png" alt="Firefox" /><span>3.5 +</span>
                        <img src="/img/chrome.png" alt="Chrome" /><span>35</span>
                        <img src="/img/ie.png" alt="Internet Explorer" /><span>7 +</span>
                        <img src="/img/opera.png" alt="Opera" /><span>12 +</span>
                        <img src="/img/safari.png" alt="Safari" /><span>5.12</span>
                    </div>
                </div>
            </div> <!-- Row Closing -->
            <div class="onerow">
                <div class="col12">
                    <div id="copyrightbanner">
                        <span>Copyright &copy; <?php echo (new \DateTime())->format('Y'); ?> - Oliver Parr</span>
                    </div>
                </div>
            </div> <!-- Row Closing -->
        </div> <!-- 1200 Closing -->
    </footer>

	<!-- JS -->
	<script src="{{ asset('/js/jquery-1.11.1.min.js') }}" type='text/javascript'></script>
	<script src="{{ asset('/js/jquery.validate.min.js') }}" type='text/javascript'></script>
	<script src="{{ asset('/js/jquery.cookie.js') }}" type='text/javascript'></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
	@yield('scripts')

        <!-- Subscribe validation -->
    <script>
    $("#subscribeForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required: "An email address is required",
                email: "A valid email address is required"
            }
        }
    });
</script>

        <!-- Google Analytics Opt-out and Opt-in -->
    <script>
        // Set to the same value as the web property used on the site
        var gaProperty = 'UA-54546266-1';

        // Disable tracking if the opt-out cookie exists.
        var disableStr = 'ga-disable-' + gaProperty;
        if (document.cookie.indexOf(disableStr + '=true') > -1) {
            window[disableStr] = true;
        }

        $(document).ready(function () {
            // Opt-out function
            $("#gadisable:radio", $('#cookies')).change(
            function gaOptout() {
                document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
                window[disableStr] = true;
            });

            // Opt-in function
            $("#gaenable:radio", $('#cookies')).change(
            function gaOptin() {
                document.cookie = disableStr + '=true; expires=Thu, 01 Jan 1970 00:00:01; path=/';
            });

            // Opt-out Checked
            if ($.cookie('ga-disable-UA-54546266-1')) {
                $("#gadisable:radio").prop('checked', true);
            }

            // Opt-in Checked
            else if ($.cookie('ga-disable-UA-54546266-1') == null) {
                $("#gaenable:radio").prop('checked', true);
            }
        });
    </script>

<!-- Cookie Hide Bar -->
    <script>
        $(document).ready(function () {
            // Hide Bar if cookie exists
            // CSS of cookie container set to display:none at first - better for Chrome (slow)
            // Jquery display cookie container unless ck_policy exists
            $("#cookie_container").css({ "display": "block" });
            if ($.cookie("ck_policy")) {
                $("#cookie_container").css({ "display": "none" });
            }

            // Hide Bar on button click
            $('#cookie_container .button ').click(function () {
                $.cookie("ck_policy", true, { expires: 1 });
                $('#cookie_container').hide();
            });
        });
    </script>

    <!-- Reorder Elements -->
    <script>
        onResize = function () {
            if ($("header").css("position") == "relative") {
                $('header #col4logo').insertBefore('header #col4query');
            } else {
                $('header #col4logo').insertAfter('header #col4query');
            }
        }
        $(document).ready(onResize);
        $(window).bind('resize', onResize);
    </script>

    <!-- Mobile Navigation -->
    <script>
        $(document).ready(function () {
            var pull = $('#pull');
            var menu = $('nav > ul'); // don't miss the var
            var menuHeight = menu.height();  // don't miss the var

            $(pull).on('click', function (e) {
                e.preventDefault();
                menu.slideToggle(function () {
                    if ($(this).css('display') == 'none') {
                        $("#pull").css({ 'background-image': 'url(img/showmobileicon.png)' });
                    } else {
                        $("#pull").css({ 'background-image': 'url(img/hidemobileicon.png)' });
                    }
                });
            });

            $(window).resize(function () {
                var w = $(window).width();
                if (w > 320 && menu.is(':hidden')) {
                    menu.removeAttr('style');
                }
            });
        }); // close
    </script>

    <!-- Back to Top -->
    <script>
        $(".backtotop span").click(function () {
            $("html, body").animate({ scrollTop: 0 }, 1000);
        });
    </script>
</body>
</html>
