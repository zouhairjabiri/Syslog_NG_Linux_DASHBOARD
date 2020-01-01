<?php

class syslog extends helperUtils {

    public function new_tables_check () {
        $current_db_tables = DB::tableList();
        for ($i=0; $i<count($current_db_tables); $i++) {
            $query = DB::query("SHOW COLUMNS FROM " . $current_db_tables[$i]);
            if ($query[0]['Field'] != 'id') {
                DB::query("ALTER TABLE `" . $current_db_tables[$i] . "` ADD `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`)");
            }
        }
    }

    public function build_queries ($hostquery, $offset, $limit, $startdate, $enddate, $searchstring, $level) {
        if ($startdate == NULL && $enddate == NULL && $searchstring == NULL && $level == NULL) {
            $query = DB::query("SELECT * FROM $hostquery LIMIT $offset,$limit");
            $querycount = DB::query("SELECT COUNT(*) FROM $hostquery");
            $queries = array($query, $querycount);
            return $queries;
        } elseif ($startdate == NULL && $enddate == NULL && $searchstring != NULL && $level == NULL) {
            $query = DB::query("SELECT * FROM $hostquery WHERE message LIKE '%$searchstring%' LIMIT $offset,$limit");
            $querycount = DB::query("SELECT COUNT(*) FROM $hostquery WHERE message LIKE '%$searchstring%'");
            $queries = array($query, $querycount);
            return $queries;
        } elseif ($startdate == NULL && $enddate == NULL && $searchstring == NULL && $level != NULL) {
            $query = DB::query("SELECT * FROM $hostquery WHERE level = '$level' LIMIT $offset,$limit");
            $querycount = DB::query("SELECT COUNT(*) FROM $hostquery WHERE level = '$level'");
            $queries = array($query, $querycount);
            return $queries;
        } elseif ($startdate == NULL && $enddate == NULL && $searchstring != NULL && $level != NULL) {
            $query = DB::query("SELECT * FROM $hostquery WHERE message LIKE '%$searchstring%' AND level = '$level' LIMIT $offset,$limit");
            $querycount = DB::query("SELECT COUNT(*) FROM $hostquery WHERE message LIKE '%$searchstring%'");
            $queries = array($query, $querycount);
            return $queries;
        } elseif ($startdate != NULL && $enddate != NULL && $searchstring == NULL && $level == NULL) {
            $query = DB::query("SELECT * FROM $hostquery WHERE datetime >='$startdate' AND datetime <= '$enddate' LIMIT $offset,$limit");
            $querycount = DB::query("SELECT COUNT(*) FROM $hostquery WHERE datetime >='$startdate' AND datetime <= '$enddate'");
            $queries = array($query, $querycount);
            return $queries;
        } elseif ($startdate != NULL && $enddate != NULL && $searchstring != NULL && $level == NULL) {
            $query = DB::query("SELECT * FROM $hostquery WHERE (message LIKE '%$searchstring%') AND (datetime >='$startdate') AND (datetime < '$enddate') LIMIT $offset,$limit");
            $querycount = DB::query("SELECT COUNT(*) FROM $hostquery WHERE (message LIKE '%$searchstring%') AND (datetime >='$startdate') AND (datetime < '$enddate')");
            $queries = array($query, $querycount);
            return $queries;
        } elseif ($startdate != NULL && $enddate != NULL && $searchstring != NULL && $level != NULL) {
            $query = DB::query("SELECT * FROM $hostquery WHERE (message LIKE '%$searchstring%') AND (datetime >='$startdate') AND (datetime < '$enddate') AND (level = '$level') LIMIT $offset,$limit");
            $querycount = DB::query("SELECT COUNT(*) FROM $hostquery WHERE (message LIKE '%$searchstring%') AND (datetime >='$startdate') AND (datetime < '$enddate') AND (level = '$level')");
            $queries = array($query, $querycount);
            return $queries;
        } elseif ($startdate != NULL && $enddate != NULL && $searchstring == NULL && $level != NULL) {
            $query = DB::query("SELECT * FROM $hostquery WHERE (datetime >='$startdate') AND (datetime < '$enddate') AND (level = '$level') LIMIT $offset,$limit");
            $querycount = DB::query("SELECT COUNT(*) FROM $hostquery WHERE (datetime >='$startdate') AND (datetime < '$enddate') AND (level = '$level')");
            $queries = array($query, $querycount);
            return $queries;
        }
    }

    public function paginate($host, $limit, $page, $totalpages, $startdate, $enddate, $searchstring, $level) {
        echo '<div class="w3-container w3-center w3-bar w3-padding">' . "\n";

	if ($host) {
	    $baseurl = '?host=' . $host;
	} 
        if ($startdate && $enddate) {
	    $baseurl = $baseurl . '&startdate=' . $startdate . '&enddate=' . $enddate;
	}
        if ($searchstring) {
	    $baseurl = $baseurl . '&searchstring=' . $searchstring;
        }
        if ($level) {
            $baseurl = $baseurl . '&level=' . $level;
        }
        if ($limit) {
            $baseurl = $baseurl . '&limit=' . $limit;
        }

        if ($page == 1 && ($totalpages - $page) == 0) {
            echo '';
        } elseif ($page == 1 && ($totalpages - $page) == 1) {
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">' . ($page + 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">&RightArrow;</a>' . "\n";
        } elseif ($page == 1 && ($totalpages - $page) == 2) {
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">' . ($page + 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 2) . '" class="w3-button">' . ($page + 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">&RightArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $totalpages . '" class="w3-button">&Rightarrow;</a>' . "\n";
        } elseif ($page == 1 && ($totalpages - $page) == 3) {
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">' . ($page + 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 2) . '" class="w3-button">' . ($page + 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 3) . '" class="w3-button">' . ($page + 3) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">&RightArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $totalpages . '" class="w3-button">&Rightarrow;</a>' . "\n";
        } elseif ($page == 1 && ($totalpages - $page) >= 4) {
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">' . ($page + 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 2) . '" class="w3-button">' . ($page + 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 3) . '" class="w3-button">' . ($page + 3) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 4) . '" class="w3-button">' . ($page + 4) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">&RightArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $totalpages . '" class="w3-button">&Rightarrow;</a>' . "\n";
        } elseif ($page == 2 && ($totalpages - $page) == 0) {
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">&LeftArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">' . ($page - 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
        } elseif ($page == 2 && ($totalpages - $page) == 1) {
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">&LeftArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">' . ($page - 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">' . ($page + 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">&RightArrow;</a>' . "\n";
        } elseif ($page == 2 && ($totalpages - $page) == 2) {
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">&LeftArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">' . ($page - 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">' . ($page + 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 2) . '" class="w3-button">' . ($page + 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">&RightArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $totalpages . '" class="w3-button">&Rightarrow;</a>' . "\n";
        } elseif ($page == 2 && ($totalpages - $page) >= 3) {
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">&LeftArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">' . ($page - 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">' . ($page + 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 2) . '" class="w3-button">' . ($page + 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 3) . '" class="w3-button">' . ($page + 3) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">&RightArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $totalpages . '" class="w3-button">&Rightarrow;</a>' . "\n";
        } elseif ($page == 3 && ($totalpages - $page) == 0) {
            echo '<a href="' . $baseurl . '&page=1" class="w3-button">&Leftarrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">&LeftArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 2) . '" class="w3-button">' . ($page - 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">' . ($page - 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
        } elseif ($page == 3 && ($totalpages - $page) == 1) {
            echo '<a href="' . $baseurl . '&page=1" class="w3-button">&Leftarrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">&LeftArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 2) . '" class="w3-button">' . ($page - 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">' . ($page - 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">' . ($page + 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">&RightArrow;</a>' . "\n";
        } elseif ($page == 3 && ($totalpages - $page) >= 2) {
            echo '<a href="' . $baseurl . '&page=1" class="w3-button">&Leftarrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">&LeftArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 2) . '" class="w3-button">' . ($page - 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">' . ($page - 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">' . ($page + 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 2) . '" class="w3-button">' . ($page + 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">&RightArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $totalpages . '" class="w3-button">&Rightarrow;</a>' . "\n";
        } elseif ($page == 4 && ($totalpages - $page) == 0) {
            echo '<a href="' . $baseurl . '&page=1" class="w3-button">&Leftarrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">&LeftArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 3) . '" class="w3-button">' . ($page - 3) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 2) . '" class="w3-button">' . ($page - 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">' . ($page - 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
        } elseif ($page == 4 && ($totalpages - $page) == 1) {
            echo '<a href="' . $baseurl . '&page=1" class="w3-button">&Leftarrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">&LeftArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 3) . '" class="w3-button">' . ($page - 3) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 2) . '" class="w3-button">' . ($page - 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">' . ($page - 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">' . ($page + 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">&RightArrow;</a>' . "\n";
        } elseif ($page == 4 && ($totalpages - $page) >= 2) {
            echo '<a href="' . $baseurl . '&page=1" class="w3-button">&Leftarrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">&LeftArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 2) . '" class="w3-button">' . ($page - 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">' . ($page - 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">' . ($page + 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 2) . '" class="w3-button">' . ($page + 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">&RightArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $totalpages . '" class="w3-button">&Rightarrow;</a>' . "\n";
        } elseif ($page >= 5 && ($totalpages - $page) == 0) {
            echo '<a href="' . $baseurl . '&page=1" class="w3-button">&Leftarrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">&LeftArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 4) . '" class="w3-button">' . ($page - 4) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 3) . '" class="w3-button">' . ($page - 3) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 2) . '" class="w3-button">' . ($page - 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">' . ($page - 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
        } elseif ($page >= 5 && ($totalpages - $page) == 1) {
            echo '<a href="' . $baseurl . '&page=1" class="w3-button">&Leftarrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">&LeftArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 3) . '" class="w3-button">' . ($page - 3) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 2) . '" class="w3-button">' . ($page - 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">' . ($page - 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">' . ($page + 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">&RightArrow;</a>' . "\n";
        } elseif ($page >= 5 && ($totalpages - $page) >= 2) {
            echo '<a href="' . $baseurl . '&page=1" class="w3-button">&Leftarrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">&LeftArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 2) . '" class="w3-button">' . ($page - 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page - 1) . '" class="w3-button">' . ($page - 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $page . '" class="w3-button w3-black">' . $page . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">' . ($page + 1) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 2) . '" class="w3-button">' . ($page + 2) . '</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . ($page + 1) . '" class="w3-button">&RightArrow;</a>' . "\n";
            echo '<a href="' . $baseurl . '&page=' . $totalpages . '" class="w3-button">&Rightarrow;</a>' . "\n";
        }
        echo '</div>' . "\n";
    }

}

?>
