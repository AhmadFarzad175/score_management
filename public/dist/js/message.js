$(function () {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    });

    $(".swalDefaultSuccess").click(function () {
        Toast.fire({
            type: "success",
            title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
        });
    });
    $(".swalDefaultInfo").click(function () {
        Toast.fire({
            type: "info",
            title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
        });
    });
    $(".swalDefaultError").click(function () {
        Toast.fire({
            type: "error",
            title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
        });
    });
    $(".swalDefaultWarning").click(function () {
        Toast.fire({
            type: "warning",
            title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
        });
    });
    $(".swalDefaultQuestion").click(function () {
        Toast.fire({
            type: "question",
            title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
        });
    });

    $(".toastrDefaultSuccess").click(function () {
        toastr.success(
            "Lorem ipsum dolor sit amet, consetetur sadipscing elitr."
        );
    });
    $(".toastrDefaultInfo").click(function () {
        toastr.info("Lorem ipsum dolor sit amet, consetetur sadipscing elitr.");
    });
    $(".toastrDefaultError").click(function () {
        toastr.error(
            "Lorem ipsum dolor sit amet, consetetur sadipscing elitr."
        );
    });
    $(".toastrDefaultWarning").click(function () {
        toastr.warning(
            "Lorem ipsum dolor sit amet, consetetur sadipscing elitr."
        );
    });
});
