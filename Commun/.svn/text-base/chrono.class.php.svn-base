<?php

##################################################################################
# Class: chrono                                                  Date: 09-Apr-2002
# Author: Ariel Filipiak <hapu@correo.com.ar>
#            This code is released under GPL (GNU Public License)                
# Feel free to edit/use so long as you keep this copyright.USE at your own risk! 

class chrono {
    
    var $frmt;
    var $ini;
    var $run;
    var $now;
    var $sum;
    var $sub;
    var $time;
    var $memarr = array();
    var $memkey;
    var $memlap;

    function chrono($s_format = "") {
        $this->frmt = $s_format;
        $this->start();
    }

    function getMicrotime(){ 
        $ts_now = explode(" ", microtime()); 
        return $ts_now[1] + $ts_now[0]; 
    } 

    function format($t_sec){ 
        if (!$this->frmt) $this->frmt = "%01.3f";
        return sprintf($this->frmt, $t_sec);
    } 

    function start() {
        $this->ini  = $this->getMicroTime();
        $this->run = TRUE;
    }

    function mem($s_id = "") {
        if (!$s_id) return "ERR<!-- ID missing -->";
        if (!$this->run) return "ERR<!-- stopped -->";
        $this->time  = $this->lap();
        $this->memarr[$s_id] = $this->sum;
        return $this->time;
    }

    function lap($s_id = "") {
        if (!$this->run) return "ERR<!-- stopped -->";
        $this->now  = $this->getMicroTime();
        $this->sum  = $this->sub + $this->now - $this->ini;
        if ($s_id) {
            if (!$this->memarr[$s_id]) return "ERR<!-- ID not found -->";
            $this->sum  = $this->sum - $this->memarr[$s_id];
        }
        $this->time = $this->format($this->sum);
        return $this->time;
    }

    function stop() {
        $this->time  = $this->lap();
        $this->sub   = $this->sum;
        $this->run   = FALSE;
        return $this->time;
    }

    function getmem() {
        $i = 0;
        $this->memkey = array();
        $this->memlap = array();
        reset($this->memarr);
        while (list ($s_key) = each ($this->memarr)) {
            $this->memkey[] = $s_key;
            $this->memlap[] = $this->lap($s_key);
            $i++;
        }
        return $i;
    }

    function restart() {
        $this->sub = "";
        $this->start();
    }
}

?>