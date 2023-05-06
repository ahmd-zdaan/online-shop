<script>
    $(document).ready(function() {
        let subcategory = [];

        $('input:checkbox').change(function(e) {
            $(this).each(function() {
                let category_id = $(this).attr("data-categoryId");
                let subcategory_id = $(this).attr("data-subcategoryId");

                if ($(this).is(':checked')) {
                    subcategory.push(subcategory_id);
                } else {
                    let index = subcategory.indexOf(subcategory_id);
                    subcategory.splice(index, 1);
                }

                let subcategory_data = 0
                if (subcategory.length != 0) {
                    subcategory_data = subcategory.join()
                }

                $.ajax({
                    type: "get",
                    url: "page/product/data/list.php?category_id=" + category_id + "&subcategory_id=" + subcategory_data,
                    dataType: "html",
                    success: function(response) {
                        $('#list-product').children().remove();
                        $('#list-product').append(response);
                    }
                });
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