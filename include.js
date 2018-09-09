$(function () {
    let add=$('#add');

    add.on('click',function () {
        $.ajax({
            url:'summary.php?c=news&m=insert',
            data:{
                title:'',
                dsc:'',
                content:''
            },
            success:function (data) {
                if(data == 1){
                    location.reload()
                }else{
                    alert('error');
                }
            }
        })
    });

let remove=$('.remove');
remove.on('click',function () {
    let id=$(this).closest('tr').attr('data-id');
    $.ajax({
        url:'summary.php?c=news&m=delete&id='+id,
        success:function (data) {
            if(data==1){
                location.reload()
            }else{
                alert('error');
            }
        }
    })
})
let tbody=$('#tbody');
tbody.on('blur','.updat',function () {
    let type=$(this).closest('td').attr('data-td');
    let value=$(this).val();
    let id=$(this).closest('tr').attr('data-id');
    $.ajax({
        url:'summary.php?c=news&m=update',
        data:{
            k:type,
            v:value,
            id:id
        }
    })
})
});


