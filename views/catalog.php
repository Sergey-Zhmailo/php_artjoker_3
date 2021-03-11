<div class="catalog-wrapper">
    <h1>Catalog</h1>
    <ul>
        <?php foreach($products as $product){ ?>
            <li><span><?php echo $product['title'] . ' - ' . $product['price'] . 'грн';?></span></li>
        <?php } ?>
    </ul>

</div>

