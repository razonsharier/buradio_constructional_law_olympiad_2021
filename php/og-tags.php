<?php
$canonical_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$website_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

?>
    <!-- facebook card start -->
    <meta property="og:url" content="<?php echo $canonical_link; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="১ম জাতীয় সাংবিধানিক আইন অলিম্পিয়াড ২০২১" />
    <meta property="og:description" content="১ম জাতীয় সাংবিধানিক আইন অলিম্পিয়াড ২০২১। রেজিস্ট্রেশন চলবে ২৫শে অক্টোবর থেকে ৩০শে অক্টোবর পর্যন্ত। প্রথম রাউন্ড ১লা নভেম্বর, ২য় রাউন্ড ২রা নভেম্বর এবং ফলাফল ঘোষণা ৪ঠা নভেম্বর।" />
    <meta property="og:image" content="<?php echo $website_link; ?>/media/bannerNEW.jpg" />
    <!-- // facebook card end -->

    <!-- twitter card start -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@buradio" />
    <meta name="twitter:title" content="১ম জাতীয় সাংবিধানিক আইন অলিম্পিয়াড ২০২১" />
    <meta name="twitter:description" content="১ম জাতীয় সাংবিধানিক আইন অলিম্পিয়াড ২০২১। রেজিস্ট্রেশন চলবে ২৫শে অক্টোবর থেকে ৩০শে অক্টোবর পর্যন্ত। প্রথম রাউন্ড ১লা নভেম্বর, ২য় রাউন্ড ২রা নভেম্বর এবং ফলাফল ঘোষণা ৪ঠা নভেম্বর।" />
    <meta name="twitter:image" content="<?php echo $website_link; ?>/media/bannerNEW.jpg" />
    <!-- // twitter card end -->

