

// backtop
$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.backtop').fadeIn();
        } else {
            $('.backtop').fadeOut();

        }
    });
    $(".backtop").click(function () {
        document.querySelector('.backtop').classList.remove('origin')

        $('html, body').animate({
            scrollTop: 0,
        }, 0)
            ,
            $('.backtop').animate({
                bottom: 500,
            }, 1000)


        setTimeout(() => {
            console.log('asdas');
            document.querySelector('.backtop').classList.add('origin')
        }, 1000)
    });

    $(".backtop").hover(function () {
        $(".backtop i").animate({
            top: 4
        })
    }, function () {
        $(".backtop i").animate({
            top: 16
        })
    });
});



// product list
$(document).ready(function () {
    $('.content-list-item-body').slick({
        slidesToShow: 4,
        slidesToScroll: 3,
        arrows: true,
        infinite: false,
        Accessibility: true,
        // autoplaySpeed :200,
        prevArrow:
            "<button type='button' class='slick-prev slick-prev-home pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
        nextArrow:
            "<button type='button' class='slick-next slick-next-home pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>"
    });
});



// main-menu
$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 80) {
            $('.main-menu').addClass('fixed-top');
            $('.hidden').addClass('fadein');
        } else {
            $('.main-menu').removeClass('fixed-top');
            $('.hidden').removeClass('fadein');
        }
    });
});
// $(document).ready(function () {
//     $('.header-has-menu-product').hover(function () {

//     }, function () {
//         $('.header-menu-product').fadeOut()
//     }, 3000
//     )
// });



const container = document.querySelector(".container-sm"),
    pwShowHide = document.querySelectorAll(".showHidePw"),
    pwFields = document.querySelectorAll(".password");


//   đổi icon và ẩn hiện mật khẩu
pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        pwFields.forEach(pwField => {
            console.log(pwField)
            if (pwField.type === "password") {
                pwField.type = "text";
                pwShowHide.forEach(icon => {
                    icon.classList.replace("fa-eye-slash", "fa-eye");
                })
            } else {
                pwField.type = "password";

                pwShowHide.forEach(icon => {
                    icon.classList.replace("fa-eye", "fa-eye-slash");
                })
            }
        })
    })
})


// name-category-home
$(function () {
    $('.content-name').hover(function () {
        $('.content-name').stop().animate({
            width: 1194,


        })
    }
        , function () {
            $('.content-name').stop().animate({
                width: 600
            })

        }
    );
});

// slick-home
$(function () {
    $('.product-list-item').hover(function () {
        $('.slick-prev').stop().animate({
            opacity: .4,
            left: 10
        })
    }, function () {
        $('.slick-prev').stop().animate({
            left: -45,
            opacity: 0
        })
    })
    $('.slick-prev').hover(function () {
        $('.slick-prev').stop().animate({
            opacity: 1,
        })
    }, function () {
        $('.slick-prev').stop().animate({

            opacity: .4
        })
    })

    $('.product-list-item').hover(function () {
        $('.slick-next').stop().animate({
            opacity: .4,
            right: 10
        })
    }
        , function () {
            $('.slick-next').stop().animate({
                right: -45,
                opacity: 0
            })
        }
    )
    $('.slick-next').hover(function () {
        $('.slick-next').stop().animate({
            opacity: 1,

        })
    }
        , function () {
            $('.slick-next').stop().animate({
                opacity: .4
            })
        }
    )
})



// detail_porduct
var swiper = new Swiper(".mySwiper", {
    loop: true,
    spaceBetween: 10,
    slidesPerView: 3,
    freeMode: true,
    direction: "vertical",

    watchSlidesProgress: true,
});
var swiper2 = new Swiper(".mySwiper2", {
    loop: true,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: {
        swiper: swiper,
    },
});



//scroll
// When the user scrolls the page, execute myFunction
window.onscroll = function () { myFunction() };

function myFunction() {
    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    var scrolled = (winScroll / height) * 100;
    document.getElementById("myBar").style.width = scrolled + "%";
}



// profile img

$(document).ready(function () {


    var readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(".file-upload").on('change', function () {
        readURL(this);
    });
});

// message profile
let msg = document.querySelector('#message');
if (msg) {
    setTimeout(() => {
        msg.classList.add("d-none")
    }, 3000)
}


