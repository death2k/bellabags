<?php

namespace Codemy\Models;

class PageAdmin extends Page implements Interface
{
    
    public function __construct($opts = array(), $tpl_dir = "/views/admin")
    {
        parent::__construct($opts, $tpl_dir);
    }

}
