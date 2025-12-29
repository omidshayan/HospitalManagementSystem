<script>
    const openBtnCont = document.getElementById('openModal-cont');
    const closeBtnCont = document.getElementById('closeModal-cont');
    const overlayCont = document.getElementById('modalOverlay-cont');

    // function openModalCont() {
    //     overlayCont.classList.add('show');
    //     document.body.style.overflow = 'hidden';
    // }

    function closeModalCont() {
        overlayCont.classList.remove('show');
        document.body.style.overflow = '';
    }

    window.addEventListener('DOMContentLoaded', () => {
        openModalCont();
    });

    // openBtnCont.addEventListener('click', openModalCont);

    closeBtnCont.addEventListener('click', closeModalCont);

    overlayCont.addEventListener('click', (e) => {
        if (e.target === overlayCont) {
            closeModalCont();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && overlayCont.classList.contains('show')) {
            closeModalCont();
        }
    });
</script>

<style>
    /* Overlay */
    .modal-overlay-cont {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        display: block;
        opacity: 0;
        pointer-events: none;
        z-index: 9999;
        direction: ltr !important;

        transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .modal-overlay-cont.show {
        opacity: 1;
        pointer-events: auto;
    }

    .modal-cont {
        width: calc(100% - 80px) !important;
        margin: 30px auto 0 auto;
        height: calc(100svh - 70px);
        background: var(--main);
        border-radius: 12px;
        overflow: hidden;
        padding: 0 10px 0 10px;
        position: relative;
        opacity: 0;
        transform: translateY(-30px) scale(0.95);
        filter: blur(2px);
        transition:
            opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1),
            transform 0.4s cubic-bezier(0.4, 0, 0.2, 1),
            filter 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow-y: auto;
    }

    .modal-overlay-cont.show .modal-cont {
        opacity: 1;
        transform: translateY(0) scale(1);
        filter: blur(0);
    }

    /* Header */
    .modal-header-cont {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 20px;
        border-bottom: 1px solid #e5e5e5;
    }

    /* Body */
    .modal-body-cont {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
    }

    .colse-btn-modal {
        text-align: right;
    }

    /* Close Button */
    .close-btn-cont {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: red;
        font-weight: bold;
        margin: 7px 7px 0 0;
        direction: rtl !important;
    }

    /* body */
    .pre-main {
        width: 100%;
        margin: 0 auto;
        justify-content: space-between;
    }

    .pre-body-right {
        width: 84%;
    }

    .pre-body-left {
        width: 280px !important;
        margin-left: 2px;
        text-align: left !important;
    }

    .patient-container {
        width: 265px !important;
    }


    .inputs-pre::-webkit-scrollbar {
        width: 10px;
        height: 10px;
    }

    .inputs-pre::-webkit-scrollbar-thumb {
        background-color: rgba(100, 100, 100, 0.5);
        border-radius: 10px;
        border: 2px solid transparent;
        background-clip: content-box;
    }



    /* top items */
    .inputs-pre {
        display: flex;
        gap: 10px;
        width: 99%;
        margin: 5px auto !important;
        overflow-x: auto;
        box-sizing: border-box;
        flex-wrap: nowrap;
        align-items: flex-start;
        user-select: none;
    }

    .inputs-pre>.input-pre,
    .inputs-pre>.search-box-pre,
    .inputs-pre>.count-pre,
    .inputs-pre>.other-select-p,
    .inputs-pre>.desc-pre {
        flex-grow: 1;
        flex-shrink: 1;
        flex-basis: 0;
        min-width: 130px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
    }

    .search-box-pre {
        flex-grow: 1.5 !important;
        min-width: 260px !important;
    }

    .search-box-pre>ul {
        flex-grow: 1.5 !important;
        min-width: 260px !important;
        width: 19% !important;
    }

    .desc-pre {
        min-width: 170px !important;
    }

    .input-pre>select,
    .input-pre>input,
    .search-box-pre>input,
    .count-pre>select,
    .other-select-p>select,
    .desc-pre>textarea {
        height: 35px;
        border-radius: 3px;
        padding: 4px 8px;
        transition: 0.4s;
        background-color: var(--main) !important;
        min-width: 100%;
        box-sizing: border-box;
    }

    .desc-prescription {
        min-height: 37px !important;
        line-height: 18px;
        font-size: 14px;
        resize: vertical;
    }

    .add-drug-pre {
        flex-grow: 0;
        flex-shrink: 0;
        width: 150px;
        min-width: 150px;
    }

    @media screen and (max-width: 768px) {
        .inputs-pre {
            flex-wrap: wrap;
        }

        .inputs-pre>div {
            flex-basis: 100%;
            min-width: auto;
        }
    }

    /* end top itmes */


    /* ////// pre items */
    .content-create-pre {
        width: 100%;
        background-color: var(--simillar);
        border-radius: 10px;
        padding: 20px;
        border: 1px solid var(--border);
        margin: 0 auto;
        overflow-x: auto;
        position: relative;
    }

    .input-pre input {
        background-color: var(--main);
        border: none;
        width: 90%;
        height: 35px;
        padding: 8px;
        border-radius: 3px;
        color: var(--text);
        font-size: 16px;
        transition: 0.4s;
        outline: none;
        border: 1px solid var(--border);
        margin-bottom: 25px;
    }

    .input-pre select {
        background-color: var(--main);
        border: none;
        width: 90%;
        height: 35px;
        padding: 4px;
        border-radius: 3px;
        color: var(--text);
        font-size: 16px;
        outline: none;
        border: 1px solid var(--bg);
    }

    .input-pre select option {
        font-size: 16px;
    }

    .input-pre input:focus {
        outline: none !important;
        border: 1px solid var(--hover);
        box-shadow: 0 0 8px var(--hover);
        transition: 0.4s;
    }

    .input-pre>textarea {
        background-color: var(--main);
        border: 1px solid var(--border);
        transition: 0.4s;
        color: var(--color);
        font-size: 18px !important;
        padding: 8px !important;
        border-radius: 5px;
    }

    .input-pre textarea:focus {
        outline: none !important;
        border: 1px solid var(--hover);
        box-shadow: 0 0 4px var(--hover);
    }

    .input-pre select:focus {
        outline: none !important;
        border: 1px solid var(--hover);
        box-shadow: 0 0 4px var(--hover);
    }

    /* btns */
    .add-drug-pre {
        position: absolute;
        top: 10px;
        left: 10px;
        min-width: 100px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid var(--bg);
        background-color: var(--bg);
        color: black;
        font-weight: bold;
        font-size: 16px;
        cursor: grab;
        user-select: none;
        z-index: 1000;
        transition: background-color 0.4s ease-in, color 0.4s ease-in;
    }

    .add-drug-pre:active {
        cursor: grabbing;
    }



    .add-drug-pre:hover {
        background-color: var(--main) !important;
        color: var(--text) !important;
        border: 1px solid var(--bg);
    }




    select option:disabled {
        color: #0ebbffff;
    }

    .search-back {
        width: 24% !important;
    }

    .nav-item:focus {
        outline: 2px solid blue;
        background-color: #64646413;
    }


    /* status */
    .close-btn {
        font-size: 28px;
        margin-right: 7px;
        color: red;
        font-weight: bold;
        opacity: 0;
        transition: 0.4s;
    }

    .label-form:hover .close-btn {
        opacity: 1;
        cursor: pointer;
    }

    .search-item-left {
        text-align: left !important;
    }

    .t84 {
        top: 136px;
    }

    .search-item-left {
        text-align: right;
    }

    .search-item-left {
        padding: 7px 10px;
        cursor: pointer;
    }

    .search-item-left:hover {
        background-color: var(--border);
    }

    #closePrescriptionBtn {
        position: relative;
    }

    .heart-beat {
        display: inline-block;
        color: #d10000;
        font-size: 18px;
        animation: heartbeat 1.4s infinite;
        transform-origin: center;
    }

    @keyframes heartbeat {
        0% {
            transform: scale(1);
        }

        14% {
            transform: scale(1.3);
        }

        28% {
            transform: scale(1);
        }

        42% {
            transform: scale(1.3);
        }

        70% {
            transform: scale(1);
        }

        100% {
            transform: scale(1);
        }
    }

    .addBtn {
        width: 140px;
        background-color: var(--bg) !important;
        cursor: pointer;
        color: var(--text) !important;
        margin: 20px 30px 0 0;
        transition: all .3s ease-in;
        border-radius: 3px !important;
        font-size: 15px;
        border: 1px solid var(--bg) !important;
        padding: 10px;
        font-weight: bold;
    }
    .addBtn:hover {
        background-color: var(--main) !important;
        color: var(--text) !important;
        border: 1px solid var(--bg);
    }
</style>