<?php 

$taxonomy=[
    "categories"=>"Catégories",
    "formats"=>"Formats",
    "annees"=>"Trier Par"
];

echo "<section>";
echo "<div class='child1'>";
echo "<select id='select_category'>";
echo "</div>";

echo "<div class='child2'>";
echo "<select id='select_annee'>";
echo "<option value=''>{$taxonomy['annees']}</option>";
echo "<option value='date_asc'>plus récent</option>";
echo "<option value='date_desc'>plus ancien</option>";
echo "</select>";
echo "</div>";

echo "</section>";