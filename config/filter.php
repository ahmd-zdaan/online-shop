<script>
    function load_product(category_data = 0, subcategory_data = 0, search = '', min_price = 0, max_price = 0) {
        $.ajax({
            type: 'get',
            url: `page/product/data/display.php?category_id=${category_data}&subcategory_id=${subcategory_data}&search=${search}&min_price=${min_price}&max_price=${max_price}`,
            dataType: 'html',
            success: function(response) {
                $('#list-product').children().remove();
                $('#list-product').append(response);
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

    $(document).ready(function() {
        load_product();

        let minPrice, maxPrice;

        $('#form_search').on('submit', function(event) {
            let search_input = $('#search_input').val();
            $('input:checkbox').prop('checked', false);

            load_product(0, 0, search_input, 0, 0);
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
        let categoryData = (checkCategory()[0].length > 0) ? checkCategory()[0] : 0;
        let subcategoryData = (checkCategory()[1].length > 0) ? checkCategory()[1] : 0;

        if ($('.price-check').is(':checked')) {
            minPrice = $(this).attr('data-min-price');
            maxPrice = $(this).attr('data-max-price');
        } else {
            minPrice = 0;
            maxPrice = 0;
        }
        console.log(subcategoryData);
        load_product(categoryData, subcategoryData, '', minPrice, maxPrice);
    });
</script>