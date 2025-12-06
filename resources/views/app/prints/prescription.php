<!-- barcode -->
<!-- <script src="<?= asset('public/assets/js/barcode.js') ?>"></script> -->
<!-- invoice print -->
<div class="form-container" id="print">

    <!-- check phone -->
    <?php
    $phones = array_filter([
        $invoice_infos['phone1'] ?? '',
        $invoice_infos['phone2'] ?? '',
        $invoice_infos['phone3'] ?? '',
        $invoice_infos['phone4'] ?? '',
    ]);
    ?>
    <!-- top header -->
    <div class="top-inv d-flex align-center">
        <div class="top-inv-text center">
            <h2 class="color-print"></h2>
            <div class="color-print fs14">تولید کننده رنگ های روغنی، پلاستیکی، و مایع رنگ</div>
            <div class="color-print fs12">
                <span><?= implode(' - ', array_map([$this, 'convertEnNumber'], $phones)) ?></span>
            </div>
        </div>
        <div class="top-inv-logo">
            <img src="<?= asset('public/assets/img/logo.png') ?>" class="" alt="logo">
        </div>
    </div>
    <hr class="hr">

    <!-- invoice infos -->
    <div class="d-flex justify-between">
        <div class="top-desc-one mt5">
            <div class="fs15 color-print">نام خریدار: <?= (isset($sale_invoice_print['user_name']) && $sale_invoice_print) ? $sale_invoice_print['user_name'] : 'عمومی' ?></div>
            <div class="fs15 color-print">شماره موبایل: <?= htmlspecialchars($sale_invoice_print['phone'] ?? '- - - -', ENT_QUOTES, 'UTF-8') ?></div>
            <div class="fs14 color-print">آدرس: <?= htmlspecialchars($sale_invoice_print['address'] ?? '- - - -', ENT_QUOTES, 'UTF-8') ?></div>
        </div>
        <div class="top-desc-one mt5 d-flex align-center">
            <div class="fs15 color-print"><svg id="barcode"></svg></div>
        </div>
        <div class="top-desc-one mt5">
            <div class="fs15 color-print bold">شماره فاکتور: <?= '555' ?></div>
            <div class="fs15 color-print">تاریخ:  44444</div>
            <div class="fs15 color-print">توسط: ali</div>
        </div>
    </div>
    <hr class="hr">

</div>


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
<script src="<?= asset('public/assets/js/jspdf.js') ?>"></script>
<script src="<?= asset('public/assets/js/htmlToCanvas.js') ?>"></script>

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