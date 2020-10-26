$.get('php/authenticate.php', function (data) {
    if (data === "0") {
        window.location.replace("http://localhost/cia2-project/login.html");
    }
});

function updateSubs() {
    $.get('php/subscriptions.php', function (data) {
        $('#subTable').html(data);
    });
}

function updateArt() {
    $.get('php/viewArtwork.php', function (data) {
        $('#artTable').html(data);
    });
}

function updateArtist() {
    $.get('php/viewArtist.php', function (data) {
        $('#artistTable').html(data);
    });
}

function sortArt() {
    let sort = $('#sortArt').val();
    let order = $('#orderArt').val();
    $.get('php/viewArtwork.php?sort='+sort+'&order='+order, function (data) {
        $('#artTable').html(data);
    });
}

function groupArt() {
    let group = $('#sortArt').val();
    let order = $('#orderArt').val();
    $.get('php/groupArtwork.php?group='+group, function (data) {
        $('#artTable').html(data);
    });
}

function disableButtons() {
    let column = $('#sortArt').val();

    if (column === 'price') {
        $('#searchArt').prop('disabled', true);
    } else {
        $('#searchArt').prop('disabled', false);
    }

    if (column === 'aname' || column === 'price') {
        $('#groupArt').prop('disabled', true);
    } else {
        $('#groupArt').prop('disabled', false);
    }
}

function deleteArt(aname, artist) {
    let dataString = `aname=${aname}&artist=${artist}`;
    $.post('php/deleteArtwork.php', dataString, function () {
        updateArt();
    });
}

function searchArt() {
    let query = $('#searchVal').val();
    let category = $('#sortArt').val();
    $.get('php/searchArtwork.php?search='+query+'&category='+category, function (data) {
        $('#artTable').html(data);
    })
}

function editArt(row_id) {
    let row = document.getElementById(row_id);
    let aname = row.cells[1].innerHTML;
    let artist = row.cells[2].innerHTML;
    let price = row.cells[3].innerHTML.replace(/,/g, '');
    price = parseInt(price.slice(1));
    let type = row.cells[4].innerHTML;
    
    $('#aname').val(aname);
    $('#artist').val(artist);
    $('#price').val(price);
    $('#atype').val(type);
    
    $('#viewArt').removeClass('active');
    $('#viewArt').removeClass('show');
    $('a[href="#viewArt"]').removeClass('active');
    $('#addArt').tab('show');
    $('a[href="#addArt"]').addClass('active');

    deleteArt(aname, artist);
}

$(document).ready(function () {
    updateSubs();
    updateArt();
    updateArtist();

    $('#addedArt').hide();
    $('#errorArt').hide();
    $('#registered').hide();
    $('#user-exists').hide();
    $('#addedPost').hide();
    $('#addedArtist').hide();
    $('#errorArtist').hide();
    
    $('#viewArt').tab('show');
    $('a[href="#viewArt"]').addClass('active');

    $.get('php/username.php', function (data) {
        $('#greeting').html(data);
    });

    $.get('php/getArtist.php', function (data) {
        $('#artist').html(data);
    });

    $.get('php/generateCSV.php', function (data) {
        $('#viewSubs #title').append('<br><a id="downloadButton" class="btn btn-danger" href="php/'+data+'" download>Download as CSV</a>');
    });
    
});

$('#registerButton').click(function(event) {
    const valid = () => {
        let valid = true;

        $('#registerForm').addClass('was-validated');
        if (!$('#registerForm')[0].checkValidity()) {
            valid = false;
        }

        if ($('#password1').val() !== $('#password2').val()) {
            $('#password2').removeClass('is-valid');
            $('#password2').addClass('is-invalid');
            $('#password2')[0].setCustomValidity('is-invalid');
            valid = false;
        } else {
            $('#password2').removeClass('is-invalid');
            $('#password2').addClass('is-valid');
            $('#password2')[0].setCustomValidity('');
        }

        return valid;
    }

    if (!valid()) {
        return;
    }
    
    let dataString = `username=${$('#username').val()}&password=${$('#password1').val()}`;

    $.post('php/register.php', dataString, function (data) {
        if (data === "0") {
            $('#user-exists').show();
        } else {
            $('#registerForm')[0].reset();
            $('#registered').show();
        }
        
        $('#registerForm').removeClass('was-validated');
        $('#password2').removeClass('is-valid');
    });
});

$("#addArtButton").click(function(event) {
    if (!validate('#addArtForm')) {
        return;
    }
    
    let dataString = `aname=${$('#aname').val()}&artist=${$('#artist').val()}&price=${$('#price').val()}&atype=${$('#atype').val()}`

    let file = $('#image').prop('files')[0];
    let file_name = $('#aname').val() + " " + $('#artist').val() + '.jpg';

    let form_data = new FormData();    
    form_data.append('image', file, file_name);

    $.post('php/addArtwork.php', dataString, function (data) {
        if (data === "0") {
            $('#errorArt').show();
            return;
        }

        $('#addArtForm')[0].reset();
        $('#addedArt').show();
        $('#addArtForm').removeClass('was-validated');

        $.ajax({
            type: 'post',
            url: 'php/upload.php',
            processData: false,                       
            cache: false,
            contentType: false,
            data: form_data
        });
    });
});

$("#postButton").click(function(event) {
    if (!validate('#postForm')) {
        return;
    }

    let dataString = `title=${$('#post-title').val()}&body=${$('#post-body').val()}`;

    $.post('php/addPost.php', dataString, function () {
        $('#postForm')[0].reset();
        $('#addedPost').show();
        $('#postForm').removeClass('was-validated');
    });
});

$("#artistButton").click(function(event) {
    if (!validate('#artistForm')) {
        return;
    }

    let dataString = `name=${$('#name').val()}&mobile=${$('#mobile').val()}&email=${$('#email').val()}&location=${$('#location').val()}`;

    $.post('php/addArtist.php', dataString, function (data) {
        if (data === "0") {
            $('#errorArtist').show();
            return;
        }

        $('#artistForm')[0].reset();
        $('#addedArtist').show();
        $('#artistForm').removeClass('was-validated');
    });
});

$("#logout").click(function() {
    $.get('php/logout.php', function () {
        window.location.replace("http://localhost/cia2-project/login.html");
    });
});

$('#showPassword').click(function() {
    if('password' == $('#password1').attr('type')){
        $('#password1').prop('type', 'text');
        $('#password2').prop('type', 'text');
    } else {
        $('#password1').prop('type', 'password');
        $('#password2').prop('type', 'password');
    }
});