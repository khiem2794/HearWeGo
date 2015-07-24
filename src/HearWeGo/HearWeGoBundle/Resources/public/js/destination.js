/**
 * Created by nthhtn on 21/07/2015.
 */
$(function()
{
    $("#area img").click(function()
    {
        var theid=$(this).attr('id');
        var sub=theid.substr(4,1);
        $("nav").each(function()
        {
            var num=$(this).attr('id').substr(5,1);
            if (sub!=num)
                $(this).hide();
        });
        $("#city #place"+sub).toggle();
    });
});