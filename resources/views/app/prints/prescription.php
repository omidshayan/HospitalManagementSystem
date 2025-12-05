<!-- invoice print -->
<style>
    * {
        margin: 0;
        padding: 0;
    }
.a4{
    width: 297mm;
    height: 210mm;
    background-color: green;
}
    .main-print {
        width: 940px;
        height: 620px;
        display: flex;
        justify-content: space-between;
        background-color: black;
    }

    .print-right {
        width: 170px;
        background-color: red;
        height: 600px;
    }
        .print-left {
        width: 170px;
        background-color: red;
        height: 600px;
    }
    .print-center{
        margin-top: 30px;
        color: white;
    }
</style>


<div class="a4">

    <div class="form-container" id="print">
        <div class="main-print">
            <div class="print-left">

            </div>
            <div class="print-center">
                <h1>کلینیک مهر سلامت</h1>
            </div>

                        <div class="print-right">
                اسم مریض:............
            </div>
        </div>
    </div>

</div>