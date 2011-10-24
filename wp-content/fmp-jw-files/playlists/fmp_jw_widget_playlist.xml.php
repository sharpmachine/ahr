<?xml version="1.0" encoding="UTF-8"?>
<playlist>
  <trackList>
    <track>
      <annotation>Realms of Glory</annotation>
      <location>http://localhost/ahr/wp-content/uploads/2011/02/02-Realms-of-Glory.mp3</location>
      <info></info>
      <image>http://localhost/ahr/wp-content/uploads/2011/02/CoverS.jpg</image>
    </track>
    <track>
      <annotation>Awaiting the Kingsss</annotation>
      <location>http://localhost/ahr/wp-content/uploads/2011/02/01-Awaiting-the-King.mp3</location>
      <info></info>
      <image>http://localhost/ahr/wp-content/uploads/2011/02/CoverS.jpg</image>
    </track>
    
    <?php query_posts( 'category_name=uncategorized' );?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <track>
      <annotation><?php echo ('add_a_song_song_title'); ?></annotation>
      <location>http://localhost/ahr/wp-content/uploads/2011/02/01-Awaiting-the-King.mp3</location>
      <info></info>
      <image>http://localhost/ahr/wp-content/uploads/2011/02/CoverS.jpg</image>
    </track>
    
<?php endwhile; else: ?>

<?php endif; ?>

  </trackList>
  
</playlist>
