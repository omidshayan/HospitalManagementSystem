<style>
.form-container {
    width: 210mm; 
    height: 297mm;
    margin: 0 auto;
    padding: 10px 10px 0 10px;
    box-sizing: border-box;
    font-size: 12pt;
    background-color: #fff;
    color: black;
}

</style>

<style>
    /* media */
    @media print {

        @page {
            size: auto;
            margin: 0;
        }

        .no-print {
            display: none !important;
        }

        .order-invoice {
            width: 100%;
            padding: 0;
            margin: 0;
            display: block;
        }

        .factor-print {
            width: 100%;
            box-sizing: border-box;
            padding: 5px;
        }

        .order-invoice-print {
            width: 100%;
            border-collapse: collapse;
        }

        .order-invoice-print th,
        .order-invoice-print td {
            border-bottom: 1px dashed #000;
            padding: 4px;
            text-align: center;
        }

        .factor-logo {
            max-width: 60px;
            height: auto;
        }

        thead th {
            font-size: 11px !important;
        }

        tbody td {
            font-size: 12px !important;
        }
    }
</style>
