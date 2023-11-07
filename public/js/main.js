$('body').on('click','.add-to-cart-link',function (e) {
    e.preventDefault();
    console.log('1111');
    var id=$(this).data('id'),
        qty=$('.quantity input').val() ? $('.quantity input').val(): 1,
        mod=$('.available select').val();
    console.log(id,qty,mod);


});












$('#currency').change(function(){
    window.location = 'currency/change?curr=' + $(this).val();
});
$(".available select").change(function () {
    var modId=$(this).val();
    var color=$(this).find('option').filter(':selected').data('title');
    var price=$(this).find('option').filter(':selected').data('price');
    var baseprice=$('#base-price').data('base');
    if(price){
        $('#base-price').text(symbol_left + price + symbol_right);
    }
    else{
        $('#base-price').text(symbol_left + baseprice + symbol_right);
    }
        //    var color=$(this).find("option :selected").data('title');
console.log(modId+' '+color+' '+price);
});