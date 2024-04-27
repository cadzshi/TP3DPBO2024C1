<?php

class Jenis extends DB
{
    function getJenis()
    {
        $query = "SELECT * FROM jenis";
        return $this->execute($query);
    }

    function getJenisById($id)
    {
        $query = "SELECT * FROM jenis WHERE jenis_id=$id";
        return $this->execute($query);
    }

    function addJenis($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO jenis VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateJenis($id, $data)
    {
        // ...
    }

    function deleteJenis($id)
    {
        $query = "DELETE FROM jenis WHERE jenis_id = '$id';";
        return $this->executeAffected($query);
    }
}
