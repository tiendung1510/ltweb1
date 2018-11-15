<?php 
  require_once "provider/Provider.php";
  require_once "core/Config.php";

  class ProductService{

    private static $ITEM_PER_PAGE;

    static function init(){
      self::$ITEM_PER_PAGE = Config::getValue("product")["itemPerPage"];
    }

    static function getAll(int $page = 1){
      $sql = SqlBuilder::from('product')
        ->select();

      return Provider::paginate('product_id', $page, self::$ITEM_PER_PAGE, $sql);
    }

    static function topSold(int $top = 10){
      $sql = SqlBuilder::from('product')
        ->order('sold desc')
        ->limit(10)
        ->select()
        ->build();
      
      return Provider::select($sql);
    }

    static function topView(int $top = 10){
      $sql = SqlBuilder::from('product')
        ->order('view desc')
        ->limit(10)
        ->select()
        ->build();
      
      return Provider::select($sql);
    }

    static function getByBranch(string $branch_id, int $page = 1){
      $sql = SqlBuilder::from('product')
        ->where("branch_id = $branch_id")
        ->select();
      
      return Provider::paginate('product_id', $page, self::$ITEM_PER_PAGE, $sql);
    }

    static function getByCategory(string $cate_id, int $page = 1){
      $sql = SqlBuilder::from('product')
        ->where("category_id = $category_id")
        ->select();
      
      return Provider::paginate('product_id', $page, self::$ITEM_PER_PAGE, $sql);
    }
  }

  ProductService::init();
?>