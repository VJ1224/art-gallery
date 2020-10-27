$(document).ready(function() {
    let pages = ['index', 'gallery', 'news', 'contact'];
    let pathname = window.location.pathname;
    
    $('.navbar-nav .nav-item .nav-link').each(function(i) {
        if (pathname.includes(pages[i])) 
            $(this).addClass('active');
        else if (this.className.includes('active'))
            $(this).removeClass('active');
    });
});

$(".nav-tabs .nav-item .nav-link:not(.nav-tabs .nav-item.dropdown .nav-link), .dropdown-item").click(function() {
    $(".dropdown-item.active").removeClass('active');
});

function validate(element) {
    $(element).addClass('was-validated');
    if (!$(element)[0].checkValidity()) {
        return false;
    }

    return true;
}