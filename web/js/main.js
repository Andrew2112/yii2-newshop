addEventListener("load", function () {
    setTimeout(hideURLbar, 0);
}, false);

function hideURLbar() {
    window.scrollTo(0, 1);
}

jQuery(document).ready(function ($) {
    $(".scroll").click(function (event) {
        event.preventDefault();
        $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
    });

    let navoffeset = $(".agileits_header").offset().top;
    $(window).scroll(function () {
        let scrollpos = $(window).scrollTop();
        if (scrollpos >= navoffeset) {
            $(".agileits_header").addClass("fixed");
        } else {
            $(".agileits_header").removeClass("fixed");
        }
    });


    $(".dropdown").hover(
        function () {
            $('.dropdown-menu', this).stop(true, true).slideDown("fast");
            $(this).toggleClass('open');
        },
        function () {
            $('.dropdown-menu', this).stop(true, true).slideUp("fast");
            $(this).toggleClass('open');
        }
    );

    /*
       var defaults = {
       containerID: 'toTop', // fading element id
       containerHoverID: 'toTopHover', // fading element hover id
       scrollSpeed: 1200,
       easingType: 'linear'
       };
   */

    $().UItoTop({easingType: 'easeOutQuart'});
    $(function () {
        $('#example').okzoom({
            width: 150,
            height: 150,
            border: "1px solid black",
            shadow: "0 0 5px #000"
        });
    });
});

$(window).load(function () {
    $('.flexslider').flexslider({
        animation: "slide",
        start: function (slider) {
            $('body').removeClass('loading');
        }
    });
});


paypal.minicart.render();

paypal.minicart.cart.on('checkout', function (evt) {
    var items = this.items(),
        len = items.length,
        total = 0,
        i;

    // Count the number of each item in the cart
    for (i = 0; i < len; i++) {
        total += items[i].get('quantity');
    }

    if (total < 3) {
        alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
        evt.preventDefault();
    }
});

/*=======CART=======*/
function showCart(cart) {
    $('#modal-cart .modal-body').html(cart);
    $('#modal-cart').modal();
    let cartSum = $('#cart-sum').text() ? $('#cart-sum').text() : '$ 0';
    if (cartSum) {
        $('.cart-sum').text(cartSum);
    }
};

function clearCart() {
    $.ajax({
        url: 'cart/clear',
        type: 'GET',
        success: function (res) {
            if (!res) alert('ERROR!');
            let now_location = document.location.pathname;
            if (now_location === '/cart/checkout') {
                location = 'cart/checkout';
            }
            showCart(res);

        },
        error: function () {
            alert('Ошибка');

        }
    });
}

function getCart() {
    $.ajax({
        url: 'cart/show',
        type: 'GET',
        success: function (res) {
            if (!res) alert('ERROR!');
            showCart(res);

        },
        error: function () {
            alert('Ошибка');

        }
    });
}

$('.add-to-cart').on('click', function () {
    let id = $(this).data('id'),
        qty = $('.quantity-product input').val() ? $('.quantity-product input').val() : 1;
    $.ajax({
        url: 'cart/add',
        data: {id: id, qty: qty},
        type: 'GET',
        success: function (res) {
            console.log(qty);
            if (!res) alert('ERROR!');
            showCart(res);

        },
        error: function () {
            alert('Ошибка');

        }
    });
    return false;

});

$('#modal-cart .modal-body').on('click', '.del-item', function () {
    let id = $(this).data('id');
    $.ajax({
        url: 'cart/del-item',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка');
            let now_location = document.location.pathname;
            if (now_location === '/cart/checkout') {
                location = 'cart/checkout';
            }
            showCart(res);

        },
        error: function () {
            alert('Error!');
        }
    })
});
/*=======/CART=======*/
/*==change-quantity==*/

$('.value-minus, .value-plus').on('click', function () {
    let id = $(this).data('id'),
        qty = $(this).data('qty');
    $('.cart-table .overlay').fadeIn();
    $.ajax({
        url: 'cart/change-cart',
        data: {id: id, qty: qty},
        type: 'GET',
        success: function (res) {
            if (!res) alert('ERROR product!');
            location = 'cart/checkout';
        },
        error: function () {
            alert('ERROR!');
        }
    });
});
/*==quantity==

$('.value-plus').on('click', function () {
    var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10) + 1;
    divUpd.text(newVal);
});

$('.value-minus').on('click', function () {
    var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10) - 1;
    if (newVal >= 1) divUpd.text(newVal);
});
*/
/*==quantity==*/
/*$(document).ready(function(c) {
    $('.close1').on('click', function(c){
        $('.rem1').fadeOut('slow', function(c){
            $('.rem1').remove();
        });
    });
});

$(document).ready(function(c) {
    $('.close2').on('click', function(c){
        $('.rem2').fadeOut('slow', function(c){
            $('.rem2').remove();
        });
    });
});

$(document).ready(function(c) {
    $('.close3').on('click', function(c){
        $('.rem3').fadeOut('slow', function(c){
            $('.rem3').remove();
        });
    });
});
*/

//js
/*==script-for sticky-nav ==*/

$(document).ready(function () {
    var navoffeset = $(".agileits_header").offset().top;
    $(window).scroll(function () {
        var scrollpos = $(window).scrollTop();
        if (scrollpos >= navoffeset) {
            $(".agileits_header").addClass("fixed");
        } else {
            $(".agileits_header").removeClass("fixed");
        }
    });

});

/*=== //script-for sticky-nav===*/