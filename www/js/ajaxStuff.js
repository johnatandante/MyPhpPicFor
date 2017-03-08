
function getHtmlForParameter(item) {
    var string = "";
    string += "<h2>Parameter " +  item.Name[0] + " <i>" + getLabelRange(item) +"</i></h2>";
    string += '<input type="number" step="0.1" id="' + item.Name[0] + ' name="' + item.Name[0] +'" ' + getNumericStepperRange(item)  + ' required />';

    return string;
}

function getNumericStepperRange(item){
    var min = '';
    var max = '';

    if(item.Minore[0]){
        max = 'max="' +item.Minore[0] +'"';
    }
    if(item.Maggiore[0]){
        min = 'min="' +item.Maggiore[0] +'"';
    }

    return min + max;
}

function getLabelRange(item) {
    var min = "";
    var max = "";

    if(item.Minore[0]){
        max = "fino a " + item.Minore[0];
    }

    if(item.Maggiore[0]){
        min = "da " + item.Maggiore[0];
    }

    if(min != "" || max != ""){
        min ="("+min;
        max +=")";
    }

    return min + " " + max;

}

$(document).ready(function () {

    function LoadXMLData(){
        var xml = $("#XmlDataParameter").val();
        $.ajax({
            type: "POST",
            url: "./api/evaluate.php",
            data: {
                xml: xml
            },
            success: function (result) {
                if (result.success) {
                    $("#parametersDiv").empty();
                    $("#output").text("...");

                    for(var i = 0; i< result.items.length; i++){
                        var p = result.items[i];
                        if(p.Name && p.Name[0])
                            $("#parametersDiv").append(getHtmlForParameter(p)); 
                    }

                } else {
                    alert('something goes wrong:\n' + result.message);
                }
            },
            error: function (result) {
                alert('error: ' + result);
            }
        });
    }

    LoadXMLData();

    $("#ReloadBtn").click(function (e) {
        e.preventDefault();

        LoadXMLData();

    });

    $("#EvaluateBtn").click(function (e) {
        e.preventDefault();

        $("#output").text("89.0001");
        
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
                    alert('Data inserted');
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