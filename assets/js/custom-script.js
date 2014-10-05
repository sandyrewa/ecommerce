/*---custom script file wich is used in all system----*/
$(function() {
    // for data category data table
    $('#category').dataTable( {
       "sDom": "<'row'<'span6'<'dt_actions'>l><'span6'<'custom_buttons'>f>r>t<'row'<'span6'i><'span6'p>>",
        "sPaginationType": "bootstrap",
        "bProcessing": true,
        "bServerSide": true,
        "bDestroy": true, 
        "sAjaxSource": "admin/get_category_list_for_data_table",
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
    $(".case").live('click',function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
});
