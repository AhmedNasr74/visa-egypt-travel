<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/DrawSVGPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
       /* Define variables */
:root {
    --light-bg: #ebf1f7;
    --turq: #348ba200;
}

/* Body styles */
body {
    padding-top: 50px;
    background: var(--light-bg);
}

/* Wrapper styles */
.wrapper {
    position: relative;
    max-width: 400px;
    margin: 0 auto;
}

/* Success styles */
.success {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    padding-top: 15px;
    display: flex;
    align-items: center;
    flex-direction: column;
}

/* Success icon styles */
.success__icon {
    width: 100px;
    height: 100px;
    margin-bottom: 10px;
}

/* Success icon border and tick styles */
.success__icon-border,
.success__icon-tick {
    stroke: var(--turq);
}

/* Success icon border styles */
.success__icon-border {
    /* Apply any additional styles */
}

/* Success icon tick styles */
.success__icon-tick {
    stroke-dasharray: 1000;
    stroke-dashoffset: 1000;
}

/* Success icon title styles */
.success__icon-title {
    position: relative;
}

    </style>
    </head>
<body>
    @php
    if($status=='SUCCESS'){
        $data="Payment Successful";
        $image="https://www.svgrepo.com/show/13650/success.svg";
    }else{
        $data="Payment Error";
        $image="https://www.svgrepo.com/show/13658/error.svg";
    }
    @endphp
<main class="wrapper">
        <div class="success">
        <svg viewBox="0 0 84 84" class="success__icon">
    <image xlink:href="{{$image}}" width="100%" height="100%" />
    <circle class="success__icon-border" cx="42" cy="42" r="40" stroke-linecap="round" stroke-width="4" stroke="#000" fill="none"/>
    <path class="success__icon-tick" stroke-linecap="round" stroke-linejoin="round" d="M23.375 42.55l13.51 13.508L64.89 28.05" stroke-width="4" stroke="#000" fill="none"/>
</svg>

            <h2 class="success__title">{{$data}}</h2>
        </div>
    </main>


    <!-- Your JavaScript scripts and other resources go here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    // Your JavaScript code goes here
    </script>
</body>
</html>

<script>
        console.log("hi")

$(document).ready(function() {
    var tl = new TimelineLite();

    var iconWrapper = $('.success');
    var icon = $('.success__icon');
    var iconBorder = $('.success__icon-border');
    var iconTick = $('.success__icon-tick');

    var success = true;

    var title = $('.success__title');

    tl.set(iconWrapper, {y: '50%'})
      .set(icon, {width: '50px', height: '50px'})
      .set(iconBorder, {drawSVG: '80%'})
      .set(title, {opacity: 0})
      .to(iconBorder, 0.8, { rotation: 360, transformOrigin: '50% 50%', ease: Linear.easeNone, repeat: -1});

    if (success) {
        tl.to(iconWrapper, 0.5, {y: '0%', ease: Expo.easeInOut})
          .to(icon, 0.5, {width: '100px', height: '100px', ease: Expo.easeInOut})
          .to(iconBorder, 0.5, {drawSVG:"100%", ease: Expo.easeOut}, '-=0.5')
          .to(iconTick, 0.7, {drawSVG:"100%", ease: Expo.easeOut})
          .set(iconBorder, {rotation: 0})
          .to(title, 0.7, {opacity: 1, y: -5, ease: Expo.easeInOut}, '-=0.7');
    }
    setTimeout(function() {
         window.location.href="/"

                  }, 8000);
});

</script>

