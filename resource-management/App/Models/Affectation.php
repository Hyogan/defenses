<?php

namespace App\Models;

use Core\Model;
use Core\Database;

class Affectation extends Model {
    protected static $table = 'affectation';

    public static function getAll() {
        $db = Database::getInstance();
        // $sql = "
        //   SELECT 
        //   a.*,
        //   s.nom as nom_service,
        //   m.nom as nom_materiel,
        //   l.nom as nom_labo, l.numero as num_labo
        //   FROM affectation a
        //   JOIN services as s ON s.id_service=a.id_service
        //   JOIN laboratoires as l ON l.id_laboratoire=a.id_laboratoire
        //   JOIN materiels as m ON m.id_materiel=a.id_materiel
        // ";
        $sql = "SELECT 
                a.*,
                s.nom as nom_service,
                m.nom as nom_materiel,
                l.nom as nom_labo, l.numero as num_labo
                FROM affectation a
                LEFT JOIN services s ON s.id_service = a.id_service
                LEFT JOIN laboratoires l ON l.id_laboratoire = a.id_laboratoire
                LEFT JOIN materiels m ON m.id_materiel = a.id_materiel";
        return $db->fetchAll($sql);
    }

    public static function getById($id) {
        $db = Database::getInstance();
        return $db->fetch("SELECT * FROM affectation WHERE id_affectation = ?", [$id]);
    }

    public static function add($data) {
        $db = Database::getInstance();
        $query = "INSERT INTO affectation (id_materiel, id_laboratoire, id_service, date_fin_affectation) VALUES (?, ?, ?, ?)";
        $params = [
            $data['id_materiel'],
            $data['id_laboratoire'],
            $data['id_service'],
            $data['date_fin_affectation']
        ];
        return $db->query($query, $params);
    }

    public static function update($id, $data) {
        $db = Database::getInstance();
        $query = "UPDATE affectation SET id_materiel = ?, id_laboratoire = ?, id_service = ?, date_fin_affectation = ? WHERE id_affectation = ?";
        $params = [
            $data['id_materiel'],
            $data['id_laboratoire'],
            $data['id_service'],
            $data['date_fin_affectation'],
            $id
        ];
        return $db->query($query, $params);
    }

    public static function delete($id) {
        $db = Database::getInstance();
        return $db->query("DELETE FROM affectation WHERE id_affectation = ?", [$id]);
    }
}
?>
