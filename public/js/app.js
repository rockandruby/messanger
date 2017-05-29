$(function () {

    var password_length = 3,
        text_length = 2,
        RULES = {
        errors: {},
        email: function (field_name, value) {
            var re = /\S+@\S+\.\S+/;
            if(!re.test(value)){
                this.errors[field_name] = 'not valid'
            }
        },
        text: function (field_name, value, length) {
            if(value.length < length){
                this.errors[field_name] = 'must contain at least ' + length + ' symbols'
            }
        },
        password_confirm: function (field_name, value) {
            var password_confirmation = $('#password_confirmation').val();
            if(value.length < password_length || value != password_confirmation){
                this.errors[field_name] = 'must contain at least '+ password_length +' symbols and correspond to password confirmation'
            }
        }
    };

    function validator(form) {
        var data = $(form).find('.validate');

        $.each(data,function (i, v) {
            var obj = $(v);
            RULES[obj.data('rule')](obj.attr('name'), obj.val(), obj.data('length') || text_length);
        })
    }

    $(document).ready(function () {

        $('form').submit(function (e) {
            RULES.errors = {};
            validator(this);
            if(!$.isEmptyObject(RULES.errors)){
                e.preventDefault();
                var error_block = $('.validation_errors');
                error_block.show().html('');
                $.each(RULES.errors, function (i, v) {
                    error_block.append('<div>'+ i.toUpperCase() + ' '+ v + '</div>')
                })
            }
        });
        
        $('.send_message').submit(function (e) {
            e.preventDefault();
            $.ajax('/user/message/' + $('#dialog').data('dialog-id'),{
                data: { text: $('#message').val() },
                method: 'POST',
                success: function (res) {
                    $('#dialog').append(res);
                    $('#message').val('')
                },
                error: function (e) {
                    console.log(e.responseText)
                }
            })
        });

        $('.glyphicon-remove').on('click',function (e) {
            var answer = confirm('Are\'re you sure to remove user?');
            if(!answer){ e.preventDefault() }
        });

        if($('#dialog')){
            (function getNewMessages() {
                $.ajax('/user/dialog/' + $('#dialog').data('dialog-id'),{
                    dataType: 'html',
                    success: function (res) {
                        $('#dialog').append(res);
                        setTimeout(getNewMessages, 2000)
                    },
                    error: function (e) {
                      console.log(e.responseText)
                    }
                })
            })()
        }

    });

});
