<?php
  $page_title = 'Add Sale';
  require_once('includes/load.php');
  //require_once('includes/database.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
 
  if(isset($_POST['add_sale'])){
    // $req_fields = array('s_id','quantity','price','total', 'date' );
     $req_fields = array('quantity','price','total', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$_POST['s_id']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = make_date();

          $sql  = "INSERT INTO sales (";
          $sql .= " product_id,qty,price,date";
          $sql .= ") VALUES (";
          $sql .= "'{$p_id}','{$s_qty}','{$s_total}','{$s_date}'";
          $sql .= ")";

                if($db->query($sql)){
                  update_product_qty($s_qty,$p_id);
                  $session->msg('s',"Sale added. ");
                  redirect('add_sale.php', false);
                } else {
                  $session->msg('d',' Sorry failed to add!');
                  redirect('add_sale.php', false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('add_sale.php',false);
        }
  }
?>
<?php include_once('layouts/header.php');  ?>

<div class="row">
  <div class="col-md-5">
    <div class = "panel panel-default">
      <?php echo display_msg($msg); ?>
    
          
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Sales</span>
         </strong>
        </div>

        
        <div class="form-group">
        <form method="post" action="add_sale.php" class= "clearfix">


        <input type="text"  id="sug_product" class="form-control" name="product_name"  placeholder=" Product Name">
        <break>
        <input type="number" min="0" id="sug_quantity" class="form-control" name="quantity"  placeholder=" Product Quantity">
        <break>
        <input type="number" min="0" id="sug_input" class="form-control" name="total"  placeholder="Total">
        <break>
        <input type="date" id="sug_input" class="form-control" name="date"  placeholder=" ">
          <div class="input-group">
            <br/>
            &nbsp;
            <button type="submit" class="btn btn-primary" name="add_sale">Save</button>
            
            <!-- <span class="input-group-btn">
              <button type="submit" class="btn btn-primary" name="add_sale">Save</button>
            </span> -->
           <!-- <input type="text" id="sug_input" class="form-control" name="title"  placeholder="Search for product name"> -->
        </div>
          <div id="result" class="list-group"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
<div class="row">


</div>

<?php include_once('layouts/footer.php'); ?>
