(function(){
    function CustomValidation(input){
        input.setCustomValidity('');
        
        if(input.validity.valueMissing)
            return 'Поле ' + $(input).attr('placeholder') + ' не заполнено;';
        
        if(input.validity.typeMismatch || input.validity.patternMismatch)
            return 'Проверьте правильность поля ' + $(input).attr('placeholder') + ';'; 
        return "";
    }
    var inputs = $('.proposal input:not([type=submit])');
    $('#proposal_submit').click(function(e){
        e.preventDefault();
        
        var errorStr = '';
        
        for(var i = 0; i< inputs.length; i++){
            console.log(inputs[i].validity);
            if( !inputs[i].validity.valid ){
                errorStr += CustomValidation(inputs[i]) + ' ';
            }
        }
        
        var textBox = $('.proposal__status');
        if(errorStr === ''){
            textBox.append('<img src="img/noun-97204-cc.png"/>');
            //ajax
        } else {
            textBox.text(errorStr);
        }
    });
    
    inputs.click(function(e){
        var id = e.currentTarget.id;
        var label = $('label[for='+id+']');
        label.css({visibility:'visible'});
    });
    inputs.blur(function(e){
        var id = e.currentTarget.id;
        var label = $('label[for='+id+']');
        if($(e.currentTarget).val() === '')
            label.css('visibility', 'hidden');
    });
    
})();