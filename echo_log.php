<?php

if (!defined('EMLOG_ROOT')) {
    exit('error!');
}

?>

    <div class="container-fluid">
        <div class="row">
            <div id="main" class="col-12 clearfix" role="main">
                <article class="posti" itemscope itemtype="https://schema.org/BlogPosting">
                    <h1 class="post-title" itemprop="name headline"><?= $log_title ?></h1>
                    <div class="post-meta">
                        <p>Written by <a itemprop="name" href="<?= blog_author($author)['url'] ?>" rel="author"><?= blog_author($author)['nkname'] ?></a> with ♥ on <time datetime="<?= date('c', $date) ?>" itemprop="datePublished"><?= date('F j, Y', $date) ?></time> in <?php blog_sort($sortid) ?></p>
                    </div>

                    <div class="post-content" itemprop="articleBody">
                        <?php parseContent($log_content); ?>
                        <?php doAction('log_related', $logData); ?>
                    </div>

                    <div id="postFun" style="display:block;margin-bottom:2em;" class="clearfix">
                        <section style="float:left;">
                            <span itemprop="keywords" class="tags"><?php blog_tag($logid) ?></span>
                        </section>
                        <section style="float:right;">
                            <span><a id="btn-comments" href="javascript:isComments();">show comments</a></span> ·
                            <span><a href="javascript:goBack();">back</a></span> ·
                            <span><a href="<?= BLOG_URL ?>">home</a></span>
                        </section>
                    </div>

                    <?php require_once View::getView('comments'); ?>

                    <?php
                    $torHTML = post_tor($log_content);
                    if ($torHTML != '') {
                        echo '<div id="postTorTree"><div id="torTree" style="display: none;"><div class="torArcT"><div class="torArcTile">' . $torHTML . '</div></div></div></div>';
                    }
                    ?>
                </article>
            </div>
        </div>
    </div>
<?php include View::getView('footer') ?>
<script>
    isMenu2('auto');

    var $navs = $('.torList'),
        $sections = $('.torAn'),
        $window = $(window),
        navLength = $navs.length - 1;

    $window.on('scroll', function() {
        var scrollTop = $window.scrollTop(),
            len = navLength;

        for (; len > -1; len--) {
            var that = $sections.eq(len);
            if (scrollTop >= (that.offset().top - 100)) {
                $navs.removeClass('on').eq(len).addClass('on');
                break;
            }
            $navs.removeClass('on');
        }
    });
</script>
