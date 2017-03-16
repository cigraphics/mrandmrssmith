var $result = null;

$(document).ready(function () {
    $result = $("#result");

    $("#calculator").on("submit", function (e) {
        e.preventDefault();

        $("#calculator button").text('Loading...');

        if ($(this).find("input[name=b]").val() === "0" && $(this).find("select[name=symbol]").val() === "/") {
            alert('Cannot divide by 0');
            return false;
        }
        var $data = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "/calculator/calculate",
            data: $data,
            success: function (data) {
                if (data.status) {
                    $("#result").val(data.result);
                } else {
                    alert(data.result);
                }
                $("#calculator button").text('CALCULATE');
            }
        })
    });
});