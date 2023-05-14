<script>
    function load_product(category_data = 0, subcategory_data = 0) {
        $.ajax({
            type: "get",
            url: `page/product/data/list.php?category_id=${category_data}&subcategory_id=${subcategory_data}`,
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

        $('input:checkbox').change(function(e) {
            $(this).each(function() {
                let category_id = $(this).attr("data-categoryId");
                let subcategory_id = $(this).attr("data-subcategoryId");

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

                // console.log(
                //     "category:", category,
                //     "\nsubcategory:", subcategory,
                //     "\ncategory_data:", category_data,
                //     "\nsubcategory_data:", subcategory_data
                // );

                load_product(category_data, subcategory_data);
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