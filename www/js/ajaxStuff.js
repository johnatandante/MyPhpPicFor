$(document).ready(function () {

    $("#EvaluateBtn").click(function (e) {
        e.preventDefault();

        var xml = $("#XmlDataParameter").text();

        $.ajax({
            type: "POST",
            url: "./api/evaluate.php",
            data: {
                xml: xml
            },
            success: function (result) {
                if (result.success) {
                    alert('ok');
                } else {
                    alert('something goes wrong:\n' + result.message);
                }
            },
            error: function (result) {
                alert('error: ' + result);
            }
        });

    });

    $("#StoreBtn").click(function (e) {
        e.preventDefault();

        var xml = $("#XmlDataParameter").text();
        var output= $("#output").text();

        $.ajax({
            type: "POST",
            url: "./api/submitdata.php",
            data: {
                xml: xml,
                output: output
            },
            success: function (result) {
                var res = JSON.parse(result);
                if (res.success) {
                    alert('ok');
                } else {
                    alert('something goes wrong:\n' + result.message);
                }
            },
            error: function (result) {
                alert('error');
            }
        });
    });
});