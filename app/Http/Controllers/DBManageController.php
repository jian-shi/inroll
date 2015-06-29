<?php
/**
 * Created by PhpStorm.
 * User: jshi
 * Date: 26/06/15
 * Time: 5:02 PM
 */

    Find GNA People
        select * from electors e
        where e.id NOT IN
        (Select id from electors_jun)
    Set is_GNA 1

    Find GNA in new Roll
        if gna in new roll
        set is_GNA =0;


    Find New on the roll
        select * from electors_jun ej
        where ej.id NOT IN
        (Select id from electors)
    Put New in DB and set address_id

    Show New Elector in area
