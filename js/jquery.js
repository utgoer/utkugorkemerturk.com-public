$(document).ready(function(){
    var navbarCollapsedHeight = $('header').height();
    $('body').attr('style', 'padding-top:' + navbarCollapsedHeight + 'px;');
    $('#navbarSupportedContent ul li a').click(function (e) {
        e.preventDefault();
        $(".collapse").collapse('hide');
        var curLink = $(this);
        var scrollPoint = $(curLink.attr('href')).position().top - navbarCollapsedHeight;
        $('body,html').animate({
            scrollTop: scrollPoint
        }, 500);
    })

    $(window).scroll(function () {
        onScrollHandle();
    });

    function onScrollHandle() {
        var currentScrollPos = $(document).scrollTop();

        $('#navbarSupportedContent ul li a').each(function () {
            var curLink = $(this);
            var refElem = $(curLink.attr('href'));
            if (refElem.position().top - navbarCollapsedHeight <= currentScrollPos 
                && refElem.position().top + refElem.height() > currentScrollPos + navbarCollapsedHeight){
                $('#navbarSupportedContent ul li').removeClass("current");
                curLink.parent().addClass("current");
            }
            else {
                if($(".current").size > 1){
                    curLink.parent().removeClass("current");
                }

            }
        });
    }

    $('form').submit(function(event) {
        var name = $('input[name=Name]').val();
        var email = $('input[name=email]').val();
        var message = $('textarea[name=Message]').val();
        if(name.trim() && email.trim() && message.trim())
        {
            var formData = {
                'name'              : name,
                'email'             : email,
                'message'           : message
            };

            $.ajax({
                type        : 'POST',
                url         : 'https://www.utkugorkemerturk.com/php/mail.php',
                data        : formData,
                dataType    : 'json',
                encode      : true,
                success     : function(result){
                    $('input[name=Name]').val('SENT!');
                    $('input[name=email]').val('');
                    $('textarea[name=Message]').val('');
                }
            });
            event.preventDefault();
        }
    });
});