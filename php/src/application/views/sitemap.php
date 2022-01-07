<?php header('Content-type: text/xml'); ?>
<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <!-- My code is looking quite different, but the principle is similar -->
    <?php foreach($sitemap_array as $row) { ?>
    <url>
        <loc><?=$row['url']?></loc>
        <changefreq>always</changefreq>
        <priority><?=$row['priority']?></priority>
    </url>
    <?php } ?>
</urlset>