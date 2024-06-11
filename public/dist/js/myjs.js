function showFileInput(fileInputId) {
    // Trigger the file input when the head image is clicked
    document.getElementById(fileInputId).click();
}

function handleFileSelect(fileInputId, headImageId) {
    const fileInput = document.getElementById(fileInputId);
    const headImage = document.getElementById(headImageId);

    // Check if a file is selected
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            // Update the src attribute of the headImage element
            headImage.src = e.target.result;
        };

        // Read the selected file as a Data URL
        reader.readAsDataURL(fileInput.files[0]);
    }
}
