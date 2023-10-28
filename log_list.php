<?php

if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
    <?php doAction('index_loglist_top'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="archive-header">
                <span>
                <?php if(isset($sort)): ?><?= '- Category · '.$sort['sortname'].' -' ?>
                <?php elseif (isset($tag)):?><?= '- Tag · '.$tag.' -' ?>
                <?php elseif (isset($author)):?><?= '- Author · '.blog_author($author)['nkname'].' -' ?>
                <?php elseif (isset($keyword)):?><?= '- Search · '.$keyword.' -' ?>
                <?php elseif (isset($record)):?><?= '- Record · '.$record.' -' ?>
                <?php else: ?><?= '- All Posts -' ?>
                <?php endif; ?>
                </span>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div id="main" role="main">
                <ul class="post-list clearfix">
                    <?php if (!empty($logs)): ?>
                        <?php foreach ($logs as $value): ?>
                            <li class="post-item grid-item" itemscope itemtype="http://schema.org/BlogPosting">
                                <a class="post-link" href="<?= $value['log_url'] ?>">
                                    <?php
                                    if (!empty($value['log_cover'])) {
                                        echo '<span class="cover" style="background: url(' . $value['log_cover'] . ') center/cover no-repeat;"></span>';
                                    }
                                    ?>
                                    <h3 class="post-title"><time class="index-time" datetime="<?= date('c', $value['date']) ?>" itemprop="datePublished"><?= date('M j, Y', $value['date']) ?></time><br><?= $value['log_title'] ?></h3>
                                    <?php bloglist_sort($value['sortid']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <br><br>
                        <h2 class="post-title" style="text-align: center;">(´°̥̥̥̥̥̥̥̥ω°̥̥̥̥̥̥̥̥｀) 什么都没有找到唉...</h2>
                    <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="nav-page">
                <?= $page_url ?>
            </div>
        </div>
    </div>

<?php include View::getView('footer') ?>