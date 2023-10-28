<?php

if (!defined('EMLOG_ROOT')) {
    exit('error!');
}

if (!function_exists('_g')) {
    emMsg('请先在商店安装并开启：PRO版模版设置插件', BLOG_URL . 'admin/store.php?action=plu');
}

?>

    <!DOCTYPE html>
    <?php
    if (_g('style_BG') != '') {
        echo '<style>';
        echo "\n";
        echo 'body{ background: #fff; } body::before{ background: url(' . _g('style_BG') . ') center/cover no-repeat; } blockquote::before{ background: transparent !important; }';
        echo "\n";
        echo '</style>';
        echo "\n";
    }
    ?>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="renderer" content="webkit">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="keywords" content="<?= Option::get('site_key') ?>"/>
        <meta name="description" content="<?= Option::get('site_description') ?>"/>

        <title>404 (,,• ₃ •,,)</title>

        <!-- CSS -->
        <link type="text/css" rel="stylesheet" href="<?=TEMPLATE_URL?>assert/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="<?=TEMPLATE_URL?>assert/css/prism.css">
        <link type="text/css" rel="stylesheet" href="<?=TEMPLATE_URL?>assert/css/zoom.css">
        <link type="text/css" rel="stylesheet" href="<?=TEMPLATE_URL?>assert/css/main.css">
        <?php if (_g('isIconNav')) : ?>
            <link type="text/css" rel="stylesheet" href="<?=TEMPLATE_URL?>assert/css/twemoji-awesome.css">
        <?php endif; ?>

        <!--[if lt IE 9]>
        <script src="http://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
        <script src="http://cdn.staticfile.org/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <!-- 头部扩展挂载点 -->
        <?php doAction('index_head'); ?>
    </head>

<body>
<!--[if lt IE 8]>
    <div class="browsehappy" role="dialog">当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>.</div>
<![endif]-->

    <header id="header" class="clearfix">
        <div class="container-fluid">
            <div class="row">
                <div class="logo">
                    <div class="header-logo">
                        <!-- 标题开始 -->
                        <a href="<?= BLOG_URL ?>">
                            <?php
                            $blognamecolorlist = ['b', 'w'];
                            $blognamelist = mb_str_split(Option::get('blogname'));
                            foreach ($blognamelist as $value) : ?>
                                <span class="<?= $blognamecolorlist[array_rand($blognamecolorlist)] ?>"><?= $value ?></span>
                            <?php endforeach; ?>
                        </a>
                        <!-- 标题结束 -->
                        <a id="btn-menu" href="javascript:isMenu();">
                            <span class="b">·</span>
                        </a>
                        <a href="javascript:isMenu1();">
                            <?php if (_g('isIconNav')) : ?>
                                <span id="menu-1" class="bf"><i class="twa twa-flags"></i></span>
                            <?php else : ?>
                                <span id="menu-1" class="bf">1</span>
                            <?php endif; ?>
                        </a>
                        <a href="javascript:isMenu2();">
                            <?php if (_g('isIconNav')) : ?>
                                <span id="menu-2" class="bf"><i class="twa twa-evergreen-tree"></i></span>
                            <?php else : ?>
                                <span id="menu-2" class="bf">2</span>
                            <?php endif; ?>
                        </a>
                        <a href="javascript:isMenu3();">
                            <?php if (_g('isIconNav')) : ?>
                                <span id="menu-3" class="bf"><i class="twa twa-mag"></i></span>
                            <?php else : ?>
                                <span id="menu-3" class="bf">3</span>
                            <?php endif; ?>
                        </a>
                    </div>
                    <div id="menu-page">
                        <?php
                        global $CACHE;
                        $navi_cache = $CACHE->readCache('navi');
                        foreach ($navi_cache as $value):
                            if ($value['pid'] != 0) {
                                continue;
                            }
                            if ($value['url'] == 'admin' && (!User::isVistor())):
                                ?>
                                <a href="<?= BLOG_URL ?>admin/"><li>管理</li></a>
                                <a href="<?= BLOG_URL ?>admin/account.php?action=logout"><li>退出</li></a>
                                <?php
                                continue;
                            endif;
                            $newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
                            $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
                            ?>
                            <a href="<?= $value['url'] ?>" <?= $newtab ?>>
                                <li><?= $value['naviname'] ?></li>
                            </a>
                        <?php endforeach; ?>
                        <?php if (_g('isRSS')) : ?>
                            <a href="rss.php">
                                <li>RSS</li>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div id="search-box">
                        <form action="<?= BLOG_URL ?>index.php" id="search" method="get" role="search">
                            <input autocomplete="off" type="text" name="keyword" id="menu-search" placeholder="Type something~" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

<div id="body" class="clearfix">

    <div class="container-fluid">
        <div class="row">
            <div id="main" role="main">
                <ul class="post-list clearfix">
                    <li class="post-item grid-item">
                        <a class="post-link">
                            <h3 class="post-title">404,<br>不知道发生了什么...</h3>
                            <div class="post-meta">(,,• ₃ •,,)</div>
                        </a>
                    </li>
                    <li class="post-item grid-item">
                        <a href="javascript:Search404();" class="post-link">
                            <h3 class="post-title">搜索一下</h3>
                            <div class="post-meta">(•̀ᴗ•́)و ̑̑</div>
                        </a>
                    </li>
                    <li class="post-item grid-item">
                        <a class="post-link" href="<?= BLOG_URL ?>">
                            <h3 class="post-title">返回首页</h3>
                            <div class="post-meta">(・(ｪ)・)</div>
                        </a>
                    </li>
                    <li class="post-item grid-item">
                        <a class="post-link">
                            <h3 class="post-title">没了哦</h3>
                            <div class="post-meta">(○’ω’○)</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end #body -->

<footer id="footer" role="contentinfo">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?= Option::get('footer_info') ?>
                <!-- 希望不要删掉这边的内容鸭 -->
                <div>
                    &copy; <?= date('Y') ?> <a href="<?= BLOG_URL ?>"><?= Option::get('blogname') ?></a>.
                    Using <a target="_blank" href="https://www.emlog.net/?ic=7XYTEMcR">emlog</a> & <a target="_blank" href="https://www.utf-x.cn/">Story</a>.
                </div>
                <!-- end -->
                <?php doAction('index_footer'); ?>
            </div>
        </div>
    </div>
</footer>

<script src="<?=TEMPLATE_URL?>assert/js/jquery.min.js"></script>
<script src="<?=TEMPLATE_URL?>assert/js/prism.js"></script>
<script src="<?=TEMPLATE_URL?>assert/js/zoom-vanilla.min.js"></script>
<script>
    var b = document.getElementsByClassName('b');
    var w = document.getElementsByClassName('w');
    var menupgMargin = (b.length + w.length) * 28;
    var srhboxMargin = (b.length + w.length + 3) * 28;
    var menusrhWidth = (b.length + w.length - 1) * 28;
    document.getElementById('menu-page').style['margin-left'] = menupgMargin + 'px';
    document.getElementById('search-box').style['margin-left'] = srhboxMargin + 'px';
    document.getElementById('menu-search').style['width'] = menusrhWidth + 'px';
    if (menusrhWidth < 140) {
        document.getElementById('menu-search').setAttribute('placeholder', 'Search~');
    }

    $(document).ready(function() {
        if (window.location.hash != '') {
            var i = window.location.hash.indexOf('#comment');
            var ii = window.location.hash.indexOf('#respond-post');
            if (i != -1 || ii != -1) {
                document.getElementById('btn-comments').innerText = 'hide comments';
                document.getElementById('comments').style.display = 'block';
                footerPosition();
            }
        }
    });

    function isMenu() {
        if (document.getElementById('menu-1').style.display == 'inline') {
            $('#search-box').fadeOut(200);
            $('#menu-page').fadeOut(200);
            $('#menu-1').fadeOut(500);
            $('#menu-2').fadeOut(400);
            $('#menu-3').fadeOut(300);
        } else {
            $('#menu-1').fadeIn(150);
            $('#menu-2').fadeIn(150);
            $('#menu-3').fadeIn(150);
        }
    }

    function isMenu1() {
        if (document.getElementById('menu-page').style.display == 'block') {
            $('#menu-page').fadeOut(300);
        } else {
            $('#menu-page').fadeIn(300);
        }
    }

    function isMenu2(c = 'none') {
        if (document.getElementById('torTree')) {
            if ($("#torTree").attr('style') == 'display: none;') {
                $("#torTree").fadeIn(300);
                $("#torTree").css('display', 'inline-block');
            } else {
                $("#torTree").fadeOut(300);
            }
        } else {
            if (c != 'auto') {
                alert('人家是导航树哦！只有在特定的文章页面才会出现的。');
            }
        }
    }

    function isMenu3() {
        if (document.getElementById('search-box').style.display == 'block') {
            $('#search-box').fadeOut(300);
        } else {
            $('#search-box').fadeIn(300);
        }
    }

    function isComments() {
        if (document.getElementById('btn-comments').innerText == 'show comments') {
            document.getElementById('btn-comments').innerText = 'hide comments';
            document.getElementById('comments').style.display = 'block';
        } else {
            document.getElementById('btn-comments').innerText = 'show comments';
            document.getElementById('comments').style.display = 'none';
        }
        footerPosition();
    }

    function Search404() {
        $('#menu-1').fadeIn(150);
        $('#menu-2').fadeIn(150);
        $('#menu-3').fadeIn(150);
        $('#search-box').fadeIn(300);
    }

    function goBack() {
        window.history.back();
    }

    function footerPosition() {
        $("footer").removeClass("fixed-bottom");
        var contentHeight = document.body.scrollHeight,
            winHeight = window.innerHeight;
        if (document.getElementsByClassName("post-content")[0]) {
            var winImgNum = document.getElementsByClassName("post-content")[0].getElementsByTagName("img").length;
        } else {
            var winImgNum = 0;
        }
        if (!(contentHeight > winHeight) && winImgNum == 0) {
            $("footer").addClass("fixed-bottom");
        }
    }
    footerPosition();
    $(window).resize(footerPosition);

    function goToComment() {
        document.getElementById('btn-comments').innerText = 'hide comments';
        document.getElementById('comments').style.display = 'block';
        window.location.hash = "#postFun";
        footerPosition();
    }

</script>

</body>

</html>