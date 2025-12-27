<script>
    const openBtnCont = document.getElementById('openModal-cont');
    const closeBtnCont = document.getElementById('closeModal-cont');
    const overlayCont = document.getElementById('modalOverlay-cont');

    function closeModalCont() {
        overlayCont.style.display = 'none';
        document.body.style.overflow = '';
    }

    openBtnCont.addEventListener('click', () => {
        overlayCont.style.display = 'block';
        document.body.style.overflow = 'hidden';
    });

    closeBtnCont.addEventListener('click', closeModalCont);

    overlayCont.addEventListener('click', (e) => {
        if (e.target === overlayCont) {
            closeModalCont();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && overlayCont.style.display === 'block') {
            closeModalCont();
        }
    });
</script>
<style>
    /* Overlay */
    .modal-overlay-cont {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        display: none;
        z-index: 9999;
    }

    /* Modal */
    .modal-cont {
        position: fixed;
        top: 30px;
        right: 30px;
        bottom: 30px;
        left: 30px;
        background: var(--main);
        border-radius: 12px;
        overflow: hidden;
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

    /* Close Button */
    .close-btn-cont {
        background: none;
        border: none;
        font-size: 22px;
        cursor: pointer;
        color: red;
        font-weight: bold;
        margin: 10px 15px 0 0;
    }

    .desc-prescription {
        height: 34px !important;
        min-height: 34px !important;

        line-height: 18px;
        font-size: 14px;
        padding: 6px 8px;

        box-sizing: border-box;
        resize: vertical;
    }


    .inputs-pre {
        width: 99%;
        margin: 20px auto !important;
        position: relative;
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    .input-pre>select,
    .input-pre>input {
        height: 29px;
        border-radius: 3px;
        padding: 4px;
        font-size: 17px;
    }

    .search-box-pre {}
</style>