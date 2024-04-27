<?php

class Merk extends DB
{
    function getMerk()
    {
        $query = "SELECT * FROM merk";
        return $this->execute($query);
    }

    function getMerkById($id)
    {
        $query = "SELECT * FROM merk WHERE merk_id=$id";
        return $this->execute($query);
    }

    function addMerk($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO merk VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateMerk($id, $data)
    {
        // ...
    }

    function deleteMerk($id)
    {
        $query = "DELETE FROM merk WHERE merk_id = '$id';";
        return $this->executeAffected($query);
    }
}
