
<h5>
<?php echo $tickets; 

foreach ($tickets as $t): 
        echo "id" . $t->id;
        echo $t->created;
        $dueDate = date_add($t->created,date_interval_create_from_date_string("1 day"));
        echo "due " . $dueDate;
        $current = date('m/d/Y', time());
        //;

    if(strtotime($dueDate) < strtotime($current))
    {
       echo "overdue";
       echo $current;
   }
   else {
    echo "not overdue";
    echo $current . "!";
   }
endforeach;
?>
</h5>