Service = function (e) {
    let _token = $("input[name=_token]").val();
    $.ajax({
        url: "/user/Services",
        type: "POST",
        data: {
            name: $('#name').val(),
            time: $('#time').val(),
            price: $('#price').val(),
            _token: _token,
        },
        success: function(response) {

            if (response['error']['name'] != null) {
                $('#name_error').text(response['error']['name']);
                $('#name_error').removeClass('hidden');
            } else {
                $('#name_error').addClass('hidden');
            }
            if (response['error']['time'] != null) {
                $('#time_error').text(response['error']['time']);
                $('#time_error').removeClass('hidden');
            } else {
                $('#time_error').addClass('hidden');
            }
            if (response['error']['price'] != null) {
                $('#price_error').text(response['error']['price']);
                $('#price_error').removeClass('hidden');
            } else {
                $('#price_error').addClass('hidden');
            }

            if (response['success'] != null) {
                $('#ex1').modal('hide');
                location.reload();
            }
        }
    });
}


ServiceEdit = function (e) {
    let _token = $("input[name=_token]").val();
    $.ajax({
        url: "/user/" + e.value + "/updateService",
        type: "PUT",
        data: {
            name: $('#name_' + e.value).val(),
            time: $('#time_' + e.value).val(),
            price: $('#price_' + e.value).val(),
            service_id: e.value,
            _token: _token,
        },
        success: function(response) {

            if (response['error']['name'] != null) {
                $('#name_error' + e.value).text(response['error']['name']);
                $('#name_error' + e.value).removeClass('hidden');
            } else {
                $('#name_error' + e.value).addClass('hidden');
            }
            if (response['error']['time'] != null) {
                $('#time_error' + e.value).text(response['error']['time']);
                $('#time_error' + e.value).removeClass('hidden');
            } else {
                $('#time_error' + e.value).addClass('hidden');
            }
            if (response['error']['price'] != null) {
                $('#price_error' + e.value).text(response['error']['price']);
                $('#price_error' + e.value).removeClass('hidden');
            } else {
                $('#price_error' + e.value).addClass('hidden');
            }

            if (response['success'] != null) {
                $('#'+e.value).modal('hide');
                location.reload();
            }
        }
    });
}

deleteService = function (e) {
    let _token = $("input[name=_token]").val();
    $.ajax({
        url: "/user/" + e.value + "/deleteService",
        type: "DELETE",
        data: {
            service_id: e.value,
            _token: _token,
        },
        success: function(response) {

            if (response['success'] != null) {
                $('#' + e.value + 'delete').modal('hide');
                location.reload();
            }
        }
    });
}