//регистрация класса Auth
var AuthFormCSS = BX.namespace('AuthFormCSS');

//вывод блока дополнительной информации для авторизации
AuthFormCSS.init = function(){
    var info = BX.message('AUTH_ADDITIONAL_CONTACT');
    let btnArea = BX.findChild(BX('login-popup'), {"attribute" : {"name" : "Login", "class" : "btn btn-primary"}, }, true);
    if(btnArea !== null){
        let additionalInf = BX.create('div', {
                attrs: {
                    className: 'block_additional_inf',
                    id: 'additionalInf_part1'
                },
                html: info
            });
            BX.insertAfter(additionalInf, btnArea);
        }
};
