@if(Route::currentRouteName() == 'blog.detail')
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <link rel="canonical" href="@yield('canonical')">
    <meta property="og:locale" content="@yield('og-locale')"/>
    <meta property="og:type" content="@yield('og-type')"/>
    <meta property="og:title" content="@yield('og-title')"/>
    <meta property="og:description" content="@yield('og-description')"/>
    <meta property="og:url" content="@yield('og-url')"/>
    <meta property="og:site_name" content="@yield('og-site-name')"/>
    <meta property="og:image" content="@yield('og-image')"/>
@else
    <meta name="description"
          content="Our mission is to take the pain out of sticker printing and make it simple, fast, and affordable without compromising quality.">
    <meta name="keywords" content="Stickers, Labels, Printing, Digital Printing">
    <link rel="canonical" href="https://stickitownit.com">
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Stickitownit"/>
    <meta property="og:description"
          content="Our mission is to take the pain out of sticker printing and make it simple, fast, and affordable without compromising quality."/>
    <meta property="og:url" content="https://stickitownit.com"/>
    <meta property="og:site_name" content="Stickitownit"/>
@endif


