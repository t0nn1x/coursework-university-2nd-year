<?php

namespace models;

use core\Core;
use core\Utils;

class Product
{
    protected static $tableName = 'product';

    public static function addProduct($row)
    {
        $fieldsList = [
            'name',
            'category_id',
            'price',
            'count',
            'short_description',
            'description',
            'visible'
        ];
        $row = Utils::filterArray($row, $fieldsList);
        Core::getInstance()->db->insert(self::$tableName, $row);
    }

    public static function deleteProduct($id)
    {
        Core::getInstance()->db->delete(self::$tableName, [
            'id' => $id
        ]);
    }

    public static function updateProduct($id, $newRow)
    {
        $fieldsList = [
            'name',
            'category_id',
            'price',
            'count',
            'short_description',
            'description',
            'visible'
        ];
        $newRow = Utils::filterArray($newRow, $fieldsList);
        Core::getInstance()->db->update(self::$tableName, $newRow, [
            'id' => $id
        ]);
    }

    public static function getProductById($id)
    {
        $row = Core::getInstance()->db->select(self::$tableName, '*', [
            'id' => $id
        ]);
        if (!empty($row)) {
            return $row[0];
        } else {
            return null;
        }
    }

    public static function getProducts()
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*');
        return $rows;
    }

    public static function getProductsInCategoryId($category_id)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', [
            'category_id' => $category_id
        ]);
        return $rows;
    }

    public static function isProductExists($id)
    {
        $row = self::getProductById($id);
        return !empty($row);
    }

    public static function searchProducts($search)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', [
            'name[~]' => $search
        ]);
        return $rows;
    }

    public static function getAllProducts()
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*');
        return $rows;
    }
}
