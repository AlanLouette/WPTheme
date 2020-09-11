<?php
function montheme_supports()
{

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails'); // Permet à notre thème de supporter les images pour illustrer les articles
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
}

function montheme_register_asset()
{
    wp_register_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'); // On va chercher le style
    wp_register_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', ['popper', 'Jquery'], false, true); // On va chercher le script. Pour fonctionner il a besoin de Popper et Jquery
    wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', [], false, true);
    wp_deregister_script('Jquery'); // On enlève la version Jquery de base de Wordpress
    wp_register_script('Jquery', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', [], false, true); // Notre Jquery. Pas de dépendance, false car pas de version, true pour le footer
    wp_enqueue_style('bootstrap'); // Permet de rajouter un style qu'on a préalablement défini
    wp_enqueue_script('bootstrap');
}

function montheme_title_separator()
{
    return '|'; // On remplace le "-" dans le titre par "|"
}

function montheme_title_parts($title)
{
    return $title;
}


function montheme_menu_class($classes)
{
    $classes[] = 'nav-item';
    return $classes;
}

function montheme_menu_link_class($attrs)
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}


add_action('after_setup_theme', 'montheme_supports');
add_action('wp_enqueue_scripts', 'montheme_register_asset');  // WP_enqueue_scripts sert à lancer quand les scripts et styles sont en attentes.
add_filter('document_title_separator', 'montheme_title_separator'); // On sélectionne le séparateur dans le titre 
add_filter('document_title_parts', 'montheme_title_parts');
add_filter('the_content_more_link', 'modify_read_more_link');
add_filter('nav_menu_css_class', 'montheme_menu_class');
add_filter('nav_menu_link_attributes', 'montheme_menu_link_class');
