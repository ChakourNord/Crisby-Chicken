<?php switch($code ?? ''): ?>
<?php case 'bulk_delete': ?>
<button class="btn btn-primary" onclick="deleteItems();">Delete Selected</button>

<script>
function deleteItems(){
var r = confirm("Confirm deletion of " + items.length + " items.");
if (r == true) {
  Xcrud.request('.xcrud-ajax',Xcrud.list_data('.xcrud-ajax',{action: 'bulk_delete', task:'action',selected:items,table:'million',identifier:'id'}))
  items = [];
}       
}
</script>
<?php break; ?>




<?php case 'table_join': ?>

<script>
    $(document).ready(function() {
        $(".xcrud-list").tableHeadFixer({"head" : false, "left" : 2}); 
    });
</script>

<?php endswitch; ?>

