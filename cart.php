<?php
session_start();

if (isset($_POST["itemId"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $itemId = $_POST;
    if (isset($_SESSION["cart"])) {
        if (!function_exists("array_column")) {

            function array_column($array, $column_name)
            {

                return array_map(function ($element) use ($column_name) {
                    return $element[$column_name];
                }, $array);
            }
        }

        $itemIdArray = array_column($_SESSION["cart"], "itemId");
        $count = count($_SESSION["cart"]);

        if (in_array($itemId, $itemIdArray)) {

            $data = array(
                "status" => 403,
                "message" => "Item already in Cart"
            );
        } else {

            $item = array("itemId" => $itemId);
            $_SESSION["cart"][$count] = $item;
            $count = count($_SESSION["cart"]);
            $data = array(
                "status" => 200,
                "message" => "Item added",
                "count" => $count
            );
        }
    } else {
        $item = array("itemId" => $itemId);
        $_SESSION["cart"][0] = $item;

        $data = array(
            "status" => 200,
            "message" => "Item added",
            "count" => 1
        );
    }
    echo json_encode($data);
}