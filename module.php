<?php

if (!defined('EMLOG_ROOT')) {
    exit('error!');
}

function blog_author($uid)
{
    $User_Model = new User_Model();
    $user_info = $User_Model->getOneUser($uid);
    $author = $user_info['nickname'];
    return ['url' => Url::author($uid), 'nkname' => $author];
}

function blog_sort($sortID)
{
    $Sort_Model = new Sort_Model();
    $r = $Sort_Model->getOneSortById($sortID);
    $sortName = isset($r['sortname']) ? $r['sortname'] : '';
    if (!empty($sortName)): ?>
        <a href="<?= Url::sort($sortID) ?>"><?= $sortName ?></a>
    <?php else: ?>
        <a href="#">none</a>
    <?php endif;
}

function bloglist_sort($sortID)
{
    $Sort_Model = new Sort_Model();
    $r = $Sort_Model->getOneSortById($sortID);
    $sortName = isset($r['sortname']) ? $r['sortname'] : '';
    if (!empty($sortName)) { ?>
        <div class="post-meta">
            <?= $sortName ?>
        </div>
    <?php }
}

function blog_tag($blogid) {
    $tag_model = new Tag_Model();
    $tag_ids = $tag_model->getTagIdsFromBlogId($blogid);
    $tag_names = $tag_model->getNamesFromIds($tag_ids);
    if (!empty($tag_names)) {
        $tag = 'tag(s): ';
        $tag_links = array_map(function($value) {
            return "<a href='" . Url::tag(rawurlencode($value)) . "'>" . htmlspecialchars($value) . "</a>";
        }, $tag_names);
        $tag .= implode(', ', $tag_links);
        echo $tag;

    }
    else{
        echo 'tag(s): none';

    }
}

function parseContent($content)
{
    // 添加 h3,h4 锚点
    $ftitle = array();
    preg_match_all('/<h([3-4])>(.*?)<\/h[3-4]>/', $content, $title);
    $num = count($title[0]);

    for ($i = 0; $i < $num; $i++) {
        $f = $title[2][$i];
        $type = $title[1][$i];
        if ($type == '3') {
            $ff = '<h3 id="anchor-' . $i . '" class="torAn">' . $f . '</h3>';
        }
        if ($type == '4') {
            $ff = '<h4 id="anchor-' . $i . '" class="torAn">' . $f . '</h4>';
        }
        array_push($ftitle, $ff);
    }
    for ($i = 0; $i < $num; $i++) {
        $content = str_replace_limit($title[0][$i], $ftitle[$i], $content);
    }

    // <img> 添加 data-action
    $fimg = array();
    preg_match_all('/<img (.*?)>/', $content, $img);
    $num = count($img[0]);

    for ($i = 0; $i < $num; $i++) {
        $f = $img[1][$i];
        $ff = '<img data-action="zoom" ' . $f . '>';

        array_push($fimg, $ff);
    }
    for ($i = 0; $i < $num; $i++) {
        $content = str_replace_limit($img[0][$i], $fimg[$i], $content);
    }

    print_r($content);
}

function str_replace_limit($search, $replace, $subject, $limit = 1)
{
    if (is_array($search)) {
        foreach ($search as $k => $v) {
            $search[$k] = '`' . preg_quote($search[$k], '`') . '`';
        }
    } else {
        $search = '`' . preg_quote($search, '`') . '`';
    }

    return preg_replace($search, $replace, $subject, $limit);
}

function post_tor($content)
{
    $f = '';
    preg_match_all('/<h[3-4]>(.*?)<\/h[3-4]>/', $content, $tor_i);
    $num = count($tor_i[0]);

    if ($num == 0) {
        return '';
    } else {
        for ($i = 0; $i < $num; $i++) {
            $a = '<a id="tor-' . $i . '" class="torList" href="#anchor-' . $i . '">' . $tor_i[0][$i] . '</a>';
            $f = $f . $a;
        }
        $f = str_replace('<h3>', '<span class="tori">', $f);
        $f = str_replace('</h3>', '</span><br>', $f);
        $f = str_replace('<h4>', '<span class="torii">', $f);
        $f = str_replace('</h4>', '</span><br>', $f);

        return '<a href="#main">Title</a><br>' . $f . '<a href="javascript:goToComment();">Comment</a>';
    }
}