<?php
/*
 * A view of the product catalogue, with a select widget for product
 * category and a table of products in the currently-selected
 * category.
 * 
 * Input params: $categoryMap - an associative array mapping from category ID
 *                         to category name
 *               $productMap - an associative array mapping from product ID
 *                         to product name for all products in the current
 *                         category.
 *               $product - the currently selected product, an instance
 *                         of the model class Product. The ID and category
 *                         of this product tell us the currently selected
 *                         productId and categoryId.
 * 
 */

define('COMBO_SIZE', 10);  // Number of lines to display

/*
 * Return the HTML for a div containing a label, a combo box and a 'go'
 * button. 
 * @param string $label - text to display as a label
 * @param assoc-array $map - a map from value to name
 * @param int $selectedRowValue - the value of the currently-selected option
 * @param int $size - the number of elements to display
 * @return - an html string for display
 */
function comboBoxHtml($label, $map, $selectedRowValue, $size=1) {
    $html = "<div class='combobox'><span class='combo-label'>$label:</span> ";
    $html .= "<select id='$label' name='$label' size='$size'>";
    foreach ($map as $id => $name) {
        if ($id === intval($selectedRowValue)) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        $html .= "<option value='$id' $selected>$name</option>\n";
    }
    $html .= "</select>\n";
    $html .= "<input type='submit' name='$label-submit' value='Go'>\n";
    $html .= "</div>";
    return $html;
}

?>
<h1>Northwind Product Browser</h1>

<div class='product-browser'>
    <form id="browser-form" action="<?php echo site_url('products/browser'); ?>" method="get">
        <?php
        echo comboBoxHtml('Category', $categoryMap, $product->categoryID, COMBO_SIZE);
        echo comboBoxHtml('Product',  $productMap,  $product->id, COMBO_SIZE);
        ?>
        <div class='product-details'>
        <h2>Product Details</h2>
        <table id='ProductDetails'>
            <?php foreach ((array) $product as $field => $value) { ?>
                <tr>
                    <td><?php echo $field; ?></td>
                    <td><?php echo $value; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        </div>
    </form>
</div>

