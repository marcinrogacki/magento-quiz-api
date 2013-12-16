var quiz = typeof quiz === 'undefined' ? {} : quiz;

quiz.answer = (function () {

    var valid           = 0,
        invalid         = 0
        ;

    function addValid() {

        var wrapper     = document.createElement('div');
        var div         = document.createElement('div');
        var input       = document.createElement('input');
        var spanAddon   = document.createElement('span');
        var span        = document.createElement('span');
        var br          = document.createElement('br');

        div.className       = 'answer input-group';

        input.className     = 'form-control';
        input.placeholder   = 'Answer';
        input.type          = 'text';
        input.name          = 'valid[' + valid + '][value]';

        spanAddon.className = 'input-group-addon';

        span.className      = 'label label-success';
        span.innerHTML      = '&#10004;';

        div.appendChild(input);
        spanAddon.appendChild(span);
        div.appendChild(spanAddon);
        wrapper.appendChild(div);
        wrapper.appendChild(br);
        
        
        var button = $("#answer-valid-add");
        button.before(wrapper);
        valid++;
    }

    function addInvalid() {

        var wrapper     = document.createElement('div');
        var div         = document.createElement('div');
        var input       = document.createElement('input');
        var spanAddon   = document.createElement('span');
        var span        = document.createElement('span');
        var br          = document.createElement('br');


        div.className       = 'answer input-group';

        input.className     = 'form-control';
        input.placeholder   = 'Answer';
        input.type          = 'text';
        input.name          = 'invalid[' + invalid + '][value]';

        spanAddon.className = 'input-group-addon';

        span.className      = 'label label-danger';
        span.innerHTML      = 'x';

        div.appendChild(input);
        spanAddon.appendChild(span);
        div.appendChild(spanAddon);
        wrapper.appendChild(div);
        wrapper.appendChild(br);
        
        
        var button = $("#answer-invalid-add");
        button.before(wrapper);
        invalid++;
    }

    return { 
        "addValid": addValid,
        "addInvalid": addInvalid
     };

}());
