<?php
$cartCollection = \Cart::getContent();
$total = \Cart::getTotal();
$cart_empty=\Cart::isEmpty();
?>

        @if($cart_empty)
            <li id="emptycart" class="w-100 text-center emptycart">
                <i class="fa fa-shopping-cart"></i>
                <h4>Your cart is empty</h4>
            </li>
            <li class="list_cart w-100"></li>
        @else
        <li class="list_cart w-100">
        <?php
        $items = Cart::getContent();

        foreach($items as $item)
        {
            $item->id; // the Id of the item
            $item->name; // the name
            $item->price; // the single price without conditions applied
            $item->getPriceSum(); // the subtotal without conditions applied
            $item->getPriceWithConditions(); // the single price with conditions applied
            $item->getPriceSumWithConditions(); // the subtotal with conditions applied
            $item->quantity; // the quantity
            $item->attributes; // the attributes

            // Note that attribute returns ItemAttributeCollection object that extends the native laravel collection
            // so you can do things like below:
?>
            <div class="clearfix cart_item_<?=$item->id?>">
                <span class="item-image"><a href="{{URL_VIEW_LMS_CONTENTS.$item->attributes->slug}}"><img  width="60" class="" src="{{IMAGE_PATH_UPLOAD_LMS_SERIES_THUMB.$item->attributes->image}}" alt="item1" /></a></span>
                <span class="item-name"><a href="{{URL_VIEW_LMS_CONTENTS.$item->attributes->slug}}"><?=$item->name?> x <?=$item->quantity?></a></span>
{{--                <span class="item-price">{!! getCurrencyCode() . parsePrice(Select_Courses_On_ID($item->id)->cost *$item->quantity) !!}</span>--}}
                <span class="item-price">{!! getCurrencyCode() . parsePrice($item->price) !!}</span>
                <span
                        data-course-id="{{$item->id}}"
                        data-course-name="{{addslashes($item->title)}}"
                        data-course-price="{{parsePrice(Select_Courses_On_ID($item->id)->cost)}}"
                        data-quantity="1"
                        data-image="{{$item->image}}"
                        onclick="removeToCart({{$item->id}})" class="item-remove"><i class="fa fa-trash"></i></span>
            </div>
            <?php
                if( $item->attributes->has('size') )
                {
                    // item has attribute size
                }
                else
                {
                    // item has no attribute size
                }
                }
            ?>
        </li>
        @endif
        <li class="lst_child">
            <span class="ordertotal">Cart Subtotal: {!! getCurrencyCode() !!}<span class="cart_total"><?php echo parsePrice($total); ?></span></span>
            <span class="cartbtn"><a href="<?=url('/cart')?>" class="button">Review Cart & Checkout</a></span>
        </li>

<div class="shopping-cart-header d-none">
    <i class="fa fa-shopping-cart cart-icon d-none"></i><span class="badge cart_count"><?=$cartCollection->count();?></span>
    <div class="shopping-cart-total d-none">
        <span class="lighter-text">Cart Subtotal:</span>
        <span class="main-color-text cart_total">{!! getCurrencyCode() . parsePrice($total) !!}</span>
    </div>
</div>
<!--end shopping-cart-header -->



