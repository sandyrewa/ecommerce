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
        "aaSorting": [[ 1, "asc" ]],
        "aoColumns": [
            { "mData":"allcheck", "bSortable":false },
            { "mData": "name" },
            { "mData": "createdDate" },
            { "mData": "status" },
            { "bSortable": false, "mData": "actions" }
        ]
    } );
    //$('.dt_actions').html($('.user_actions').html());
    // select all and deselect all in category
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(document).on('click', ".case", function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
    // delete category
    $(document).on('click','a.delete-category',  function(){
        var catId = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: baseUrl+"admin/delete_category",
            dataType: "json",
            data: "cat_id="+catId,
            success: function(response){
                alert(response);
                var $this = $(this);
                $(this).closest("tr").hide();
               
            },
            error: function(response){
                alert(response);
            }
        });
    });
});
