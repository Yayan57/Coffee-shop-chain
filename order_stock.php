<?php 
  include('includes/header.php');

  function Print_Stock(){
    echo "stock item";
    echo $item_amount
}
?>

<div>
<h1>
    Order Stock
</h1>
    <a href = "#stock"> table containing stock </a>
    <?php 
    foreach ($item as $stock){
        Print_Stock()
        Order More?
        <input type="radio" name="order"
        <?php if (isset($order) && $order=="yes") echo "checked";?>
            value="yes"> yes
        <input type="radio" name="order"
        <?php if (isset($order) && $order=="no") echo "checked";?>
            value="no"> no
        if (value = "yes"){
            echo "how many should be ordered?"
            Order_Number: <input type="number" name="O_N" value="<?php echo $O_N;?>" >
            echo $O_N + $item + "ordered."
            $item_amount = $item_amount + $O_N
        }
        
    }
    ?>
</div>


 
<?php 
  include('includes/footer.php');
?>