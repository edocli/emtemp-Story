<?php

/*@support tpl_options*/
!defined('EMLOG_ROOT') && exit('access deined!');

$options = [
    'TplOptionsNavi' => [
        'type' => 'radio',
        'values' => [
            'setting' => '设置',
        ],
        'description' => '<p>模板：Story <br>爱上你我的故事。</p>'
    ],
    'style_BG' => [
        'labels' => 'setting',
        'type' => 'text',
        'name' => '背景图像地址',
        'description' => '在这里填入一个图片 URL 地址，留空则不显示。'
    ],
    'isTorTree' => [
        'labels' => 'setting',
        'type' => 'checkon',
        'name' => '文章导航树',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否在文章页显示文章导航树'
    ],
    'isIconNav' => [
        'labels' => 'setting',
        'type' => 'checkon',
        'name' => '将导航栏中的 1,2,3 替换成 Emoji 图标',
        'default' => 0,
        'values' => [
            '1' => 1,
        ],
        'description' => '开启后将导航栏中的 1,2,3 替换成 Emoji 图标'
    ],
    'isRSS' => [
        'labels' => 'setting',
        'type' => 'checkon',
        'name' => '在菜单栏中加入 RSS 按钮',
        'values' => [
            '1' => 1,
        ],
        'description' => '开启后将在菜单栏中显示 RSS 按钮'
    ],
];