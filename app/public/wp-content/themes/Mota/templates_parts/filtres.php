<?php 

$taxonomy = [
    "categories" => "CATÉGORIES",
    "formats" => "FORMATS",
    "annees" => "TRIER PAR"
];

echo "<div class='conteneur_filtres'>";
echo "<div class='filtres'>";

function afficherSelectTaxonomie($id, $name, $label, $afficherTaxonomiesCallback = null) {
    echo "<div class='filtre'>";
    echo "<section id='$id' class='js-filter-form filtre colonne'>";
    echo "<select id='select-$id' name='$name' class='custom-select'>";
    echo "<option value='all' hidden></option>";
    echo "<option value='all' selected>$label</option>";
    if ($afficherTaxonomiesCallback) {
        $afficherTaxonomiesCallback($name);
    }
    echo "</select>";
    echo "</section>";
    echo "</div>";
}

// Affichage des filtres de taxonomies
afficherSelectTaxonomie('categories', 'categorie', $taxonomy['categories'], 'afficherTaxonomies');
afficherSelectTaxonomie('formats', 'format', $taxonomy['formats'], 'afficherTaxonomies');

// Filtre par date
echo "<div class='filtre filtre-trier-par'>";
echo "<section id='annees' class='js-filter-form filtre colonne'>";
echo "<select id='select-annee' name='annee' class='custom-select'>";
echo "<option value='all'>{$taxonomy['annees']}</option>";
echo "<option value='date_asc'>plus récent</option>";
echo "<option value='date_desc'>plus ancien</option>";
echo "</select>";
echo "</section>";
echo "</div>";

echo "</div>";
echo "</div>";
