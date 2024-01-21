<?php
 session_start();
 require("SimpleAuth.php");
 $login = new Login;
 $login->authorize();
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">  <head> <title>Impresion de Voucher</title>  <link href="https://fonts.cdnfonts.com/css/source-code-pro" rel="stylesheet"> <style type="text/css">     table { page-break-inside:auto }     tr    { page-break-inside:avoid; page-break-after:auto }     thead { display:table-header-group }     tfoot { display:table-footer-group } footer { font-size: 9px; color: #f00; text-align: center;} button.right { float: right; }  @media print {  .noprint { display: none; } footer { position: fixed; bottom: 25px; }  @page {      size: auto;     margin: 15mm 2mm 0mm 6mm; } body {     margin:0;     padding:0; } }    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>  <body>

    <div class="container noprint">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Imprimir Vouchers desde nombre de Lotes (batch_name) </h4>
			<a href="index.php?action=clear_login">Desconectarme</a> <button onclick="window.print()" class="right">Imprimir</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">

                                <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Buscar Lote">
                                        <button type="submit" class="btn btn-primary">Filtrar Lote</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div></div>  


                                <?php 
                                    $con = mysqli_connect("localhost","radius","84Uniq@","radius");

                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                    $query = "SELECT * FROM radius.fichas WHERE CONCAT(batch_name) LIKE '$filtervalues'";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>

<table style="display: inline-block; width: 184px; border: 3px solid #000000; margin: 1px;">
<tbody>

<tr style="height: 15px;">
<td style="text-align: center; width: 168px; height: 13px; font-size: 12px;"><strong><?= $items['planname']; ?> = $ <?= $items['plancost']; ?></strong>
<table style="text-align: center; width: 173.562px; background-color: #ffffff; line-height: 110%;">
<tbody>

<tr style="background-color: #eeeeee; height: 11px;">
<td style="width: 68px; height: 11px; border: 1px dotted #000000;">Usuario</td>
<td style="width: 60.5625px; height: 11px; border: 1px dotted #000000;">Clave</td>
</tr>
<tr style="height: 20.7917px;">

<td style="width: 68px; border: 1px solid #5097a4; font-weight: bold; font-size: 21px; height: 20.7917px; font-family: 'Source Code Pro';"><?= $items['username']; ?></td>
<td style="width: 60.5625px; border: 1px solid #5097a4; font-weight: bold; font-size: 21px; height: 20.7917px; font-family: 'Source Code Pro';"><?= $items['value']; ?></td>
</tr>
</tbody>
</table>
<!-- <?php echo $row['planname']; ?> = <?php echo $row['plancost']; ?> --></td>
</tr>
</tbody>
</table>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="4">No se encontro nada alli</td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
               
<footer>
<strong><?= LOTE; ?> =  <?= $items['batch_name']; ?></strong>
</footer>
    </body>
</html>

