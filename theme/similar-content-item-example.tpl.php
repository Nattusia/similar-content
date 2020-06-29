<?php //we have node object in this template, so we can output all node fields; ?>
<?php //It is not only method to manipulate with node in template, and not the best.
//But it most easy for understanding; ?>
<div class = "custom-similar-content-node clearfix">
  <h2 class = "similar-content-title"><?php print l($node->title, 'node/' . $node->nid); ?></h2>
  
  <div class = "similar-content-content">
    <?php //Change the machine name of the field in this line. It has to be machine name of the field contains image; ?>
    <?php if(isset($node->field_image['und'])): ?>
      <div class = "sim-image">
        <?php //Change the machine name of the field and machine name of the image style; ?>
        <img src = "<?php print image_style_url('thumbnail', $node->field_image['und'][0]['uri']); ?>">
      </div>
    <?php endif; ?>

    <div class = "tags">
      <?php //This is one of the methods to output node field content. The other is looks like this:
      //<?php print $node->NAME_OF_FIELD['und'][0]['value'];
      //if you have more than one value in the field you can output all of this usin foreach cicle
      //foreach($node->NAME_OF_FIELD['und'] as ($index => $value)){print $value['value'];}
      //The value element is not always has name "value" but. It may be tid or uri.
      //But I will not to overcharge you with information.
      ?>


      <?php if(isset($node->field_tags)): ?>
        <?php $tasg = field_view_field('node', $node, 'field_tags'); ?>
        <?php print render($tasg); ?>
      <?php endif; ?>
      <?php if(isset($node->field_tags_2)): ?>
        <?php $tasg_2 = field_view_field('node', $node, 'field_tags_2'); ?>
        <?php print render($tasg_2); ?>
      <?php endif; ?>
      <?php if(isset($node->field_tags_3)): ?>
        <?php $tasg_3 = field_view_field('node', $node, 'field_tags_3'); ?>
        <?php print render($tasg_3); ?>
      <?php endif; ?>

    </div>
    <?php //I added this we can be sure all values are counted right. You can just delete this; ?>
    <div class = "counts">
      <?php if (isset($counts[$node->nid]['summ'])): ?>
        <div class = "terms-weight">Values summ: <?php print $counts[$node->nid]['summ']; ?></div>
      <?php endif; ?>
      <div class = "terms-weight">Qty: <?php print $counts[$node->nid]['i']; ?></div>
    </div>
  </div>
</div>