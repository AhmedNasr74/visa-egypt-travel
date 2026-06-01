// document.addEventListener("DOMContentLoaded", function () {
//   let mixer = mixitup(".experience");
// });

// document.addEventListener("DOMContentLoaded", function () {
//   let mixer = mixitup(".tourPlan");
// });

$('.tourPlan .controls button').on('click' , function(){
    $('.tourPlan .mix').removeClass('d-none');
});

window.onscroll = function () {
    if (window.scrollY >= 50) {
        $('nav').addClass("fixed-top").addClass('bg-dark').removeClass('bg-transparent');
        $('.topHeader').addClass("d-none");
    }
    else{
        $('nav').removeClass("fixed-top").removeClass('bg-dark').addClass('bg-transparent');
        $('.topHeader').removeClass("d-none")
    }
};

$('.nav-item.dropdown').on('mouseenter' , function(){
    $('.dropdown-menu').removeClass('show')
    $(this).find('.dropdown-menu').addClass('show');

    $(this).on('mouseleave' , function(){
        $('.dropdown-menu').removeClass('show')
    });

});


// topRated
$('.rowMain > div').on('mouseenter' , function(){
    $('.rowMain > div').removeClass('flex-grow-1');
    $(this).addClass('flex-grow-1');

    $('.rowMain > div').on('mouseleave' , function(){
        $('.rowMain > div').addClass('flex-grow-1');
    })

})

// home video

$(document).on("click", "#body-overlay", function (e) {
    e.preventDefault();
    $("#body-overlay").removeClass("active");
    $(".video-popup").removeClass("active");
    $(".video-popup iframe").attr("src", "");
});
$(document).on("click", ".contactIcon", function (e) {
    e.preventDefault();

    $(".video-popup iframe").attr(
        "src",
        "https://www.youtube.com/embed/BOXYG4llnKY?color=white"
    );
    $(".video-popup").addClass("active");
    $("#body-overlay").addClass("active");
});

// sliders
$(document).ready(function () {
    $(".testmonialSlider").slick({
        autoplay: true,
        arrows: false,
        dots:true,
        speed: 500,
        centerMode: true,
        centerPadding: "200px",
        slidesToShow: 1,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "110px",
                    slidesToShow: 1,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "30px",
                    slidesToShow: 1,
                },
            },
            {
                breakpoint: 500,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "0px",
                    slidesToShow: 1,
                },
            },
        ],
    });

    $(".mainImgSlider").slick({
        autoplay: false,
        arrows: true,
        speed: 800,
        slidesToShow: 1,
        slickCurrentSlide: arguments,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: true,
                    slidesToShow: 1,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: true,
                    slidesToShow: 1,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    slidesToShow: 1,
                },
            },
        ],
    });

    $(".imgSlider").slick({
        autoplay: true,
        arrows: false,
        dots: true,
        speed: 800,
        centerMode: true,
        centerPadding: "30px",
        slidesToShow: 3,
        slickCurrentSlide: arguments,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    centerMode: true,
                    // centerPadding: "100px",
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "40px",
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "20px",
                    slidesToShow: 2,
                },
            },
        ],
    });
});


const blog_slider = new Swiper(".blogSlider", {
    slidesPerView: 2,
    spaceBetween: 15,
    loop: true,
    autoplay: {
        delay: 500,
        disableOnInteraction: true,
    },
    speed: 4000,
    breakpoints: {
        300: {
            slidesPerView: 1,
        },768: {
            slidesPerView: 2,
        },
        992: {
            slidesPerView: 2,
        },
    },
    loopAdditionSlides: true,
});





// let imgs = Array.from(document.querySelectorAll(".parent .cart img"));

// let galleryLayer = document.querySelector(".galleryLayer");

// let nextItem = document.querySelector(".nextButton");
// let prevItem = document.querySelector(".prevButton");

// let closeItem = document.querySelector(".closeButton");
// let curentIndex = 0;

// for (let i = 0; i < imgs.length; i++) {
//    imgs[i].addEventListener("click", function (e) {
//       curentIndex = imgs.indexOf(e.target);

//       let curentSrc = e.target.src;

//       $('.mainImg').attr('src' , curentSrc);
//       $('.galleryLayer').removeClass('d-none');

//    });
// };

// closeItem.addEventListener("click", close);

// nextItem.addEventListener("click", next);

// prevItem.addEventListener("click", prev);

// document.addEventListener("keydown", function (e) {
//    if (e.key == "ArrowLeft") {
//       prev();
//    } else if (e.key == "ArrowRight") {
//       next();
//    } else if (e.key == "Escape") {
//       close();
//    }
// });

// document.addEventListener("click", function (e) {
//    if (e.target == galleryLayer) {
//       close();
//    }
// });

// function close() {
//     galleryLayer.classList.add('d-none');
// }

// function next() {
//    curentIndex++;

//    if (curentIndex == imgs.length) {
//       curentIndex = 0;
//    }

//    var curentSrc = imgs[curentIndex].src;
//    $('.mainImg').attr('src' , curentSrc);


// }

// function prev() {
//    curentIndex--;

//    if (curentIndex < 0) {
//       curentIndex = imgs.length - 1;
//    }

//    var curentSrc = imgs[curentIndex].src;

//   $('.mainImg').attr('src' , curentSrc);
// }



document.addEventListener("DOMContentLoaded", function () {
    $(".counter").countTo();
});

// sliders

$(document).ready(function () {
    $(".logoSlider").slick({
        autoplay: true,
        arrows: false,
        dots: true,
        speed: 2000,
        centerMode: true,
        centerPadding: "160px",
        slidesToShow: 4,
        slickCurrentSlide: arguments,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "100px",
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "80px",
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "50px",
                    slidesToShow: 1,
                },
            },
        ],
    });

    $(".categoriesSlider").slick({
        autoplay: true,
        arrows: false,
        dots: true,
        speed: 1000,
        // centerMode: true,
        // centerPadding: "100px",
        slidesToShow: 5,
        slickCurrentSlide: arguments,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    // centerMode: true,
                    // centerPadding: "100px",
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    // centerMode: true,
                    // centerPadding: "80px",
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    // centerMode: true,
                    // centerPadding: "75px",
                    slidesToShow: 1,
                },
            },
        ],
    });

    $(".teamSlider").slick({
        autoplay: true,
        arrows: false,
        dots:true,
        speed: 1000,
        slidesToShow: 4,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "30px",
                    slidesToShow: 1,
                },
            },
        ],
    });

    $(".testmonialSlidera").slick({
        autoplay: true,
        arrows: false,
        dots:true,
        speed: 2500,
        centerMode: true,
        centerPadding: "200px",
        slidesToShow: 1,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "110px",
                    slidesToShow: 1,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "30px",
                    slidesToShow: 1,
                },
            },
            {
                breakpoint: 500,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "0px",
                    slidesToShow: 1,
                },
            },
        ],
    });

    $(".newsSlider").slick({
        autoplay: true,
        arrows: false,
        dots: false,
        speed: 1000,
        slidesToShow: 3,
        slickCurrentSlide: arguments,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 500,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                },
            },
        ],
    });

    $(".experienceSlider").slick({
        autoplay: true,
        arrows: false,
        dots: true,
        speed: 1000,
        slidesToShow: 3,
        slickCurrentSlide: arguments,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                },
            },
        ],
    });



    $(".reviewSlider").slick({
        autoplay: true,
        arrows: false,
        dots: true,
        speed: 500,
        centerMode: true,
        centerPadding: "30px",
        slidesToShow: 1,
        slickCurrentSlide: arguments,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    centerMode: true,
                    // centerPadding: "100px",
                    slidesToShow: 1,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "40px",
                    slidesToShow: 1,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "20px",
                    slidesToShow: 1,
                },
            },
        ],
    });

});


var destination_slider = new Swiper(".des-slider", {
    slidesPerView: 5,
    spaceBetween: 50,
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: true,
    },
    speed: 2000,
    effect: "coverflow",
    coverflowEffect: {
        rotate: 1,
        stretch: 2,
        depth: 100,
        modifier: 3,
        slideShadows: true,
    },
    breakpoints: {
        300: {
            slidesPerView: 1,
        },768: {
            slidesPerView: 2,
        },
        992: {
            slidesPerView: 3,
        },
    },
    loopAdditionSlides: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

var team_slider = new Swiper(".team-slider", {
    slidesPerView: 5,
    spaceBetween: 50,
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: true,
    },
    speed: 2000,
    effect: "coverflow",
    coverflowEffect: {
        rotate: 1,
        stretch: 2,
        depth: 100,
        modifier: 3,
        slideShadows: true,
    },
    breakpoints: {
        300: {
            slidesPerView: 1,
        },768: {
            slidesPerView: 2,
        },
        992: {
            slidesPerView: 3,
        },
    },
    loopAdditionSlides: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});


// faqs
$(function () {
    $(".problemInfo").on("click", function () {
        $(this).siblings().toggleClass("d-none");
        $(this).find(".plus").toggleClass("d-none");
        $(this).find(".minus").toggleClass("d-none");
    });

});






// end





$(function () {
    $(".replay").on("click", function () {
        // console.log("ahmed");
        $("#replayComment").toggleClass("d-none");
    });
    $("#replayComment").on("change", function () {
        // console.log($("#replayComment").val());
        replayValue = $("#replayComment").val();
        $("#replayComment").addClass("d-none");
        console.log(replayValue);
        $("#user-replayComment").removeClass("d-none");
        $("#user-replayComment .commentDesc").html(replayValue);
    });
});



// calender
// $(function(){

//   $(document).on("click", "#body-overlay", function (e) {
//     e.preventDefault();
//     $("#body-overlay").removeClass("active");
//     $("#calender-popup").removeClass("active");
//   });
//   $(document).on("click", "#calenderFire", function (e) {
//     e.preventDefault();
//     $("#calender-popup").addClass("active");
//     $("#body-overlay").addClass("active");
//   });

//   let yearWord , monthWord;

//   const daysContainer = document.querySelector(".days");
//   const nextBtn = document.querySelector(".next");
//   const prevBtn = document.querySelector(".prev");
//   const todayBtn = document.querySelector(".today");
//   const month = document.querySelector(".month");

//   const months = [
//     "January",
//     "February",
//     "March",
//     "April",
//     "May",
//     "June",
//     "July",
//     "August",
//     "September",
//     "October",
//     "November",
//     "December",
//   ];

//   const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

//   const date = new Date();
//   let currentDay = date.getDate();
//   let currentMonth = date.getMonth();
//   let currentYear = date.getFullYear();

//   // console.log(currentDay);

//   // main array

//   let mainArray = {
//     "Days": {
//       1: "on",
//       2: "on",
//       4: "on",
//       9: "on",
//       11: "on",
//       12: "on",
//       13: "on",
//       14: "on",
//       16: "on",
//       20: "on",
//       24: "on",
//       25: "on",
//       26: "on",
//       27: "on",
//       29: "on",
//       30: "on",
//       31: "on"
//     },
//     "Week": {
//       "Monday": "on",
//       "Tuesday": "on",
//       "Wednesday": "on",
//       "Friday": "on",
//       "Saturday": "on",
//       "Sunday": "on"
//     },
//     "Month": {
//       "April": "on",
//       "May": "on",
//       "June": "on",
//       "July":"on",
//       "November": "on"
//     },
//     "Year": {
//       2024: "on"
//     }
//   };
// const daysArray = Object.keys(mainArray.Days).map(Number);
// const monthsArray = Object.keys(mainArray.Month);
// const yearsArray = Object.keys(mainArray.Year);





//   const renderCalendar = () => {
//     date.setDate(1);
//     const firstDay = new Date(currentYear, currentMonth, 1);
//     const lastDay = new Date(currentYear, currentMonth + 1, 0);
//     const lastDayIndex = lastDay.getDay();
//     const lastDayDate = lastDay.getDate();
//     const prevLastDay = new Date(currentYear, currentMonth, 0);
//     const prevLastDayDate = prevLastDay.getDate();
//     const nextDays = 7 - lastDayIndex - 1;

//     month.innerHTML = `${months[currentMonth]} ${currentYear}`;

//     console.log($(month).text());

//         const words = $(month).text().split(" ");
//         yearWord = words[1];
//         monthWord = words[0];
//         // monthWord = months.indexOf(words[0])+1; // Note: January is month 0, so May is month 4
//       //  console.log(yearWord , monthWord);


//     // console.log(monthsArray.includes(monthWord));
//     // console.log(yearsArray.includes(yearWord));


//     let days = "";



// // previous  days
//     // for (let x = firstDay.getDay(); x > 0; x--) {
//     //   days += `<div class="day prev d-flex flex-column">
//     //   ${prevLastDayDate - x + 1}
//     //   <span class="font-sm mt-2">$100</span>
//     //   </div>`;
//     // }

//     for (let i = 1; i <= lastDayDate; i++) {

//       function getUnAvaliable() {

//         days += `<div class="day  d-flex flex-column unavaliable">
//           ${i}
//           <span class="font-sm mt-2">$200</span>
//           </div>`;

//       }

//       // console.log('for true');
//       if(yearsArray.includes(yearWord)){
//         if(monthsArray.includes(monthWord)){

//           if (daysArray.includes(i)){
//             if (
//               i === new Date().getDate() &&
//               currentMonth === new Date().getMonth() &&
//               currentYear === new Date().getFullYear()

//             ) {

//               days += `<div class="day today cPointer d-flex flex-column">
//               ${i}
//               <span class="font-sm mt-2">$100</span>
//               </div>`;


//             } else if(
//             currentMonth < new Date().getMonth() &&
//             currentYear <= new Date().getFullYear() ){
//               getUnAvaliable();
//               // days += `<div class="day  d-flex flex-column unavaliable">
//               // ${i}
//               // <span class="font-sm mt-2">$200</span>
//               // </div>`;

//             }else if(currentMonth === new Date().getMonth() &&
//             currentYear <= new Date().getFullYear()&&
//             i < new Date().getDate()){

//               getUnAvaliable();
//             // days += `<div class="day  d-flex flex-column unavaliable">
//             // ${i}
//             // <span class="font-sm mt-2">$200</span>
//             // </div>`;

//             }
//             else{

//               days += `<div class="day cPointer d-flex flex-column avaliable">
//               ${i}
//               <span class="font-sm mt-2">$200</span>
//               </div>`;

//             }
//           }else{
//             getUnAvaliable();
//             // days += `<div class="day  d-flex flex-column unavaliable">
//             // ${i}
//             // <span class="font-sm mt-2">$200</span>
//             // </div>`;

//           }

//         }else{
//           getUnAvaliable();
//           // days += `<div class="day  d-flex flex-column unavaliable">
//           // ${i}
//           // <span class="font-sm mt-2">$200</span>
//           // </div>`;

//         }
//       }else{
//         getUnAvaliable();
//         // days += `<div class="day  d-flex flex-column unavaliable">
//         // ${i}
//         // <span class="font-sm mt-2">$200</span>
//         // </div>`;

//       }


//     // next  days
//       // for (let j = 1; j <= nextDays; j++) {
//       //   days += `<div class="day next d-flex flex-column">
//       //   ${j}
//       //   <span class="font-sm mt-2">$300</span>
//       //   </div>`;
//       // }

//       daysContainer.innerHTML = days;
//       hideTodayBtn();


//       $('.days .day.cPointer').on('click' , function(){
//         // console.log($(this));
//         $('.days .day.avaliable , .days .day.today').addClass('opacity-50')
//         $(this).removeClass('opacity-50');

//         const sentence = $(this).parent().parent().find(".month").text();
//         const words = sentence.split(" ");
//         yearWord = words[1];
//         monthWord = months.indexOf(words[0]); // Note: January is month 0, so May is month 4
//       //  console.log(yearWord , monthWord);
//         const days_array=$(this).text().split(" ");
//         let filteredArray = days_array.filter(function(element) {
//           return element.trim() !== '';
//         });
//         let dayWord =filteredArray[0] ;
//   // Create a new Date object with the specified date components
//   let date = new Date(yearWord, monthWord, dayWord);
//         console.log(date);
//         $("#price").val($(this).find('span').text())
//       })

//       }

//       // console.log(DaysArray.includes(i));

//   };

//   nextBtn.addEventListener("click", () => {
//     currentMonth++;
//     if (currentMonth > 11) {
//       currentMonth = 0;
//       currentYear++;
//     }
//     renderCalendar();
//   });

//   prevBtn.addEventListener("click", () => {
//     currentMonth--;
//     if (currentMonth < 0) {
//       currentMonth = 11;
//       currentYear--;
//     }
//     renderCalendar();
//   });

//   todayBtn.addEventListener("click", () => {
//     currentMonth = date.getMonth();
//     currentYear = date.getFullYear();
//     renderCalendar();
//   });

//   function hideTodayBtn() {
//     if (
//       currentMonth === new Date().getMonth() &&
//       currentYear === new Date().getFullYear()
//     ) {
//       todayBtn.style.display = "none";
//     } else {
//       todayBtn.style.display = "flex";
//     }
//   }

//   renderCalendar();


// });


// user profile

$(function () {
    $(".addAddress").on("click", function () {
        // console.log("aaaa");
        $(".addAddress").addClass("d-none");
        $(".addAddress + div").toggleClass("d-none");
    });

    $(".userProfile .nav-link").on("click", function (e) {
        // console.log(e.target.getAttribute("href"));
        $('.user').addClass('d-none');
        $(`.user${e.target.getAttribute("href")} `).toggleClass('d-none')
    });

});
