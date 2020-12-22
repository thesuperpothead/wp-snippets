<?php
global $wpdb;

/*
 * Find cross of two taxonomies.
 * For one tax it's a tax term
 * For another all not empty terms
 */
$query = "SELECT tr.object_id FROM $wpdb->term_relationships tr
          LEFT JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id=tt.term_taxonomy_id WHERE tt.taxonomy='product_cat' AND term_id=".$cat->term_id;
$cat_posts = $wpdb->get_col($query);

$query = "SELECT tt.term_taxonomy_id FROM $wpdb->term_taxonomy tt 
          LEFT JOIN $wpdb->term_relationships tr ON tr.term_taxonomy_id=tt.term_taxonomy_id WHERE tt.taxonomy='collection'
          AND tr.object_id IN (".implode(",", $cat_posts).")";
$res = $wpdb->get_col($query);
if (empty($res)) $res = [0,1]; // if empty we still need to pass not empty array

$collections = get_terms([
  'taxonomy' => 'collection',
  'include'  => $res
]);
