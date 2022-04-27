<?php

    function error($string) {
        return '<div class="alert alert-danger alert-dismissible show fade">
                      <div class="alert-body" style="height: 20px;">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        '.$string.'
                      </div>
                    </div>';
    }

    function success($string) {
        return '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body" style="height: 20px;">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        '.$string.'
                      </div>
                    </div>';
    }

    function _ago($tm,$rcs = 0) {
        $cur_tm = time();
        $dif = $cur_tm-$tm;
        $pds = array('second','minute','hour','day','week','month','year','decade');
        $lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);
        for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);
        $no = floor($no);
        if($no <> 1)
            $pds[$v] .='s';
        $x = sprintf("%d %s ",$no,$pds[$v]);
        if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0))
            $x .= time_ago($_tm);
        return $x;
    }

    class stats {

        function totalUsers($database) {
            $result = $database->query("SELECT COUNT(*) FROM users");
            return $result->fetchColumn(0);
        }

        function totalSearch($database) {
            $result = $database->query("SELECT COUNT(*) FROM logs");
            return $result->fetchColumn(0);
        }

        function totalDatabases($username) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://154.52.41.67/f5327f9baabe134177c4ca7455c3356a/8054972c64a02b053fcfd92bc00b35a2.php");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_NOSIGNAL, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }

        function totalLines($username) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://154.52.41.67/f5327f9baabe134177c4ca7455c3356a/610bc02e0eae8e7771a27f63bf427c55.php");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_NOSIGNAL, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }

    }

?>