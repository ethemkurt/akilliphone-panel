$(function () {
    'use strict';

    var dt_product_table = $('.product-list-table'),
    dt_date_table = $('.date-list-table'),
    dt_complex_header_table = $('.complex-header-table'),
    dt_row_grouping_table = $('.row-grouping-table'),
    dt_multilingual_table = $('.multilingual-list-table'),
    assetPath = '../../../app-assets/';

    if ($('body').attr('data-framework') === 'laravel') {
        assetPath = $('body').attr('data-asset-path');
    }

    if (dt_product_table.length) {
        var dt_custom = dt_product_table.DataTable({
            ajax: assetPath + 'data/product-list.json',
            columns: [
                {
                    data: 'responsive_id'
                },
                {
                    data: 'id'
                },
                {
                    data
                }
            ]
        });
    }
})
