<?php

require_once 'header.php';
require_once 'Db.php';
require_once 'Pagination.php';
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
        <table class="table table-bordered border-primary">
            <thead>
            <tr>
                <th scope="col">תעודת זהות</th>
                <th scope="col">סיסמה אישית</th>
                <th scope="col">עריכה</th>
            </tr>
            </thead>
            <tbody>

    <?php

    $page = $_GET['page'] ?? 1;
    $per_page = 10;
    $total = $db->countLinesInDb();
    $pg = new Pagination($page, $per_page, $total);
    $start = $pg->getStart();
    $data_from_db = $db->getDataFromDbRashi($start, $per_page);

    foreach ($data_from_db as $item)
    {
        echo "
               <tr><td>" . $item['tz'] . "</td><td>" . $item['code_ishi'] . "</td><td>
               <form method='post'>
               <input type='hidden' name='edit' value=" . $item['id'] . ">
              <button class='btn btn-sm btn-primary me-md-2' type='submit'>עריכה</button>
              </form>
              <input type='hidden' name='delete'>
              <button class='btn btn-sm btn-danger' type='submit'>למחוק</button>
              </td></tr>";
    }

    if (isset($_POST['edit']))
    {
        $id = $_POST['edit'];
        $data = $db->getDataFromDbToEdit($id);
//        print_r($data[0]['tz']);

        echo "<form method='post' class='row g-3'>
                <div class='row g-2 justify-content-center'>
                    <div class='col-2 mb-3'>
                      <input class='form-control form-control-sm' name='tz' type='text' value=" . $data[0]['tz'] . ">
                  </div>
                    <div class='col-2 mb-3'>
                      <input class='form-control form-control-sm' name='code_ishi' type='text' value=" . $data[0]['code_ishi'] . ">
                  </div>
                    <div class='col-1 mt-1'>
                    <button class='btn btn-success btn-sm' type='submit'>שמור</button>
                  </div>
                </div>
                </form>";
    }
    if (isset($_POST['tz']) || $_POST['code_ishi'])
    {
        
        print_r($_POST);
    }
    ?>

            </tbody>
        </table>
</div>
</div>
<div class="container">
    <div class="shadow p-3 mb-1 bg-body rounded">
        <?php echo $pg->getHtml();?>
    </div>

</div>
<!--        ======================================================================================================================================-->

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

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
