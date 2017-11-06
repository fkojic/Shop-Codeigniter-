<div class="span12">
    <div class="well well-small">
        <hr class="soften"/>
  <?php   
    $cart_check = $this->cart->contents();
    if(empty($cart_check)) {
    echo 'Klikom na "Dodaj u korpu" možete kupiti proizvod.';
} ?>

<table id="table" border="0" cellpadding="5px" cellspacing="1px" class="table table-bordered table-striped">
<?php
// All values of cart store in "$cart".
if ($cart = $this->cart->contents()): ?>
<tr id= "main_heading">
<td>Serial</td>
<td>Ime</td>
<td>Cena</td>
<td>Broj</td>
<td>Ukupno</td>
<td>Ukloni proizvod</td>
</tr>
<?php
// Create form and send all values in "shopping/update_cart" function.
echo form_open('home/update_cart');
$grand_total = 0;
$i = 1;

foreach ($cart as $item):
// echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
// Will produce the following output.
// <input type="hidden" name="cart[1][id]" value="1" />

echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
echo form_hidden('cart[' . $item['id'] . '][slika]', $item['slika']);
?>
<tr>
<td>
<?php echo img('assets/img/'.$item['slika'],$item['name'], array('width'=>'100px', 'height'=>'100px')); ?>
</td>
<td>
<?php echo $item['name']; ?>
</td>
<td>
 <?php echo number_format($item['price'], 2); ?> €
</td>
<td>
<?php echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" size="1" style="text-align: right"'); ?>
</td>
<?php $grand_total = $grand_total + $item['subtotal']; ?>
<td>
 <?php echo number_format($item['subtotal'], 2) ?> €
</td>
<td>

<?php
echo anchor('home/remove/' . $item['rowid'], 'Ukloni', array('class'=>'shopBtn')); ?>
</td>
<?php endforeach; ?>
</tr>
<tr>
<td><b>Ukupno: <?php

//Grand Total.
echo number_format($grand_total, 2); ?> €</b></td>

<?php // "clear cart" button call javascript confirmation message ?>
<td colspan="5" align="right"><input  class ='shopBtn' type="button" value="Obrisi sve" onclick="clear_cart()">

<?php //submit button. ?>
<input class ='shopBtn'  type="submit" value="Osveži">
<?php echo form_close(); ?>

</tr>
<?php endif; ?>
</table>
    </div>
</div>