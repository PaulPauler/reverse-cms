$(document).ready(function(){
    $("#phone").mask("+7 (999) 999-9999");

    $('#contactsform').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/feedback',
            data: $('#contactsform').serialize(),
            success: function(result){
                  $.fancybox.open({
                  	src  : '#modal_'+result,
                  	type : 'inline'
                  });
            },
            error: function(jqXHR, exception) {
                var newData=JSON.parse(jqXHR.responseText);
                if(newData['errors']){
                  var arrErr = newData.errors;
                  Object.keys(arrErr).map(function(key) {
                    $('#senderror').css('display','none').append('<p>'+arrErr[key]+'</p>');
                  });
                }else{
                  $('#senderror').css('display','none').html('Unknown error. Try later.');
                }
            }
        });
    });
});

function checkParams() {
    var name = $('#name').val();
    var mail = $('#mail').val();
    var validatemail = (/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(mail));
    var phone = $('#phone').val();
    var message = $('#message').val();

    if(name.length != 0 &&  mail.length != 0 && phone.length == 17 && validatemail && message.length != 0) {
        $('#submit').removeAttr('disabled');
    } else {
        $('#submit').attr('disabled', 'disabled');
    }
}
