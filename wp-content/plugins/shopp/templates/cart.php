<?php
/** 
 ** WARNING! DO NOT EDIT!
 **
 ** These templates are part of the core Shopp files 
 ** and will be overwritten when upgrading Shopp.
 **
 ** For editable templates, setup Shopp theme templates:
 ** http://docs.shopplugin.net/Setting_Up_Theme_Templates
 **
 **/
?>
<?php if (shopp('cart','hasitems')): ?>
<form id="cart" action="<?php shopp('cart','url'); ?>" method="post">
<big>
	<a href="<?php shopp('cart','referrer'); ?>">&laquo; <?php _e('Continue Shopping','Shopp'); ?></a>
	<a href="<?php shopp('checkout','url'); ?>" class="right"><?php _e('Proceed to Checkout','Shopp'); ?> &raquo;</a>
</big>

<?php shopp('cart','function'); ?>
<table class="cart">
	<tr>
		<th scope="col" class="item"><?php _e('Cart Items','Shopp'); ?></th>
		<th scope="col"><?php _e('Quantity','Shopp'); ?></th>
		<th scope="col" class="money"><?php _e('Item Price','Shopp'); ?></th>
		<th scope="col" class="money"><?php _e('Item Total','Shopp'); ?></th>
	</tr>

	<?php while(shopp('cart','items')): ?>
		<tr>
			<td>
				<a href="<?php shopp('cartitem','url'); ?>"><?php shopp('cartitem','name'); ?></a>
				<?php shopp('cartitem','options'); ?>
				<?php shopp('cartitem','addons-list'); ?>
				<?php shopp('cartitem','inputs-list'); ?>
			</td>
			<td><?php shopp('cartitem','quantity','input=text'); ?>
				<?php shopp('cartitem','remove','input=button'); ?></td>
			<td class="money"><?php shopp('cartitem','unitprice'); ?></td>
			<td class="money"><?php shopp('cartitem','total'); ?></td>
		</tr>
	<?php endwhile; ?>

	<?php while(shopp('cart','promos')): ?>
		<tr><td colspan="4" class="money"><?php shopp('cart','promo-name'); ?> &mdash; <strong><?php shopp('cart','promo-discount'); ?></strong></td></tr>
	<?php endwhile; ?>
	
	<tr class="totals">
		<td colspan="2" rowspan="5">
			<?php if (shopp('cart','needs-shipping-estimates')): ?>
			<small><?php _e('Estimate shipping &amp; taxes for:','Shopp'); ?></small>
			<?php shopp('cart','shipping-estimates'); ?>
			<?php endif; ?>
			<?php shopp('cart','promo-code'); ?>
		</td>
		<th scope="row"><?php _e('Subtotal','Shopp'); ?></th>
		<td class="money"><?php shopp('cart','subtotal'); ?></td>
	</tr>
	<?php if (shopp('cart','hasdiscount')): ?>
	<tr class="totals">
		<th scope="row"><?php _e('Discount','Shopp'); ?></th>
		<td class="money">-<?php shopp('cart','discount'); ?></td>
	</tr>
	<?php endif; ?>
	<?php if (shopp('cart','hasshipcosts')): ?>
	<tr class="totals">
		<th scope="row"><?php shopp('cart','shipping','label='.__('Shipping','Shopp')); ?></th>
		<td class="money"><?php shopp('cart','shipping'); ?></td>
	</tr>
	<?php endif; ?>
	<tr class="totals">
		<th scope="row"><?php shopp('cart','tax','label='.__('Tax','Shopp')); ?></th>
		<td class="money"><?php shopp('cart','tax'); ?></td>
	</tr>
	<tr class="totals total">
		<th scope="row"><?php _e('Total','Shopp'); ?></th>
		<td class="money"><?php shopp('cart','total'); ?></td>
	</tr>
	<tr class="buttons">
		<td colspan="4"><?php shopp('cart','update-button'); ?></td>
	</tr>
</table>

<big>
	<a href="<?php shopp('cart','referrer'); ?>">&laquo; <?php _e('Continue Shopping','Shopp'); ?></a>
	<a href="<?php shopp('checkout','url'); ?>" class="right"><?php _e('Proceed to Checkout','Shopp'); ?> &raquo;</a>
</big>

</form>

<?php else: ?>
	<p class="warning"><?php _e('There are currently no items in your shopping cart.','Shopp'); ?></p>
	<p><a href="<?php shopp('catalog','url'); ?>">&laquo; <?php _e('Continue Shopping','Shopp'); ?></a></p>
<?php endif; ?>
