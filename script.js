document.addEventListener("DOMContentLoaded", () => {
    const galleryItems = document.querySelectorAll(".gallery-item");
    const modal = document.querySelector(".modal");
    const modalImage = document.getElementById("modal-image");
    const modalVideo = document.getElementById("modal-video");
    const modalVideoSource = modalVideo.querySelector("source");
    const closeModal = document.querySelector(".close");
    const downloadBtn = document.getElementById("download-btn");

    // Open modal when gallery item is clicked
    galleryItems.forEach(item => {
        item.addEventListener("click", () => {
            const type = item.dataset.type;
            const src = item.tagName === "VIDEO" ? item.querySelector("source").src : item.src;

            if (type === "image") {
                modalImage.src = src;
                modalImage.style.display = "block";
                modalVideo.style.display = "none";
            } else if (type === "video") {
                modalVideoSource.src = src;
                modalVideo.load(); // Reload video source
                modalVideo.style.display = "block";
                modalImage.style.display = "none";
            }

            // Update download button
            downloadBtn.href = src;
            downloadBtn.download = src.split("/").pop(); // Set download filename

            modal.style.display = "flex";
        });

        // Autoplay video on hover
        item.addEventListener("mouseenter", () => {
            if (item.dataset.type === "video") {
                const videoElement = item.querySelector("video");
                videoElement.play();
            }
        });

        // Pause video when not hovering
        item.addEventListener("mouseleave", () => {
            if (item.dataset.type === "video") {
                const videoElement = item.querySelector("video");
                videoElement.pause();
                videoElement.currentTime = 0;
            }
        });
    });

    // Close modal
    closeModal.addEventListener("click", () => {
        modal.style.display = "none";
        modalImage.src = "";
        modalVideo.pause();
        modalVideoSource.src = ""; // Reset the video source
    });

    // Close modal on outside click
    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
            modalImage.src = "";
            modalVideo.pause();
            modalVideoSource.src = ""; // Reset the video source
        }
    });
});