$(function () {
    $(document).on('click','.notification',function () {
        var lang = $(this).attr('id');
        //alert('you clicked me:' + lang);
        $.post('index.php?r=site/see',{'lang':lang},function (data) {
            location.reload();
        });
    });

    $(document).on('click','.close',function () {
        var id = $(this).attr('id');
        //alert('you clicked me:' + id);
        $.post('index.php?r=site/erase',{'id':id},function (data) {

        });
    });

});
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}