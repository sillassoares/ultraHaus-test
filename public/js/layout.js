var maskPhone = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    maskOption = {
        onKeyPress: function(val, e, field, options) {
            field.mask(maskPhone.apply({}, arguments), options);
        },
        clearIfNotMatch: true
    };

$('.phone').mask(maskPhone, maskOption);
$('.cpf').mask('000.000.000-00', {reverse: true, clearIfNotMatch: true});