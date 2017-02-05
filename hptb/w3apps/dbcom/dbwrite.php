<?php

class dbwrite
{
    /**
     * @param $data
     * @return bool|mysqli_result
     */
    public function insertReport($data){
        $fields = "";
        $values = "";
        foreach ($data as $key=>$val){
            if ($fields != "") {
                $fields .= ", ";
                $values .= ", ";
            }
            $fields .= $key;
            $values .= "'$val'";
        }
        global $conn;
        $sql = "INSERT INTO report ($fields) VALUES ($values)";
        return $conn->query($sql);
    }

    /**
     * @param $id
     * @param $data
     * @return bool|mysqli_result
     */
    public function updateReportData($id, $data){
        $fieldsValues = "";
        foreach ($data as $key=>$val){
            if ($fieldsValues != "") {
                $fieldsValues .= ", ";
            }
            $fieldsValues .= "$key='$val'";
        }
        global $conn;
        $sql = "UPDATE report SET $fieldsValues WHERE id=$id";
        return $conn->query($sql);
    }

    /**
     * @param $id
     * @return bool|mysqli_result
     */
    public function deleteReport($id){
        global $conn;
        $sql = "DELETE FROM report WHERE id=$id";
        return $conn->query($sql);
    }
}