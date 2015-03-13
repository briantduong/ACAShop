$(document).ready(function(){

    // Bind to the continue shopping button
    $("#btn-continue-shopping").click(function(){
       window.location.href = '/products';
    });

    // bind to the checkout button
    $("#btn-checkout").click(function(){
        window.location.href = '/process_order';
    });

    // bind to the cart button
    $("#btn-cart").click(function(){
        window.location.href = '/cart';
    });

    // bind to the cart button
    $("#btn-process-action").click(function(){
        $("#shipping-form").submit();
    });

});