<?php

class dbread
{
    /**
     * @return int
     */
    public function countUncompletedReportList(){
        global $conn;
        $sql = "SELECT id FROM report WHERE testData=''";
        $result = $conn->query($sql);
        return $result->num_rows;
    }

    /**
     * @return int
     */
    public function countCompletedReportList(){
        global $conn;
        $sql = "SELECT id FROM report WHERE testData!=''";
        $result = $conn->query($sql);
        return $result->num_rows;
    }

    /**
     * @param $keywords
     * @return int
     */
    public function countFindReportList($keywords){
        global $conn;
        $sql = "SELECT id FROM report WHERE $keywords";
        $result = $conn->query($sql);
        return $result->num_rows;
    }

    /**
     * @param $limitStart
     * @param $limit
     * @return array
     */
    public function getUncompletedReportList($limitStart, $limit){
        $limitStart -=1;
        global $conn;
        $sql = "SELECT id, rDt, client, clientRef, crDt, supplier, meRef, mrDt, pumpType, discharge, head, pumpSn, motorSn FROM report WHERE testData='' LIMIT $limitStart, $limit";
        $result = $conn->query($sql);
        $data_stuck = [];
        for ($i = 0; $i < $result->num_rows; $i++){
            $data_stuck[] = $result->fetch_assoc();
        }
        $finalData = array("totalData"=>$this->countUncompletedReportList(),"data"=>$data_stuck);
        return $finalData;
    }

    /**
     * @param $limitStart
     * @param $limit
     * @return array
     */
    public function getCompletedReportList($limitStart, $limit){
        $limitStart -=1;
        global $conn;
        $sql = "SELECT id, rDt, tDtTm, client, clientRef, crDt, supplier, meRef, mrDt, pumpType, discharge, head, pumpSn, motorSn FROM report WHERE testData!='' LIMIT $limitStart, $limit";
        $result = $conn->query($sql);
        $data_stuck = [];
        for ($i = 0; $i < $result->num_rows; $i++){
            $data_stuck[] = $result->fetch_assoc();
        }
        $finalData = array("totalData"=>$this->countCompletedReportList(),"data"=>$data_stuck);
        return $finalData;
    }

    /**
     * @param $limitStart
     * @param $limit
     * @param $keywords
     * @return array
     */
    public function searchReportList($limitStart, $limit, $keywords){
        $limitStart -=1;
        global $conn;
        $sql = "SELECT id, rDt, tDtTm, client, clientRef, crDt, supplier, meRef, mrDt, pumpType, discharge, head, pumpSn, motorSn FROM report WHERE $keywords LIMIT $limitStart, $limit";
        $result = $conn->query($sql);
        $data_stuck = [];
        for ($i = 0; $i < $result->num_rows; $i++){
            $data_stuck[] = $result->fetch_assoc();
        }
        $finalData = array("totalData"=>$this->countFindReportList($keywords),"data"=>$data_stuck);
        return $finalData;
    }

    public function getReport($id){
        global $conn;
        $sql = "SELECT * FROM report WHERE id=$id";
        $result = $conn->query($sql);
        $data = array();
        if ($result->num_rows > 0){
            $data = $result->fetch_assoc();
        }
        $finalData = array("totalData"=>1,"data"=>$data);
        return $finalData;
    }
}


