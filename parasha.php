<?php

require_once 'header.php';
require_once 'Db.php';
$db = new Db();
?>
<body>
<div class="container">
    <div class="shadow p-3 mb-1 bg-body rounded">
        <form method="post" enctype='multipart/form-data'>
        <div class="input-group">
            <input type="file" class="form-control" name="uploadfile" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
<!--            <button class="btn btn-outline-secondary" type="submit">העלה קובץ</button>-->
            <input type="submit" name="submit" class="btn btn-outline-secondary">
        </div>
        </form>
    </div>
</div>

<div class="container text-center">
    <div class="shadow p-3 mb-1 bg-body rounded">

<!--        ======================================================================================================================================-->

        <table id="example" class="table table-striped" style="width:100%">
            <thead>
            <tr>
                <th>Id</th>
                <th>קוד מנוי</th>
                <th>תעודת זהות</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($db->readDataFromDbRashi() as $key)
                {
                    echo "<tr><td>$key[id]</td><td>$key[code_ishi]</td><td>$key[tz]</td></tr>";
                }
            ?>
            </tbody>
        </table>

<!--        ======================================================================================================================================-->

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
<?php

if (!empty($_POST))
{
    require_once "Classes/PHPExcel/IOFactory.php";

    require 'Classes/PHPExcel.php';


    $uploadfile = $_FILES['uploadfile']['tmp_name'];

    $objExcel=PHPExcel_IOFactory::load($uploadfile);


    foreach($objExcel->getWorksheetIterator() as $worksheet)
    {
        $highestrow = $worksheet->getHighestRow();
        for($row = 0; $row <= $highestrow; $row++)
        {
            $code_ishi = $worksheet->getCellByColumnAndRow(0,$row)->getValue();
            $tz  = $worksheet->getCellByColumnAndRow(1,$row)->getValue();
            if ($tz != '' && $code_ishi != '')
            {
                $db->inserDataToDb($tz, $code_ishi);
            }
        }


    }
    unset($_POST);
}
?>

</body>
</html>
