$('#form_contact').submit(function(event) {

    var arrErrors = [];

    if ($('#name').val() === '') {
        arrErrors.push("O campo nome é obrigatório.");
    }

    if ($('#email').val() === '') {
        arrErrors.push("O campo email é obrigatório.");
    } else {
        if (!validateEmail($('#email').val())) {
            arrErrors.push("O email infirmado é inválido.");
        }
    }

    if ($('#cpf').val() === '') {
        arrErrors.push("O campo cpf é obrigatório.");
    } else {
        if (!validateCPF($('#cpf').val())) {
            arrErrors.push("o cpf informado é inválido.");
        }
    }

    if (arrErrors.length === 0) {
        return;
    } else {
        display_error(arrErrors);
    }
    event.preventDefault();
});

$('#email').blur(function() {

    var email = $('#email').val();
    if (email === '') {
        return false;
    }

    if (!validateEmail(email)) {
        display_error(['O email informádo é invalido.']);
        return false;
    }

    var url = '';

    if ($('[name="_method"]').val() === undefined) {
        url = '/contact/emailValidate/' + email;
    } else {
        var id = $('[name="_method"]').attr('data-id');
        url = '/contact/emailValidateUpdate/' + email + '/' + id ;
    }

    $.ajax({
        url: url,
        method: 'GET'
    }).done(function (response) {
        console.log(response);
        if (!response.success) {
            display_error(["O email inserido já existe no banco."]);
        } else {
            display_error([]);
        }
    }).fail(function (error) {
        console.log(error);
    });
});


function display_error(message) {
    $('#display-error').html('');
    $('#display-error-backend').hide();

    if (message.length > 0) {
        var html = "<div class='alert alert-danger'> <ul>";
        message.map(function (m) {
            html += "<li>" + m +"</li>";
        });
        html += "</ul></div>";
        $('#display-error').html(html);
        $('#display-error').removeClass('hide');
    }
}


// function to validade cpf

function validateCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g,'');
    if(cpf == '') return false;
    // Elimina CPFs invalidos conhecidos
    if (cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999")
        return false;
    // Valida 1o digito
    add = 0;
    for (i=0; i < 9; i ++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        return false;
    // Valida 2o digito
    add = 0;
    for (i = 0; i < 10; i ++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        return false;
    return true;
}

// function to validate email

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}