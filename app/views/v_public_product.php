<?php
include("includes/public_header.php")
?>
<div id="content">
  <img src="<?php $this->getData('prod_image');?>" alt="<?php $this->getData('prod_name');?>" class="product_image">
  <h2><?php $this->getData('prod_name');?></h2>
  <div class="price"><?php $this->getData('prod_price');?></div>
  <div class="description"><?php $this->getData('prod_description');?></div>

  <a href="cart.php?id=<?php $this->getData('prod_id');?>" class="button">Add to cart</a>

</div>
<?php
include("includes/public_footer.php")
?>