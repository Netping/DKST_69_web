$(function () {
    $('.report-periods-radios input').on('change', function (e) {
        e.preventDefault();

        $('.report-period').hide();
        var periodId = $(this).val();
        $('#' + periodId).show();
    })
});