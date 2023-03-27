$( document ).ready(function() {
    //刪除欄位
    var info = 0;
    $('#table_member').on('click','.delet-btn',function(){
        // console.log('hi');
        if(confirm('是否確認刪除？')){
            $(this).closest('tr').remove();
        }
        return false;
    });

    // // EMOJI
    // $("#welcome").emojioneArea({
    //     pickerPosition: "bottom",
    //     filtersPosition: "bottom"
    // });
});