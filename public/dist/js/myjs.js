function showFileInput() {
    // Trigger the file input when the head image is clicked
    document.getElementById("fileInput").click();
}

function handleFileSelect() {
    const fileInput = document.getElementById("fileInput");
    const headImage = document.getElementById("headImage");

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
