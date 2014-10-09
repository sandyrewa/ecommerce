/*---custom script file wich is used in all system----*/
$(function() {
    // base url
    var baseUrl = $("#base-url").val();
    // for data category data table
    $('#dt-category').dataTable( {
       //"sDom": "<'row'<'span6'<'dt_actions'>l><'span6'<'custom_buttons'>f>r>t<'row'<'span6'i><'span6'p>>",
        "sPaginationType": "bootstrap",
        "bProcessing": true,
        "bServerSide": true,
        "bDestroy": true, 
        "sAjaxSource": baseUrl+"admin/get_category_list_for_data_table",
        "aaSorting": [[ 0, "asc" ]],
        "aoColumns": [
            //{ "mData":"allcheck", "bSortable":false },
            { "mData": "id" },
            { "mData": "name" },
            { "mData": "createdDate" },
            { "mData": "status" },
            { "bSortable": false, "mData": "actions" }
        ],
        "fnDrawCallback": function( oSettings ) {
            deleteCategory();
            checkAll();
        }
    } );
    //$('.dt_actions').html($('.user_actions').html());
    // select all and deselect all in category
    // add multiple select / deselect functionality
    function checkAll()
    {
        $("#selectall").on('click',function () {
              $('.case').attr('checked', this.checked);
        });
     
        // if all checkbox are selected, check the selectall checkbox
        // and viceversa
        $('.case').on('click', function(){
     
            if($(".case").length == $(".case:checked").length) {
                $("#selectall").attr("checked", "checked");
            } else {
                $("#selectall").removeAttr("checked");
            }
     
        });
    }
    
    // delete category
    function deleteCategory()
    {
        $('.delete-category').on('click', function(){
            var catId = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: baseUrl+"admin/delete_category",
                dataType: "json",
                data: "cat_id="+catId,
                success: function(response){
                    alert(response);
                    $('#'+catId).closest("tr").fadeOut();
                   
                },
                error: function(response){
                    alert(response);
                }
            });
        });
    }
    

    // start code here for product listing using jquery data table
    
    $('#dt-product-list').dataTable( {
       //"sDom": "<'row'<'span6'<'dt_actions'>l><'span6'<'custom_buttons'>f>r>t<'row'<'span6'i><'span6'p>>",
        "sPaginationType": "bootstrap",
        "bProcessing": true,
        "bServerSide": true,
        "bDestroy": true, 
        "sAjaxSource": baseUrl+"admin/get_product_list_for_data_table",
        "aaSorting": [[ 0, "asc" ]],
        "aoColumns": [
            //{ "mData":"allcheck", "bSortable":false },
            { "mData": "id" },
            { "mData": "product" },
            { "mData": "category" },
            { "mData": "price" },
            { "mData": "quantity" },
            { "mData": "createdDate" },
            { "mData": "status" },
            { "bSortable": false, "mData": "actions" }
        ],
        "fnDrawCallback": function( oSettings ) {
            deleteProduct();
        }
    });

    // delete products
    function deleteProduct(){
        $('.delete-product').on("click", function(e){
            //alert('product');
            e.preventDefault();
            var pid = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: baseUrl+"admin/delete_product",
                dataType: "json",
                data: "product_id="+pid,
                success: function(response){
                    alert(response);
                    //var $this = $(this);
                    $('#'+pid).closest("tr").fadeOut();
                    //$('#'+pid).closest("tr").remove();
                   
                },
                error: function(response){
                    alert(response);
                }
            });
        });
    }
    
});
