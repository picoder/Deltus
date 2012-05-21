<?php
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Baner extends DV_Controller
    {

        public function _remap($method)
        {
            $this -> index();
        }

        public function index()
        {
            // Setting permissions
            switch($this->uri->segment($this->method_seg()))
            {
                default :
                // access without permission
                    break;
            }

            // Checking permissions
            if ($this -> check_permission('permissions/permissions', 'start/start/no_access'))
            {
                // Additional steps if no permission
                return;
            }

            // Running methods (if we have right permission)
            switch($this->uri->segment($this->method_seg()))
            {
                default :
                    $this -> remapped();
                    break;
            }

        }

        public function remapped()
        {
            // inicjujemy generator licz losowych
            srand((float)microtime() * 1000000);

            // tablica zawierajaca tablice z banerami i linkami
            $ban[] = array('baner1.gif' => 'www.wp.pl');
            $ban[] = array('baner2.gif' => 'www.onet.pl');
            $ban[] = array('baner3.gif' => 'www.php.net');
            $ban[] = array('baner4.gif' => 'www.php.pl');
            $ban[] = array('baner5.gif' => 'www.kess.com.pl');

            // wybieramy losowy element z tablicy
            $ban_rand = $ban[array_rand($ban)];

            // wyswietlamy podlinkowany baner
            foreach ($ban_rand as $key => $value)
            {
                echo $value.br();
                
            }
        }

    }
