<!DOCTYPE html>
<html lang="ja">
   <head>
     <meta charset="UTF-8">
     <title>映画飯</title>
     <link rel="stylesheet" href="html5reset-1.6.1.css">
     <link rel="stylesheet" href="topmenu.css">
   
  <title>自動販売機</title>
  <style>
    section {
      margin-bottom: 20px;
      border-top: solid 1px;
    }

    table {
      width: 660px;
      border-collapse: collapse;
    }

    table, tr, th, td {
      border: solid 1px;
      padding: 10px;
      text-align: center;
    }

    caption {
      text-align: left;
    }

    .text_align_right {
      text-align: right;
    }

    .item_name_width {
      width: 100px;
    }

    .input_text_width {
      width: 60px;
    }
  </style>
</head>
<body>
<?php if (empty($result_msg) !== TRUE) { ?>
  <p><?php print $result_msg; ?></p>
<?php } ?>
<?php foreach ($err_msg as $value) { ?>
  <p><?php print $value; ?></p>
<?php } ?>
  <h1>自動販売機管理ツール</h1>
  <section>
    <h2>新規商品追加</h2>
    <form method="post" enctype="multipart/form-data">
      <div><label>名前: <input type="text" name="new_name" value=""></label></div>
      <div><label>値段: <input type="text" name="new_price" value=""></label></div>
      <div><label>個数: <input type="text" name="new_stock" value=""></label></div>
      <div><input type="file" name="new_img"></div>
      <input type="hidden" name="sql_kind" value="insert">
      <div><input type="submit" value="商品を追加"></div>
    </form>
  </section>
  <section>
    <h2>商品情報変更</h2>
    <table>
      <caption>商品一覧</caption>
      <tr>
        <th>商品画像</th>
        <th>商品名</th>
        <th>価格</th>
        <th>在庫数</th>
      </tr>
<?php foreach ($data as $value)  { ?>
      <tr>
        <form method="post" enctype="multipart/form-data">  
        <td>
         <img src="<?php print $img_dir . $value['img'];  ?>"</td>
        <input type="file" class="input_file_width file_align_right" name="update_img" img src="<?php print $img_dir . $value['img']; ?>"</td>
          <input type="hidden" name="sql_kind" value="update_img">
          <input type= "hidden" name="item_id" value="<?php print $value['item_id']; ?>">
            <div><input type="submit" value="画像を変更"></div>
         
       </form>
      
        <form method="post">
        <td class="item_name_width">
          <input type="text" class="input_text_width text_align_right" name="update_item_name" value="<?php print $value['item_name']; ?>"> &nbsp;&nbsp; <input type="submit"  value= "変更" ></td>
          <input type="hidden" name="sql_kind" value="update_item_name">
          <input type= "hidden" name="item_id" value="<?php print $value['item_id']; ?>">
         </form>
         <form method="post">
          <td><input type="text" class="input_text_width text_align_right" name="update_price" value="<?php print $value['price']; ?>">円&nbsp;&nbsp;<input type="submit"  value="変更" ></td>
            <input type= "hidden" name="item_id" value="<?php print $value['item_id']; ?>">
            <input type="hidden" name="sql_kind" value="update_price">
        </form>
        <form method="post">
          <td><input type="text" class="input_text_width text_align_right" name="update_stock" value="<?php print $value['stock']; ?>">個&nbsp;&nbsp;<input type="submit" value="変更"></td>
          <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
           <input type="hidden" name="sql_kind" value="update_stock">
        </form>
      <tr>
<?php } ?>
    </table>
  </section>
</body>
</html>
