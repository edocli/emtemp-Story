<?php

/**
* Template Name:Story
* Description:爱上你我的故事
* Version:0.1
* Template Url:https://www.emlog.net/template/detail/1125
* Author:UTF-X
* Author Url:https://www.utf-x.cn/
*/

if (!defined('EMLOG_ROOT')) {
    exit('error!');
}

require_once View::getView('module');

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
    <meta name="keywords" content="<?= $site_key ?>"/>
    <meta name="description" content="<?= $site_description ?>"/>

    <title><?= $site_title ?></title>

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
                    $blognamelist = mb_str_split($blogname);
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