$(window).load(function(){
    setSelect2();
    setTable();
});
function setSelect2(){
 $('.select2').each(function() {
     $(this).select2();
     console.log('select2 generated')
 });
}

function setTable(){
    $('.table').each(function() {
        $(this).DataTable();
        console.log('datatable generated')
    });
}