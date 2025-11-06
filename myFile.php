<?php
?>

<script>
    var less_tables = row.less_per_pcs;
    var disc_tables = row.discount_per_pcs;
    var total_pcs = row.total_pcs;
    var gt_less = 0;
    var gt_disc = 0;
    if(less_tables !== ''){
        var gt_less = total_pcs * less_tables;
    }
    if(disc_tables !== ''){
        var gt_disc = total_pcs * disc_tables;
    }
    t_less +=gt_less;
    t_disc +=gt_disc;
    var g_total = gt_less + gt_disc;
    grand_tot += g_total;



    var t_amount = data.amount;
    var g_per = (t_disc/t_amount) * 100;
    $('#total_less').val(t_less);
    $('#total_disc').val(g_per.toFixed(2) + '% |' +t_disc.toFixed(2));
    var grand_less = t_less + t_disc;
    var grand_per = grand_less/t_amount * 100;
    $('#total_less2').val(grand_per.toFixed(2) + '% |' +grand_less.toFixed(2));
</script>
