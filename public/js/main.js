let url = 'http://instagram.com.test/';
window.addEventListener("load", function () {
    $('.btn-dislike').css('cursor','pointer');
    $('.btn-dislike').css('cursor','pointer');

    //Boton like
    function like() {
        $('.btn-like').unbind('click').click(function() {
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'img/heartRed.svg');
            let btn_likes = $(this).closest('.likes').find('.count-like');

            //Peticion Ajax
            $.ajax({
                type: "GET",
                url: url+'like/'+$(this).data('id'),
                success: function (response) {
                    if (response) {
                        let likes_sum = parseInt(btn_likes.text());
                        likes_sum = likes_sum + 1;
                        btn_likes.text(likes_sum);
                    }
                }
            });

            dislike();
        });
    }
    like();

    //Boton dislike
    function dislike() {
        $('.btn-dislike').unbind('click').click(function() {
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'img/heartBlack.svg');
            let btn_likes = $(this).closest('.likes').find('.count-like');

            //Peticion Ajax
            $.ajax({
                type: "GET",
                url: url+'dislike/'+$(this).data('id'),
                success: function (response) {
                    if (response) {
                        let likes_res = parseInt(btn_likes.text());
                        likes_res = likes_res - 1;
                        btn_likes.text(likes_res);
                    }
                }
            });

            like();
        });
    }
    dislike();

    //Buscador
    $('#buscador').submit(function () {
        $(this).attr('action',url+'gente/'+$('#buscador #search').val());
    });
});
