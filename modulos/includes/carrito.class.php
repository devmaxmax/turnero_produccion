<?
if (!defined('IN_SITE')){
  die('Hacking attempt');
}

class carrito {

  public $id;

  function __construct($id = 0)
  {
    $this->id = $id;
  }


  function add ($idproducto,  $cantidad = 0)
  {
    $result = sql_query ("SELECT COUNT(*) as count FROM carrito
                           WHERE idcarrito ='".$this->id."' AND idproducto ='$idproducto'", true);
                           
    if( empty($result['count']) )
    {
      $query = "INSERT INTO carrito (idcarrito, idproducto, time, cantidad)
                VALUES('$this->id', '$idproducto', '".time()."', '$cantidad')";
    }
    else
    {
      $query = "UPDATE carrito SET time = '".time()."', cantidad = cantidad + 1
                WHERE idcarrito = '".$this->id."' AND idproducto = '$idproducto' LIMIT 1";
    }
    mysql_query($query);
  }

  function delete($idproducto)
  {
    @mysql_query("DELETE FROM carrito WHERE idcarrito = '".$this->id."' AND idproducto IN ($idproducto)");
  }

  function deleteAll()
  {
    @mysql_query("DELETE FROM carrito WHERE idcarrito = '$this->id'");
  }

  function update($idproducto, $cantidad = 0)
  {
    if($cantidad == 0) {
      
    } else {
      @mysql_query("UPDATE carrito SET time = '".time()."', cantidad = '$cantidad'
                    WHERE idcarrito = '".$this->id."' AND idproducto = '$idproducto' LIMIT 1");
    }
  }
  
  function getItems()
  {
    $items = sql_query ("SELECT a.id, a.idcategoria, a.titulo, a.marca, a.idfoto, cr.cantidad 
                          FROM carrito cr
                          INNER JOIN art a ON cr.idproducto = a.id
                          WHERE cr.idcarrito = '$this->id'
                          ORDER BY a.id ASC");
    return $items;
  }

  function counts() {
    $result = sql_query ("SELECT COUNT(*) as count FROM carrito
                           WHERE idcarrito ='".$this->id."'", true);
    return intval($result['count']);
  }
}
?>
