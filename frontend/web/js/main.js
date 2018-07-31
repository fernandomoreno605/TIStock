$(function () {
    $(document).on('click','.language',function () {
        var lang = $(this).attr('id');
        //alert('you clicked me:' + lang);
        $.post('index.php?r=site/language',{'lang':lang},function (data) {
            location.reload();
        });
    });
    $(document).on('click','.hotel',function () {
        var h = $(this).attr('id');
        $.post('index.php?r=site/change',{'h':h},function (data) {
            location.reload();
        });
    });
    $(document).on('click','.view',function () {
        var h = $(this).attr('id');
        var d1 = 'div-list';
        var d2 = 'div-grid';
        if (h == 1){
            document.getElementById(h).style.display = 'none';
            document.getElementById(2).style.display = 'block';

            document.getElementById(d1).style.display = 'block';
            document.getElementById(d2).style.display = 'none';
        }else if (h == 2){
            document.getElementById(h).style.display = 'none';
            document.getElementById(1).style.display = 'block';
            document.getElementById(d1).style.display = 'none';
            document.getElementById(d2).style.display = 'block';
        }
    });
    $(document).on('click','.notification',function () {
        var lang = $(this).attr('id');
        //alert('you clicked me:' + lang);
        $.post('index.php?r=site/see',{'lang':lang},function (data) {

        });
    });

    $(document).on('click','.close',function () {
        var id = $(this).attr('id');
        //alert('you clicked me:' + id);
        $.post('index.php?r=site/erase',{'id':id},function (data) {

        });
    });
});
