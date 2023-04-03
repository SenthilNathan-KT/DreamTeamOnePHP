<?php
session_start();
/////////////////////////// CART FUNCTIONS ///////////////////////////
function addToCart($bp_id)
{
    // if the cart is not set, we create it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // add the product to the cart
    if (!array_key_exists($bp_id, $_SESSION['cart'])) {
        $_SESSION['cart'][$bp_id] = 1;
    } else {
        $_SESSION['cart'][$bp_id]++;
    }
}

function modifyCart($bp_id, $quantity)
{
    // if the cart is not set, we create it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // add the product to the cart
    $_SESSION['cart'][$bp_id] = $quantity;
}

function getCountForProduct($bp_id)
{
    // if the cart is not set, we create it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // add the product to the cart
    if (array_key_exists($bp_id, $_SESSION['cart'])) {
        return $_SESSION['cart'][$bp_id];
    } else {
        return 0;
    }
}