function base_url(uri) {
    return BASE_URL + uri;
}
$(function() {
    $(document).on("change", "#state", function() {
        let id = $('#state').val();
        let state = {
            url: base_url('/admin/settings/city/getCities'),
            data: {
                'id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            method: 'post',
            dataType: 'json',
            success: function(res) {
                if (res.status == 1) {
                    let option = '';
                    res.data.map(function(key) {
                        option += `<option value='${key.city_id}'>${key.city_name}</option>`
                    });
                    $('#citie').html(`<option value='' >Select city</option>
                    ${option}
               </select>`);
                }
            }
        }
        $.ajax(state);
    })



    $(".tst4").on("click", function() {
        $.toast({
            heading: 'Welcome to my Deposito Admin',
            text: 'Use the predefined ones, or specify a custom position object.',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500

        });

    });

    $(document).on("change", "#edit-state", function() {
        let id = $(this).val();
        let state = {
            url: base_url('/admin/settings/city/getCities'),
            data: {
                'id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            method: 'post',
            dataType: 'json',
            success: function(res) {
                if (res.status == 1) {
                    let option = '';
                    res.data.map(function(key) {
                        option += `<option value='${key.city_id}'>${key.city_name}</option>`
                    });
                    $('#edit-city').html(`<option value='' >Select city</option>
                    ${option}
               </select>`);
                }
            }
        }
        $.ajax(state);
    })

})