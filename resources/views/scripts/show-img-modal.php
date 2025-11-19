<?php
function renderImageWithModal($imagePath, $defaultImagePath = 'public/assets/img/empty.png', $altText = 'Image')
{
    $escapedImagePath = htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8');
    $escapedDefaultImagePath = htmlspecialchars($defaultImagePath, ENT_QUOTES, 'UTF-8');
    $escapedAltText = htmlspecialchars($altText, ENT_QUOTES, 'UTF-8');
    $finalPath = $imagePath ? $escapedImagePath : $escapedDefaultImagePath;
    return '<img class="img w50 cursor-p" src="' . asset($finalPath) . '" alt="' . $escapedAltText . '" onclick="openModal(\'' . asset($finalPath) . '\')">';
}
?>

<script>
    function openModal(imageSrc) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');

        modal.style.display = 'flex'; // Use flexbox for centering
        modalImage.src = imageSrc;
    }

    function closeModal(event) {
        const modal = document.getElementById('imageModal');

        // Close modal only if clicked outside the image or on the close button
        if (event.target.id === 'imageModal' || event.target.className === 'close') {
            modal.style.display = 'none';
        }
    }
</script>
<div id="imageModal" class="show-modal-img" onclick="closeModal(event)">
    <span class="close" onclick="closeModal(event)">&times;</span>
    <img class="modal-content" id="modalImage">
</div>