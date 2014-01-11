var quiz = typeof quiz === 'undefined' ? {} : quiz;

quiz.answer = (function () {

    var valid           = 0,
        invalid         = 0,
        reference       = 0
        ;

    function populate() {
        var data = JSON.parse($('#form_question_data').val());

        $('#form_question select[name=category_id]').val(data['category_id']);
        $('#form_question input[name=question]').val(data['question']);
        $('#form_question input[name=question_id]').val(data['question_id']);

        data['valid'].forEach(function(entry) {
            addValid(entry.value, entry.id);
        });
        data['invalid'].forEach(function(entry) {
            addInvalid(entry.value, entry.id);
        });
        data['reference'].forEach(function(entry) {
            addReference(entry.url, entry.id);
        });
    }

    function addValid(text, id) {
        text = typeof text !== 'undefined' ? text : '';
        id = typeof id !== 'undefined' ? id : '';

        var wrapper     = document.createElement('div');
        var div         = document.createElement('div');
        var input       = document.createElement('input');
        var hidden      = document.createElement('input');
        var spanAddon   = document.createElement('span');
        var span        = document.createElement('span');
        var br          = document.createElement('br');

        div.className       = 'answer input-group';

        input.className     = 'form-control';
        input.placeholder   = 'Answer';
        input.type          = 'text';
        input.name          = 'valid[' + valid + '][value]';
        input.value         = text;

        hidden.name         = 'valid[' + valid + '][id]';
        hidden.type         = 'hidden';
        hidden.value        = id;

        spanAddon.className = 'input-group-addon';

        span.className      = 'label label-success';
        span.innerHTML      = '&#10004;';

        spanAddon.appendChild(span);
        div.appendChild(spanAddon);
        div.appendChild(input);
        div.appendChild(hidden);
        wrapper.appendChild(div);
        wrapper.appendChild(br);
        
        
        var button = $("#answer-valid-add");
        button.before(wrapper);
        valid++;
    }

    function addInvalid(text, id) {
        text = typeof text !== 'undefined' ? text : '';
        id = typeof id !== 'undefined' ? id : '';

        var wrapper     = document.createElement('div');
        var div         = document.createElement('div');
        var input       = document.createElement('input');
        var hidden      = document.createElement('input');
        var spanAddon   = document.createElement('span');
        var span        = document.createElement('span');
        var br          = document.createElement('br');


        div.className       = 'answer input-group';

        input.className     = 'form-control';
        input.placeholder   = 'Answer';
        input.type          = 'text';
        input.name          = 'invalid[' + invalid + '][value]';
        input.value         = text;

        hidden.name         = 'invalid[' + invalid + '][id]';
        hidden.type         = 'hidden';
        hidden.value        = id;

        spanAddon.className = 'input-group-addon';

        span.className      = 'label label-danger';
        span.innerHTML      = 'x';

        div.appendChild(input);
        spanAddon.appendChild(span);
        div.appendChild(spanAddon);
        div.appendChild(hidden);
        wrapper.appendChild(div);
        wrapper.appendChild(br);
        
        
        var button = $("#answer-invalid-add");
        button.before(wrapper);
        invalid++;
    }

    function addReference(text, id) {
        text = typeof text !== 'undefined' ? text : '';
        id = typeof id !== 'undefined' ? id : '';

        var wrapper     = document.createElement('div');
        var div         = document.createElement('div');
        var input       = document.createElement('input');
        var hidden      = document.createElement('input');
        var spanAddon   = document.createElement('span');
        var span        = document.createElement('span');
        var br          = document.createElement('br');

        div.className       = 'input-group';

        input.className     = 'form-control';
        input.placeholder   = 'Url';
        input.type          = 'text';
        input.name          = 'reference[' + reference + '][url]';
        input.value         = text;

        hidden.name         = 'reference[' + reference + '][id]';
        hidden.type         = 'hidden';
        hidden.value        = id;

        spanAddon.className = 'input-group-addon';

        span.className      = 'label label-info';
        span.innerHTML      = 'link';

        spanAddon.appendChild(span);
        div.appendChild(spanAddon);
        div.appendChild(input);
        div.appendChild(hidden);
        wrapper.appendChild(div);
        wrapper.appendChild(br);
        
        
        var button = $("#answer-reference-add");
        button.before(wrapper);
        reference++;
    }

    function del() {
        console.log(this);
    }


    return { 
        "addValid": addValid,
        "addInvalid": addInvalid,
        "addReference": addReference,
        "del": del, 
        "populate": populate 
     };

}());

quiz.answer.populate();
