<?php

if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>

    <div class="container-fluid">
        <div class="row">
            <div id="main" class="col-12 clearfix" role="main">
                <article class="posti" itemscope itemtype="http://schema.org/BlogPosting">
                    <h1 style="text-align:right;" class="post-title" itemprop="name headline"><?= $log_title ?></h1>
                    <div class="post-content" itemprop="articleBody">
                        <?= $log_content ?>
                    </div>

                    <div id="postFun" style="display:block;margin-bottom:2em;" class="clearfix">
                        <section style="float:right;">
                            <span><a id="btn-comments" href="javascript:isComments();">show comments</a></span> ·
                            <span><a href="javascript:goBack();">back</a></span> ·
                            <span><a href="<?= BLOG_URL ?>">home</a></span>
                        </section>
                    </div>

                    <?php require_once View::getView('comments'); ?>

                </article>
            </div>
        </div>
    </div>

<?php include View::getView('footer'); ?>