   <?php
    $title = 'فاکتور';
    include_once('resources/views/layouts/header.php');
    ?>
   <!-- barcode -->
   <script src="<?= asset('public/assets/js/barcode.js') ?>"></script>
   <!-- invoice print -->
   <div class="form-container mt20" id="print">

       <!-- top header -->
       <div class="top-inv d-flex align-center">
           <div class="top-inv-text center">
               <h2 class="color-print"><?= $factor_infos['center_name'] ?></h2>
               <div class="color-print fs14"><?= $factor_infos['slogan'] ?></div>
               <div class="color-print fs12 bold">
                   <span><?= $factor_infos['phone1'] ?></span>
                   <span><?= $factor_infos['phone2'] ?></span>
                   <span><?= $factor_infos['phone3'] ?></span>
                   <span><?= $factor_infos['phone4'] ?></span>
               </div>
           </div>
           <h3 class="center color-print">فـــاکـتـور برگــشت از خـــریــد</h3>
           <div class="top-inv-logo">
               <img src="<?= asset('public/assets/img/logo.png') ?>" class="" alt="logo">
           </div>
       </div>
       <hr class="hr">

       <!-- invoice infos -->
       <div class="d-flex justify-between">
           <div class="top-desc-one mt5">
               <div class="fs15 color-print"> نام خریدار: <span>ali jan sedighi </span></div>
               <div class="fs15 color-print"> شماره موبایل: <span>07999999</span></div>
               <div class="fs14 color-print"> آدرس: <span>shaher dsafldj no</span></div>
           </div>
           <div class="top-desc-one mt5 d-flex align-center">
               <div class="fs15 color-print"><svg id="barcode"></svg></div>
           </div>
           <div class="top-desc-one mt5">
               <div class="fs15 color-print bold"> شماره فاکتور: <span>dfd33</span></div>
               <div class="fs15 color-print"> تاریخ: <span>1404/3/3</span></div>
               <div class="fs15 color-print"> توسط: <span>ahmad jan</span></div>
           </div>
       </div>

       <!-- products details -->
       <table class="table-print w100 color-print center mt15">
           <thead>
               <tr class="fs14">
                   <th class="w20 fs11">شماره</th>
                   <th class="w300">نام محصول</th>
                   <th>تعداد بسته</th>
                   <th>تعداد جز</th>
                   <th>تعداد کل</th>
                   <th>قیمت واحد</th>
                   <th class="fs11">تخفیف</th>
                   <th>قیمت کل</th>
               </tr>
           </thead>

           <tbody>

               <tr>
                   <td>1</td>
                   <td class="w300">product name</td>
                   <td class="w80">33 <span class="fs12">baste</span></td>
                   <td class="w80">43 <span class="fs12">baste</span></td>
                   <td class="w80">333 <span class="fs12">baste</span></td>
                   <td class="w80">333333</td>
                   <td>0</td>
                   <td class="w80">43233</td>
               </tr>

           </tbody>
       </table>

       <!-- amount details -->
       <table class="table-print w100 color-print center mt5">
           <thead>
               <tr>
                   <th colspan="4">مبلغ کل</th>
               </tr>
           </thead>
           <tbody>
               <tr class="fs15">
                   <td colspan="1" class="text-right bold w300">price to number_to_dary_word<span class="fs11">افغانی</span></td>
                   <td colspan="1" class="w200 bold"> افغانی 333 </td>
               </tr>
               <tr class="fs15">
                   <td class="bold"> پرداختی: 333</td>
                   <td class="bold"> باقیمانده: 3333</td>
               </tr>

           </tbody>
       </table>

       <!-- seller details -->

       <table class="table-print w100 color-print center mt5">
           <thead>
               <tr>
                   <th colspan="4">جزئیات مالی حساب </th>
               </tr>
           </thead>
           <tbody>
               <tr class="fs15">
                   <td class="bold">مانده از حساب قبلی:
                       <span>4444</span>
                   </td>
                   <td class="bold"> مانده از این فاکتور: <span>3333</span></td>
                   <td class="bold">مجموع بدهی</td>
                   <td class="bold">333333</td>
               </tr>
           </tbody>
       </table>

       <div class="d-flex justify-between">
           <div class="fs12 center mt5 color-print"><?= $factor_infos['address'] ?></div>
           <div class="fs12 center mt5 color-print"><?= $factor_infos['website'] ?> - E-Mail: <?= $factor_infos['email'] ?></div>
       </div>
   </div>

   <!-- <?php
        $timestamp = $sale_invoice_print['date'];
        $discount = ($sale_invoice_print['discount']) ? '-' . $this->formatPrice($sale_invoice_print['discount']) : '';
        $date = date('Ymd', $timestamp);
        $fa =  $sale_invoice_print['id'] . '-' . $date . $discount;
        ?> -->

   <!-- barcode -->
   <script>
       var qrcode = "<?= $fa ?>";
       JsBarcode("#barcode", qrcode, {
           format: "CODE128",
           lineColor: "#000",
           width: 1,
           height: 40,
           displayValue: false,
           text: "",
           textAlign: "center",
       });
   </script>

   <!-- barcode lib -->
   <!-- <script src="<?= asset('public/assets/js/jspdf.js') ?>"></script>
    <script src="<?= asset('public/assets/js/htmlToCanvas.js') ?>"></script> -->

   <script>
       const {
           jsPDF
       } = window.jspdf;

       async function generateAndPrintPDF() {
           const doc = new jsPDF({
               orientation: "portrait",
               unit: "mm",
               format: "a4",
           });

           const element = document.querySelector(".form-container");
           const canvas = await html2canvas(element, {
               scale: 2,
               useCORS: true,
           });

           const imgData = canvas.toDataURL("image/jpeg", 0.9);
           const imgWidth = 205;
           const imgHeight = 270;
           const marginLeft = 10;

           doc.addImage(imgData, "JPEG", marginLeft, 0, imgWidth - marginLeft, imgHeight);

           const pdfBlob = doc.output("blob");
           const pdfUrl = URL.createObjectURL(pdfBlob);
           const printWindow = window.open(pdfUrl, "_blank");
           if (printWindow) {
               printWindow.addEventListener("load", () => {
                   printWindow.print();
               });
           }
       }

       window.addEventListener("load", function() {
           generateAndPrintPDF();
       });
   </script>

   <?php
    include_once('resources/views/layouts/footer.php') ?>