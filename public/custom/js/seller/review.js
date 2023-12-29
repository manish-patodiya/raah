$(function() {

    $("#review_tbl").DataTable({
        ajax: {
            url: base_url("/seller/review/datatable_json"),
            dataSrc: 'details',
        },
        columns: [
            { data: 0, "orderData": 0 },
            { data: 1 },
            { data: 2 },
            { data: 3 },
            { data: 4 },
        ],
        "columnDefs": [{
            'targets': [4],
            'orderable': false,
            'class': 'text-end'
        }]
    })
})