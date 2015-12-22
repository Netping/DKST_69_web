/*
	Dropdown with Multiple checkbox select with jQuery - May 27, 2013
	(c) 2013 @ElmahdiMahmoud
	license: http://www.opensource.org/licenses/mit-license.php
*/

$(".dropdown-checkbox .select-box a").on('click', function () {
    var $dropdown = $(this).parents(".dropdown-checkbox");
    if ($dropdown.hasClass('active'))
        $dropdown.removeClass('active');
    else {
        $(".dropdown-checkbox").removeClass('active');
        $dropdown.addClass('active');
    }
});

$(document).bind('click', function (e) {
    var $clicked = $(e.target);
    if (!$clicked.parents().hasClass("dropdown-checkbox")) $(".dropdown-checkbox").removeClass('active');
});

$('.select-list input[type="checkbox"]').on('click', function () {
    var $option = $(this);
    var title = $option.parent().text();

    if ($(this).is(':checked')) {
        var html = '<span title="' + title + '">' + title + ', </span>';
        $option.parents('.dropdown-checkbox').find('.select-box a').append(html);
        $option.parents('li').addClass('active');
    } else {
        $option.parents('.dropdown-checkbox').find('.select-box a span[title="' + title + '"]').remove();
        $option.parents('li').removeClass('active');
    }
});