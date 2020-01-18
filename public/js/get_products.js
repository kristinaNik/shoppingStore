$(document).ready(function () {

    fetch_customer_data();
    function fetch_customer_data(query) {
        $.ajax({
            url: "search",
            method: 'GET',
            data: {query: query},
            dataType: 'json',
            success: function (data) {

                var trHTML = '';

                $.each(data, function (i, item) {
                    $.each(item, function (j, product_data) {

                        trHTML += '<div class="col-sm-6 col-md-4"><div class="thumbnail">' +

                            '<img src="storage/images/' + product_data.image + '"class="img-thumbnail">' +

                            '<div class="caption">' +
                            '<a href="/' + product_data.id + '">' +
                            '<h3>' + product_data.title + '</h3>' +
                            '</a>' +
                            '<p class="description">' +
                            product_data.description +
                            '</p>' +
                            '<div class="clearfix">' +
                            '<div class="pull-left price">' + product_data.price + '</div>' +
                            '<a href="add-to-cart/' + product_data.id + '" class="btn btn-success pull-right" role="button"> Add Cart</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    });

                });

                $('.row').html(trHTML);
            }
        });
    }

    window.addEventListener('load', function () {
        $('#search_products').on('click', function (e) {
            e.preventDefault();
            var query = $('#search').val();
            fetch_customer_data(query);

        });

    });
});
