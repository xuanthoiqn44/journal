//login form
function login(){
    $.ajax({
        type:'POST',
        url:'login',
        success: function(data)
        {
            $('#myModal').html(data);
            $('#myModal').modal();
        }
    });
}
//end login form
//register form
function register(){
    $.ajax({
        type:'POST',
        url:'account/register',
        success: function(data)
        {
            $('#myModal').html(data);
            $('#myModal').modal();
        }
    });
}
//end register form
    $('#radioBtn a').on('click', function () {
        var sel = $(this).data('title');
        var tog = $(this).data('toggle');
        $('#' + tog).prop('value', sel);

        $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('_active').addClass('_notActive');
        $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('_notActive').addClass('_active');
    })
//step form order
    $(document).ready(function () {
        $('#orderpost-urgency option').each(function()
        {
            var x = $(this).append(' days');
            var y =x ;
        });
        //Initialize tooltips
        $('.nav-tabs > li a[title]').tooltip();

        //Wizard
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

            var $target = $(e.target);
            Validate_Tabs();
            if ($target.hash == "#step3"){
                //$('.next-step').prop('type', 'submit');
            }
            else {
                //$('#submit_order').prop('type', 'button');
            }
            if ($target.parent().hasClass('disabled') || Validate_Tabs()===false) {
                return false;
            }
        });
        //click tabs

        //click button next step
        $(".next-step").click(function (e) {
            //Validate_Tabs();
            if (Validate_Tabs())
            {
                var $active = $('.wizard .nav-tabs li.active');
                $active.next().removeClass('disabled');
                nextTab($active);
            }
        });



        /*function Validate_Order() {
            var $yiiform = $("#order");
            $.ajax({
                    type: $yiiform.attr("method"),
                    url: $yiiform.attr("action"),
                    data: $yiiform.serialize(),
                }
            )
                .done(function (data) {
                    if (data.success) {
                        // data is saved
                        var $active = $('.wizard .nav-tabs li.active');
                        $active.next().removeClass('disabled');
                        nextTab($active);

                    } else if (data.validation) {
                        // server validation failed
                        $yiiform.yiiActiveForm('updateMessages', data.validation, true); // renders validation messages at appropriate places
                    } else {
                        // incorrect server response
                    }
                })
                .fail(function () {
                    // request failed
                })

            return false; // prevent default form submission
        }*/


        /*$("#order").on('beforeSubmit', function () {
            var $yiiform = $(this);
            $.ajax({
                    type: $yiiform.attr("method"),
                    url: $yiiform.attr("action"),
                    data: $yiiform.serialize(),
                }
            )
                .done(function(data) {
                    if(data.success) {
                        // data is saved
                        var $active = $('.wizard .nav-tabs li.active');
                        $active.next().removeClass('disabled');
                        nextTab($active);
                    } else if (data.validation) {
                        // server validation failed
                        $yiiform.yiiActiveForm('updateMessages', data.validation, true); // renders validation messages at appropriate places
                    } else {
                        // incorrect server response
                    }
                })
                .fail(function () {
                    // request failed
                })

            return false; // prevent default form submission
        })*/

        $(".prev-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            prevTab($active);

        });
    });

    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }

    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }
function Validate_Tabs() {
    var bool = true;
    var form = document.getElementById('order');
    if (form) {
        for(var i=form.elements.length - 1; i > 0; i--){
            var x = form.elements[i].getAttribute("aria-invalid");
            if(form.elements[i].value === '' && form.elements[i].getAttribute('aria-required')){
                form.elements[i].focus();
                //form.elements[i].getElementsByClassName("help-block help-block-error").innerHTML = "can't be blank";
                bool = false;
            }
            else if (x==="true"){
                var x = form.elements[i].getAttribute("aria-invalid");
                form.elements[i].focus();
                bool = false;
            }
        }
    }

    return bool;
}





    $('.btnnext').on('click', function () {
        $('#order').yiiActiveForm('validate', true);
    });



    /*slide show*/

    $(document).ready(function () {
        var itemsMainDiv = ('.MultiCarousel');
        var itemsDiv = ('.MultiCarousel-inner');
        var itemWidth = "";

        $('.leftLst, .rightLst').click(function () {
            var condition = $(this).hasClass("leftLst");
            if (condition)
                click(0, this);
            else
                click(1, this)
        });

        ResCarouselSize();


        $(window).resize(function () {
            ResCarouselSize();
        });

        //this function define the size of the items
        function ResCarouselSize() {
            var incno = 0;
            var dataItems = ("data-items");
            var itemClass = ('.item');
            var id = 0;
            var btnParentSb = '';
            var itemsSplit = '';
            var sampwidth = $(itemsMainDiv).width();
            var bodyWidth = $('body').width();
            $(itemsDiv).each(function () {
                id = id + 1;
                var itemNumbers = $(this).find(itemClass).length;
                btnParentSb = $(this).parent().attr(dataItems);
                itemsSplit = btnParentSb.split(',');
                $(this).parent().attr("id", "MultiCarousel" + id);


                if (bodyWidth >= 1200) {
                    incno = itemsSplit[1];
                    itemWidth = sampwidth / incno;
                }
                else if (bodyWidth >= 992) {
                    incno = itemsSplit[1];
                    itemWidth = sampwidth / incno;
                }
                else if (bodyWidth >= 768) {
                    incno = itemsSplit[1];
                    itemWidth = sampwidth / incno;
                }
                else {
                    incno = itemsSplit[0];
                    itemWidth = sampwidth / incno;
                }
                $(this).css({'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers});
                $(this).find(itemClass).each(function () {
                    $(this).outerWidth(itemWidth);
                });

                $(".leftLst").addClass("over");
                $(".rightLst").removeClass("over");

            });
        }


        //this function used to move the items
        function ResCarousel(e, el, s) {
            var leftBtn = ('.leftLst');
            var rightBtn = ('.rightLst');
            var translateXval = '';
            var divStyle = $(el + ' ' + itemsDiv).css('transform');
            var values = divStyle.match(/-?[\d\.]+/g);
            var xds = Math.abs(values[4]);
            if (e == 0) {
                translateXval = parseInt(xds) - parseInt(itemWidth * s);
                $(el + ' ' + rightBtn).removeClass("over");

                if (translateXval <= itemWidth / 2) {
                    translateXval = 0;
                    $(el + ' ' + leftBtn).addClass("over");
                }
            }
            else if (e == 1) {
                var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                translateXval = parseInt(xds) + parseInt(itemWidth * s);
                $(el + ' ' + leftBtn).removeClass("over");

                if (translateXval >= itemsCondition - itemWidth / 2) {
                    translateXval = itemsCondition;
                    $(el + ' ' + rightBtn).addClass("over");
                }
            }
            $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
        }

        //It is used to get some elements from btn
        function click(ell, ee) {
            var Parent = "#" + $(ee).parent().attr("id");
            var slide = $(Parent).attr("data-slide");
            ResCarousel(ell, Parent, slide);
        }

    });

    /*$('.carousel[data-type="multi"] .item').each(function() {
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        if (next.next().length>0) {
            next.next().children(':first-child').clone().appendTo($(this));
        } else {
            $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
        }
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i = 0; i < 1; i++) {
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }

            next.children(':first-child').clone().appendTo($(this));
        }
    });*/
    /*end slide show*/

//click currency
    /*$('.currency').click(function () {
        var usd = ["$12.99", "$15.99", "$16.55", "$18.99", "$20.99"];
        var vnd = ["30.000đ", "35.000đ", "60.000đ", "65.000đ", "70.000đ"];
        var data = $(this).data('title');
        var x = document.getElementsByClassName("_prs");
        var getoption = document.getElementsByName("groupOfDefaultRadios");
        for ($i = 0; $i < x.length; $i++) {
            if (data === 'VND') {
                x[$i].innerHTML = vnd[$i];
                var pr = vnd[$i].split('đ');
                getoption[$i].setAttribute('data-prices', pr[0]);
                //x[$i].data('prices') //= vnd[$i].split('đ');
            } else if (data === 'USD') {
                x[$i].innerHTML = usd[$i];
                pr = usd[$i].split('$');
                getoption[$i].setAttribute('data-prices', pr[1]);
            }
        }
        RefreshUrl();

    });*/





    /*$(document).ready(function () {
        var x = document.getElementById("_slide");
        var bodyWidth = $('body').width();
        var sampwidth = $('.MultiCarousel').width();
        var itemNumbers = $(this).find('.item').length;
        var items = $('.MultiCarousel').data('items');
        var itemsSplit = items.split(',');
        if (bodyWidth >= 1200) {
            incno = itemsSplit[1];
            itemWidth = sampwidth / incno;
        }
        else if (bodyWidth >= 992) {
            incno = itemsSplit[1];
            itemWidth = sampwidth / incno;
        }
        else if (bodyWidth >= 768) {
            incno = itemsSplit[1];
            itemWidth = sampwidth / incno;
        }
        else {
            incno = itemsSplit[0];
            itemWidth = sampwidth / incno;
        }
        $width = 0;
        AutoSlide(itemNumbers,itemWidth,$width);
    })
    function AutoSlide(itemNumbers,itemWidth,width) {
        for (var i = 0; i < itemNumbers; i++) {
            (function (i) {
                setTimeout(function () {
                    if (i < itemNumbers-1) {

                        width += itemWidth;
                        //$('#_slide').css({ 'transform': 'translateX(-'+width+'px)', 'width': itemWidth * itemNumbers });
                        //i++;

                    }else{
                        width = 0;
                        AutoSlide(itemNumbers,itemWidth,$width);
                    }
                }, 2000*i);
            })(i);
        };
    }*/
    $(document).ready(function ($) {

        setInterval(function () {
            moveRight();
        }, 3000);

        var slideCount = $('#slider ul li').length;
        var slideWidth = $('#slider ul li').width();
        var slideHeight = $('#slider ul li').height();
        var sliderUlWidth = slideCount * slideWidth;

        $('#slider').css({width: slideWidth, height: slideHeight});

        $('#slider ul').css({width: sliderUlWidth, marginLeft: -slideWidth});

        $('#slider ul li:last-child').prependTo('#slider ul');


        function moveRight() {
            $('#slider ul').animate({
                left: -slideWidth
            }, 200, function () {
                $('#slider ul li:first-child').appendTo('#slider ul');
                $('#slider ul').css('left', '');
            });
        };


    })
    $(".filter").change(function () {
        var filterValue = $(this).val();
        var row = $('.row');

        row.hide()
        row.each(function (i, el) {
            if ($(el).attr('data-type') == filterValue) {
                $(el).show();
            }
        })

    });
    $("#tabs-2").hide();
    $("#tabs-3").hide();

















