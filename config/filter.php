<script>
    function loadProductList(category_data = 0, subcategory_data = 0, search = '', min_price = 0, max_price = 0, manifacturer_id = 0) {
        $.ajax({
            type: 'get',
            url: `page/product/display/list.php?category_id=${category_data}&subcategory_id=${subcategory_data}&search=${search}&min_price=${min_price}&max_price=${max_price}&manifacturer_id=${manifacturer_id}`,
            dataType: 'html',
            success: function(response) {
                $('#display-product-list').children().remove();
                $('#display-product-list').append(response);
            }
        });
    }

    function loadProductGrid(category_data = 0, subcategory_data = 0, search = '', min_price = 0, max_price = 0, manifacturer_id = 0) {
        $.ajax({
            type: 'get',
            url: `page/product/display/grid.php?category_id=${category_data}&subcategory_id=${subcategory_data}&search=${search}&min_price=${min_price}&max_price=${max_price}&manifacturer_id=${manifacturer_id}`,
            dataType: 'html',
            success: function(response) {
                $('#display-product-grid').children().remove();
                $('#display-product-grid').append(response);
            }
        });
    }

    function checkCategory() {
        let category = [];
        let subcategory = [];

        $('.category-group').each(function() {
            $(this).find('input:checkbox').each(function() {
                let categoryId = $(this).attr('data-categoryId');
                let subcategoryId = $(this).attr('data-subcategoryId');

                if ($(this).is(':checked')) {
                    category.push(categoryId);
                    subcategory.push(subcategoryId);
                }
            });
        });

        return [category, subcategory];
    }

    function checkManifacturer() {
        let manifacturer = [];

        $('.manifacturer-group').each(function() {
            $(this).find('input:checkbox').each(function() {
                let manifacturerId = $(this).attr('data-manifacturer');

                if ($(this).is(':checked')) {
                    manifacturer.push(manifacturerId);
                }
            });
        });

        return [manifacturer];
    }

    function resetFilter(search) {
        if ('<?= $view ?>' == 'list') {
            loadProductList(0, 0, search, 0, 0, 0);
        } else if ('<?= $view ?>' == 'grid') {
            loadProductGrid(0, 0, search, 0, 0, 0);
        }

        $('input:checkbox').prop('checked', false);
    }





    $(document).ready(function() {
        if ('<?= $view ?>' == 'list') {
            loadProductList();
        } else if ('<?= $view ?>' == 'grid') {
            loadProductGrid();
        }
        $('#form_search').on('submit', function(event) {
            let search_input = $('#search_input').val();
            resetFilter(search_input);
          
            event.preventDefault();
        })

        $('.price-check').click(function() {
            $('.price-check').not(this).prop('checked', false);
        })

        $('.category-checkbox').click(function() {
            if ($(this).is(':checked')) {
                $(this).parent().find('.subcategory-checkbox').prop('checked', true);
            } else {
                $(this).parent().find('.subcategory-checkbox').prop('checked', false);
            }
        })

        $('.subcategory-checkbox').click(function() {
            if ($(this).is(':checked')) {
                $(this).parents('.category-group').find('.category-checkbox').prop('checked', true);
            } else {
                $(this).parents('.category-group').find('.category-checkbox').prop('checked', false);
            }
        })
    })

    $('input:checkbox').change(function() {
        let minPrice, maxPrice;
        let categoryData = (checkCategory()[0].length > 0) ? checkCategory()[0] : 0;
        let subcategoryData = (checkCategory()[1].length > 0) ? checkCategory()[1] : 0;

        if ($('.price-check').is(':checked')) {
            minPrice = $(this).attr('data-min-price');
            maxPrice = $(this).attr('data-max-price');
        } else {
            minPrice = 0;
            maxPrice = 0;
        }

        let manifacturerData = (checkManifacturer()[0].length > 0) ? checkManifacturer()[0] : 0;

        if ('<?= $view ?>' == 'list') {
            loadProductList(categoryData, subcategoryData, '', minPrice, maxPrice, manifacturerData);
        } else if ('<?= $view ?>' == 'grid') {
            loadProductGrid(categoryData, subcategoryData, '', minPrice, maxPrice, manifacturerData);
        }
    });
</script>