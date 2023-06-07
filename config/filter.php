<script>
    function load_product(category_data = 0, subcategory_data = 0, search = '') {
        $.ajax({
            type: "get",
            url: `page/product/data/list.php?category_id=${category_data}&subcategory_id=${subcategory_data}&search=${search}`,
            dataType: "html",
            success: function(response) {
                $('#list-product').children().remove();
                $('#list-product').append(response);
            }
        });
    }

    load_product();

    $(document).ready(function() {
        let category = [];
        let subcategory = [];

        $('#form_search').on('submit', function(event) {
            let search_input = $('#search_input').val();
            // let search = $('form_search :input[name="search_input"]');

            $('input:checkbox').prop('checked', false);

            load_product(0, 0, search_input);
            event.preventDefault();
        })

        $('input:checkbox').change(function(e) {
            $(this).each(function() {
                let search_input = $('#search_input').val();

                let price_id = $(this).attr("price_id");

                // if (price_id.length == 0) {
                //     console.log('tes');
                // }

                let category_id = $(this).attr("data-categoryId");
                let subcategory_id = $(this).attr("data-subcategoryId");

                // console.log(category_id, subcategory_id);

                if ($(this).is(':checked')) {
                    category.push(category_id);
                    subcategory.push(subcategory_id);
                } else {
                    let index_category = category.indexOf(category_id);
                    let index_subcategory = subcategory.indexOf(subcategory_id);
                    category.splice(index_category, 1);
                    subcategory.splice(index_subcategory, 1);
                }

                let category_data = 0
                if (category.length != 0) {
                    category_data = category.join()
                }
                let subcategory_data = 0
                if (subcategory.length != 0) {
                    subcategory_data = subcategory.join()
                }

                load_product(category_data, subcategory_data);

                // console.log(
                //     "category:", category,
                //     "\nsubcategory:", subcategory,
                //     "\ncategory_data:", category_data,
                //     "\nsubcategory_data:", subcategory_data
                // );
            });
        });

        // let category_filter_1 = $('#category-filter-1');

        // category_filter_1.change(function(e) {
        //     let val = category_filter_1.val();
        //     e.preventDefault();
        //     if (category_filter_1.is(':checked')) {
        //         console.log(val);
        //         // $('#article').html(val)
        //     } else {
        //         // $('#article').text('');
        //     }
        // });
    });
</script>