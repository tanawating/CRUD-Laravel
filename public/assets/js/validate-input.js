// created by => tanawat.info
// form source code => https://github.com/tanawating

function reset_input()
{
    $('#prefix').removeClass('input-success');
    $('#sex').removeClass('input-success');
    $('#firstname').removeClass('input-success');
    $('#lastname').removeClass('input-success');
    $('#email').removeClass('input-success');
    $('#phonenumber').removeClass('input-success');

    $('#prefix').removeClass('input-error');
    $('#sex').removeClass('input-error');
    $('#firstname').removeClass('input-error');
    $('#lastname').removeClass('input-error');

    $('#prefix').val('');
    $('#sex').val('');
    $('#firstname').val('');
    $('#lastname').val('');
    $('#email').val('');
    $('#phonenumber').val('');
}

function validate(prefix,sex,firstname,lastname)
{
    var check_validate = true;

    if(prefix == '') 
    {
        $('#prefix').addClass('input-error')
        var check_validate = false;
    }
    if(sex  == '') 
    {
        $('#sex').addClass('input-error')
        var check_validate = false;
    }
    if(firstname == '') 
    {
        $('#firstname').addClass('input-error')
        var check_validate = false;
    }
    if(lastname == '') 
    {
        $('#lastname').addClass('input-error')
        var check_validate = false;
    }

    return check_validate;
}

$('#prefix').change(function()
{
    if($('#prefix').val() == '')
    {
        $('#prefix').addClass('input-error');
        $('#prefix').removeClass('input-success');
    }
    else
    {
        $('#prefix').addClass('input-success');
        $('#prefix').removeClass('input-error');
    }
});

$('#sex').change(function()
{
    if($('#sex').val() == '')
    {
        $('#sex').addClass('input-error');
        $('#sex').removeClass('input-success');
    }
    else
    {
        $('#sex').addClass('input-success');
        $('#sex').removeClass('input-error');
    }
});

$('#firstname').change(function()
{
    if($('#firstname').val() == '')
    {
        $('#firstname').addClass('input-error');
        $('#firstname').removeClass('input-success');
    }
    else
    {
        $('#firstname').addClass('input-success');
        $('#firstname').removeClass('input-error');
    }
});

$('#lastname').change(function()
{
    if($('#lastname').val() == '')
    {
        $('#lastname').addClass('input-error');
        $('#lastname').removeClass('input-success');
    }
    else
    {
        $('#lastname').addClass('input-success');
        $('#lastname').removeClass('input-error');
    }
});

$('#email').change(function()
{
    if($('#email').val() == '')
    {
        $('#email').removeClass('input-success');
    }
    else
    {
        $('#email').addClass('input-success');
    }
});

$('#phonenumber').change(function()
{
    if($('#phonenumber').val() == '')
    {
        $('#phonenumber').removeClass('input-success');
    }
    else
    {
        $('#phonenumber').addClass('input-success');
    }
});