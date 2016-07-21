function getContent(timestamp)
{
    var queryString = {'timestamp':timestamp };
    $.get ('connect.php',queryString,function (data)
    {
        var obj = jQuery.parseJSON( data );

        for (var k in obj)
        {
            var comment = "<p>" + obj[k].comment + "</p>";
            var timestamp = obj[k].timestamp;
            $( '#response' ).append(comment);
        }

        // reconecta ao receber uma resposta do servidor
        getContent( timestamp );
    });
}

$( document ).ready( function ()
{
    getContent();
});
