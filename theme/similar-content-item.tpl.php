<div class = "custom-similar-content-node clearfix">
  <h2 class = "similar-content-title"><?php print l($node->title, 'node/' . $node->nid); ?></h2>
  <div class = "similar-content-content">
    <?php if(isset($node->field_file_url['und'])): ?>
      <div class = "similar-content-image">
        <img src = "<?php print $node->field_file_url['und'][0]['value']; ?>">
      </div>
    <?php endif; ?>
    <?php if(isset($node->field_seller)): ?>
      <div class = "seller">
        <?php $seller = field_view_field('node', $node, 'field_seller'); ?>
        <?php print render($seller); ?>
      </div>
    <?php endif; ?>
    <?php if(isset($node->field_custom_price['und'])): ?>
    <div class = "custom-price">
      <label>Price: </label>
      <div class = "value">php print $node->field_custom_price['und'][0]['value']; ?></div>
    </div>
    <?php endif; ?>
    <?php if(isset($node->field_website['und'])): ?>
      <div class = "website">
        <label>Shop <?php print $node->label_website; ?></label>
        <?php $website = field_view_field('node', $node, 'field_website'); ?>
        <?php print render($website); ?>
      </div>
    <?php endif; ?>

  </div>
</div>