<?php

if (!defined('EMLOG_ROOT')) {
    exit('error!');
}

function threadedComments($comments, $children)
{
    ?>
    <ol class="comment-list">
        <?php
        $comoddflg = false;
        $comleveloddflg = false;
        foreach ($children as $cid) {
            $comment = $comments[$cid];

            $commentClass = '';
            /*if ($comments->authorId) {
                if ($comments->authorId == $comments->ownerId) {
                    $commentClass .= ' comment-by-author';
                } else {
                    $commentClass .= ' comment-by-user';
                }
            }*/
            if ($comment['url']) {
                $author = '<a href="' . $comment['url'] . '"' . '" target="_blank"' . ' rel="external nofollow">' . $comment['poster'] . '</a>';
            } else {
                $author = $comment['poster'];
            }
            ?>
            <li id="li-comment-<?= $comment['cid'] ?>" class="comment-body<?php
            if ($comment['level'] > 0) {
                echo ' comment-child';
                if (!$comleveloddflg) {
                    echo ' comment-level-odd';
                    $comleveloddflg = true;
                } else {
                    echo ' comment-level-even';
                    $comleveloddflg = false;
                }
            } else {
                echo ' comment-parent';
            }
            if (!$comoddflg) {
                echo ' comment-odd';
                $comoddflg = true;
            } else {
                echo ' comment-even';
                $comoddflg = false;
            }
            echo $commentClass;
            ?>">
                <div id="comment-<?= $comment['cid'] ?>">
                    <img class="avatar" src="<?= getGravatar($comment['mail'], 80) ?>" alt="<?= $comment['poster'] ?>"/>
                    <div class="comment_main">
                        <p><?= $comment['content'] ?></p>
                        <div class="comment_meta">
                            <span class="comment_author"><?= $author ?></span> <span
                                    class="comment_time"><?= $comment['date'] ?></span><span class="comment_reply"><a
                                        href="#respond-post" rel="nofollow"
                                        onclick="return Em.reply('comment-<?= $comment['cid'] ?>', <?= $comment['cid'] ?>);">回复</a></span>
                        </div>
                    </div>
                </div>
                <?php if ($comment['children']) { ?>
                    <div class="comment-children"><?php threadedComments($comments, $comment['children']); ?></div><?php } ?>
            </li>
        <?php } ?>
    </ol>
<?php } ?>

<div id="comments" class="gen">
    <?php extract($comments);
    $isNeedChinese = Option::get('comment_needchinese');
    if ($allow_remark == 'y'): ?>
        <div id="respond-post" class="respond">
            <div class="cancel-comment-reply">
                <a id="cancel-comment-reply-link" href="#respond-post" rel="nofollow" style="display: none"
                   onclick="return Em.cancelReply();">取消回复</a>
            </div>

            <form method="post" action="<?= BLOG_URL ?>?action=addcom" id="comment-form" role="form"
                  is-chinese="<?= $isNeedChinese ?>">
                <div class="comment-inputs">
                    <input type="hidden" name="pid" id="comment-pid" value="0" tabindex="1"/>
                    <input type="hidden" name="gid" value="<?= $logid ?>"/>
                    <?php if (ISLOGIN) : ?>
                        <input disabled type="text" id="comment-name-logged" class="text"
                               value="<?= blog_author(UID)['nkname'] ?>"/>
                    <?php else : ?>
                        <input type="text" name="comname" id="comment-name" class="text" placeholder="name"
                               value="<?= $ckname ?>" required/>
                        <input type="email" name="comemail" id="comment-mail" class="text" placeholder="mail"
                               value="<?= $ckmail ?>"/>
                        <input type="url" name="comeurl" id="comment-url" class="text" placeholder="https://"
                               value="<?= $ckurl ?>"/>
                    <?php endif; ?>
                </div>
                <div class="comment-editor">
                    <textarea name="comment" id="textarea" class="textarea" required
                              onkeydown="if((event.ctrlKey||event.metaKey)&&event.keyCode==13){document.getElementById('submitComment').click();return false};"></textarea>
                </div>
                <div class="comment-buttons">
                    <div class="left">
                        <?php if ($verifyCode): ?>
                            <img src="include/lib/checkcode.php" id="captcha" alt="验证码"
                                 onclick="Em.captchaRefresh($(this))">
                            <input type="text" name="imgcode" style="outline: none;background: transparent;flex: 1 !important;border: 0;padding: 0 15px;border-radius: 0;line-height: normal;border-left: 1px solid #E1E1E1;border-right: 1px solid #E1E1E1;"
                                   maxlength="5"
                                   placeholder="verify code"
                                   required/>
                        <?php else: ?>
                            <span>Smile : )</span>
                        <?php endif; ?>
                    </div>
                    <div class="right">
                        <button id="submitComment" type="submit" class="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    <?php else : ?>
        <h2 style="text-align: center">抱歉，评论已关闭...</h2>
    <?php endif; ?>

    <?php if ($commentStacks) : ?>
        <h2>评论</h2>

        <?php threadedComments($comments, $commentStacks) ?>

        <div class="nav-page" style="align-items: center;">
            <?= $commentPageUrl ?>
        </div>
    <?php endif; ?>
</div>
<script>
    window.Em = {
        dom: function (id) {
            return document.getElementById(id);
        },

        create: function (tag, attr) {
            let el = document.createElement(tag);

            for (let key in attr) {
                el.setAttribute(key, attr[key]);
            }

            return el;
        },

        reply: function (cid, coid) {
            let comment = this.dom(cid),
                response = this.dom('respond-post'), input = this.dom('comment-parent'),
                form = 'form' === response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];

            if (null == input) {
                input = this.create('input', {
                    'type': 'hidden',
                    'name': 'parent',
                    'id': 'comment-parent'
                });

                form.appendChild(input);
            }

            input.setAttribute('value', coid);

            if (null == this.dom('comment-form-place-holder')) {
                let holder = this.create('div', {
                    'id': 'comment-form-place-holder'
                });

                response.parentNode.insertBefore(holder, response);
            }

            comment.appendChild(response);
            this.dom('cancel-comment-reply-link').style.display = '';

            if (null != textarea && 'text' === textarea.name) {
                textarea.focus();
            }

            $("#comment-pid").attr("value", $('#respond-post').parent().attr("id").replace("comment-", ""));

            return false;
        },

        cancelReply: function () {
            $("#comment-pid").attr("value", 0);
            let response = this.dom('respond-post'),
                holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');

            if (null != input) {
                input.parentNode.removeChild(input);
            }

            if (null == holder) {
                return true;
            }

            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        },

        captchaRefresh: function ($t) {
            let timestamp = new Date().getTime();
            $t.attr("src", "include/lib/checkcode.php?" + timestamp)
        },
    };
</script>