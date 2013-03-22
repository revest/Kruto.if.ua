<?='<?xml version="1.0" encoding="UTF-8"?>'?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?= SiteMapGenerator::sitemap_url_gen($this->createAbsoluteUrl("/music"), date("Y-m-d"), "always", 0.3) ?>
    <?= SiteMapGenerator::sitemap_url_gen($this->createAbsoluteUrl("/music/p2"), date("Y-m-d"), "always", 0.3) ?>
    <?= SiteMapGenerator::sitemap_url_gen($this->createAbsoluteUrl("/music/p3"), date("Y-m-d"), "always", 0.3) ?>
    <?= SiteMapGenerator::sitemap_url_gen($this->createAbsoluteUrl("/music/p4"), date("Y-m-d"), "always", 0.3) ?>
    <?= SiteMapGenerator::sitemap_url_gen($this->createAbsoluteUrl("/music/p5"), date("Y-m-d"), "always", 0.3) ?>
    <?= SiteMapGenerator::sitemap_url_gen($this->createAbsoluteUrl("/music/p6"), date("Y-m-d"), "always", 0.3) ?>
    <?= SiteMapGenerator::sitemap_url_gen($this->createAbsoluteUrl("/music/p7"), date("Y-m-d"), "always", 0.3) ?>
    <?= SiteMapGenerator::sitemap_url_gen($this->createAbsoluteUrl("/music/p8"), date("Y-m-d"), "always", 0.3) ?>
    <?= SiteMapGenerator::sitemap_url_gen($this->createAbsoluteUrl("/music/p9"), date("Y-m-d"), "always", 0.3) ?>
    <?= SiteMapGenerator::sitemap_url_gen($this->createAbsoluteUrl("/music/p10"), date("Y-m-d"), "always", 0.3) ?>
    <?= SiteMapGenerator::sitemap_url_gen($this->createAbsoluteUrl("/music/p11"), date("Y-m-d"), "always", 0.3) ?>
    <?php foreach ($rows as $row) : ?>
        <? echo $row?>
    <? endforeach; ?>
</urlset>