Content-type: text/html; charset=utf-8
From: [from]
To: [to]
Subject: [subject]

<style type="text/css">
html { font: 13px "Lucida Grande", "Lucida Sans Unicode", Tahoma, Verdana, sans-serif; padding: 20px; position: relative; text-align: center; background: #efefef; }

#header, #body { width: 600px; margin: 0 auto; text-align: left; }
#header { width: 680px; padding: 0; }
#body { background: white; padding: 40px; }

h1 { font-size: 30px; margin-bottom: 4px; }
h2 { margin-top: 0; color: #999; font-weight: normal; }

address { font-style: normal; }
fieldset { border: none; border-top: 1px solid #dadada; margin: 20px 40px 20px 0; }
fieldset legend { display: block; font-weight: bold; color: #999; }
table { clear: both; }
table.transaction th { text-align: left; }
.labels { width: 100%; }
table.labels td { vertical-align: top; }
h1 { margin-bottom: 0; }
p { margin-bottom: 24px; }

.order { width: 100%; overflow: hidden; border: none; }
.order td { border: none; }
.order th { font-weight: bold; text-align: left; }
.order .item { width: 50%; }
.order td.qty { text-align: center; }
.order .money,
.order .total,
.order .buttons td { text-align: right; }
.order .remove { font-size: 12px; }
.order tr.totals th,.order tr.totals td { padding: 10px 0 0 0; }
</style>
<html>

<div id="header">
<h1><?php bloginfo('name'); ?></h1>
<h2><?php _e('Order','Shopp'); ?> <?php shopp('purchase','id'); ?></h2>
</div>
<div id="body">
	
<?php shopp('purchase','receipt'); ?>

<?php if (shopp('purchase','notpaid')): ?> 
    <?php if (shopp('checkout','offline-instructions','return=1')): ?>
    <p><?php shopp('checkout','offline-instructions'); ?></p>
    <?php endif; ?>
<?php endif; ?>	

</div>

</html>