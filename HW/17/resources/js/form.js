check = function check(e) 
{
    if (e.value === 'after') {
        $('#date').removeClass('hidden');
    }else{
        $('#date').addClass('hidden');
        $('#input-date').val($('#replace').val());
    }
}