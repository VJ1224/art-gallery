$(document).ready(function() {
    let pages = ['index', 'gallery', 'blog', 'contact'];
    let pathname = window.location.pathname;
    
    $('.navbar-nav .nav-item .nav-link').each(function(i) {
        if (pathname.includes(pages[i])) 
            $(this).addClass('active');
        else if (this.className.includes('active'))
            $(this).removeClass('active');
    });
});

function validate(element) {
    $(element).addClass('was-validated');
    if (!$(element)[0].checkValidity()) {
        return false;
    }

    return true;
}