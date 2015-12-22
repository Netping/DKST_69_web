$(document).ready(function () {


    $('.show-sockets-btn, .show-sensors-btn').click(function () {
        showModal();
    });

    $('.window .buttons .cancel').click(function () {
        hideModal();
    })

    $('.socket-history-link').click(function () {
        showModal();
    })
})

function showModal() {
    $('html,body').addClass('noscroll');
    $('.overlay').addClass('active');
}

function hideModal() {
    $('html,body').removeClass('noscroll');
    $('.overlay').removeClass('active');
}