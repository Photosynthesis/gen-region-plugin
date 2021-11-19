<?php

if ( Murmurations\Aggregator\Config::get('node_single') ) {
  if ( Murmurations\Aggregator\Config::get('node_single_url_field') ) {
    $single_url_field = Murmurations\Aggregator\Config::get('node_single_url_field');
    if ( trim( $single_url_field ) != '' ){
      $project_url   = $data[ Murmurations\Aggregator\Config::get('node_single_url_field') ];
    } else {
      $project_url = $data['guid'];
    }
  } else {
    $project_url = $data['guid'];
  }
}

if ($data['gen_project_image_thumbnail_url']){
  $data['gen_project_image_thumbnail_url'] = str_replace('ecodb-test', 'www', $data['gen_project_image_thumbnail_url']);
}

?>

<article data-post-type="gen_project" class="gen_project entry wpautop <?= $data_classes ?>" aria-label="<?php echo $data['name']; ?>">
  <header class="entry-header"><h2 class="entry-title"><a href="<?= $project_url ?>"><?php echo $data['name']; ?></a></h2></header><div class="project-info">
    <ul class="project-meta ">
      <li class="project-region"><b>Region</b>: <?= $data['gen_region'] ?></li>
      <?php if ($data['languages_spoken']){ ?>
        <li class="project-languages"><b>Languages</b>: <?= join(", ", $data['languages_spoken'] ) ?></li>
      <?php } ?>
    </ul></div>

    <?php if ($data['gen_project_image_thumbnail_url']){ ?>
      <a href="<?= $project_url ?>" title="<?= $data['name'] ?>" class="image-link alignleft" style="background-image: url(<?= $data['gen_project_image_thumbnail_url'] ?>)"></a>
    <?php } ?>

    <div class="entry-content"><?php echo wp_trim_words( $data['description'], 60, '...' ); ?> 
  <a href="<?= $project_url ?>" target="_blank">read more</a>
  </div>
</article>
