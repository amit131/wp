<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();
?>
<!-- OrderProcess -->
<ul class="order-process">
	<?php WC()->cart->get_cart_url();?>
    <li><a href="javascript:void(0)">STEP 1</li>
    <li class="active"><a href="javascript:void(0)">STEP 2</li>
    <li>STEP 3</li>
	<li>STEP 4</li>
</ul>
<?php
do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>
<?php //print_r($_REQUEST);?>
<script>
jQuery(document).ready(function(){
//alert('Hello');
jQuery("#order_review").css("position","absolute");
jQuery("#order_review").css("top","350px");
jQuery("#order_review").css("visibility","hidden");

/*jQuery("#back2cart").click(function(){

});*/

jQuery("#proceed2payment").click(function(){
jQuery("#customer_details").css("visibility","hidden");
jQuery(".woocommerce-info").css("visibility","hidden");
jQuery("#order_review").css("visibility","visible");
});

jQuery("#billing_first_name, #billing_last_name, #billing_address_1, #billing_city, #billing_postcode, #billing_email, #billing_phone, #shipping_first_name, #shipping_last_name, #shipping_address_1, #shipping_city, #shipping_postcode, #shipping_email, #shipping_phone").keyup(function() {
        var empty = false;
        jQuery("#billing_first_name, #billing_last_name, #billing_address_1, #billing_city, #billing_postcode, #billing_email, #billing_phone, #shipping_first_name, #shipping_last_name, #shipping_address_1, #shipping_city, #shipping_postcode, #shipping_email, #shipping_phone").each(function() {
            if (jQuery(this).val().length == 0) {
                empty = true;
            }
        });

        if (empty) {
            jQuery('#proceed2payment').attr('disabled', 'disabled');
        } else {
            jQuery('#proceed2payment').attr('disabled', false);
        }
    });
});
//functions.php [remove order review section from checkout template]
//remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );
//styles.css
/* --------- OrderProcess ----------------- */

/*ul.order-process {
    padding: 0;
    list-style: none;
    width: 100%;
    background: none repeat scroll 0% 0% #363B3F;
}

ul.order-process li {
    display: inline-block;
    width: 30%;
    padding: 10px 0;
    color: #fff;
    text-align: center;
}

ul.order-process li.active {
    background: none repeat scroll 0% 0% # FF4646;
    font-weight: bold;
}*/

</script>
<form name="checkout" class="checkout_billing_shipping" method="post" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">
<!-- class="checkout" -->
	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">

			<div class="col-1">

				<?php do_action( 'woocommerce_checkout_billing' ); ?>

			</div>

			<div class="col-2">

				<?php do_action( 'woocommerce_checkout_shipping' ); ?>

			</div>

		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
<a href="http://localhost/wordpress/?page_id=5" id="back2cart">Back to Cart </a><input type="button" disabled="disabled" id="proceed2payment" value="Proceed to Payment" />
		<!--<h3 id="order_review_heading"><?php //_e( 'Your order', 'woocommerce' ); ?></h3>-->
<!--<input type="submit" value="Proceed to Payment" />-->
	<?php endif; ?>

	<?php do_action( 'woocommerce_checkout_order_review' ); ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>