$( document ).ready(function() {
    //刪除欄位
    var info = 0;
    $('#table-member').on('click','.delet-btn',function(){
        // console.log('hi');
        confirm('是否確認刪除？')
        $(this).closest('tr').remove();
    });

    // EMOJI
    $("#welcome").emojioneArea({
        pickerPosition: "bottom",
        filtersPosition: "bottom"
    });
});