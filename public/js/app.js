$(function(){
    $('#camera_wrap').camera({
        thumbnails: true,
        height: '100%',
        portrait: true,
        loader: 'none'
    });
});

function updCart(data){
    var qty = +data.qty,
        cost = +data.total,
        text;
    $('#cost').replaceWith( '<td id="cost">' + cost + " грн.</td>" );

    switch (qty){
        case 0: text = "В корзине<br>товаров нет";
            break;
        case 1: text = "В корзине 1 товар <br> на сумму " + cost + " грн.";
            break;
        case 2:
        case 3:
        case 4: text = "В корзине " + qty + " товара <br> на сумму " + cost + " грн.";
            break;
        default: text = "В корзине " + qty + " товаров <br> на сумму " + cost + " грн.";
    }
    $( "div[class='media-body cart']" ).replaceWith('<div class="media-body cart">'+text+'</div>');
}