<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

  <div class="container" style="margin-top: 20px;">
    <div class="row">
      <div class="col-12">
        <form method="POST">
          <div class="form-group">
            <input type="text" placeholder="Client Name" name="name" value="<?php if (isset($_POST['name'])) {
                                                                              echo $_POST['name'];
                                                                            } ?>" class="form-control" id="exampleInputtext" aria-describedby="textHelp">
          </div>

          <div class="form-group">
            <select name="city" class="form-control">
              <option value="cairo" <?php if (isset($_POST['city']) && $_POST['city'] == 'cairo') { ?> selected='selected' <?php } ?>>Cairo</option>
              <option value="giza" <?php if (isset($_POST['city']) && $_POST['city'] == 'giza') { ?> selected='selected' <?php } ?>>Giza</option>
              <option value="alex" <?php if (isset($_POST['city']) && $_POST['city'] == 'alex') { ?> selected='selected' <?php } ?>>Alex</option>
              <option value="others" <?php if (isset($_POST['city']) && $_POST['city'] == 'others') { ?> selected='selected' <?php } ?>>Others</option>
            </select>
          </div>

          <div class="form-group">
            <input type="number" name="products_num" value="<?php if (isset($_POST['products_num'])) {
                                                              echo $_POST['products_num'];
                                                            } ?>" placeholder="Number of Products" class="form-control" id="exampleInputtext">
          </div>

          <button type="submit" name="enter" class="btn btn-danger form-control"> Enter Products </button>

          <?php if (isset($_POST['enter'])) {
            $i;
          ?>
            <div class="container">
              <table class="table text-center">
                <thead>
                  <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($i = 0; $i < $_POST['products_num']; $i++) { ?>
                    <tr>
                      <td><input type="text" name="products<?php echo $i ?>" class="form-control"></td>
                      <td><input type="text" name="price<?php echo $i ?>" class="form-control"></td>
                      <td><input type="number" name="quantity<?php echo $i ?>" class="form-control"></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <button type="submit" name="calc" class="btn btn-danger form-control"> Calculate </button>
            </div>
          <?php } ?>

          <div class="container">
            <table class="table text-center" style="font-size: 18px;">
              <?php
              if (isset($_POST['calc'])) { ?>
                <thead>
                  <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Sub Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sum = 0;
                  for ($i = 0; $i < $_POST['products_num']; $i++) { ?>
                    <tr>
                      <td> <?php echo $_POST['products' . $i] ?> </td>
                      <td> <?php echo $_POST['price' . $i] ?> </td>
                      <td> <?php echo $_POST['quantity' . $i] ?> </td>
                      <td> <?php echo ($sub_total = $_POST['price' . $i] * $_POST['quantity' . $i]) ?> </td>
                    </tr>
                  <?php
                    $sum += $sub_total;
                    $total_price = $sum;
                  } ?>

                  <?php
                  if ($total_price < 1000) {
                    $discountfees = $total_price * 1;
                  }
                  if ($total_price >= 1000 && $total_price < 3000) {
                    $discountfees = $total_price * 0.1;
                  }
                  if ($total_price >= 3000 && $total_price < 4500) {
                    $discountfees = $total_price * 0.15;
                  }
                  if ($total_price > 4500) {
                    $discountfees = $total_price * 0.2;
                  }
                  $priceafterdiscount = $total_price - $discountfees;
                  ?>

                  <?php if ($_POST['city'] == 'cairo') {
                    $fees = 0 . ' EGP';
                  }
                  if ($_POST['city'] == 'giza') {
                    $fees = 30 . ' EGP';
                  }
                  if ($_POST['city'] == 'alex') {
                    $fees = 50 . ' EGP';
                  }
                  if ($_POST['city'] == 'others') {
                    $fees = 100 . ' EGP';
                  } ?>
                  <?php $nettotal = $priceafterdiscount + $fees; ?>
                  <?php
                  $bill = [
                    'Client name' => $_POST['name'],
                    'City' => $_POST['city'],
                    'Total' => $sum,
                    'Discount' => $discountfees,
                    'Delivery' => $fees,
                    'Total after Discount' => $priceafterdiscount
                  ]; ?>
                  <?php
                  foreach ($bill as $key => $value) { ?>
                    <tr>
                      <th><?php echo $key ?></th>
                      <td> <?php echo $value ?> </td>
                      <td></td>
                      <td></td>
                    </tr>
                  <?php } ?>
                  <tr>
                    <th style="color: red;">Net Total</th>
                    <td></td>
                    <td></td>
                    <td style="color: red;font-weight:bold;"><?php echo $nettotal ?></td>
                  </tr>
                <?php } ?>
                </tbody>
            </table>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>