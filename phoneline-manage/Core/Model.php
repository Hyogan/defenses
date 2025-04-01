<?php
namespace Core;

use Core\Database;

class Model {
    protected static $table;
    protected static $db;
    protected static $where = [];


    public function __construct() {
        // Initialiser la connexion à la base de données
        if(self::$db === null){
          self::$db = Database::getInstance();
      }
    }

    public static function all($limit = 10, $offset = 0) {
        $table = static::$table;
        return self::$db->fetchAll("SELECT * FROM {$table} LIMIT ? OFFSET ?", [$limit, $offset]);
    }

    /**
     * Trouver un enregistrement par son ID
     */
    public static function find($id) {
        $table = static::$table;
        return self::$db->fetch("SELECT * FROM {$table} WHERE id = ?", [$id]);
    }

    /**
     * Créer un nouvel enregistrement
     */
    public static function create($data) {
        $table = static::$table;
        
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $db = Database::getInstance();

        $db->query($sql, array_values($data));
        return self::$db->getConnection()->lastInsertId();
    }

    public static function Count() 
    {
      $db = Database::getInstance();
      $table = static::$table;
      $sql = "SELECT COUNT(*) FROM $table";
      $stmt = $db->query($sql); 
      $count = $stmt->fetchColumn();
      return (int) $count; 
       
    }

    /**
     * Mettre à jour un enregistrement
     */
    

    public static function update($id, $data) {
        $table = static::$table;
        // Vérifier si l'élément existe
        $existing = self::find($id);
        if (!$existing) {
            return false; // Retourner false si l'enregistrement n'existe pas
        }
    
        // Sinon, procéder à la mise à jour
        $setParts = [];
        $values = [];
        foreach ($data as $column => $value) {
            $setParts[] = "{$column} = ?";
            $values[] = $value;
        }
        $setClause = implode(', ', $setParts);
        $values[] = $id;
        $sql = "UPDATE {$table} SET {$setClause} WHERE id = ?";
        return self::$db->query($sql, $values);
    }
    

    /**
     * Supprimer un enregistrement
     */
    public static function delete($id) {
        $table = static::$table;
        // Vérifier si l'enregistrement existe
        $existing = self::find($id);
        if (!$existing) {
            return false; // Retourner false si l'enregistrement n'existe pas
        }
    
        return self::$db->query("DELETE FROM {$table} WHERE id = ?", [$id]);
    }


    public static function where($column, $operator, $value = null) {
      if (func_num_args() == 2) {
          $value = $operator;
          $operator = '=';
      }
      self::$where[] = [$column, $operator, $value];
      // dd(self::$where);
      return new static();
  }

  public static function get() {
      $table = static::$table;
      $sql = "SELECT * FROM {$table}";
      $values = [];
      if (empty(self::$where)) {
        // ... your existing code ...
    }

      if (!empty(self::$where)) {
          $whereClauses = [];
          foreach (self::$where as $clause) {
              $whereClauses[] = "{$clause[0]} {$clause[1]} ?";
              $values[] = $clause[2];
          }
          $sql .= " WHERE " . implode(' AND ', $whereClauses);
      }
      // dd([$sql, $values]);

      self::$where = []; // Reset where clause

      return self::$db->fetchAll($sql, $values);
  }

}

