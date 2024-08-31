<?php
include("includes/public_header.php")
?>
<div id="content">
  <h2>Shopping Cart</h2>
  <ul class="alerts">
    <?php $this->getAlert() ?>
  </ul>
  <form action="" method="POST">
    <ul class="cart">
      <?php $this->getData('cart_rows'); ?>
    </ul>
    <div class="buttons_row">
      <a href="?empty" class="button_alt">Empty Cart</a>
      <input type="submit" name="update" class="button_alt" value="Update Cart">
    </div>
  </form>

  <div id="paypal-button-container"></div>
  <p id="result-message"></p>
</div>

<?php
include("includes/public_footer.php")
?>