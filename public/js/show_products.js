window.addEventListener('load', function () {

    var pathname = window.location.pathname.split("/");
    var id = pathname[pathname.length-1];

    $.ajax({
        type: 'GET',
        url: "api/products/" + id,
        success: function (data) {
            var trHTML = '';
            $.each(data, function (i, item) {
                console.log(item.id);
                trHTML += '<div class="col-sm-6 col-md-4"><div class="thumbnail"><img src="storage/images/'+ item.image + '"class="img-thumbnail">' +
                        '<div class="caption">' +
                        '<h3>'+ item.title + '</h3>' +
                        '<p class="description">' +
                    item.description +
                        '</p>' +
                        '<div class="clearfix">'+
                        '<div class="pull-left price">' + item.price + '</div>' +
                        '<a href="add-to-cart/' + item.id +'" class="btn btn-success pull-right" role="button"> Add Cart</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';


            });

            $('.row').append(trHTML);
        }
    });
    function GetURLParameter(sParam){

        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
            {
                return sParameterName[1];
            }
        }

    }



});
