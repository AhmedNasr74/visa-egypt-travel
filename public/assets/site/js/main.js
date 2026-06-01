// =====================  aos animmation =======================
$(document).ready(function(){
    AOS.init({
        offset: 200,
        delay: 50,
        duration: 1500,
        easing: 'ease-in-out',
        once: false,
        mirror: true,
        anchorPlacement: 'top-bottom',

    });
})


// =====================  navbar =======================
$('.searchIcon').on('click' , function(){
    $('.searchIcon').toggleClass('text-second-color');
    $('.searchDetails').toggleClass('hidden');

    $('.searchDetails').on('click' , function(){
        $('.searchIcon').toggleClass('text-second-color');
        $('.searchDetails').addClass('hidden');
    })


})

$('.menuIcon').on('click' , function(){
    $('#menu-details').toggleClass('hidden')
})



// =====================  tour nav sidebar  =======================

$('aside li.sidebarList').on('click' , function(){
    $('aside li.sidebarList').removeClass('titleActive')
    $(this).addClass('titleActive');

});

// =====================  tour itinerary =======================

$('.itineraryHead').on('click' , function(){

    $(this).siblings('.itineraryDesc').toggleClass('hidden');
});


// sliders
$(document).ready(function(){


    $('.reviewSlider').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        // lazyLoad:true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        smartSpeed:1000,
        responsive:{
            0:{
                items:1
            },
            800:{
                items:2
            }
        }
    });

    $('.partnerSlider').owlCarousel({
        loop:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        smartSpeed:1000,
        responsive:{
            0:{
                items:2
            },
            600:{
                items:4
            },
            1000:{
                items:6
            }
        }
    });

    $('.newsSlider').owlCarousel({
        loop:true,
        nav:true,
        dots:false,
        margin:20,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        smartSpeed:1000,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            800:{
                items:2
            },
            1100:{
                items:3
            }
        }
    });

    $('.teamSlider').owlCarousel({
        loop:true,
        nav:true,
        dots:false,
        margin:20,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        smartSpeed:1000,
        responsive:{
            0:{
                items:1
            },
            500:{
                items:2
            },
            800:{
                items:3
            },
            1100:{
                items:4
            }
        }
    })

});

// =====================  home form  =======================

$('.trip form i.plus').on('click' , function () {
    let currentValue = Number($(this).siblings('input').val());
    if(currentValue >= 0){
        currentValue++
        $(this).siblings('input').val(currentValue);

    }
});
$('.trip form i.minus').on('click' , function () {
    let currentValue = Number($(this).siblings('input').val());
    if(currentValue > 0){
        currentValue--
        $(this).siblings('input').val(currentValue);

    }

 });

 // =====================  about video  =======================

$('.videoBox').on('click' , function(){
    $('.videoOverlay').toggleClass('hidden')

});
$('.videoOverlay').on('click' , function(){
    $('.videoOverlay').addClass('hidden')
    console.log('done');

})

 // =====================  counter  =======================

 $(function(){
     try {
         $('.counterIt').countTo({from:0,speed:8000});
     }  catch (e) {}
 }
);


 // =====================  mix it up filter  =======================

 $(function(){
    try {
        var mixer = mixitup('.tourFilter');
    }  catch (e) {}
 }
)

// =====================  nileCruiseDetails controls btns  =======================

$('.tourFilter .controls button').on('click' , function(){
    $('.tourFilter .controls button').removeClass('btnActive').addClass('btn')
    $(this).removeClass('btn').addClass('btnActive');
});



// =====================  search  =======================

function updatePrice(value) {
    $('#current-price').text(`current price: $ ${value}`)
}
function updateDuration(value) {
    $('#current-duration').text(`current duration: ${value}`)
}

$('#price-range').on('input' , function(){
    updatePrice($(this).val());

})
$('#duration-range').on('input' , function(){
    updateDuration($(this).val());

})

