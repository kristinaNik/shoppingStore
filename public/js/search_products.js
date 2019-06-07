window.addEventListener('load', function () {
    var pathname = window.location.pathname.split("/search");
    var value = pathname[pathname.length-1];


    $.ajax({
        type: 'GET',
        url: "api/products?search=" + value,
        success: function (data) {
            var trHTML = '';
            var search = GetURLParameter('search');

            $.each(data, function (i, item) {
                $.each(item, function (j, product_data) {

                    trHTML += '<div class="col-sm-6 col-md-4"><div class="thumbnail">' +

                        '<img src="storage/images/'+ product_data.image + '"class="img-thumbnail">' +

                        '<div class="caption">' +
                        '<a href="/' + product_data.id + '">' +
                        '<h3>'+ product_data.title + '</h3>' +
                        '</a>' +
                        '<p class="description">' +
                        product_data.description +
                        '</p>' +
                        '<div class="clearfix">'+
                        '<div class="pull-left price">' + product_data.price + '</div>' +
                        '<a href="add-to-cart/' + product_data.id +'" class="btn btn-success pull-right" role="button"> Add Cart</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                });

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
