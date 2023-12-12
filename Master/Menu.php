<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/utsku/index.php?target=";
        $data = [
            array('Text' => 'Home', 'Link' => $base . 'home'),
            array('Text' => 'user', 'Link' => $base . 'user'),
            array('Text' => 'siswa', 'Link' => $base . 'siswa'),
            array('Text' => 'sanksi', 'Link' => $base . 'sanksi'),
        ];
        return $data;
    }
}
