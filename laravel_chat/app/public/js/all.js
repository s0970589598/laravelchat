$( document ).ready(function() {
    //刪除欄位
    $('#table_member').on('click','.delet-btn',function(){
        // console.log('hi');
        let id = $(this).closest('tr').data();
        if(confirm('是否確認刪除？')){
            $(this).closest('tr').removeData(id);
        }
        return false;
    });

    // // EMOJI
    // $("#welcome").emojioneArea({
    //     pickerPosition: "bottom",
    //     filtersPosition: "bottom"
    // });
});