<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>映画飯{管理}</title>
    <link rel="stylesheet" href="html5reset-1.6.1.css">
    <link rel="stylesheet" href="view/movie.css">
    <link rel="icon" href="./img/icon/favicon.ico" type="image/png" sizes="18x18">
    <meta name="description" content="いつもの食卓をちょっぴり豪勢に！主婦からの投稿が多いので、誰でも作れる簡単レシピが沢山掲載されております！">
    <meta name="keywords" content="CookCamp,クックキャンプ,レシピ,献立,簡単,料理,recipe">
    <title>[管理飯]</title>
    <style>
        .status_false {
            background-color: #A9A9A9;
        }
        .now_item {
            text_align: left;
            display: block;
            font-size: 0.5ex;
        }
        th{ 
            border-bottom-style:ridge;
        }
        #add_box{
            border-bottom-style:ridge;
        }
    </style>
</head>
<body>
    <?php if (empty($result_msg) !== TRUE) { ?>
    <p>
        <?php print $result_msg; ?>
    </p>
    <?php } ?>
    <?php foreach ($err_msg as $value) { ?>
    <p>
        <?php print $value; ?>
    </p>
    <?php } ?>
    <h1>商品管理ツール</h1>
    <section>
        <h2>新規商品追加</h2>
        <form method="post" enctype="multipart/form-data">
            <div><label>名前: <input type="text" name="new_name" value=""></label></div>
            <div><label>値段: <input type="text" name="new_price" value=""></label></div>
            <div><label>個数: <input type="text" name="new_stock" value=""></label></div>
            <div><input type="file" name="new_img"></div>
            <input type="hidden" name="sql_kind" value="insert">
            <div><label>ステータス： <select name="new_status">
          <option value="0">非公開</option>
          <option value="1">公開</option></select></label>
            </div>
            <div><input type="submit" value="商品を追加"></div>
        </form>
    </section>
    <section>

        <table>
            <caption>商品情報</caption>
            <tr id ="add_box">
                <th></th>
                <th>登録商品情報</th>
                <th>登録情報変更</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($data as $value)  { ?>
            <?php if ( $value['status'] === '1' ) { ?>
            <tr>
                <?php } else { ?>
                <tr class="status_false">
                    <?php } ?>
                    <th>
                        <img src="<?php print $img_dir . $value['img']; ?>" height="100" width="100"></br>
                    </th>
                    <th class="now_item">
                        <a class="now_item">商品名:<?php print $value['item_name']; ?></a></br>
                        <a class="now_item">商品価格：<?php print $value['price']; ?>円</a></br>
                        <a class="now_item">商品在庫:<?php print $value['stock']; ?>個</a>
                    </th>
                    <th>
                        <form method="post" enctype="multipart/form-data">
                            <input type="file" class="input_file_width file_align_right" name="update_img" img src="<?php print $img_dir . $value['img']; ?>" <input type="hidden" name="sql_kind" value="update_img">
                            <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                            <div><input type="submit" value="画像を変更"></div>
                        </form>
                    </th>
                    <th>
                        <form method="post">
                            <input type="text" class="input_text_width text_align_right" name="item_name"　value="<?php print $value['stock']; ?>" > &nbsp;&nbsp; <input type="submit" value="商品名変更">
                            <input type="hidden" name="sql_kind" value="update_item_name">
                            <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                        </form>
                    </th>
                    <th>
                        <form method="post">
                            <input type="text" class="input_text_width text_align_right" name="update_price" value="<?php print $value['price']; ?>">円&nbsp;&nbsp;<input type="submit" value="価格変更">
                            <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                            <input type="hidden" name="sql_kind" value="update_price">
                        </form>
                    </th>
                    <th>
                        <form method="post">
                            <input type="text" class="input_text_width text_align_right" name="update_stock" value="<?php print $value['stock']; ?>">個&nbsp;&nbsp;<input type="submit" value="在庫変更">
                            <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                            <input type="hidden" name="sql_kind" value="update_stock">
                        </form>
                    </th>
                    <th>
                        <form method="post">
                            <input type="submit" value="データ削除">
                            <input type="hidden" name="sql_kind" value="delete">
                            <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                        </form>
                    </th>
                    <th>
                        <?php if ( $value['status'] === '1' ) { ?>
                        <form method="post">
                            <input type="submit" value="公開→非公開">
                            <input type="hidden" name="sql_kind" value="change">
                            <input type="hidden" name="change_status" value="0">
                            <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                        </form>

                        <?php } elseif ( $value['status'] === '0' ) { ?>
                        <form method="post">
                            <input type="submit" value="非公開→公開">
                            <input type="hidden" name="sql_kind" value="change">
                            <input type="hidden" name="change_status" value="1">
                            <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                        </form>

                    </th>
                </tr>

                <?php  } } ?>
        </table>
    </section>
</body>
</html>