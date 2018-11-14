<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{
    //  THE TAGGABLE TABLE RELATES TWO TABLES TOGETHER.
    // primaryly, this table contains data that is unique (What they have in common [id])
    //  to both tables {In this case, the tag table and the Post/Videos table}
}
